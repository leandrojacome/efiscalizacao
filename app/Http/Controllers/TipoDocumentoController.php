<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoDocumentoFormRequest;
use App\Repositories\TipoDocumentoRepository;
use Illuminate\Http\Request;


class TipoDocumentoController extends Controller
{
    /**
     * @var TipoDocumentoRepository
     */
    private $tipoDocumento;

    public function __construct(TipoDocumentoRepository $tipoDocumento)
    {
        $this->middleware(['auth','role:super-admin|gerencia|administrativo']);
        $this->tipoDocumento = $tipoDocumento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposDocumento = $this->tipoDocumento->orderBy('nome')->paginate(20);
        return view('tipo_documento.index', compact('tiposDocumento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_documento.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoDocumentoFormRequest $request)
    {
        $this->tipoDocumento->create($request->all());
        return redirect()->route('tipo_documento.index')
            ->with('msg','Tipo de Documento cadastrado com sucesso!')
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
        $tipoDocumento = $this->tipoDocumento->find($id);
        return view('tipo_documento.show', compact('tipoDocumento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoDocumento = $this->tipoDocumento->find($id);
        return view('tipo_documento.edit', compact('tipoDocumento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoDocumentoFormRequest $request, $id)
    {
        $this->tipoDocumento->find($id)->update($request->all());
        return redirect()->route('tipo_documento.index')
            ->with('msg', 'Tipo de Documento atualizado com sucesso!')
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
        $tipoDocumento = $this->tipoDocumento->find($id);
        $tipoDocumento->delete();
        return redirect()->route('tipo_documento.index')
            ->with('msg', 'Tipo de Documento removido com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $tiposDocumeno = $this->tipoDocumento->search($request->all());
        return view('tipo_documento.index', compact('tiposDocumeno'));
    }
}
