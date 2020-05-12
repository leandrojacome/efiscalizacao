<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->
    <title>e-Fiscalização - @yield('titulo')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{url('images')}}/favicon.ico">
    @include('layouts.styles')

</head>

<body class="animsition">
<div class="page-wrapper">
    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        <div class="header-mobile__bar">
            <div class="container-fluid">
                <div class="header-mobile-inner">
                    <a class="logo" href="index.html">
                        <a href="{{route('home')}}"><img src="{{ asset('images/favicon/logo.png') }}" alt="CRECI-GO"/></a>
                    </a>
                    <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <nav class="navbar-mobile">
            <div class="container-fluid">
                <ul class="navbar-mobile__list list-unstyled">
                    <li class="has-sub">
                        @hasanyrole('super-admin|gerencia|administrativo')
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-list-alt"></i>Dados</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('cidade.index')}}">Cidades</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('rota.index')}}">Rotas</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('origem.index')}}">Origem</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('ocorrencia.index')}}">Ocorrência</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('situacao.index')}}">Situação</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('localizacao.index')}}">Localização</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('tipo_historico.index')}}">Tipo de Histórico</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('tipo_documento.index')}}">Tipo de Documento</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                            <li>
                                <a href="{{route('papel.index')}}">Papel</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                            <li>
                                <a href="{{route('permissao.index')}}">Permissão</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia')
                            <li>
                                <a href="{{route('fiscal.index')}}">Fiscal</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                            <li>
                                <a href="{{route('usuario.index')}}">Usuários</a>
                            </li>
                            @endhasanyrole
                        </ul>
                    </li>
                    @endhasanyrole
                    <li>
                        <a href="{{route('diligencia.index')}}">
                            <i class="fas fa-suitcase"></i>Diligências</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- END HEADER MOBILE-->
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
            <a href="{{route('home')}}"><img src="{{ asset('images/logo.png') }}"></a>
        </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    @hasanyrole('super-admin|gerencia|administrativo')
                    <li class="has-sub">
                        <a class="js-arrow" href="#">
                            <i class="fas fa-list-alt"></i>Dados</a>
                        <ul class="list-unstyled navbar__sub-list js-sub-list">
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('cidade.index')}}">Cidades</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('rota.index')}}">Rotas</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('origem.index')}}">Origem</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('ocorrencia.index')}}">Ocorrência</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('situacao.index')}}">Situação</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('localizacao.index')}}">Localização</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('tipo_historico.index')}}">Tipo de Histórico</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li>
                                <a href="{{route('tipo_documento.index')}}">Tipo de Documento</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                            <li>
                                <a href="{{route('papel.index')}}">Papel</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin')
                            <li>
                                <a href="{{route('permissao.index')}}">Permissão</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia')
                            <li>
                                <a href="{{route('fiscal.index')}}">Fiscal</a>
                            </li>
                            @endhasanyrole
                            @hasanyrole('super-admin|gerencia')
                            <li>
                                <a href="{{route('usuario.index')}}">Usuários</a>
                            </li>
                            @endhasanyrole
                        </ul>
                    </li>
                    @endhasanyrole
                    @hasanyrole('super-admin|gerencia|fiscalizacao')
                    <li>
                        <a href="{{route('diligencia.index')}}">
                            <i class="fas fa-suitcase"></i>Diligências</a>
                    </li>
                    @endhasanyrole
                </ul>

            </nav>
        </div>
    </aside>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid text-right">
                    <div class="header-wrap">
                        <div class="header-button">
                            @if(!is_null(Auth::user()))
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                        </div>
                                        <form name="formLogout" action="{{route('logout')}}" method="post">
                                            @csrf
                                        </form>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{Auth::user()->email}}</span>
                                                    <a href="{{route('usuario.change.password', Auth::user()->id)}}">Alterar minha senha</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#" onclick="formLogout.submit()">
                                                    <i class="fa fa-power-off"></i>Sair</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    @yield('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2020 CRECI-GO. Todos direitos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->
    </div>
</div>

@include('layouts.scripts')

@yield('script_parse')

</body>

</html>
<!-- end document-->
