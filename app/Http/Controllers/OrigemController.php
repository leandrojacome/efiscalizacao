<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrigemFormRequest;
use App\Repositories\OrigemRepository;
use Illuminate\Http\Request;

class OrigemController extends Controller
{
    /**
     * @var OrigemRepository
     */
    private $origem;

    public function __construct(OrigemRepository $origem)
    {
        $this->middleware(['auth','role:super-admin|gerencia|administrativo']);
        $this->origem = $origem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $origens = $this->origem->orderBy('nome')->paginate(20);
        return view('origem.index', compact('origens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('origem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrigemFormRequest $request)
    {
        $this->origem->create($request->all());
        return redirect()->route('origem.index')
            ->with('msg','Origem cadastrada com sucesso!')
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
        $origem = $this->origem->find($id);
        return view('origem.show', compact('origem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $origem = $this->origem->find($id);
        return view('origem.edit', compact('origem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrigemFormRequest $request, $id)
    {
        $this->origem->find($id)->update($request->all());
        return redirect()->route('origem.index')
            ->with('msg', 'Origem atualizada com sucesso!')
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
        $origem = $this->origem->find($id);
        $origem->delete();
        return redirect()->route('origem.index')
            ->with('msg', 'Origem removida com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $origens = $this->origem->search($request->all());
        return view('origem.index', compact('origens'));
    }
}
