@extends('layouts.template')

@section('titulo', "Visualizar {$permissao->nome}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$permissao->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('permissao.destroy', $permissao->id) }}" method="POST"
                      class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="row">
                        <div class="col-6">
                            <div>Slug</div>
                            <div>{{$permissao->slug}}</div>
                        </div>
                        <div class="col-6">
                            <div>Nome</div>
                            <div>{{$permissao->name}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('permissao.index')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('permissao.edit', $permissao->id)}}" type="reset" class="btn btn-primary btn-sm">
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
