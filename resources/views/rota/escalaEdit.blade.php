@extends('layouts.template')

@section('titulo','Cadastrar rota')

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
                Editar escala
            </div>
            <div class="card-body card-block">
                <form name="form1" action="{{route('rota.escalaStore')}}" method="POST" class="form-horizontal">
                    @csrf
                    {{method_field('patch')}}
                    <div class="card-body card-block">
                        @for($i=0;$i<count($rotas);$i++)
                            <div class="row form-group">
                                <div class="col-6">
                                    @if(!empty($escala))
                                        <select name="rota[{{$i}}]" id="rota{{$i}}">
                                            <option value="">Selecione uma rota</option>
                                            @foreach($rotas as $rota)
                                                <option
                                                    value="{{$rota->id}}" {{(($rota->id === $escala[$i]['rota_id'])) ? 'selected' : ''}}>{{$rota->nome}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select name="rota[{{$i}}]" id="rota{{$i}}">
                                            <option value="">Selecione uma rota</option>
                                            @foreach($rotas as $rota)
                                                <option
                                                    value="{{$rota->id}}">{{$rota->nome}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="col-6 text-left">
                                    @if(!empty($escala))
                                        <select name="fiscal[{{$i}}]" id="fiscal{{$i}}">
                                            <option value="">Selecione um fiscal</option>
                                            @foreach($fiscais as $fiscal)
                                                <option
                                                    value="{{$fiscal->id}}" {{($fiscal->id === $escala[$i]['fiscal_id']) ? 'selected' : ''}}>{{$fiscal->user->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select name="fiscal[{{$i}}]" id="fiscal{{$i}}">
                                            <option value="">Selecione um fiscal</option>
                                            @foreach($fiscais as $fiscal)
                                                <option
                                                    value="{{$fiscal->id}}">{{$fiscal->user->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>
                        @endfor
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button type="button" onclick="form1.submit();" class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Salvar
                </button>
                <a href="{{route('rota.index')}}" type="reset" class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i> Cancelar
                </a>
            </div>
        </div>
    </div>
@endsection
@section('script_parse')
    <script>
        $('#rota0').select2();
        $('#rota1').select2();
        $('#rota2').select2();
        $('#rota3').select2();
        $('#rota4').select2();
        $('#rota5').select2();
        $('#rota6').select2();
        $('#rota7').select2();
        $('#rota8').select2();

        $('#fiscal0').select2();
        $('#fiscal1').select2();
        $('#fiscal2').select2();
        $('#fiscal3').select2();
        $('#fiscal4').select2();
        $('#fiscal5').select2();
        $('#fiscal6').select2();
        $('#fiscal7').select2();
        $('#fiscal8').select2();

    </script>
@endsection

