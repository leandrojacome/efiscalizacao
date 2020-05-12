
<div class="form-group">
    <label for="cidades" class="form-control-label">Cidades</label>
    <select name="cidades" id="cidades" multiple>
        @foreach($cidades as $cidade)
            <option value="{{$cidade->id}}">{{$cidade->nome}}</option>
        @endforeach
    </select>
    <input type="hidden" name="cidadesSelecionadas" id="cidadesSelecionadas">
</div>
<div class="form-group">
    <label for="fiscais" class="form-control-label">Fiscais</label>
    <select name="fiscais" id="fiscais" multiple>
        @foreach($fiscais as $fiscal)
            <option value="{{$fiscal->id}}">{{$fiscal->user->name}}</option>
        @endforeach
    </select>
    <input type="hidden" name="fiscaisSelecionados" id="fiscaisSelecionados">
</div>
<div class="row col-12">
    <div class="col-6">Data de Inínio</div>
    <div class="col-6">Data Final</div>
</div>
<div class="row form-group col-12">
    <div class="col-6"><input type="text" class="form-control" name="data_inicio" id="data_inicio"></div>
    <div class="col-6"><input type="text" class="form-control" name="data_fim" id="data_fim"></div>
</div>
@if(!empty($viagem))
    <div class="row form-group">
        <div class="col-12">
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="40%">tipo</th>
                        <th width="40%">numero</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($historicos))
                        @foreach($historicos as $historico)
                            <tr>
                                <td>{{$historico->id}}</td>
                                <td>{{$historico->tipo_historico->nome}}</td>
                                <td>{{$historico->numero}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Não há nenhum histórico</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Cadastrar de documentos
            </div>
            <div class="card-body card-block">
                <div class="card-body card-block">
                    <form name="form1" action="#" method="post" class="form-horizontal">
                        @csrf
                        <div class="row form-group">
                            <div class="col-6">
                                <label for="tipo_historico_id" class="form-control-label">Origem</label>
                                <select name="tipo_historico_id" id="tipo_historico_id" class="form-control">
                                    <option value="">Selecione um tipo de histórico</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="numero" class="form-control-label">Número</label>
                                <input type="text" name="numero" id="numero" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" id="buttonSave" onclick="form1.submit();"
                        class="btn btn-primary btn-sm">
                    <i class="fa fa-dot-circle-o"></i> Adicionar
                </button>
            </div>
        </div>
    </div>
    @endif
@section('script_parse')
    <script>
        $('#cidades').select2();
        $('#fiscais').select2();
        let valorCidades = [];
        $('#cidades').on('select2:selecting', function (e) {
            let value = e.params.args.data.id;
            valorCidades.push(value);
            console.log(valorCidades);
        });
        $('#cidades').on('select2:unselecting', function (e) {
            let value = e.params.args.data.id;
            index = valorCidades.indexOf(value);
            if (index > -1) {
                (index == 0) ? valorCidades.shift() : valorCidades.splice(index, value);
                console.log(valorCidades);
            }
        });
        let valorFiscais = [];
        $('#fiscais').on('select2:selecting', function (e) {
            let value = e.params.args.data.id;
            valorFiscais.push(value);
            console.log(valorFiscais);
        });
        $('#fiscais').on('select2:unselecting', function (e) {
            let value = e.params.args.data.id;
            index = valorFiscais.indexOf(value);
            if (index > -1) {
                (index == 0) ? valorFiscais.shift() : valorFiscais.splice(index, value);
                console.log(valorFiscais);
            }
        });
        $('#form1').on('submit', function () {
            for (i=0;i<valorCidades.length;i++)
            {
                $('#cidadesSelecionadas').val(valorCidades[i]+"|");
            }
            for (i=0;i<valorFiscais.length;i++)
            {
                $('#cidadesSelecionadas').val(valorCidades[i]+"|");
            }
        });
        $('#data_inicio').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            lang: 'en',
            weekStart : 0,
            time: false,
            cancelText : 'Cancelar',
            clearButton: true,
            clearText: 'Limpar',
        });
        $('#data_fim').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
            lang: 'en',
            weekStart : 0,
            time: false,
            cancelText : 'Cancelar',
            clearButton: true,
            clearText: 'Limpar',
        });
    </script>
@endsection

