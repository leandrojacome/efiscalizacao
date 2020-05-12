<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissaoFormRequest;
use App\Models\Permissao;
use App\Repositories\PermissaoRepository;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    /**
     * @var PermissaoRepository
     */
    private $permissao;

    public function __construct(PermissaoRepository $permissao)
    {
        $this->middleware(['auth','role:super-admin']);
        $this->permissao = $permissao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissoes = $this->permissao->orderBy('slug')->paginate(20);
        return view('permissao.index', compact('permissoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissaoFormRequest $request)
    {
        Permissao::create($request->all());
        return redirect()->route('permissao.index')
            ->with('msg','Permissão cadastrado com sucesso!')
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
        $permissao = $this->permissao->find($id);
        return view('permissao.show', compact('permissao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permissao = $this->permissao->find($id);
        return view('permissao.edit', compact('permissao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissaoFormRequest $request, $id)
    {
        $update = $this->permissao->find($id)->update($request->all());
        return redirect()->route('permissao.index')
            ->with('msg', 'Permissão atualizado com sucesso!')
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
        $permissao = $this->permissao->find($id);
        $permissao->delete();
        return redirect()->route('permissao.index')
            ->with('msg', 'Permissão removido com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $permissoes = $this->permissao->search($request->all());
        return view('permissao.index', compact('permissoes'));
    }
}
