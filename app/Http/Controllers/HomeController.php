<?php

namespace App\Http\Controllers;

use App\Models\Papel;
use App\Repositories\DiligenciaRepository;
use App\Repositories\EscalaRepository;
use App\Repositories\FiscalRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * @var DiligenciaRepository
     */
    private $diligencia;
    /**
     * @var FiscalRepository
     */
    private $fiscal;
    /**
     * @var EscalaRepository
     */
    private $escala;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DiligenciaRepository $diligencia,
                                FiscalRepository $fiscal,
                                EscalaRepository $escala)
    {
        $this->middleware('auth');
        $this->diligencia = $diligencia;
        $this->fiscal = $fiscal;
        $this->escala = $escala;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $hash = null)
    {
        if(Auth::user()->first_login)
        {
            return redirect()->route('usuario.reset.password', Auth::user()->id);
        } else {
            if(Auth::user()->hasAnyRole('super-admin|gerencia|administrativo')) {
                $diligencias = $this->diligencia->orderBy('updated_at', 'desc')
                    ->orderBy('created_at', 'desc')->orderBy('nome', 'asc')
                    ->paginate(20);
            } else if(Auth::user()->hasRole('fiscalizacao'))
            {
                $fiscal = $this->fiscal->where(['user_id' => Auth::user()->id])->get()->first();
                $escala = $this->escala->where(['fiscal_id' => $fiscal->id, 'mes' => (int)date('m')])->get()->first();
                $diligencias = $this->diligencia->where(['rota_id' => $escala->rota_id])
                    ->orderBy('updated_at', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->orderBy('nome', 'asc')
                    ->paginate(20);
            }
            return view('home', compact('diligencias'));
        }
    }
}
