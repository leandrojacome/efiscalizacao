
@extends('layouts.template')

@section('titulo', "Editar {$diligencia->nome}")

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
                Editar {{$diligencia->nome}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('diligencia.update', $diligencia->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('patch')}}
                    @include('diligencia.form')
                </form>
                <form name="form2" action="{{ route('diligencia.destroy', $diligencia->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
                <div class="row col-12">
                    @foreach($diligencia->fotos as $foto)
                        <div class="col-2">
                            <div style="margin-top: 10px;">
                                <img src="{{ url("/uploads/thumbs/") . "/" . $foto->path }}" />
                            </div>
                            <div class="text-center" style="margin-top: 10px;">
                                <form action="{{ route('foto.delete', $foto->id) }}" method="POST" class="form-horizontal">
                                    @csrf
                                    {{method_field('delete')}}
                                    <button type="submit" onclick="if(confirm('Tem certeza?')) form.submit();" class="btn btn-danger btn-sm">Remover</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <button type="button" id="buttonSave" onclick="form1.submit();" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Salvar
                </button>
                <a href="{{route('diligencia.index')}}" type="reset" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
                <a href="{{route('foto.upload', $diligencia->id)}}" class="btn btn-warning btn-sm">
                    <i class="fa fa-upload"></i> Enviar Fotos
                </a>
                <a href="{{url('/diligencia/pdf/'.$diligencia->id)}}" target="_blank" class="btn btn-secondary btn-sm">
                    <i class="fa fa-print"></i> Imprimir
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form2.submit();" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
                <a href="{{route('diligencia.historico', $diligencia->id)}}" type="reset" class="btn btn-info btn-sm">
                    <i class="fa fa-tags"></i> Histórico
                </a>
            </div>
        </div>
    </div>
@endsection
