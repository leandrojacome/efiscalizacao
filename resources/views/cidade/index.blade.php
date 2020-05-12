@extends('layouts.template')

@section('titulo', 'Cidades')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">Cidades</h2>
                <a class="au-btn au-btn-icon au-btn--blue" href="{{route('cidade.create')}}">
                    <i class="zmdi zmdi-plus"></i>Novo</a>
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
            <form action="{{url('/cidade/buscar')}}" method="post" class="form-horizontal">
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
                        <th width="20%">rota</th>
                        <th width="60%">nome</th>
                        <th width="20%" class="text-right">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cidades as $cidade)
                        <tr>
                            <td>
                                @if($cidade->rota == null)
                                    Sem rota
                                @else
                                    {{ $cidade->rota->nome }}
                                @endif
                            </td>
                            <td><a href="{{ route('cidade.show', $cidade->id) }}">{{ $cidade->nome }}</a></td>
                            <td class="text-right">
                                <a href="{{ route('cidade.edit', $cidade->id) }}"
                                   class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $cidades->links() }}
@endsection
