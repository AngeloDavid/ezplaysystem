<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EZPAY - norificacion </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/icon/ezplayrose.png')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('css/metisMenu.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css')}}">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="{{ asset('css/typography.css')}}">
    <link rel="stylesheet" href="{{ asset('css/default-css.css')}}">
    <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}">
    <!-- modernizr css -->
    <script src="{{ asset('js/vendor/modernizr-2.8.3.min.js')}}"></script>
    @yield('scriptcss')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">
                Estás utilizando un navegador <strong>obsoleto </strong>. Por favor  <a href="http://browsehappy.com/">Actualiza tu navegdor</a> para mejorar tu experiencia</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form>
                    <div class="login-form-head">
                        <img src="{{ asset('images/icon/ezplayrose.png')}}" alt="logo"  width="50%"><br><br>
                    <h5 style="text-align:center; color:#1c73b8;" >Factura Recibida</h5>                       
                    </div>
                    <div class="login-form-body">                        
                        <div class="form-gp">
                            <p>Estimado, <strong>Administrador</strong><br><br>
                                El cliente <strong>nombre </strong> ha ingresado una nueva factura.
                                El numero es: <strong># 334444 </strong>
                                Para seguimiento de la factura, visite  plataforma Ezpay
                            </p>
                        </div>
                        <div class="submit-btn-area">
                            <a class="btn btn-rounded btn-primary mb-3" href="{{ url('/TodasFacturas')}}">EZPay <i class="ti-arrow-right"></i></a>                            
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Conoce más en: <a href="https://pay.ezrose.com/">pay.ezrose.com</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
 
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js')}}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ asset('js/popper.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js')}}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js')}}"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="{{ asset('js/line-chart.js')}}"></script>
    <!-- all pie chart -->
    <script src="{{ asset('js/pie-chart.js')}}"></script>
    @yield('scriptjs')
    <!-- others plugins -->
    <script src="{{ asset('js/plugins.js')}}"></script>
    <script src="{{ asset('js/scripts.js')}}"></script>
</body>

</html>