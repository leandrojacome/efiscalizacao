@extends('layouts.template')

@section('titulo', "Visualizar {$diligencia->nome}")

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Visualizar {{$diligencia->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('diligencia.destroy', $diligencia->id) }}" method="POST"
                      class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="card-body card-block">
                    <div class="row">
                        <div class="col-12 text text-center"><strong>Cadastrada
                                por: {{$diligencia->user->sigla}}</strong></div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="text">Data</div>
                            <div class="text"><strong>{{ date( 'd/m/Y', strtotime($diligencia->data_hora)) }}
                                    / {{ date( 'H:i', strtotime($diligencia->data_hora)) }}</strong></div>
                        </div>
                        <div class="col-3">
                            <div class="text">Origem</div>
                            <div class="text"><strong>{{$diligencia->origem->nome}}</strong></div>
                        </div>
                        <div class="col-3">
                            <div class="text">Cidade</div>
                            <div class="text"><strong>{{$diligencia->cidade->nome}}</strong></div>
                        </div>
                        <div class="col-3">
                            <div class="text">Rota</div>
                            <div class="text"><strong>
                                    @if(!is_null($diligencia->rota_id))
                                        {{$diligencia->rota->nome}}
                                    @else
                                        @if(!is_null($diligencia->cidade->rota))
                                            {{$diligencia->cidade->rota->nome}}
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
                        <div class="col-4">
                            <div class="text">Nome</div>
                            <div class="text"><strong>{{ $diligencia->nome }}</strong></div>
                        </div>
                        <div class="col-4">
                            <div class="text">Telefones</div>
                            <div class="text">
                                <strong>{{ ($diligencia->telefone) ? $diligencia->telefone : "Não informado" }}</strong>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text">CRECI</div>
                            <div class="text">
                                <strong>{{ ($diligencia->creci) ? $diligencia->creci : "Não informado" }}</strong>
                            </div>
                        </div>
                    </div>
                    @if(!is_null($diligencia->ocorrencias))
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="text">Ocorrencia(s)</div>
                                @foreach($diligencia->ocorrencias as $ocorrencia)
                                    <div class="text"><strong>{{ $ocorrencia->nome }}</strong></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text">Endereço</div>
                            <div class="text">
                                <strong>{{ ($diligencia->endereco) ? $diligencia->endereco : "Não informado" }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text">Observações</div>
                            <div class="text">
                                <strong>{{ ($diligencia->observacao) ? $diligencia->observacao : "Não informado" }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="text">Status</div>
                        </div>
                        <div class="col-12">
                            <div class="text">
                                <strong>
                                <?php
                                    switch($diligencia->status) {
                                        case "AB": echo "ABERTA";
                                            break;
                                        case "EA": echo "EM ANDAMENTO";
                                            break;
                                        case "AN": echo "AUTO DE NOTIFICAÇÃO";
                                            break;
                                        case "AI": echo "AUTO DE INFRAÇÃO";
                                            break;
                                        case "AC": echo "AUTO DE CONSTATAÇÃO";
                                            break;
                                        case "PR": echo "PROCESSO";
                                            break;
                                        case "AR": echo "ARQUIVO";
                                            break;
                                        case "CO": echo "CONCLUÍDO";
                                            break;
                                        default:
                                            echo "SEM STATUS";
                                    }
                                ?>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    @hasanyrole('super-admin|gerencia|administrativo')
                    <div class="row">
                        <div class="col-6">
                            <div class="text">Nome denunciante</div>
                            <div class="text"><strong>{{$diligencia->nome_denunciante}}</strong></div>
                        </div>
                        <div class="col-6">
                            <div class="text">Telefone denunciante</div>
                            <div class="text"><strong>{{$diligencia->telefone_denunciante}}</strong></div>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    @endhasanyrole
                    <div class="row col-12">Fotos:</div>
                    <div class="row col-12">
                        @foreach($diligencia->fotos as $foto)
                            <div class="col-2">
                                <div style="margin-top: 10px;">
                                    <img src="{{ url("/uploads/thumbs/") . "/" . $foto->path }}"/>
                                </div>
                                @hasanyrole('super-admin|gerencia|administrativo')
                                <div class="text-center" style="margin-top: 10px;">
                                    <form action="{{ route('foto.delete', $foto->id) }}" method="POST"
                                          class="form-horizontal">
                                        @csrf
                                        {{method_field('delete')}}
                                        <button type="button" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#modal{{$foto->id}}">
                                            Ver
                                        </button>
                                        <button type="submit" onclick="if(confirm('Tem certeza?')) form.submit();"
                                                class="btn btn-danger btn-sm">Remover
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endhasanyrole
                            <div class="modal fade" id="modal{{$foto->id}}" role="dialog">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Foto</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Fechar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ url("/uploads/") . "/" . $foto->path }}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('diligencia.index')}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('foto.upload', $diligencia->id)}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-upload"></i> Enviar Fotos
                </a>
                <a href="{{url('/diligencia/pdf/'.$diligencia->id)}}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="fa fa-print"></i> Imprimir
                </a>
                @hasanyrole('super-admin|gerencia|administrativo')
                <a href="{{route('diligencia.edit', $diligencia->id)}}" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit"></i> Editar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form1.submit();"
                        class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
                @endhasanyrole
                <a href="{{route('diligencia.historico', $diligencia->id)}}" class="btn btn-info btn-sm">
                    <i class="fa fa-tags"></i> Histórico
                </a>
                @hasanyrole('super-admin|gerencia|administrativo')
                <a href="{{route('diligencia.create')}}" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-plus"></i> Novo
                </a>
                @endhasanyrole
            </div>
        </div>
    </div>
@endsection
