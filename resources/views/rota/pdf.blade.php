<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images')}}/favicon.ico">
    <title>Escala de rotas - mês {{date('m')}}</title>
    <style>
        /** Define the margins of your page **/
        * {
            font-family: Arial, sans-serif;
            font-size:  22px;
        }
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
<table width="80%" align="center">
    <thead>
    <tr style="background-color: #2b2b2b; color: #fff;">
        <th>Rota</th>
        <th>Fiscal</th>
    </tr>
    </thead>
    <tbody>
    {{$i=1}}
    @foreach($escalas as $escala)
        <tr style="{{($i%2==0) ? 'background-color: #9d9d9d' : 'background-color: #fff' }}">
            <td>{{$escala->rota->nome}}</td>
            <td>{{$escala->fiscal->user->name}}</td>
        </tr>
        {{$i++}}
    @endforeach
    </tbody>
</table>
</body>
</html>


