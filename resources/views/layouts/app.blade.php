<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="icon" sizes="16x16" href="{{ asset('icono.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('css/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c3.css') }}">
    <link href="{{ asset('css/smartadmin-production-plugins.min.css') }}" rel="stylesheet" type="text/css" media="screen">
    <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}" rel="stylesheet"> 
    <title>Spanish Today</title>
</head>

<body>
    @guest
        <div class="splash-container">
            @yield('content-login')
        </div>
    @else
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html">Spanish Today</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('ico-64.ico') }}" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">{{ Auth::user()->nombre }}</h5>
                                </div>
                                <a class="dropdown-item" href="{{ route('usuario.index') }}"><i class="fas fa-user mr-2"></i>Mi Cuenta</a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Cerrar Session</a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                MENU
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('blog.index') }}">BLOG</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categoria_blog.index') }}">CATEGORIAS</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" id="ventas" href="{{ route('ventas.index') }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> VENTAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contactos" href="{{ route('contactos.index') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> CONTACTOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="free_trial" href="{{ route('free_trial.index') }}"><i class="fa fa-users" aria-hidden="true"></i> FREE TRIAL</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="cuestionarios" href="{{ route('cuestionarios.index') }}"><i class="fa fa-file" aria-hidden="true"></i> CUESTIONARIOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="preguntas" href="{{ route('preguntas.index') }}"><i class="fa fa-question" aria-hidden="true"></i> PREGUNTAS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="respuestas" href="{{ route('respuestas.index') }}"><i class="fa fa-check" aria-hidden="true"></i> RESPUESTAS</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">@yield('title')</h2>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    @endguest
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/jquery.jqGrid.min.js') }}"></script>
    <script src="{{ asset('js/grid.locale-es.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('js/main-js.js') }}"></script>
    <script src="{{ asset('js/chartist.min.js') }}"></script>
    <script src="{{ asset('js/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('js/raphael.min.js') }}"></script>
    <script src="{{ asset('js/morris.js') }}"></script>
    <script src="{{ asset('js/c3.min.js') }}"></script>
    <script src="{{ asset('js/d3-5.4.0.min.js') }}"></script>
    <script src="{{ asset('js/C3chartjs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/sweetalert2.js') }}"></script>
    <!-- <script src="{{ asset('js/dashboard-ecommerce.js') }}"></script> -->
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend:function()
                {            
                    alertas(1);
                },
                error: function (x, status, error) {
                    if (x.status == 422) {
                        alertas(3);
                        var data = x.responseJSON.errors;
                        for(let i in data){
                            if(i.indexOf('.') !== -1)
                            {
                                mostrarArregloErrores(i.substring(0, i.indexOf('.',1)),data[i][0],i.substring(i.indexOf('.') + 1, i.length));
                            }
                            else
                            {
                                mostrarErrores(i,data[i][0]);
                            }
                        }
                    }
                    else {
                        alertas(4);
                    }
                }
            });
        });

        function limpiarErrores(nombre) {
            $("#error_"+nombre).hide();
            $("#error_"+nombre).text('');
            $("#"+nombre).removeClass('is-invalid');
        }

        function mostrarErrores(nombre, error) {
            $("#error_"+nombre).show();
            $("#error_"+nombre).text(error);
            $("#"+nombre).addClass('is-invalid');
        }

        function mostrarArregloErrores(nombre, error, indice) {
            $('input[name="'+nombre+'[]"]:eq('+parseInt(indice)+')').attr('data-indice',indice);
            $('span[id="error_'+nombre+'[]"]:eq('+parseInt(indice)+')').show();
            $('span[id="error_'+nombre+'[]"]:eq('+parseInt(indice)+')').text(error);
            $('input[name="'+nombre+'[]"]:eq('+parseInt(indice)+')').addClass('is-invalid');
        }

        function alertas(tipo, url) {
            if (tipo === 1) {
                swal({
                    title: "PROCESANDO INFORMACION",
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    allowEnterKey:false,
                    showConfirmButton: false,
                    onOpen: function () {
                      swal.showLoading()
                    }
                  }).then(
                    function () {},
                    function (dismiss) {
                      if (dismiss === 'timer') {
                        console.log('I was closed by the timer')
                      }
                    }) 
            } else if(tipo === 2) {
                let timerInterval
                swal({
                    type: 'success',
                    title: 'EXITO',
                    timer: 1600,
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    showConfirmButton: false,
                    onOpen: () => {
                        timerInterval = setInterval(() => {
                        }, 100)
                    },
                    onClose: () => {
                        var ruta = "{{URL::to(':id')}}";
                        ruta = ruta.replace(':id', url);
                        window.location.href = ruta;
                        clearInterval(timerInterval)
                    }
                });   
            } else if(tipo === 3) {
                swal({
                    type: 'warning',
                    title: 'FALTA COMPLETAR DATOS EN EL FORMULARIO',
                    timer: 1200,
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    showConfirmButton: false,
                    onOpen: () => {
                        timerInterval = setInterval(() => {
                        }, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                });
            } else {
                swal({
                    type: 'error',
                    title: 'OCURRIO UN PROBLEMA',
                    allowOutsideClick: false,
                    allowEscapeKey:false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'ACEPTAR'
                }); 
            }

        }
    </script>
    @yield('page-js-script')
</body>
 
</html>