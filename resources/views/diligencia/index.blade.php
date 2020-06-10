@extends('layouts.template')

@section('titulo', 'Diligencias')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="overview-wrap">
                <h2 class="title-1">diligências</h2>
                @hasanyrole('super-admin|gerencia|administrativo')
                <a class="au-btn au-btn-icon au-btn--blue" href="{{route('diligencia.create')}}">
                    <i class="fa fa-plus-square"></i>Novo</a>
                <a class="au-btn au-btn-icon au-btn--blue2" href="{{route('diligencia.export')}}" target="_blank">
                    <i class="fa fa-download"></i>Relatório</a>
                <a class="au-btn au-btn-icon au-btn--green" href="{{route('pdfDownloadAll')}}" target="_blank">
                    <i class="fa fa-download"></i>Download de Todas</a>
                @endhasanyrole
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
            <form action="{{url('/diligencia/buscar')}}" method="post" class="form-horizontal">
                @csrf
                <div class="input-group">
                    <input type="text" id="busca" name="busca" placeholder="Buscar..." class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-primary">
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
                        <th width="5%">#</th>
                        <th width="45%">nome</th>
                        <th width="20%">fiscal</th>
                        <th width="20%">status</th>
                        <th width="20%" class="text-center">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($diligencias))
                        <?php $i = 0 ?>
                        @foreach($diligencias as $diligencia)
                            <tr>
                                <td id="id">{{ $diligencia->id }}</td>
                                <td>
                                    <a href="{{ route('diligencia.show', $diligencia->id) }}">{{ mb_strtoupper($diligencia->nome) }}</a>
                                </td>
                                <td>
                                    <div class="row">
                                        <select name="fiscal_id" id="fiscal_id-{{$i}}" class="form-control">
                                            <option value="">Selecione um fiscal</option>
                                            @foreach($fiscais as $fiscal)
                                                @if(!is_null($diligencia->fiscal_id))
                                                    @if($diligencia->fiscal_id == $fiscal->id)
                                                        <option value="{{$fiscal->id}}"
                                                                selected>{{$fiscal->nome}}</option>
                                                    @endif
                                                @endif
                                                <option
                                                    value="{{$fiscal->id}}" {{ (old("fiscal_id") == $fiscal->id ? "selected":"") }}>{{$fiscal->nome}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <select name="status[{{$diligencia->id}}]" id="status-{{$i}}" class="form-control">
                                            <option value="">Selecione um status</option>
                                            <option value="AB" {{(isset($diligencia->status) and ($diligencia->status === 'AB')) ? 'selected' : null}}>ABERTA</option>
                                            <option value="EA" {{(isset($diligencia->status) and ($diligencia->status === 'EA')) ? 'selected' : null}}>EM ANDAMENTO</option>
                                            <option value="AN" {{(isset($diligencia->status) and ($diligencia->status === 'AN')) ? 'selected' : null}}>AUTO DE NOTIFICAÇÃO</option>
                                            <option value="AI" {{(isset($diligencia->status) and ($diligencia->status === 'AI')) ? 'selected' : null}}>AUTO DE INFRAÇÃO</option>
                                            <option value="AC" {{(isset($diligencia->status) and ($diligencia->status === 'AC')) ? 'selected' : null}}>AUTO DE CONSTATAÇÃO</option>
                                            <option value="PR" {{(isset($diligencia->status) and ($diligencia->status === 'PR')) ? 'selected' : null}}>PROCESSO</option>
                                            <option value="AR" {{(isset($diligencia->status) and ($diligencia->status === 'AR')) ? 'selected' : null}}>ARQUIVO</option>
                                            <option value="CO" {{(isset($diligencia->status) and ($diligencia->status === 'CO')) ? 'selected' : null}}>CONCLUÍDA</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <a href="{{route('diligencia.historico', $diligencia->id)}}" type="reset"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-tags"></i>
                                    </a>
                                    <a href="{{route('foto.upload', $diligencia->id)}}"
                                       class="btn btn-warning btn-sm">
                                        <i class="fa fa-upload"></i>
                                    </a>
                                    <a href="{{url('/diligencia/pdf/'.$diligencia->id)}}" target="_blank"
                                       class="btn btn-secondary btn-sm">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a href="{{url("/diligencia/pdf/{$diligencia->id}/download")}}" target="_blank"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @hasanyrole('super-admin|gerencia|administrativo')
                                    <a href="{{ route('diligencia.edit', $diligencia->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i></a>
                                    @endhasanyrole
                                </td>
                            </tr>
                            <?php $i++ ?>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Nenhum registro encontrado.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $diligencias->links() }}
@endsection
@section('script_parse')
    <script>
        $(document).ready(function () {
            $("select[name='fiscal_id']").each(function (index, element) {
                $('#fiscal_id-'+index).on('change', function() {
                    changeFiscal($(this).closest('tr').children('td#id').text(), $(this).find(":selected").val())
                });
                $('#status-'+index).on('change', function() {
                    changeStatus($(this).closest('tr').children('td#id').text(), $(this).find(":selected").val())
                });
            })
            function changeFiscal (diligenciaId, fiscalId) {
                $.ajax({
                    type: "GET",
                    url: '/diligencia/'+diligenciaId+'/'+fiscalId+'/changeFiscal',
                    success: function (data) {
                        alert(data+'Fiscal alterado com sucesso.');
                    }
                })
            }
            function changeStatus (diligenciaId, status) {
                $.ajax({
                    type: "GET",
                    url: '/diligencia/'+diligenciaId+'/'+status+'/changeStatus',
                    success: function (data) {
                        alert('Status alterado com sucesso.');
                    }
                })
            }
        })
    </script>
@endsection
