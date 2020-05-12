<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiligenciaFormRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\DiligenciaRepository;
use App\Repositories\EscalaRepository;
use App\Repositories\FiscalRepository;
use App\Repositories\HistoricoRepository;
use App\Repositories\LocalizacaoRepository;
use App\Repositories\OcorrenciaRepository;
use App\Repositories\OrigemRepository;
use App\Repositories\RotaRepository;
use App\Repositories\SituacaoRepository;
use App\Repositories\TipoHistoricoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiligenciaController extends Controller
{

    /**
     * @var DiligenciaRepository
     */
    private $diligencia;
    /**
     * @var OrigemRepository
     */
    private $origem;
    /**
     * @var CidadeRepository
     */
    private $cidade;
    /**
     * @var RotaRepository
     */
    private $rota;
    /**
     * @var OcorrenciaRepository
     */
    private $ocorrencia;
    /**
     * @var LocalizacaoRepository
     */
    private $localizacao;
    /**
     * @var SituacaoRepository
     */
    private $situacao;
    /**
     * @var TipoHistoricoRepository
     */
    private $tipoHistorico;
    /**
     * @var TipoHistoricoRepository
     */
    private $historico;
    /**
     * @var FiscalRepository
     */
    private $fiscal;
    /**
     * @var EscalaRepository
     */
    private $escala;

    public function __construct(DiligenciaRepository $diligencia,
                                OrigemRepository $origem,
                                CidadeRepository $cidade,
                                RotaRepository $rota,
                                OcorrenciaRepository $ocorrencia,
                                LocalizacaoRepository $localizacao,
                                SituacaoRepository $situacao,
                                TipoHistoricoRepository $tipoHistorico,
                                HistoricoRepository $historico,
                                FiscalRepository $fiscal,
                                EscalaRepository $escala)
    {
        $this->middleware(['auth', 'role:super-admin|gerencia|administrativo|fiscalizacao']);
        $this->diligencia = $diligencia;
        $this->origem = $origem;
        $this->cidade = $cidade;
        $this->rota = $rota;
        $this->ocorrencia = $ocorrencia;
        $this->localizacao = $localizacao;
        $this->situacao = $situacao;
        $this->tipoHistorico = $tipoHistorico;
        $this->historico = $historico;
        $this->fiscal = $fiscal;
        $this->escala = $escala;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->hasAnyRole('super-admin|gerencia|administrativo')) {
            $diligencias = $this->diligencia->orderBy('updated_at', 'desc')
                ->orderBy('created_at', 'desc')->orderBy('nome', 'asc')
                ->paginate(20);
        } else if ($user->hasRole('fiscalizacao')) {
            $fiscal = $this->fiscal->where(['user_id' => $user->id])->get()->first();
            $escala = $this->escala->where(['fiscal_id' => $fiscal->id, 'mes' => (int)date('m')])->get()->first();
            $diligencias = $this->diligencia->where(['rota_id' => $escala->rota_id])
                ->orderBy('updated_at', 'desc')
                ->orderBy('created_at', 'desc')
                ->orderBy('nome', 'asc')
                ->paginate(20);
        }
        return view('diligencia.index', compact('diligencias'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        $diligenca = $this->diligencia;
        $origens = $this->origem->orderBy('nome')->all();
        $cidades = $this->cidade->orderBy('nome')->all();
        $rotas = $this->rota->orderBy('nome')->all();
        $ocorrencias = $this->ocorrencia->orderBy('nome')->pluck('nome', 'id');
        $localizacoes = $this->localizacao->orderBy('nome')->all();
        $situacoes = $this->situacao->orderBy('nome')->all();
        $lstBox1 = $ocorrencias->toArray();
        $lstBox2 = array();
        return view('diligencia.create', compact('diligenca',
            'origens', 'cidades', 'rotas', 'ocorrencias', 'localizacoes', 'situacoes', 'lstBox1', 'lstBox2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(DiligenciaFormRequest $request)
    {
        if (!empty($request->data_hora)) {
            $data_hora = explode(" ", $request->data_hora);
            $data = $data_hora[0];
            $hora = $data_hora[1];
            $data_hora = implode("-", array_reverse(explode("/", $data))) . " " . $hora;
            $request->request->add(['data_hora' => $data_hora]);
        } else {
            $data_hora = date('YYYY-mm-dd HH:ii:ss');
            $request->request->add(['data_hora' => $data_hora]);
        }

        $cidade_nome = $this->cidade->find($request->cidade_id)->nome;
        if ($cidade_nome !== "GOIÂNIA") {
            if (is_null($this->cidade->find($request->cidade_id)->rota)) {
                $this->cidade->update(['rota_id' => $request->rota_id], $request->cidade_id);
            }
        }

        $request->request->add(['user_id' => Auth::user()->id]);
        ($cidade_nome === "GOIÂNIA") ?
            $result = $this->diligencia->create($request->all()) :
            $result = $this->diligencia->create($request->except('rota_id'));
        if (!is_null($result) and !is_null($request->get('ocorrencias'))) {
            $result->ocorrencias()->sync($request->get('ocorrencias'));
        }
        return redirect()->route('diligencia.show', $result->id)
            ->with('msg', 'Diligência cadastrada com sucesso!')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $diligencia = $this->diligencia->find($id);
        $data_hora = explode(" ", $diligencia->data_hora);
        $data = implode("/", array_reverse(explode("-", $data_hora[0])));
        $data_hora = $data . " " . $data_hora[1];
        return view('diligencia.show', compact('diligencia', 'data_hora'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $diligencia = $this->diligencia->find($id);
        $origens = $this->origem->all();
        $cidades = $this->cidade->all();
        $rotas = $this->rota->all();
        $data_hora = explode(" ", $diligencia->data_hora);
        $data = implode("/", array_reverse(explode("-", $data_hora[0])));
        $data_hora = $data . " " . $data_hora[1];
        $ocorrencias_all = $this->ocorrencia->pluck('nome', 'id');
        $ocorrencias = $diligencia->ocorrencias()->get()->pluck('nome', 'id');
        $localizacoes = $this->localizacao->all();
        $situacoes = $this->situacao->all();

        $lstBox1 = array_diff($ocorrencias_all->toArray(), $ocorrencias->toArray());
        $lstBox2 = $ocorrencias->toArray();

        return view('diligencia.edit', compact('diligencia',
            'origens', 'cidades', 'rotas', 'ocorrencias_all', 'localizacoes', 'situacoes', 'lstBox1', 'lstBox2', 'data_hora'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(DiligenciaFormRequest $request, $id)
    {
        if (!empty($request->data_hora)) {
            $data_hora = explode(" ", $request->data_hora);
            $data = $data_hora[0];
            $hora = $data_hora[1];
            $data_hora = implode("-", array_reverse(explode("/", $data))) . " " . $hora;
            $request->request->add(['data_hora' => $data_hora]);
        } else {
            $data_hora = date('YYYY-mm-dd HH:ii:ss');
            $request->request->add(['data_hora' => $data_hora]);
        }
        ($this->cidade->find($request->cidade_id)->nome === "Goiânia") ?
            $result = $this->diligencia->update($request->all(), $id) :
            $result = $this->diligencia->update($request->except('rota_id'), $id);
        if ($result and !is_null($request->get('ocorrencias'))) {
            $diligencia = $this->diligencia->find($id);
            $diligencia->ocorrencias()->sync($request->get('ocorrencias'));
        }
        return redirect()->route('diligencia.index')
            ->with('msg', 'Diligência atualizada com sucesso!')
            ->with('status', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $diligencia = $this->diligencia->find($id);
        $diligencia->delete();
        return redirect()->route('diligencia.index')
            ->with('msg', 'Diligência removida com sucesso!')
            ->with('status', 'danger');
    }

    public
    function pdf($id)
    {
        $diligencia = $this->diligencia->find($id);
        return \PDF::loadView('diligencia.pdf', compact('diligencia'))->stream();
    }

    public function historico($diligencia_id)
    {
        $diligencia = $this->diligencia->find($diligencia_id);
        $historicos = $this->historico->findByField('diligencia_id', $diligencia_id);
        $tiposHistorico = $this->tipoHistorico->all();
        return view('diligencia.historico', compact('diligencia', 'historicos', 'tiposHistorico'));
    }

    public function historicoStore(Request $request, $diligencia_id)
    {
        $request->validate([
            'tipo_historico_id' =>  ['required'],
            'numero'            =>  ['required'],
        ]);
        $this->historico->create(['diligencia_id' => $diligencia_id,
            'tipo_historico_id' => $request->tipo_historico_id,
            'numero' => $request->numero]);
        return redirect()->back();
    }

    public
    function buscar(Request $request)
    {
        $diligencias = $this->diligencia->search($request->all());
        return view('diligencia.index', compact('diligencias'));
    }
}
