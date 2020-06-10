<div class="card-body card-block">
    <div class="row form-group">
        <div class="col-3">
            <label for="data_hora" class="form-control-label">Data / Hora</label>
            <input name="data_hora" id="data_hora" class="form-control"
                   value="@if(isset($diligencia->data_hora)){{$data_hora}}@else{{date('d/m/Y H:i:s')}}@endif">
        </div>
        <div class="col-9">
            <label for="origem_id" class="form-control-label">Origem</label>
            <select name="origem_id" id="origem_id" class="form-control">
                <option value="">Selecione uma origem</option>
                @foreach($origens as $origem)
                    @if(isset($diligencia))
                        @if($diligencia->origem_id == $origem->id)
                            <option value="{{$origem->id}}" selected>{{$origem->nome}}</option>
                        @endif
                    @endif
                    <option
                        value="{{$origem->id}}" {{ (old("origem_id") == $origem->id ? "selected":"") }}>{{$origem->nome}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-4">
            <label for="cidade_id" class="form-control-label">Cidade</label>
            <select name="cidade_id" id="cidade_id" class="form-control">
                <option value="">Selecione uma cidade</option>
                @foreach($cidades as $cidade)
                    @if(isset($diligencia))
                        @if($diligencia->cidade_id == $cidade->id)
                            <option value="{{$cidade->id}}" selected>{{$cidade->nome}}</option>
                        @endif
                    @endif
                    <option
                        value="{{$cidade->id}}" {{ (old("cidade_id") == $cidade->id ? "selected":"") }}>{{$cidade->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <label for="rota_id" class="form-control-label">Rota</label>
            <select name="rota_id" id="rota_id" class="form-control">
                <option value="">Selecione uma rota</option>
                @foreach($rotas as $rota)
                    @if(isset($diligencia))
                        @if(!is_null($diligencia->rota_id))
                            @if($diligencia->rota_id == $rota->id)
                                <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                            @elseif($diligencia->cidade->rota_id == $rota->id)
                                <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                            @endif
                        @endif
                        @if(old("rota_id") == $rota->id)
                            <option value="{{$rota->id}}" selected>{{$rota->nome}}</option>
                        @endif
                    @endif
                    <option value="{{$rota->id}}" selected) }}>{{$rota->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <label for="status" class="form-control-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="">Selecione um status</option>
                <option value="">--------------------</option>
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
    </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <label for="nome" class="form-control-label">Nome</label>
            <input id="nome" name="nome" type="text" class="form-control"
                   value="@if(isset($diligencia->nome)){{$diligencia->nome}}@else{{old('nome')}}@endif">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <label for="creci" class="form-control-label">CRECI</label>
            <input id="creci" name="creci" type="text" class="form-control"
                   value="@if(isset($diligencia->creci)){{$diligencia->creci}}@else{{old('creci')}}@endif">
        </div>
    </div>
    <div class="row style-select form-group">
        <div class="col-12">
            <div class="subject-info-box-1">
                <label for="ocorrencias_disponiveis">Ocorrências disponíveis</label>
                <select name="ocorrencias_disponiveis[]" id="lstBox1" class="form-control" multiple="multiple">
                    @foreach($lstBox1 as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="subject-info-arrows text-center">
                <br/><br/>
                <input type='button' id='btnAllRight' value='>>' class="btn btn-default"/><br/>
                <input type='button' id='btnRight' value='>' class="btn btn-default"/><br/>
                <input type='button' id='btnLeft' value='<' class="btn btn-default"/><br/>
                <input type='button' id='btnAllLeft' value='<<' class="btn btn-default"/>
            </div>
            <div class="subject-info-box-2">
                <label for="ocorrencias">Ocorrências</label>
                <select name="ocorrencias[]" id="lstBox2" class="form-control" multiple="multiple">
                    @foreach($lstBox2 as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row form-group">
        <div class="col-12">
            <label for="telefone" class="form-control-label">Telefones</label>
            <input id="telefone" name="telefone" type="text" class="form-control"
                   value="@if(isset($diligencia->telefone)){{$diligencia->telefone}}@else{{old('telefone')}}@endif">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <label for="endereco" class="form-control-label">Endereço</label>
            <input id="endereco" name="endereco" type="text" class="form-control"
                   value="@if(isset($diligencia->endereco)){{$diligencia->endereco}}@else{{old('endereco')}}@endif">
        </div>
    </div>
    <div class="row form-group">
        <div class="col-12">
            <label for="onservacao" class="form-control-label">Observação</label>
            <textarea id="observacao" name="observacao" type="text" class="form-control" style="text-transform: uppercase;" rows="5">
                @if(isset($diligencia->observacao)){{$diligencia->observacao}}@else{{old('observacao')}}@endif
            </textarea>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-6">
            <label for="nome_denunciante" class="form-control-label">Nome Denunciante</label>
            <input id="nome_denunciante" name="nome_denunciante" type="text" class="form-control"
                   value="@if(isset($diligencia->nome_denunciante)){{$diligencia->nome_denunciante}}@else{{old('nome_denunciante')}}@endif">
        </div>
        <div class="col-6">
            <label for="telefone_denunciante" class="form-control-label">Telefone Denunciante</label>
            <input id="telefone_denunciante" name="telefone_denunciante" type="text" class="form-control"
                   value="@if(isset($diligencia->telefone_denunciante)){{$diligencia->telefone_denunciante}}@else{{old('telefone_denunciante')}}@endif">
        </div>
    </div>
</div>
@section('script_parse')
    <script>
        moment.locale('pt-BR');
        $('document').ready(function () {
            $('#buttonSave').hover(function () {
                var selects = [];
                $.each($('#lstBox2 option'), function () {
                    $(this).attr('selected', true);
                });
            });
            $('#buttonSave').focus(function () {
                var selects = [];
                $.each($('#lstBox2 option'), function () {
                    $(this).attr('selected', true);
                });
            });
            $("input[type=text]").css("text-transform","uppercase");
            $("input[type=text]").keyup(function () {
               $(this).val($(this).val().toUpperCase());
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
            $('#origem_id').select2({});
            $('#cidade_id').select2({});
            $('#rota_id').select2({});
            $('#rota_id').select2().trigger('change');
            $('#localizacao_id').select2({});
            $('#status').select2({});
            $('#btnRight').click(function (e) {
                $('select').moveToListAndDelete('#lstBox1', '#lstBox2');
                e.preventDefault();
            });

            $('#btnAllRight').click(function (e) {
                $('select').moveAllToListAndDelete('#lstBox1', '#lstBox2');
                e.preventDefault();
            });

            $('#btnLeft').click(function (e) {
                $('select').moveToListAndDelete('#lstBox2', '#lstBox1');
                e.preventDefault();
            });

            $('#btnAllLeft').click(function (e) {
                $('select').moveAllToListAndDelete('#lstBox2', '#lstBox1');
                e.preventDefault();
            });
            $('#data_hora').bootstrapMaterialDatePicker({
                format: 'DD/MM/YYYY HH:mm',
                lang: 'fr',
                weekStart: 0,
                time: true,
                cancelText: 'Cancelar',
                clearButton: true,
                clearText: 'Limpar',
            });
        })
    </script>
@endsection
