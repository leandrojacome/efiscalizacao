
@extends('layouts.template')

@section('titulo', 'Fiscais')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">fiscais</h2>
                <a class="au-btn au-btn-icon au-btn--blue" href="{{route('fiscal.create')}}">
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
            <form action="{{url('/fiscal/buscar')}}" method="post" class="form-horizontal">
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
                        <th width="40%">nome</th>
                        <th width="10%">telefone</th>
                        <th width="10%">usuário</th>
                        <th width="10%">Disponível</th>
                        <th width="10%" class="text-right">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fiscais as $fiscal)
                    <tr>
                        <td><a href="{{ route('fiscal.show', $fiscal->id) }}">{{ $fiscal->user->name }}</a></td>
                        <td>{{ $fiscal->telefone }}</td>
                        <td>{{ $fiscal->user->username }}</td>
                        <td>@if(isset($fiscal->disponivel) and ($fiscal->disponivel == 'on')) Sim @else Não @endif</td>
                        <td class="text-right">
                            <a href="{{ route('fiscal.edit', $fiscal->id) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Editar</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3">
            {{ $fiscais->links() }}
        </div>
    </div>

@endsection
