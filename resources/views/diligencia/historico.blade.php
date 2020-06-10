@extends('layouts.template')

@section('titulo', "Visualizar {$diligencia->nome}")

@section('content')
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
    <div class="row form-group">
        <div class="col-12">
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                    <tr>
                        <th width="30%">tipo</th>
                        <th width="30%">fiscal</th>
                        <th width="30%">numero</th>
                        <th width="10%">ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!is_null($historicos))
                        @foreach($historicos as $historico)
                            <tr>
                                <td>{{$historico->tipo_historico->nome}}</td>
                                <td>
                                    @if(!is_null($historico->fical_id))
                                        {{$historico->fiscal->user->name}}
                                    @else
                                        Não há fiscal vinculado.
                                    @endif
                                </td>
                                <td>{{$historico->numero}}</td>
                                <td><a href="{{route('diligencia.historico.destroy', $historico->id)}}" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Não há nenhum histórico</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Cadastrar de histórico
            </div>
            <div class="card-body card-block">
                <div class="card-body card-block">
                    <form name="form1" action="{{route('diligencia.historico.store', $diligencia->id)}}" method="post" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col-3">
                                <label for="tipo_historico_id" class="form-control-label">Tipo de Histórico</label>
                                <select name="tipo_historico_id" id="tipo_historico_id" class="form-control">
                                    <option value="">Selecione um tipo de histórico</option>
                                    @foreach($tiposHistorico as $tipoHistorico)
                                        <option
                                            value="{{$tipoHistorico->id}}" {{ (old("tipo_historico_id") == $tipoHistorico->id ? "selected":"") }}>{{$tipoHistorico->nome}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="fiscal_id" class="form-control-label">Fiscal</label>
                                <select name="fiscal_id" id="fiscal_id" class="form-control">
                                    <option value="">Selecione um fiscal</option>
                                    @foreach($fiscais as $fiscal)
                                        <option
                                            value="{{$fiscal->id}}" {{ (old("fiscal_id") == $fiscal->id ? "selected":"") }}>{{$fiscal->user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="numero" class="form-control-label">Número</label>
                                <input type="text" name="numero" id="numero" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{url()->previous()}}"
                        class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <button type="button" id="buttonSave" onclick="form1.submit();"
                        class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Adicionar
                </button>
            </div>
        </div>
    </div>
@endsection
@section('script_parse')
    <script>
        $('document').ready(function () {
            $('#tipo_historico_id').select2({});
            $('#fiscal_id').select2({});
        });
    </script>
@endsection
