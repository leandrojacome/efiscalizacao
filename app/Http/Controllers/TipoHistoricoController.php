<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoHistoricoFormRequest;
use App\Repositories\TipoHistoricoRepository;
use Illuminate\Http\Request;

class TipoHistoricoController extends Controller
{
    /**
     * @var TipoHistoricoRepositoryRepository
     */
    private $tipoHistorico;

    public function __construct(TipoHistoricoRepository $tipoHistorico)
    {
        $this->middleware(['auth','role:super-admin|gerencia|administrativo']);
        $this->tipoHistorico = $tipoHistorico;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposHistorico = $this->tipoHistorico->orderBy('nome')->paginate(20);
        return view('tipo_historico.index', compact('tiposHistorico'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tipo_historico.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoHistoricoFormRequest $request)
    {
        $this->tipoHistorico->create($request->all());
        return redirect()->route('tipo_historico.index')
            ->with('msg','Tipo de Histórico cadastrado com sucesso!')
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
        $tipoHistorico = $this->tipoHistorico->find($id);
        return view('tipo_historico.show', compact('tipoHistorico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoHistorico = $this->tipoHistorico->find($id);
        return view('tipo_historico.edit', compact('tipoHistorico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipoHistoricoFormRequest $request, $id)
    {
        $this->tipoHistorico->find($id)->update($request->all());
        return redirect()->route('tipo_historico.index')
            ->with('msg', 'Tipo de Histórico atualizado com sucesso!')
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
        $tipoHistorico = $this->tipoHistorico->find($id);
        $tipoHistorico->delete();
        return redirect()->route('tipo_historico.index')
            ->with('msg', 'Tipo de Histórico removido com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $tiposHistorico = $this->tipoHistorico->search($request->all());
        return view('tipo_historico.index', compact('tiposHistorico'));
    }
}
