<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title Page-->
    <title>Alteração obrigatória de senha</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images')}}/favicon.ico">
    @include('layouts.styles')

</head>
<body class="animsition">
<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="{{url('images')}}/logo.png" alt="CRECI-GO">
                        </a>
                    </div>
                    <div class="col-lg-12">
                        @if( isset($errors) && count($errors) > 0)
                            <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                @foreach($errors->all() as $error)
                                    <p>{{$error}}</p>
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                Alterar senha {{$usuario->name}}
                            </div>
                            <div class="card-body card-block">
                                <form name="form1" action="{{ route('usuario.update.password', $usuario->id) }}"
                                      method="POST"
                                      class="form-horizontal">
                                    @csrf
                                    {{method_field('patch')}}
                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required
                                                   autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="form1.submit();" class="btn btn-success btn-sm">
                                    <i class="fa fa-unlock"></i> Alterar e Continuar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.scripts')

</body>

</html>
<!-- end document-->

