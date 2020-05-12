@extends('layouts.template')

@section('titulo', "Visualizar {$fiscal->user->name}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$fiscal->user->name}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('fiscal.destroy', $fiscal->id) }}" method="POST"
                      class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="row col-12">
                        <div class="col-6">Nome</div>
                        <div class="col-6">Usuário</div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6"><strong>{{$fiscal->user->name}}</strong></div>
                        <div class="col-6"><strong>{{$fiscal->user->username}}</strong></div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6">E-mail</div>
                        <div class="col-6">Telefone</div>
                    </div>
                    <div class="row col-12">
                        <div class="col-6"><strong>{{$fiscal->user->email}}</strong></div>
                        <div class="col-6"><strong>{{$fiscal->telefone}}</strong></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('fiscal.index')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('fiscal.edit', $fiscal->id)}}" type="reset" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form1.submit();"
                        class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
            </div>
        </div>
    </div>
@endsection
