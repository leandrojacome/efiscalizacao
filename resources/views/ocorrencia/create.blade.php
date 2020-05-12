
@extends('layouts.template')

@section('titulo','Cadastrar ocorrência')

@section('content')
<div class="col-lg-12">
    @if( isset($errors) && count($errors) > 0)
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            Cadastrar ocorrência
        </div>
        <div class="card-body card-block">
            <form name="form1" action="{{ route('ocorrencia.store') }}" method="POST" class="form-horizontal">
                @csrf
                @include('ocorrencia.form')
            </form>
        </div>
        <div class="card-footer">
            <button type="button" onclick="form1.submit();" class="btn btn-primary btn-sm">
                <i class="fa fa-dot-circle-o"></i> Salvar
            </button>
            <a href="{{route('ocorrencia.index')}}" type="reset" class="btn btn-danger btn-sm">
                <i class="fa fa-ban"></i> Cancelar
            </a>
        </div>
    </div>
</div>
@endsection
