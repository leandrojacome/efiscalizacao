
@extends('layouts.template')

@section('titulo', "Editar {$papel->slug}")

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
                Editar {{$papel->slug}}
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{ route('papel.update', $papel->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('patch')}}
                    @include('papel.form')
                </form>
                <form name="form2" action="{{ route('papel.destroy', $papel->id) }}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('delete')}}
                </form>
            </div>
            <div class="card-footer">
                <button type="button" onclick="form1.submit();" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> Salvar
                </button>
                <a href="{{route('papel.index')}}" type="reset" class="btn btn-success btn-sm">
                    <i class="fa fa-ban"></i> Cancelar
                </a>
                <button type="button" onclick="if(confirm('Tem certeza?')) form2.submit();" class="btn btn-danger btn-sm">
                    <i class="fa fa-times"></i> Remover
                </button>
            </div>
        </div>
    </div>
@endsection
