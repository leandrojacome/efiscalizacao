<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalizacaoFormRequest;
use App\Repositories\LocalizacaoRepository;
use Illuminate\Http\Request;

class LocalizacaoController extends Controller
{
    /**
     * @var LocalizacaoRepository
     */
    private $localizacao;

    public function __construct(LocalizacaoRepository $localizacao)
    {
        $this->middleware (['auth','role:super-admin|gerencia|administrativo']);
        $this->localizacao = $localizacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localizacoes = $this->localizacao->orderBy('nome')->paginate(20);
        return view('localizacao.index', compact('localizacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('localizacao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LocalizacaoFormRequest $request)
    {
        $this->localizacao->create($request->all());
        return redirect()->route('localizacao.index')
            ->with('msg','Localização cadastrada com sucesso!')
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
        $localizacao = $this->localizacao->find($id);
        return view('localizacao.show', compact('localizacao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localizacao = $this->localizacao->find($id);
        return view('localizacao.edit', compact('localizacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LocalizacaoFormRequest $request, $id)
    {
        $this->localizacao->find($id)->update($request->all());
        return redirect()->route('localizacao.index')
            ->with('msg', 'Localização atualizada com sucesso!')
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
        $localizacao = $this->localizacao->find($id);
        $localizacao->delete();
        return redirect()->route('localizacao.index')
            ->with('msg', 'Localização removida com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $localizacoes = $this->localizacao->search($request->all());
        return view('localizacao.index', compact('localizacoes'));
    }
}
