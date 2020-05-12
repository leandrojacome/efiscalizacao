<div class="card-body card-block">
    <div class="form-group">
        <label for="rota_id" class="form-control-label">Rota</label>
        <select name="rota_id" id="rota_id" class="form-control">
            <option value="">Selecione uma rota</option>
            @foreach($rotas as $rota)
                @if(isset($cidade))
                    @if($cidade->rota_id == $rota->id)
                        <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                    @endif
                @endif
                <option value="{{$rota->id}}" {{ (old("rota_id") == $rota->id ? "selected":"") }}>{{$rota->nome}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nome" class="form-control-label">Nome</label>
        <input id="nome" name="nome" type="text" class="form-control input-upper" value="@if(isset($cidade->nome)){{$cidade->nome}}@else{{old('nome')}}@endif">
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
