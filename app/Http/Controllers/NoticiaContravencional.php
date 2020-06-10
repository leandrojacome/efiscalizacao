<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticiaContravencionalFormRequest;
use App\Repositories\CidadeRepository;
use App\Repositories\FiscalRepository;
use App\Repositories\LocalizacaoRepository;
use App\Repositories\NoticiaContravencionalRepository;
use App\Repositories\RotaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticiaContravencional extends Controller
{

    /**
     * @var LocalizacaoRepository
     */
    private $localizacao;
    /**
     * @var FiscalRepository
     */
    private $fiscal;
    /**
     * @var CidadeRepository
     */
    private $cidade;
    /**
     * @var RotaRepository
     */
    private $rota;
    /**
     * @var NoticiaContravencionalRepository
     */
    private $noticiaContravencional;

    public function __construct(LocalizacaoRepository $localizacao,
                                FiscalRepository $fiscal,
                                CidadeRepository $cidade,
                                RotaRepository $rota,
                                NoticiaContravencionalRepository $noticiaContravencional)
    {

        $this->localizacao = $localizacao;
        $this->fiscal = $fiscal;
        $this->cidade = $cidade;
        $this->rota = $rota;
        $this->noticiaContravencional = $noticiaContravencional;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->redirectTo(route('noticia_contravencional.create'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cidades = $this->cidade->all();
        $fiscais = $this->fiscal->all();
        $localizacoes = $this->localizacao->all();
        $rotas = $this->rota->all();
        $noticiasContravencionais = $this->noticiaContravencional->paginate(20);
        return view('noticia_contravencional.create', compact('cidades', 'fiscais', 'localizacoes', 'rotas', 'noticiasContravencionais'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticiaContravencionalFormRequest $request)
    {
        if (!empty($request->data_lavratura)) {
        $data_lavratura = implode("-", array_reverse(explode("/", $request->data_lavratura)));
        $request->request->add(['data_lavratura' => $data_lavratura]);
        } else {
            $data_lavratura = date('YYYY-mm-dd');
            $request->request->add(['data_lavratura' => $data_lavratura]);
        }
        if (!empty($request->data_auto)) {
            $data_auto = implode("-", array_reverse(explode("/", $request->data_auto)));
            $request->request->add(['data_auto' => $data_auto]);
        } else {
            $request->request->remove('data_entrega');
        }
        if (!empty($request->data_entrega)) {
            $data_entrega = implode("-", array_reverse(explode("/", $request->data_entrega)));
            $request->request->add(['data_entrega' => $data_entrega]);
        } else {
            $request->request->remove('data_entrega');
        }

        $cidade_nome = $this->cidade->find($request->cidade_id)->nome;
        if ($cidade_nome !== "GOIÂNIA") {
            if (is_null($this->cidade->find($request->cidade_id)->rota)) {
                $this->cidade->update(['rota_id' => $request->rota_id], $request->cidade_id);
            }
        }

        ($cidade_nome === "GOIÂNIA") ?
            $result = $this->noticiaContravencional->create($request->all()) :
            $result = $this->noticiaContravencional->create($request->except('rota_id'));

        return response()->redirectTo(route('noticia_contravencional.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cidades = $this->cidade->all();
        $fiscais = $this->fiscal->all();
        $localizacoes = $this->localizacao->all();
        $rotas = $this->rota->all();
        $noticiaContravencional = $this->noticiaContravencional->find($id);
        return view('noticia_contravencional.show', compact('cidades', 'fiscais',
            'localizacoes', 'rotas', 'noticiaContravencional'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cidades = $this->cidade->all();
        $fiscais = $this->fiscal->all();
        $localizacoes = $this->localizacao->all();
        $rotas = $this->rota->all();
        $noticiaContravencional = $this->noticiaContravencional->find($id);
        $noticiasContravencionais = $this->noticiaContravencional->paginate(20);
        return view('noticia_contravencional.edit', compact('cidades', 'fiscais',
            'localizacoes', 'rotas', 'noticiaContravencional', 'noticiasContravencionais'));
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
        if (!empty($request->data_lavratura)) {
            $data_lavratura = implode("-", array_reverse(explode("/", $request->data_lavratura)));
            $request->request->add(['data_lavratura' => $data_lavratura]);
        } else {
            $data_lavratura = date('YYYY-mm-dd');
            $request->request->add(['data_lavratura' => $data_lavratura]);
        }
        if (!empty($request->data_auto)) {
            $data_auto = implode("-", array_reverse(explode("/", $request->data_auto)));
            $request->request->add(['data_auto' => $data_auto]);
        } else {
            $request->request->remove('data_auto');
        }
        if (!empty($request->data_entrega)) {
            $data_entrega = implode("-", array_reverse(explode("/", $request->data_entrega)));
            $request->request->add(['data_entrega' => $data_entrega]);
        } else {
            $request->request->remove('data_entrega');
        }

        $cidade_nome = $this->cidade->find($request->cidade_id)->nome;
        if ($cidade_nome !== "GOIÂNIA") {
            if (is_null($this->cidade->find($request->cidade_id)->rota)) {
                $this->cidade->update(['rota_id' => $request->rota_id], $request->cidade_id);
            }
        }

        ($cidade_nome === "GOIÂNIA") ?
            $result = $this->noticiaContravencional->update($request->all(), $id) :
            $result = $this->noticiaContravencional->update($request->except('rota_id'), $id);

        return response()->redirectTo(route('noticia_contravencional.create'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticiaContravencional = $this->noticiaContravencional->find($id);
        $noticiaContravencional->delete();
        return response()->redirectTo(route('noticia_contravencional.create'));
    }

    public function changeFiscal($noticiaId, $fiscalId)
    {
        $this->noticiaContravencional->update(['fiscal_id' => $fiscalId], $noticiaId);
    }

    public
    function buscar(Request $request)
    {
        $cidades = $this->cidade->all();
        $fiscais = $this->fiscal->all();
        $localizacoes = $this->localizacao->all();
        $rotas = $this->rota->all();
        $noticiasContravencionais = $this->noticiaContravencional->search($request->all());
        return view('noticia_contravencional.create', compact('cidades', 'fiscais',
            'localizacoes', 'rotas', 'noticiasContravencionais'));
    }
}
