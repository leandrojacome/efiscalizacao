<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiscalFormRequest;
use App\Repositories\FiscalRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FiscalController extends Controller
{
    /**
     * @var FiscalRepository
     */
    private $fiscal;
    /**
     * @var UserRepository
     */
    private $user;

    public function __construct(FiscalRepository $fiscal, UserRepository $user)
    {
        $this->middleware (['auth','role:super-admin|gerencia|administrativo']);
        $this->fiscal = $fiscal;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fiscais = $this->fiscal->paginate(20);
        return view('fiscal.index', compact('fiscais'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fiscal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FiscalFormRequest $request)
    {
        if(empty($request->disponivel))
        {
            $request->request->add(["disponivel" => "off"]);
        }
        $user = $this->user->create([
            'name' => $request->name,
            'username' => $request->username,
            'sigla' => $request->sigla,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $request->request->add(['user_id' => $user->id]);
        $this->fiscal->create($request->all());
        $user->assignRole('fiscalizacao');
        return redirect()->route('fiscal.index')
            ->with('msg','Fiscal cadastrada com sucesso!')
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
        $fiscal = $this->fiscal->find($id);
        return view('fiscal.show', compact('fiscal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fiscal = $this->fiscal->find($id);
        return view('fiscal.edit', compact('fiscal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FiscalFormRequest $request, $id)
    {
        $fiscal = $this->fiscal->find($id);
        if(empty($request->disponivel))
        {
            $request->request->add(["disponivel" => "off"]);
        }
        $fiscal->user->update($request->all());
        $fiscal->update($request->all());
        return redirect()->route('fiscal.index')
            ->with('msg', 'Fiscal atualizada com sucesso!')
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
        $fiscal = $this->fiscal->find($id);
        $fiscal->delete();
        return redirect()->route('fiscal.index')
            ->with('msg', 'Fiscal removida com sucesso!')
            ->with('status', 'danger');
    }

    public function buscar(Request $request)
    {
        $fiscais = $this->fiscal->search($request->all());
        return view('fiscal.index', compact('fiscais'));
    }
}
