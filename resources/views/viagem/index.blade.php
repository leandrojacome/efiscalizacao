@extends('layouts.template')

@section('titulo', 'Viagem')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">viagem</h2>
                <a class="au-btn au-btn-icon au-btn--blue" href="{{route('viagem.create')}}">
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
        <div class="col-lg-12">
            <br>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="95%">nome</th>
                        <th width="10%" class="text-right">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($viagens as $viagem)
                    <tr>
                        <td>{{ $viagem->id }}</td>
                        <td><a href="{{ route('viagem.show', $viagem->id) }}">{{ $viagem->nome }}</a></td>
                        <td class="text-right">
                            <a href="{{ route('viagem.edit', $viagem->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Editar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            {{ $viagens->links() }}
        </div>
    </div>

@endsection
