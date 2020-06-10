@extends('layouts.template')

@section('titulo', "Editar {$termoRepresentacao->nome}")

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
                Editar {{$termoRepresentacao->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('termo_representacao.update', $termoRepresentacao->id) }}"
                      method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('patch')}}
                    @include('termo_representacao.form')
                </form>
                <form name="form2" action="{{ route('termo_representacao.destroy', $termoRepresentacao->id) }}"
                      method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
            </div>
            <div class="card-footer">
                <button type="button" onclick="form1.submit();" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Salvar
                </button>
                <a href="{{route('termo_representacao.create')}}" type="reset" class="btn btn-success btn-sm">
                    <i class="fa fa-ban"></i> Cancelar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form2.submit();"
                        class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
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
                            <th width="25%">nome</th>
                            <th width="25%">cidade</th>
                            <th width="5%">data Lavratura</th>
                            <th width="30%">fiscal</th>
                            <th width="10%" class="text-right">ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($termosRepresentacao as $termoRepresentacao)
                            <tr>
                                <td id="id">{{$termoRepresentacao->id}}</td>
                                <td>
                                    <a href="{{ route('termo_representacao.show', $termoRepresentacao->id) }}">{{ $termoRepresentacao->nome }}</a>
                                </td>
                                <td>{{$termoRepresentacao->cidade->nome}}</td>
                                <td>{{
                                    (!is_null($termoRepresentacao->data_lavratura)) ?
                                    implode('/',array_reverse(explode('-',$termoRepresentacao->data_lavratura))) :
                                    "Sem data"
                                    }}</td>
                                <?php $i = 0 ?>
                                <td>
                                    <div class="row">
                                        <select name="fiscal" id="fiscal-{{$i}}" class="form-control">
                                            <option value="">Selecione um fiscal</option>
                                            @foreach($fiscais as $fiscal)
                                                @if(!is_null($termoRepresentacao->fiscal_id))
                                                    @if($termoRepresentacao->fiscal_id == $fiscal->id)
                                                        <option value="{{$fiscal->id}}"
                                                                selected>{{$fiscal->nome}}</option>
                                                    @endif
                                                @endif
                                                <option
                                                    value="{{$fiscal->id}}" {{ (old("fiscal") == $fiscal->id ? "selected":"") }}>{{$fiscal->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('termo_representacao.edit', $termoRepresentacao->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{ $termosRepresentacao->links() }}
@endsection
