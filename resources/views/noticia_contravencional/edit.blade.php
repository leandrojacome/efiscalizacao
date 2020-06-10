@extends('layouts.template')

@section('titulo', "Editar {$noticiaContravencional->nome}")

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
                Editar {{$noticiaContravencional->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('noticia_contravencional.update', $noticiaContravencional->id) }}"
                      method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('patch')}}
                    @include('noticia_contravencional.form')
                </form>
                <form name="form2" action="{{ route('noticia_contravencional.destroy', $noticiaContravencional->id) }}"
                      method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
            </div>
            <div class="card-footer">
                <button type="button" onclick="form1.submit();" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Salvar
                </button>
                <a href="{{route('noticia_contravencional.create')}}" type="reset" class="btn btn-success btn-sm">
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
                            <th width="20%">cidade</th>
                            <th width="5%">DP</th>
                            <th width="5%">data Lavratura</th>
                            <th width="5%">data Auto</th>
                            <th width="25%">fiscal</th>
                            <th width="10%" class="text-right">ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($noticiasContravencionais as $noticiaContravencional)
                            <tr>
                                <td id="id">{{$noticiaContravencional->id}}</td>
                                <td>
                                    <a href="{{ route('noticia_contravencional.show', $noticiaContravencional->id) }}">{{ $noticiaContravencional->nome }}</a>
                                </td>
                                <td>{{$noticiaContravencional->cidade->nome}}</td>
                                <td>{{$noticiaContravencional->dp}}</td>
                                <td>{{
                                    (!is_null($noticiaContravencional->data_lavratura)) ?
                                    implode('/',array_reverse(explode('-',$noticiaContravencional->data_lavratura))) :
                                    "Sem data"
                                    }}</td>
                                <td>
                                    {{
                                    (!is_null($noticiaContravencional->data_auto)) ?
                                    implode('/',array_reverse(explode('-',$noticiaContravencional->data_lavratura))) :
                                    "Sem data"
                                    }}
                                </td>
                                <?php $i = 0 ?>
                                <td>
                                    <div class="row">
                                        <select name="fiscal" id="fiscal-{{$i}}" class="form-control">
                                            <option value="">Selecione um fiscal</option>
                                            @foreach($fiscais as $fiscal)
                                                @if(!is_null($noticiaContravencional->fiscal_id))
                                                    @if($noticiaContravencional->fiscal_id == $fiscal->id)
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
                                    <a href="{{ route('noticia_contravencional.edit', $noticiaContravencional->id) }}"
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
    {{ $noticiasContravencionais->links() }}
@endsection
