<div class="card-body card-block">
    <div class="form-group">
        <label for="nome" class="form-control-label">Nome</label>
        <input id="nome" name="nome" type="text" class="form-control input-upper" value="@if(isset($origem->nome)){{$origem->nome}}@else{{old('nome')}}@endif">
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
