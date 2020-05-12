
@extends('layouts.template')

@section('titulo', "Visualizar {$origem->nome}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$origem->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('origem.destroy', $origem->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="form-group">
                        <label for="nome" class="form-control-label">Nome</label>
                        <div name="nome" class="form-control">{{$origem->nome}}</div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('origem.index')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('origem.edit', $origem->id)}}" type="reset" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form1.submit();" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
            </div>
        </div>
    </div>
@endsection
