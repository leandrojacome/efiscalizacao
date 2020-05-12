<?php

namespace App\Http\Controllers;

use App\Http\Requests\OcorrenciaFormRequest;
use App\Repositories\OcorrenciaRepository;
use Illuminate\Http\Request;

class OcorrenciaController extends Controller
{
    /**
     * @var OcorrenciaRepository
     */
    private $ocorrencia;

    public function __construct(OcorrenciaRepository $ocorrencia)
    {
        $this->middleware (['auth','role:super-admin|gerencia|administrativo']);
        $this->ocorrencia = $ocorrencia;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ocorrencias = $this->ocorrencia->orderBy('nome')->paginate(20);
        return view('ocorrencia.index', compact('ocorrencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ocorrencia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OcorrenciaFormRequest $request)
    {
        $this->ocorrencia->create($request->all());
        return redirect()->route('ocorrencia.index')
            ->with('msg','Ocorrencia cadastrada com sucesso!')
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
        $ocorrencia = $this->ocorrencia->find($id);
        return view('ocorrencia.show', compact('ocorrencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ocorrencia = $this->ocorrencia->find($id);
        return view('ocorrencia.edit', compact('ocorrencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OcorrenciaFormRequest $request, $id)
    {
        $this->ocorrencia->find($id)->update($request->all());
        return redirect()->route('ocorrencia.index')
            ->with('msg', 'Ocorrencia atualizada com sucesso!')
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
        $ocorrencia = $this->ocorrencia->find($id);
        $ocorrencia->delete();
        return redirect()->route('ocorrencia.index')
            ->with('msg', 'Ocorrencia removida com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $ocorrencias = $this->ocorrencia->search($request->all());
        return view('ocorrencia.index', compact('ocorrencias'));
    }
}
