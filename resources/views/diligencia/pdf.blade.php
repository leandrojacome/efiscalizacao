<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diligência - {{str_pad($diligencia->id, 4, 0, STR_PAD_LEFT)}} - {{$diligencia->nome}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images')}}/favicon.ico">
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 20px 10px;
            font-family: Arial, sans-serif;
        }

        img {
            margin-top: 40px;
        }

        hr {
            margin: 20px 20px;
        }
    </style>
</head>
<body>
<div align="center"><strong>DILIGÊNCIA - {{str_pad($diligencia->id, 4, 0, STR_PAD_LEFT)}}
        - {{$diligencia->user->sigla}}</strong></div>
<table width="80%" align="center">
    <tr>
        <td width="40%"><strong>DATA / HORA:</strong> {{ date( 'd/m/Y', strtotime($diligencia->data_hora)) }}
            / {{ date( 'H:i', strtotime($diligencia->data_hora)) }}</td>
        <td width="40%"><strong>ORIGEM:</strong> {{mb_strtoupper($diligencia->origem->nome)}}</td>
    </tr>
    <tr>
        <td width="40%"><strong>CIDADE:</strong> {{$diligencia->cidade->nome}}</td>
        <td width="40%"><strong>ROTA:</strong>
            @if(!is_null($diligencia->rota_id))
                {{mb_strtoupper($diligencia->rota->nome)}}
            @else
                @if(!is_null($diligencia->cidade->rota))
                    {{mb_strtoupper($diligencia->cidade->rota->nome)}}
                @else
                    SEM ROTA
                @endif
            @endif</td>
    </tr>
    <tr>
        <td width="80%" colspan="2"><strong>NOME:</strong> {{mb_strtoupper($diligencia->nome)}}</td>
    </tr>
    <tr>
        <td width="80%" colspan="2"><strong>CRECI:</strong>
            @if((empty($diligencia->creci) OR is_null($diligencia->creci)))
                SEM Nº DE CRECI
            @else
                {{$diligencia->creci}}
            @endif
        </td>
    </tr>
    <tr>
        <td width="80%" colspan="2"><strong>OCORRÊNCIA(S):</strong></td>
    </tr>
    @if(count($diligencia->ocorrencias) == 0)
        SEM OCORRÊNCIA
    @else
        @foreach($diligencia->ocorrencias as $ocorrencia)
            <tr>
                <td width="80%" colspan="2">{{mb_strtoupper($ocorrencia->nome)}}</td>
            </tr>
        @endforeach
    @endif
    <tr>
        <td width="80%" colspan="2"><strong>TELEFONE(S):</strong>
            @if((empty($diligencia->telefone) OR is_null($diligencia->telefone)))
                SEM TELEFONE
            @else
                {{$diligencia->telefone}}
            @endif
        </td>
    </tr>
    <tr>
        <td width="80%" colspan="2"><strong>ENDEREÇO:</strong>
            @if((empty($diligencia->endereco) OR is_null($diligencia->endereco)))
                SEM ENDEREÇO
            @else
                {{$diligencia->endereco}}
            @endif
        </td>
    </tr>
    <tr>
        <td width="80%" colspan="2"><strong>OBSERVAÇÃO:</strong>
            @if((empty($diligencia->observacao) OR is_null($diligencia->observacao)))
                SEM OBSERVAÇÂO
            @else
                {{$diligencia->observacao}}
            @endif
        </td>
    </tr>
    <tr>
        <td width="80%" colspan="2"></td>
    </tr>
    <tr>
        <td width="40%"><strong>AUTO DE NOTIFICAÇÃO</strong></td>
        <td width="40%"><strong>AUTO DE INFRAÇÃO</strong></td>
    </tr>
    <tr>
        <td width="40%">
            <strong>(&nbsp;&nbsp;) SIM:</strong> __________________<br>
            <strong>(&nbsp;&nbsp;) NÂO</strong>
        </td>
        <td width="40%">
            <strong>(&nbsp;&nbsp;) SIM:</strong> __________________<br>
            <strong>(&nbsp;&nbsp;) NÂO</strong>
        </td>
    </tr>
    <tr>
        <td width="80%" colspan="2" align="center"></td>
    </tr>
    <tr>
        <td width="80%" colspan="2" align="center"></td>
    </tr>
    <tr>
        <td width="80%" colspan="2" align="center"><strong>HISTÓRICO:</strong></td>
    </tr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
</table>
<table width="100%">
    @foreach($diligencia->fotos as $foto)
        <tr>
            <td width="100%" style="text-align: center"><img src="{{url('/uploads/grey/') . "/" . $foto->path }}"
                                                             height="1010" alt=""></td>
        </tr>
    @endforeach
</table>
</body>
</html>


