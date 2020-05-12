<?php

namespace App\Http\Controllers;

use App\Http\Requests\CidadeFormRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\RotaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CidadeController extends Controller
{
    /**
     * @var CidadeRepository
     */
    private $cidade;
    /**
     * @var RotaRepository
     */
    private $rota;

    public function __construct(CidadeRepository $cidade, RotaRepository $rota)
    {
        $this->middleware (['auth','role:super-admin|gerencia|administrativo']);
        $this->cidade = $cidade;
        $this->rota = $rota;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = $this->cidade->orderBy('nome')->paginate(20);
        return view('cidade.index', compact('cidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rotas = $this->rota->orderBy('nome')->all();
        return view('cidade.create', compact('rotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CidadeFormRequest $request)
    {
        $this->cidade->create($request->all());
        return redirect()->route('cidade.index')
                        ->with('msg','Cidade cadastrada com sucesso!')
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
        $cidade = $this->cidade->find($id);
        return view('cidade.show', compact('cidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rotas = $this->rota->all();
        $cidade = $this->cidade->find($id);
        return view('cidade.edit', compact('rotas','cidade'));
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CidadeFormRequest $request, $id)
    {
        $this->cidade->find($id)->update($request->all());
        return redirect()->route('cidade.index')
                    ->with('msg', 'Cidade atualizada com sucesso!')
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
        $cidade = $this->cidade->find($id);
        $cidade->delete();
        return redirect()->route('cidade.index')
                        ->with('msg', 'Cidade removida com sucesso!')
                        ->with('status', 'danger');
    }

    public function getRota($id = 0)
    {
        if($id !== 0)
        {
            if(!is_null($this->cidade->find($id)->rota))
                return $this->cidade->find($id)->rota->id;
            else
                return "";
        }
        return "";
    }

    public function buscar(Request $request)
    {
        $cidades = $this->cidade->search($request->all());
        return view('cidade.index', compact('cidades'));
    }
}
