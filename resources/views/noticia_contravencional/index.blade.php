@extends('layouts.template')

@section('titulo', 'Tipo de Documento')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Tipo de Documento</h2>
                <a class="au-btn au-btn-icon au-btn--blue" href="{{route('tipo_documento.create')}}">
                    <i class="fa fa-plus-square"></i>Novo</a>
            </div>
        </div>
    </div>
    <br>
    @if(session('msg'))
        <div class="sufee-alert alert with-close alert-{{session('status')}} alert-dismissible fade show">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <form action="{{url('/tipo_documento/buscar')}}" method="post" class="form-horizontal">
                @csrf
                <div class="input-group">
                    <input type="text" id="busca" name="busca" placeholder="Buscar..." class="form-control">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <br>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                    <tr>
                        <th width="90%">nome</th>
                        <th width="10%" class="text-right">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tiposDocumento as $tiposDocumento)
                    <tr>
                        <td><a href="{{ route('tipo_documento.show', $tiposDocumento->id) }}">{{ $tiposDocumento->nome }}</a></td>
                        <td class="text-right">
                            <a href="{{ route('tipo_documento.edit', $tiposDocumento->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Editar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
