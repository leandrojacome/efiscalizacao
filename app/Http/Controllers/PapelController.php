<?php

namespace App\Http\Controllers;

use App\Http\Requests\PapelFormRequest;
use App\Models\Papel;
use App\Repositories\PapelRepository;
use Illuminate\Http\Request;

class PapelController extends Controller
{
    /**
     * @var PapelRepository
     */
    private $papel;

    public function __construct(PapelRepository $papel)
    {
        $this->middleware(['auth','role:super-admin']);
        $this->papel = $papel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $papeis = $this->papel->orderBy('slug')->paginate(20);
        return view('papel.index', compact('papeis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('papel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PapelFormRequest $request)
    {
        Papel::create($request->all());
        return redirect()->route('papel.index')
            ->with('msg','Papel cadastrado com sucesso!')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $papel = $this->papel->find($id);
        return view('papel.show', compact('papel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $papel = $this->papel->find($id);
        return view('papel.edit', compact('papel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PapelFormRequest $request, $id)
    {
        $update = $this->papel->find($id)->update($request->all());
        return redirect()->route('papel.index')
            ->with('msg', 'Papel atualizado com sucesso!')
            ->with('status', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $papel = $this->papel->find($id);
        $papel->delete();
        return redirect()->route('papel.index')
            ->with('msg', 'Papel removido com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $papeis = $this->papel->search($request->all());
        return view('papel.index', compact('papeis'));
    }
}
