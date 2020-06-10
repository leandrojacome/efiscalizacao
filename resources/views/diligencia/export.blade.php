<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>DATA E HORA</th>
        <th>NOME</th>
        <th>CRECI</th>
        <th>ORIGEM</th>
        <th>CIDADE</th>
        <th>ROTA</th>
        <th>TELEFONE</th>
        <th>ENDERECO</th>
        <th>OBSERVACAO</th>
        <th>STATUS</th>
        <th>OCORRENCIAS</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0 ?>
    @foreach($diligencias as $diligencia)
        @if($i%2==0)
            <tr style="background-color: #9d9d9d">
        @else
            <tr>
                @endif
                <td>{{ $diligencia->id }}</td>
                <?php
                $data = explode(' ', $diligencia->data_hora);
                $data[0] = implode('/', array_reverse(explode('-', $data[0])));
                ?>
                <td>{{ $data[0] . ' ' . $data[1] }}</td>
                <td>{{ $diligencia->nome }}</td>
                <td>{{ $diligencia->creci }}</td>
                <td>{{ $diligencia->origem->nome }}</td>
                <td>{{ $diligencia->cidade->nome }}</td>
                <td>
                    @if(!is_null($diligencia->rota_id))
                        {{mb_strtoupper($diligencia->rota->nome)}}
                    @else
                        @if(!is_null($diligencia->cidade->rota))
                            {{mb_strtoupper($diligencia->cidade->rota->nome)}}
                        @else
                            SEM ROTA
                        @endif
                    @endif
                </td>
                <td>
                    @if((empty($diligencia->telefone) OR is_null($diligencia->telefone)))
                        SEM TELEFONE
                    @else
                        {{$diligencia->telefone}}
                    @endif
                </td>
                <td>
                    @if((empty($diligencia->endereco) OR is_null($diligencia->endereco)))
                        SEM ENDEREÇO
                    @else
                        {{$diligencia->endereco}}
                    @endif
                </td>
                <td>
                    @if((empty($diligencia->observacao) OR is_null($diligencia->observacao)))
                        SEM OBSERVAÇÂO
                    @else
                        {{$diligencia->observacao}}
                    @endif
                </td>
                <td>
                    <?php
                    switch ($diligencia->status) {
                        case "AB":
                            echo "ABERTA";
                            break;
                        case "EA":
                            echo "EM ANDAMENTO";
                            break;
                        case "AN":
                            echo "AUTO DE NOTIFICAÇÃO";
                            break;
                        case "AI":
                            echo "AUTO DE INFRAÇÃO";
                            break;
                        case "AC":
                            echo "AUTO DE CONSTATAÇÃO";
                            break;
                        case "PR":
                            echo "PROCESSO";
                            break;
                        case "AR":
                            echo "ARQUIVO";
                            break;
                        case "CO":
                            echo "CONCLUÍDO";
                            break;
                        default:
                            echo "SEM STATUS";
                    }
                    ?>
                </td>
                <td>
                    @if(count($diligencia->ocorrencias) == 0)
                        SEM OCORRÊNCIA
                    @else
                        @foreach($diligencia->ocorrencias as $ocorrencia)
                            {{mb_strtoupper($ocorrencia->nome).';'}}
                        @endforeach
                    @endif
                </td>
            </tr>
            <?php $i++ ?>
            @endforeach
    </tbody>
</table>
