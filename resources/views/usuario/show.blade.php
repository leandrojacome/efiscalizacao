
@extends('layouts.template')

@section('titulo', "Visualizar {$usuario->name}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$usuario->name}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('usuario.destroy', $usuario->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="row col-12">
                        <div class="row col-6">Nome</div>
                        <div class="row col-6">Usuário</div>
                    </div>
                    <div class="row col-12">
                        <div class="row col-6"><strong>{{$usuario->name}}</strong></div>
                        <div class="row col-6"><strong>{{$usuario->username}}</strong></div>
                    </div>
                    <div class="row col-12">
                        <div class="row col-12">&nbsp;</div>
                    </div>
                    <div class="row col-12">
                        <div class="row col-6">E-mail</div>
                        <div class="row col-6">Papel</div>
                    </div>
                    <div class="row col-12">
                        <div class="row col-6"><strong>{{$usuario->email}}></strong></div>
                        <div class="row col-6"><strong>Sem permissão para visualizar</strong></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('usuario.index')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('usuario.edit', $usuario->id)}}" type="reset" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form1.submit();" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
            </div>
        </div>
    </div>
@endsection
