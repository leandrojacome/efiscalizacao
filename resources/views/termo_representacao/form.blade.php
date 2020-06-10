<div class="card-body card-block">
    <div class="row form-group">
        <div class="col-6">
            <label for="localizacao_id" class="form-control-label">Local</label>
            <select name="localizacao_id" id="localizacao_id" class="form-control">
                <option value="">Selecione uma local</option>
                @foreach($localizacoes as $localizacao)
                    @if(isset($termoRepresentacao))
                        @if(!is_null($termoRepresentacao->localizacao_id))
                            @if($termoRepresentacao->localizacao_id == $localizacao->id)
                                <option value="{{$localizacao->id}}" selected>{{$localizacao->nome}}</option>
                            @endif
                        @endif
                        @if(old("localizacao_id") == $localizacao->id)
                            <option value="{{$localizacao->id}}" selected>{{$localizacao->nome}}</option>
                        @endif
                    @endif
                    <option value="{{$localizacao->id}}">{{$localizacao->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="fiscal_id" class="form-control-label">Fiscal</label>
            <select name="fiscal_id" id="fiscal_id" class="form-control">
                <option value="">Selecione uma fiscal</option>
                @foreach($fiscais as $fiscal)
                    @if(isset($termoRepresentacao))
                        @if(!is_null($termoRepresentacao->fiscal_id))
                            @if($termoRepresentacao->fiscal_id == $fiscal->id)
                                <option value="{{$fiscal->id}}" selected>{{$fiscal->user->name}}</option>
                            @endif
                        @endif
                        @if(old("fiscal_id") == $fiscal->id)
                            <option value="{{$fiscal->id}}" selected>{{$fiscal->user->name}}</option>
                        @endif
                    @endif
                    <option value="{{$fiscal->id}}">{{$fiscal->user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-6">
            <label for="cidade_id" class="form-control-label">Cidade</label>
            <select name="cidade_id" id="cidade_id" class="form-control">
                <option value="">Selecione uma rota</option>
                @foreach($cidades as $cidade)
                    @if(isset($termoRepresentacao))
                        @if(!is_null($termoRepresentacao->cidade_id))
                            @if($termoRepresentacao->cidade_id == $cidade->id)
                                <option value="{{$cidade->id}}" selected>{{$cidade->nome}}</option>
                            @endif
                        @endif
                        @if(old("cidade_id") == $cidade->id)
                            <option value="{{$cidade->id}}" selected>{{$cidade->nome}}</option>
                        @endif
                    @endif
                    <option value="{{$cidade->id}}">{{$cidade->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6">
            <label for="rota_id" class="form-control-label">Rota</label>
            <select name="rota_id" id="rota_id" class="form-control">
                <option value="">Selecione uma rota</option>
                @foreach($rotas as $rota)
                    @if(isset($termoRepresentacao))
                        @if(!is_null($termoRepresentacao->rota_id))
                            @if($termoRepresentacao->rota_id == $rota->id)
                                <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                            @elseif($termoRepresentacao->cidade->rota_id == $rota->id)
                                <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                            @endif
                        @endif
                        @if(old("rota_id") == $rota->id)
                            <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                        @endif
                    @endif
                    <option value="{{$rota->id}}">{{$rota->nome}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-6">
            <div class="form-group">
                <label for="nome" class="form-control-label">Nome</label>
                <input id="nome" name="nome" type="text" class="form-control input-upper"
                       value="@if(isset($termoRepresentacao->nome)){{$termoRepresentacao->nome}}@else{{old('nome')}}@endif">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="data_lavratura" class="form-control-label">Data de Lavratura</label>
                <input id="data_lavratura" name="data_lavratura" type="text" class="form-control input-upper date"
                       value="@if(isset($termoRepresentacao->data_lavratura)){{implode('/',array_reverse(explode('-',$termoRepresentacao->data_lavratura)))}}@else{{old('data_lavratura')}}@endif">
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="data_entrega" class="form-control-label">Data de entrega</label>
                <input id="data_entrega" name="data_entrega" type="text" class="form-control input-upper date"
                       value="@if(isset($termoRepresentacao->data_entrega)){{implode('/',array_reverse(explode('-',$termoRepresentacao->data_entrega)))}}@else{{old('data_entrega')}}@endif">
            </div>
        </div>
    </div>
    @if(session('msg'))
        <div class="sufee-alert alert with-close alert-{{session('status')}} alert-dismissible fade show">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
</div>
@section('script_parse')
    <script>
        $('document').ready(function () {
            $("input[type=text]").css("text-transform", "uppercase");
            $("input[type=text]").keyup(function () {
                $(this).val($(this).val().toUpperCase());
            });
        });
        $('#cidade_id').change(function () {
            var id = $('#cidade_id').val();
            var data;
            $.ajax({
                type: 'get',
                url: '{{url('/getRota')}}/' + id,
                success: function (response) {
                    //$('#rota_id').find('option[value="'+response+'"]').attr("selected",true);
                    $('#rota_id').val(response);
                    $('#rota_id').select2().trigger('change');
                },
                error: function () {
                    alert('Ocorreu um erro.');
                }
            })
        });
        $('#cidade_id').select2({});
        $('#fiscal_id').select2({});
        $('#rota_id').select2().trigger('change');
        $('#localizacao_id').select2({});
        $('.date').mask('99/99/9999');
        $("select[name='fiscal']").each(function (index, element) {
            $('#fiscal-' + index).on('change', function () {
                changeFiscal($(this).closest('tr').children('td#id').text(), $(this).find(":selected").val())
            });
        })

        function changeFiscal(termoId, fiscalId) {
            $.ajax({
                type: "GET",
                url: '/termo_representacao/' + termoId + '/' + fiscalId + '/changeFiscal',
                success: function (data) {
                    alert(data + 'Fiscal alterado com sucesso.');
                }
            })
        }
    </script>
@endsection

