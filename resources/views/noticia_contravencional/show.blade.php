@extends('layouts.template')

@section('titulo', "Visualizar {$noticiaContravencional->nome}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$noticiaContravencional->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('noticia_contravencional.destroy', $noticiaContravencional->id) }}"
                      method="POST"
                      class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="row">
                        <div class="col-6">
                            <div class="text">Localização</div>
                            <div class="text"><strong>{{ $noticiaContravencional->localizacao->nome }}</strong></div>
                        </div>
                        <div class="col-6">
                            <div class="text">Fiscal</div>
                            <div class="text">
                                <strong>{{(!is_null($noticiaContravencional->fiscal_id) ? $noticiaContravencional->fiscal->user->name : "Sem Fiscal" )}}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="text">Cidade</div>
                            <div class="text"><strong>{{$noticiaContravencional->cidade->nome}}</strong></div>
                        </div>
                        <div class="col-6">
                            <div class="text">Rota</div>
                            <div class="text"><strong>
                                    @if(!is_null($noticiaContravencional->rota_id))
                                        {{$noticiaContravencional->rota->nome}}
                                    @else
                                        @if(!is_null($noticiaContravencional->cidade->rota))
                                            {{$noticiaContravencional->cidade->rota->nome}}
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
                        <div class="col-1">
                            <div class="text">DP</div>
                            <div class="text"><strong>{{ $noticiaContravencional->dp }}</strong></div>
                        </div>
                        <div class="col-5">
                            <div class="text">Nome</div>
                            <div class="text">
                                <strong>{{ ($noticiaContravencional->nome) ? $noticiaContravencional->nome : "Não informado" }}</strong>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="text">Data Lavratura</div>
                            <div class="text">
                                <strong>{{ ($noticiaContravencional->data_lavratura) ? implode('/',array_reverse(explode('-',$noticiaContravencional->data_lavratura))) : "Sem data" }}</strong>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="text">Data Auto</div>
                            <div class="text">
                                <strong>{{ ($noticiaContravencional->data_auto) ? implode('/',array_reverse(explode('-',$noticiaContravencional->data_auto))) : "Sem data" }}</strong>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="text">Data Entrega</div>
                            <div class="text">
                                <strong>{{ ($noticiaContravencional->data_entrega) ? implode('/',array_reverse(explode('-',$noticiaContravencional->data_entrega))) : "Sem data" }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{route('noticia_contravencional.create')}}" class="btn btn-success btn-sm">
                        <i class="fa fa-backward"></i> Voltar
                    </a>
                    @hasanyrole('super-admin|gerencia|administrativo')
                    <a href="{{route('noticia_contravencional.edit', $noticiaContravencional->id)}}"
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
