<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioFormRequest;
use App\Repositories\PapelRepository;
use App\Repositories\UserRepository;
use App\Repositories\UsuarioRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * @var UsuarioRepository
     */
    private $usuario;
    /**
     * @var PapelRepository
     */
    private $papel;

    public function __construct(UserRepository $usuario,
                                PapelRepository $papel)
    {
        $this->usuario = $usuario;
        $this->papel = $papel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('home');
        } else {
            $usuarios = $this->usuario->orderBy('name')->paginate(20);
            return view('usuario.index', compact('usuarios'));
        }
    }

    public function logout()
    {
        return redirect('login')->with(Auth::logout());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('401');
        } else {
            $papeis = $this->papel->all();
            return view('usuario.create', compact('papeis'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('401');
        } else {
            $request->validate([
                'name'      =>  ['required', 'string', 'max:255'],
                'username'  =>  ['required', 'string', 'max:255'],
                'sigla'     =>  ['required', 'string', 'max:5'],
                'email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  =>  ['required', 'string', 'min:8', 'confirmed'],
                'papel'     =>  ['required']
            ]);
            $data = $request->toArray();
            $usuario = $this->usuario->create([
                'name' => $data['name'],
                'username' => $data['username'],
                'sigla' => $data['sigla'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $usuario->assignRole($request->papel);
            return redirect()->route('usuario.index')
                ->with('msg', 'Usuário cadastrado com sucesso!')
                ->with('status', 'success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin')) {
            return redirect()->route('401');
        } else {
            $usuario = $this->usuario->find($id);
            return view('usuario.show', compact('usuario'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $papeis = $this->papel->all();
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('401');
        } else {
            $usuario = $this->usuario->find($id);
            return view('usuario.edit', compact('usuario', 'papeis'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('401');
        } else {
            $this->validate($request, [
                'name'      =>  ['required', 'string', 'max:255'],
                'username'  =>  ['required', 'string', 'max:255'],
                'sigla'     =>  ['required', 'string', 'max:5'],
                'email'     =>  ['required', 'string', 'email', 'max:255'],
                'papel'     =>  ['required']
            ]);
            $usuario = $this->usuario->update($request->all(), $id);
            $usuario->syncRoles($request->papel);

            return redirect()->route('usuario.index')
                ->with('msg', 'Usuário atualizado com sucesso!')
                ->with('status', 'primary');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('401');
        } else {
            $usuario = $this->usuario->find($id);
            $usuario->delete();
            return redirect()->route('usuario.index')
                ->with('msg', 'Usuário removido com sucesso!')
                ->with('status', 'danger');
        }
    }

    public function editPassword($id)
    {
        $usuario = $this->usuario->find($id);
        return view('usuario.changepassword', compact('usuario'));
    }

    public function resetPassword($id)
    {
        $usuario = $this->usuario->find($id);
        return view('usuario.resetpassword', compact('usuario'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = $request->toArray();
        $password = Hash::make($data['password']);
        $usuario = $this->usuario->find($id)->update(['password' => $password]);
        if (Auth::user()->first_login == 1) {
            Auth::user()->first_login = 0;
            Auth::user()->save();
        }

        return redirect()->route('usuario.index')
            ->with('msg', 'Senha alterada com sucesso!')
            ->with('status', 'warning');
    }

    public function buscar(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasAnyRole('super-admin|gerencia')) {
            return redirect()->route('401');
        } else {
            $usuarios = $this->usuario->search($request->all());
            return view('usuario.index', compact('usuarios'));
        }
    }
}
