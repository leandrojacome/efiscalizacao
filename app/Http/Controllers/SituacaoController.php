<?php

namespace App\Http\Controllers;

use App\Http\Requests\SituacaoFormRequest;
use App\Repositories\SituacaoRepository;
use Illuminate\Http\Request;

class SituacaoController extends Controller
{
    /**
     * @var SituacaoRepository
     */
    private $situacao;

    public function __construct(SituacaoRepository $situacao)
    {
        $this->middleware(['auth','role:super-admin|gerencia|administrativo']);
        $this->situacao = $situacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $situacoes = $this->situacao->orderBy('nome')->paginate(20);
        return view('situacao.index', compact('situacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('situacao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SituacaoFormRequest $request)
    {
        $this->situacao->create($request->all());
        return redirect()->route('situacao.index')
            ->with('msg','Situação cadastrada com sucesso!')
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
        $situacao = $this->situacao->find($id);
        return view('situacao.show', compact('situacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $situacao = $this->situacao->find($id);
        return view('situacao.edit', compact('situacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SituacaoFormRequest $request, $id)
    {
        $this->situacao->find($id)->update($request->all());
        return redirect()->route('situacao.index')
            ->with('msg', 'Situação atualizada com sucesso!')
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
        $situacao = $this->situacao->find($id);
        $situacao->delete();
        return redirect()->route('situacao.index')
            ->with('msg', 'Situação removida com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $situacoes = $this->situacao->search($request->all());
        return view('situacao.index', compact('situacoes'));
    }
}
