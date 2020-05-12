@extends('layouts.template')

@section('titulo', 'Rotas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <div class="col-3">
                    <h2 class="title-1">Escala</h2>
                </div>
                <div class="col-9 text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-success btn-sm">
                        <li class="fa fa-backward"></li> Voltar
                    </a>
                    <a href="{{ route('rota.escala.pdf', (int)date('m')) }}" target="_blank" class="btn btn-secondary btn-sm">
                        <li class="fa fa-print"></li> Imprimir
                    </a>
                </div>
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
        <div class="col-lg-12">
            <br>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                    <tr>
                        <th width="50%">rota</th>
                        <th width="50%">fiscal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($escalas as $escala)
                        <tr>
                            <td>{{ $escala->rota->nome }}</td>
                            <td>{{ $escala->fiscal->user->name }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row col-12 text-center">

            </div>
        </div>
    </div>
@endsection
