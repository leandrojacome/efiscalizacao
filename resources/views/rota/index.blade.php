@extends('layouts.template')

@section('titulo', 'Rotas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <div class="col-3">
                    <h2 class="title-1">rotas</h2>
                </div>
                <div class="col-9 text-right">
                    <a class="btn btn-info btn-sm" href="{{ route('rota.showEscala') }}">
                        <i class="fa fa-eye"></i> Mostrar escala</a>
                    <a class="btn btn-secondary btn-sm" href="{{route('rota.escalaAlternada')}}">
                        <i class="fa fa-gears"></i> Criar alternada</a>
                    <a class="btn btn-success btn-sm" href="{{route('rota.escalaRotativa')}}">
                        <i class="fa fa-retweet"></i> Criar rotativa</a>
                    <a class="btn btn-warning btn-sm" href="{{route('rota.escalaEdit')}}">
                        <i class="fa fa-group"></i> Editar escala</a>
                    <a class="btn btn-primary btn-sm" href="{{route('rota.create')}}">
                        <i class="fa fa-plus-square"></i> Novo</a>
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
        <div class="col-12">
            <form action="{{url('/rota/buscar')}}" method="post" class="form-horizontal">
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
                        <th width="70%">nome</th>
                        <th width="20%">com escala</th>
                        <th width="10%" class="text-right">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rotas as $rota)
                        <tr>
                            <td><a href="{{ route('rota.show', $rota->id) }}">{{ $rota->nome }}</a></td>
                            <td class="{{ ($rota->escala == 'on') ? 'process' : 'denied' }}">{{ ($rota->escala == 'on') ? 'Sim' : 'Não' }}</td>
                            <td class="text-right">
                                <a href="{{ route('rota.edit', $rota->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row text-md-center col-md-6 col-md-offset-3">
            {{ $rotas->links() }}
        </div>
    </div>

@endsection
