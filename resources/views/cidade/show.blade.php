
@extends('layouts.template')

@section('titulo', "Visualizar {$cidade->nome}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$cidade->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('cidade.destroy', $cidade->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    @if(!is_null($cidade->rota))
                    <div class="form-group">
                        <label for="nome" class="form-control-label">Rota</label>
                        <div name="nome" class="form-control">{{$cidade->rota->nome}}</div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="nome" class="form-control-label">Nome</label>
                        <div name="nome" class="form-control">{{$cidade->nome}}</div>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{route('cidade.index')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('cidade.edit', $cidade->id)}}" type="reset" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form1.submit();" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
            </div>
        </div>
    </div>
@endsection
