@extends('layouts.template')

@section('titulo', 'Home')

@section('content')
    @hasanyrole('super-admin|gerencia')
    <div class="row">
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Histórico de Diligências</h3>
                    <canvas id="sales-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Produtividade</h3>
                    <canvas id="team-chart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Diligências por fiscal</h3>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Diligências produzidas/Arquivadas</h3>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="au-card m-b-30">
                <div class="au-card-inner">
                    <h3 class="title-2 m-b-40">Infrações</h3>
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endhasanyrole
    @hasanyrole('super-admin|gerencia|administrativo|fiscalizacao')
    <div class="row">
        <div class="col-12">
            <form action="{{url('/diligencia/buscar')}}" method="post" class="form-horizontal">
                @csrf
                <div class="input-group">
                    <input type="text" id="busca" name="busca" placeholder="Buscar..." class="form-control">
                    <div class="input-group-btn">
                        <button class="btn btn-primary">
                            <i class="fa fa-search"></i> Pesquisar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <br>
            <div class="table-responsive table--no-card m-b-40">
                <table class="table table-borderless table-striped table-earning">
                    <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="55%">nome</th>
                        <th width="40%">ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(!is_null($diligencias))
                        @foreach($diligencias as $diligencia)
                            <tr>
                                <td>{{ $diligencia->id }}</td>
                                <td>
                                    <a href="{{ route('diligencia.show', $diligencia->id) }}">{{ $diligencia->nome }}</a>
                                </td>
                                <td class="text-right">
                                    <a href="{{route('diligencia.historico', $diligencia->id)}}" type="reset"
                                       class="btn btn-info btn-sm">
                                        <i class="fa fa-tags"></i> Histórico
                                    </a>
                                    <a href="{{route('foto.upload', $diligencia->id)}}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-upload"></i> Enviar Fotos
                                    </a>
                                    <a href="{{url('/diligencia/pdf/'.$diligencia->id)}}" target="_blank"
                                       class="btn btn-secondary btn-sm">
                                        <i class="fa fa-print"></i> Imprimir
                                    </a>
                                    @hasanyrole('super-admin|gerencia|administrativo')
                                    <a href="{{ route('diligencia.edit', $diligencia->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> Editar</a>
                                    @endhasanyrole
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">Nenhum registro encontrado.</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endhasanyrole
@endsection
@hasanyrole('super-admin|gerencia')
@section('script_parse')
    <script>
        (function ($) {
            // USE STRICT
            "use strict";

            try {
                //Sales chart
                var ctx = document.getElementById("sales-chart");
                if (ctx) {
                    ctx.height = 150;
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Jan", "Fev", "Mar", "Abr"],
                            type: 'line',
                            defaultFontFamily: 'Poppins',
                            datasets: [{
                                label: "Diligências",
                                data: [12, 33, 54, 88],
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(220,53,69,0.75)',
                                borderWidth: 3,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: 'rgba(220,53,69,0.75)',
                            }, {
                                label: "Concluídas",
                                data: [4, 14, 21, 46],
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(40,167,69,0.75)',
                                borderWidth: 3,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: 'rgba(40,167,69,0.75)',
                            }]
                        },
                        options: {
                            responsive: true,
                            tooltips: {
                                mode: 'index',
                                titleFontSize: 12,
                                titleFontColor: '#000',
                                bodyFontColor: '#000',
                                backgroundColor: '#fff',
                                titleFontFamily: 'Poppins',
                                bodyFontFamily: 'Poppins',
                                cornerRadius: 3,
                                intersect: false,
                            },
                            legend: {
                                display: false,
                                labels: {
                                    usePointStyle: true,
                                    fontFamily: 'Poppins',
                                },
                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Meses'
                                    },
                                    ticks: {
                                        fontFamily: "Poppins"
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Valores',
                                        fontFamily: "Poppins"

                                    },
                                    ticks: {
                                        fontFamily: "Poppins"
                                    }
                                }]
                            },
                            title: {
                                display: false,
                                text: 'Normal Legend'
                            }
                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }

            try {

                //Team chart
                var ctx = document.getElementById("team-chart");
                if (ctx) {
                    ctx.height = 150;
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Janeiro", "Fevereiro", "Março", "Abril"],
                            type: 'line',
                            defaultFontFamily: 'Poppins',
                            datasets: [{
                                data: ['12', 10, 6, 2],
                                label: "Produtividade",
                                backgroundColor: 'rgba(0,103,255,.15)',
                                borderColor: 'rgba(0,103,255,0.5)',
                                borderWidth: 3.5,
                                pointStyle: 'circle',
                                pointRadius: 5,
                                pointBorderColor: 'transparent',
                                pointBackgroundColor: 'rgba(0,103,255,0.5)',
                            },]
                        },
                        options: {
                            responsive: true,
                            tooltips: {
                                mode: 'index',
                                titleFontSize: 12,
                                titleFontColor: '#000',
                                bodyFontColor: '#000',
                                backgroundColor: '#fff',
                                titleFontFamily: 'Poppins',
                                bodyFontFamily: 'Poppins',
                                cornerRadius: 3,
                                intersect: false,
                            },
                            legend: {
                                display: false,
                                position: 'top',
                                labels: {
                                    usePointStyle: true,
                                    fontFamily: 'Poppins',
                                },


                            },
                            scales: {
                                xAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Meses'
                                    },
                                    ticks: {
                                        fontFamily: "Poppins"
                                    }
                                }],
                                yAxes: [{
                                    display: true,
                                    gridLines: {
                                        display: false,
                                        drawBorder: false
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Valores em %',
                                        fontFamily: "Poppins"
                                    },
                                    ticks: {
                                        fontFamily: "Poppins"
                                    }
                                }]
                            },
                            title: {
                                display: false,
                            }
                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }

            try {
                //bar chart
                var ctx = document.getElementById("barChart");
                if (ctx) {
                    ctx.height = 200;
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        defaultFontFamily: 'Poppins',
                        data: {
                            labels: ["Fabiane", "Morganna", "Hamilton", "Renan", "Tiago", "Thaynara", "Daniele"],
                            datasets: [
                                {
                                    label: "Diligências atribuídas",
                                    data: [65, 59, 80, 81, 56, 63, 54],
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(0, 123, 255, 0.5)",
                                    fontFamily: "Poppins"
                                },
                                {
                                    label: "Diligências concluídas",
                                    data: [28, 48, 40, 19, 32, 27, 32],
                                    borderColor: "rgba(0,0,0,0.09)",
                                    borderWidth: "0",
                                    backgroundColor: "rgba(0,0,0,0.07)",
                                    fontFamily: "Poppins"
                                }
                            ]
                        },
                        options: {
                            legend: {
                                position: 'top',
                                labels: {
                                    fontFamily: 'Poppins'
                                }

                            },
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        fontFamily: "Poppins"

                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontFamily: "Poppins"
                                    }
                                }]
                            }
                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }

            try {

                //line chart
                var ctx = document.getElementById("lineChart");
                if (ctx) {
                    ctx.height = 150;
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: ["Janeiro", "Fevereiro", "Março", "Abril"],
                            defaultFontFamily: "Poppins",
                            datasets: [
                                {
                                    label: "Diligências produzidas",
                                    borderColor: "rgba(0,0,0,.09)",
                                    borderWidth: "1",
                                    backgroundColor: "rgba(0,0,0,.07)",
                                    data: [41, 55, 32, 21]
                                },
                                {
                                    label: "Diligências arquivadas",
                                    borderColor: "rgba(0, 123, 255, 0.9)",
                                    borderWidth: "1",
                                    backgroundColor: "rgba(0, 123, 255, 0.5)",
                                    pointHighlightStroke: "rgba(26,179,148,1)",
                                    data: [12, 21, 9, 11]
                                },
                                {
                                    label: "Resultou em processos",
                                    borderColor: "rgba(131, 0, 50, 0.9)",
                                    borderWidth: "1",
                                    backgroundColor: "rgba(131, 0, 50, 0.5)",
                                    pointHighlightStroke: "rgba(79,0,153,1)",
                                    data: [10, 14, 6, 4]
                                }
                            ]
                        },
                        options: {
                            legend: {
                                position: 'top',
                                labels: {
                                    fontFamily: 'Poppins'
                                }

                            },
                            responsive: true,
                            tooltips: {
                                mode: 'index',
                                intersect: false
                            },
                            hover: {
                                mode: 'nearest',
                                intersect: true
                            },
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        fontFamily: "Poppins"

                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontFamily: "Poppins"
                                    }
                                }]
                            }

                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }

            try {

                //pie chart
                var ctx = document.getElementById("pieChart");
                if (ctx) {
                    ctx.height = 200;
                    var myChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: [45, 15, 5, 15, 10, 15],
                                backgroundColor: [
                                    "rgba(0, 153, 137,0.5)",
                                    "rgba(0, 123, 255,0.5)",
                                    "rgba(61, 0, 157,0.5)",
                                    "rgba(191,63,167,0.5)",
                                    "rgba(76,25,29,0.5)",
                                    "rgba(0,0,0,0.2)",
                                ],
                                hoverBackgroundColor: [
                                    "rgba(0, 153, 137,0.9)",
                                    "rgba(0, 123, 255,0.9)",
                                    "rgba(61, 0, 157,0.9)",
                                    "rgba(191,63,167,0.9)",
                                    "rgba(76,25,29,0.9)",
                                    "rgba(0,0,0,0.5)",

                                ]

                            }],
                            labels: [
                                "Exercício Ilegal",
                                "Exercício Ilegal PJ",
                                "Débito",
                                "Anúncio s/ CRECI",
                                "Execício Irregular",
                                "Estágio s/ Supervisão",
                            ]
                        },
                        options: {
                            legend: {
                                position: 'top',
                                labels: {
                                    fontFamily: 'Poppins'
                                }

                            },
                            responsive: true
                        }
                    });
                }


            } catch (error) {
                console.log(error);
            }
        })(jQuery);
    </script>
@endsection
@endhasanyrole
