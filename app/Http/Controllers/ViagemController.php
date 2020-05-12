<?php

namespace App\Http\Controllers;

use App\Repositories\CidadeRepository;
use App\Repositories\FiscalRepository;
use App\Repositories\TipoDocumentoRepository;
use App\Repositories\ViagemRepository;
use Illuminate\Http\Request;

class ViagemController extends Controller
{

    /**
     * @var ViagemRepository
     */
    private $viagem;
    /**
     * @var CidadeRepository
     */
    private $cidade;
    /**
     * @var FiscalRepository
     */
    private $fiscal;
    /**
     * @var TipoDocumentoRepository
     */
    private $tipoDocumento;

    public function __construct(ViagemRepository $viagem,
                                CidadeRepository $cidade,
                                FiscalRepository $fiscal,
                                TipoDocumentoRepository $tipoDocumento)
    {

        $this->viagem = $viagem;
        $this->cidade = $cidade;
        $this->fiscal = $fiscal;
        $this->tipoDocumento = $tipoDocumento;
    }
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidades = $this->cidade->all();
        $fiscais = $this->fiscal->where(['disponivel' => 1])->get();
        $tiposDocumento = $this->tipoDocumento->all();
        return view('viagem.create', compact('cidades','fiscais','tiposDocumento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $viagem = $this->viagem->create($request->all());
        $viagem->cidades()->sync(explode('|',$request->get('cidadesSelecionadas')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
