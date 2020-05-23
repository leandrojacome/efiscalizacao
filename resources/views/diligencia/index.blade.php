@extends('layouts.template')

@section('titulo', 'Diligencias')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">diligências</h2>
                @hasanyrole('super-admin|gerencia|administrativo')
                <a class="au-btn au-btn-icon au-btn--blue" href="{{route('diligencia.create')}}">
                    <i class="fa fa-plus-square"></i>Novo</a>
                @endhasanyrole
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
            <form action="{{url('/diligencia/buscar')}}" method="post" class="form-horizontal">
                @csrf
                <div class="input-group">
                    <input type="text" id="busca" name="busca" placeholder="Buscar..." class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-primary">
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
                        <th width="5%">#</th>
                        <th width="55%">nome</th>
                        <th width="40%" class="text-center">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($diligencias))
                        @foreach($diligencias as $diligencia)
                            <tr>
                                <td>{{ $diligencia->id }}</td>
                                <td>
                                    <a href="{{ route('diligencia.show', $diligencia->id) }}">{{ mb_strtoupper($diligencia->nome) }}</a>
                                </td>
                                <td class="text-right">
                                    <a href="{{route('diligencia.historico', $diligencia->id)}}" type="reset"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-tags"></i> Histórico
                                    </a>
                                    <a href="{{route('foto.upload', $diligencia->id)}}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-upload"></i> Enviar Fotos
                                    </a>
                                    <a href="{{url('/diligencia/pdf/'.$diligencia->id)}}" target="_blank"
                                       class="btn btn-secondary btn-sm">
                                        <i class="fa fa-print"></i> Imprimir
                                    </a>
                                    <a href="{{url("/diligencia/pdf/{$diligencia->id}/download")}}" target="_blank"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-download"></i> Download
                                    </a>
                                    @hasanyrole('super-admin|gerencia|administrativo')
                                    <a href="{{ route('diligencia.edit', $diligencia->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> Editar</a>
                                    @endhasanyrole
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Nenhum registro encontrado.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $diligencias->links() }}
@endsection
@section('script_parse')
    <script>
        $('#cidade').select2();
    </script>
@endsection
