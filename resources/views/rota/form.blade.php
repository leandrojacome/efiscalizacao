<div class="card-body card-block">
    <div class="row form-group">
        <label for="nome" class="form-control-label">Nome</label>
        <input id="nome" name="nome" type="text" class="form-control input-upper"
               value="@if(isset($rota->nome)){{$rota->nome}}@else{{old('nome')}}@endif">
    </div>
    <div class="row col-12 form-group">
        <div class="col-2">
            <label for="escala" class="form-check-label">Tem escala?</label>
        </div>
        <div class="col-10">
            <label class="switch switch-3d switch-primary mr-3">
                <input id="escala" name="escala" class="switch-input" type="checkbox"
                @if(isset($rota->escala) and ($rota->escala == 'on')){{"checked=true"}}@else{{old('escala')}}@endif>
                <span class="switch-label"></span>
                <span class="switch-handle"></span>
            </label>
        </div>
    </div>
</div>
@section('script_parse')
    <script>
        $('document').ready(function () {
            $("input[type=text]").css("text-transform", "uppercase");
            $("input[type=text]").keyup(function () {
                $(this).val($(this).val().toUpperCase());
            });
        });
    </script>
@endsection
