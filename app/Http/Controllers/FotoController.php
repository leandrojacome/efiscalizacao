<?php

namespace App\Http\Controllers;

use App\Repositories\FotoRepository;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FotoController extends Controller
{
    /**
     * @var FotoRepository
     */
    private $foto;

    public function __construct(FotoRepository $foto)
    {
        $this->middleware (['auth','role:super-admin|gerencia|administrativo']);
        $this->foto = $foto;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($diligencia_id)
    {
        return view('foto.index', compact('diligencia_id'));
    }

    public function upload(Request $request, $diligencia_id)
    {
        $image = $request->file('file');
        $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
        $img_thub = Image::make($request->file('file'));
        $img_thub->resize(150, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('uploads/thumbs') . "/" . $imageName);

        $img_original = Image::make($request->file('file'));
        $img_original->resize('1010', null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(public_path('uploads') . "/" . $imageName);

        $img_90 = Image::make($request->file('file'));
        $img_90->resize('1010', null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->rotate(90)->save(public_path('uploads/90') . "/" . $imageName);

        $img_grey = Image::make($request->file('file'));
        $img_grey->resize('1010', null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->greyscale()->rotate(90)->save(public_path('uploads/grey') . "/" . $imageName);

        $this->foto->create(['diligencia_id' => $diligencia_id, 'path' => $imageName]);
        return response()->json(['success'=>$imageName]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($foto_id)
    {
        $foto = $this->foto->find($foto_id);
        unlink(public_path('uploads/thumbs') . "/" . $foto->path);
        unlink(public_path('uploads') . "/" . $foto->path);
        unlink(public_path('uploads/90') . "/" . $foto->path);
        unlink(public_path('uploads/grey') . "/" . $foto->path);
        $foto->delete();
        return redirect()->back();
    }
}
