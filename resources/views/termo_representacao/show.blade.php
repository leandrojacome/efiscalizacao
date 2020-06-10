@extends('layouts.template')

@section('titulo', "Visualizar {$termoRepresentacao->nome}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$termoRepresentacao->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('termo_representacao.destroy', $termoRepresentacao->id) }}"
                      method="POST"
                      class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="row">
                        <div class="col-6">
                            <div class="text">Localização</div>
                            <div class="text"><strong>{{ $termoRepresentacao->localizacao->nome }}</strong></div>
                        </div>
                        <div class="col-6">
                            <div class="text">Fiscal</div>
                            <div class="text">
                                <strong>{{(!is_null($termoRepresentacao->fiscal_id) ? $termoRepresentacao->fiscal->user->name : "Sem Fiscal" )}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text">Cidade</div>
                            <div class="text"><strong>{{$termoRepresentacao->cidade->nome}}</strong></div>
                        </div>
                        <div class="col-6">
                            <div class="text">Rota</div>
                            <div class="text"><strong>
                                    @if(!is_null($termoRepresentacao->rota_id))
                                        {{$termoRepresentacao->rota->nome}}
                                    @else
                                        @if(!is_null($termoRepresentacao->cidade->rota))
                                            {{$termoRepresentacao->cidade->rota->nome}}
                                        @else
                                            Sem rota
                                        @endif
                                    @endif</strong></div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text">Nome</div>
                            <div class="text">
                                <strong>{{ ($termoRepresentacao->nome) ? $termoRepresentacao->nome : "Não informado" }}</strong>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text">Data Lavratura</div>
                            <div class="text">
                                <strong>{{ ($termoRepresentacao->data_lavratura) ? implode('/',array_reverse(explode('-',$termoRepresentacao->data_lavratura))) : "Sem data" }}</strong>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="text">Data Entrega</div>
                            <div class="text">
                                <strong>{{ ($termoRepresentacao->data_entrega) ? implode('/',array_reverse(explode('-',$termoRepresentacao->data_entrega))) : "Sem data" }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('termo_representacao.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-backward"></i> Voltar
                    </a>
                    @hasanyrole('super-admin|gerencia|administrativo')
                    <a href="{{route('termo_representacao.edit', $termoRepresentacao->id)}}"
                       class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i> Editar
                    </a>
                    <button type="button" onclick="if(confirm('Tem certeza?')) form1.submit();"
                            class="btn btn-danger btn-sm">
                        <i class="fa fa-times"></i> Remover
                    </button>
                    @endhasanyrole
                </div>
            </div>
        </div>
@endsection
