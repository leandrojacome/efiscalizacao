<?php

namespace App\Http\Controllers;

use App\Http\Requests\RotaFormRequest;
use App\Repositories\EscalaRepository;
use App\Repositories\FiscalRepository;
use App\Repositories\RotaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class RotaController extends Controller
{
    /**
     * @var RotaRepository
     */
    private $rota;
    /**
     * @var FiscalRepository
     */
    private $fiscal;
    /**
     * @var EscalaRepository
     */
    private $escala;

    public function __construct(RotaRepository $rota, FiscalRepository $fiscal, EscalaRepository $escala)
    {
        $this->middleware(['auth', 'role:super-admin|gerencia|administrativo']);
        $this->rota = $rota;
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
        $rotas = $this->rota->orderBy('nome')->paginate(20);
        return view('rota.index', compact('rotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RotaFormRequest $request)
    {
        if (empty($request->escala)) {
            $request->request->add(["escala" => "off"]);
        }
        $this->rota->create($request->all());
        return redirect()->route('rota.index')
            ->with('msg', 'Rota cadastrada com sucesso!')
            ->with('status', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rota = $this->rota->find($id);
        return view('rota.show', compact('rota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rota = $this->rota->find($id);
        return view('rota.edit', compact('rota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RotaFormRequest $request, $id)
    {
        if (empty($request->escala)) {
            $request->request->add(["escala" => "off"]);
        }
        $this->rota->find($id)->update($request->all());
        return redirect()->route('rota.index')
            ->with('msg', 'Rota atualizada com sucesso!')
            ->with('status', 'primary');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rota = $this->rota->find($id);
        $rota->delete();
        return redirect()->route('rota.index')
            ->with('msg', 'Rota removida com sucesso!')
            ->with('status', 'danger');
    }

    private function UniqueRandomNumber($min, $max, $quantity)
    {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    public function escalaAlternada()
    {
        $fiscais = $this->fiscal->get('id')->toArray();
        $rotas = $this->rota->where(['escala' => '1'])->get('id');
        $numRotas = $rotas->count();
        $escala = $this->UniqueRandomNumber(1, $numRotas, $numRotas);
        $escalaAtual = $this->escala->where(['mes' => date('m')]);
        /*
            Primeira escala randomica
        */
        if($this->escala->count() == 0)
        {
            for ($i = 0; $i < $numRotas; $i++) {
                $this->escala->create(['rota_id' => $escala[$i],
                    'fiscal_id' => $fiscais[$i]['id'],
                    'mes' => date('m')]);
            }
            if($this->escala->count() == $numRotas) {
                return redirect()->route('rota.index')
                    ->with('msg', 'Primeira escala criada!')
                    ->with('status', 'warning');
            } else {
                dd($this->escala->count());
            }
        }
        if ($escalaAtual->count() < $numRotas) {
            for ($i = 0; $i < $numRotas; $i++) {
                if (isset($escala[$i])) {
                    $escalasAnteriores = $this->escala->where(['rota_id' => $escala[$i], 'fiscal_id' => $fiscais[$i]['id'],
                        'mes' => date('m') - 1]);
                    $escalasDisponiveis = $this->escala->where(['rota_id' => $escala[$i], 'fiscal_id' => $fiscais[$i]['id'],
                        'mes' => (int)date('m')]);
                }
                if (($escalasAnteriores->count() > 0) OR ($escalasDisponiveis->count() > 0)) {
                    $i = 0;
                    foreach ($escala as $key => $item) {
                        $escalaNew[$i] = $item;
                        $i++;
                    }
                    $this->escala->create(['rota_id' => $escalaNew[count($escalaNew) - 1],
                        'fiscal_id' => $fiscais[$i]['id'],
                        'mes' => date('m')]);
                    $k = array_search($escalaNew[count($escalaNew) - 1], $escala);
                    if ($k !== false) unset($escala[$k]);
                } else {
                    $this->escala->create(['rota_id' => $escala[$i],
                        'fiscal_id' => $fiscais[$i]['id'],
                        'mes' => date('m')]);
                    unset($escala[$i]);
                }
            }
            return redirect()->route('rota.index')
                ->with('msg', 'Escala criada com sucesso!')
                ->with('status', 'success');
        } else {
            return redirect()->route('rota.index')
                ->with('msg', 'Escala já foi criada!')
                ->with('status', 'danger');
        }
    }

    public function escalaRotativa()
    {
        $rotas = $this->rota->where(['escala' => '1'])->get('id');
        $numRotas = $rotas->count();
        $escalaAtual = $this->escala->where(['mes' => date('m')]);
        if ($escalaAtual->count() < $numRotas) {
            $escalaAnterior = $this->escala->where(['mes' => (int)date('m') - 1]);
            $maiorValor = $this->escala->max('rota_id');
            $escalas = $escalaAnterior->get(['fiscal_id', 'rota_id'])->toArray();
            for ($i = 0; $i < $escalaAnterior->count(); $i++) {
                if ($escalas[$i]['rota_id'] !== $maiorValor) {
                    $this->escala->create(['rota_id' => $escalas[$i]['rota_id'] + 1,
                        'fiscal_id' => $escalas[$i]['fiscal_id'],
                        'mes' => date('m')]);
                } else if ($escalas[$i]['rota_id'] === $maiorValor) {
                    $this->escala->create([
                        'rota_id' => 1,
                        'fiscal_id' => $escalas[$i]['fiscal_id'],
                        'mes' => date('m')]);
                }
            }
            return redirect()->route('rota.index')
                ->with('msg', 'Escala criada com sucesso!')
                ->with('status', 'success');
        } else {
            return redirect()->route('rota.index')
                ->with('msg', 'Escala já foi criada!')
                ->with('status', 'danger');
        }
    }

    public function escalaEdit()
    {
        $rotas = $this->rota->where(['escala' => 'on'])->orderBy('nome')->get();
        $fiscais = $this->fiscal->where(['disponivel' => 'on'])->get();
        $escala = $this->escala->where(['mes' => (int)date('m')])->orderBy('rota_id')->get()->toArray();
        return view('rota.escalaEdit', compact('rotas', 'fiscais', 'escala'));
    }

    public function showEscala()
    {
        $rotas = $this->rota->where(['escala' => 'on'])->get();
        $escalas = $this->escala->where(['mes' => (int)date('m')])->orderBy('rota_id')->get();
        return view('rota.showEscala', compact('escalas', 'rotas'));
    }

    public function escalaStore(Request $request)
    {
        $rotas = $request->rota;
        $fiscais = $request->fiscal;
        for ($i = 0; $i < count($rotas); $i++) {
            $escala = $this->escala->where(['rota_id' => $rotas[$i]]);
            if ($this->escala->where(['mes' => (int)date('m')])->count() > 0) {
                $escala->update(['rota_id' => $rotas[$i], 'fiscal_id' => $fiscais[$i]]);
                return redirect()->route('rota.index')
                    ->with('msg', 'Escala editada com sucesso!')
                    ->with('status', 'primary');
            } else {
                $this->escala->create(['rota_id' => $rotas[$i], 'fiscal_id' => $fiscais[$i], 'mes' => (int)date('m')]);
                return redirect()->route('rota.index')
                    ->with('msg', 'Escala criada com sucesso!')
                    ->with('status', 'success');
            }
        }

    }

    public function printPDF($mes)
    {
        $escalas = $this->escala->where(['mes' => $mes])->orderBy('rota_id')->get();
        return \PDF::loadView('rota.pdf', compact('escalas'))
            ->setPaper('A4', 'landscape')
            ->stream();
    }

    public function buscar(Request $request)
    {
        $rotas = $this->rota->search($request->all());
        return view('rota.index', compact('rotas'));
    }
}
