<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title Page-->
    <title>BIS - @yield('titulo')</title>
    @include('layouts.styles')

</head>

<body class="animsition">
    <form id="form-logout" action="{{ route('logout') }}" method="post" class="form-inline">
        @csrf
    </form>
    <div class="page-wrapper">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled">
                            @hasanyrole('super-admin|gerencia|administrativo')
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-list-alt"></i>Dados
                                    <span class="bot-line"></span>
                                </a>
                                <ul class="header3-sub-list list-unstyled">
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
                            @hasanyrole('super-admin|gerencia|fiscalizacao|administrativo')
                            <li>
                                <a href="{{route('diligencia.index')}}">
                                    <i class="fas fa-suitcase"></i>Diligências</a>
                            </li>
                            @endhasanyrole
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="header-button-item has-noti js-item-menu">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{Auth::user()->name}}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">{{Auth::user()->name}}</a>
                                            </h5>
                                            <span class="email">{{Auth::user()->email}}</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{route('usuario.change.password', Auth::user()->id)}}">
                                                <i class="zmdi zmdi-settings"></i>Alterar senha
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                            <i class="zmdi zmdi-power"></i><a href="{{ route('logout') }}"> Sair</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->

        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">Você está em:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="#">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Dashboard</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- WELCOME-->
            <section class="welcome p-t-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title-4">Bem vindo(a)
                                <span> {{ Auth::user()->name }} </span>
                            </h1>
                            <hr class="line-seprate">
                        </div>
                    </div>
                </div>
            </section>
            <!-- END WELCOME-->




            <!-- DATA TABLE-->
            <section class="p-t-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
            <!-- END DATA TABLE-->

            <!-- COPYRIGHT-->
            <section class="p-t-60 p-b-20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2020 Bauduco - Todos direitos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END COPYRIGHT-->
        </div>

    </div>

@include('layouts.scripts')

@yield('script_parse')

</body>

</html>
<!-- end document-->
