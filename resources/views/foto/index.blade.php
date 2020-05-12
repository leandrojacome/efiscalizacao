
@extends('layouts.template')

@section('titulo', "Upload")
@section('styles')
    {{Html::style('vendor/dropzone/dist/min/dropzone.min.css')}}
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Enviar fotos
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <div class="col-1">
                    &nbsp;
                </div>
                <div class="col-10">
                    <form method="post" action="{{route('foto.upload.send', $diligencia_id)}}" enctype="multipart/form-data"
                          class="dropzone" id="dropzone">
                        @csrf
                    </form>
                </div>
                <div class="col-1">
                    &nbsp;
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="card-footer">
                <a href="{{route('diligencia.show', $diligencia_id)}}" class="btn btn-success btn-sm">
                    <i class="fa fa-backward"></i> Voltar
                </a>
            </div>
        </div>
    </div>
@endsection
@section('script_parse')
    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: false,
                dictRemoveFile: "Remover",
                dictDefaultMessage: "Arraste e solte a foto aqui, ou clique para selecionar.",
                dictCancelUpload: "Cancelar",
                timeout: 5000,
                success: function(file, response)
                {
                    console.log(response);
                },
                error: function(file, response)
                {
                    return false;
                }
            };
    </script>
@endsection
@section('scripts')
    {{Html::script('vendor/dropzone/dist/min/dropzone.min.js')}}
@endsection
