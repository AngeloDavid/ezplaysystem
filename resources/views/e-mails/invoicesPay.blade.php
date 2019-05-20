<!doctype html>
<html lang="en">

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
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">
                Estás utilizando un navegador <strong>obsoleto </strong>. Por favor  <a href="http://browsehappy.com/">Actualiza tu navegdor</a> para mejorar tu experiencia</p>
        <![endif]-->
    <!-- preloader area start -->
  
    <!-- preloader area end -->
    <!-- page container area start -->
    
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form>
                    <div class="login-form-head">
                        <img src="{{ asset('images/icon/ezplayrose.png')}}" alt="logo"  width="150"><br><br>
                    <h5 style="text-align:center; color:#1c73b8;" >Factura Recibida</h5>                       
                    </div>
                    <div class="login-form-body">                        
                        <div class="form-gp">
                            @if ($isadmin)
                                <p>Estimado Administrador</><br><br>    
                                    <p>El cliente <strong>{{ $username }} </strong> ha {{ $action }} la factura.</p><br>
                                    <ul>
                                        <li>Numero: {{ $factura }}</li>
                                        <li>Detalle: {{ $concepto  }}</li>
                                        <li>Fecha: {{ $fecha }}</li>
                                        <li>Estado: {{ $estado }}</li>
                                    </ul><br>                                    
                            @else
                                <p>Estimado ciente, <strong> {{ $username }}</strong></p><br><br>    
                                <p>Su factuta <strong>{{ $factura }} </strong> ya sido {{ $action }} correctamente.</p><br>
                                    <ul>
                                            <li>Numero: {{ $factura }}</li>
                                            <li>Detalle: {{ $concepto  }}</li>
                                            <li>Fecha: {{ $fecha }}</li>
                                            <li>Estado: {{ $estado }}</li>
                                        </ul>
                                    </p>    
                            @endif                            
                            Para seguimiento de la factura, visite  plataforma <a  href="{{ url('/')}}"> Ezpay</a> 
                        </div>
                        <div class="submit-btn-area">
                                @if ($isadmin)
                                    <a class="btn btn-rounded btn-primary mb-3" href="{{ url('/TodasFacturas')}}">EZPay <i class="ti-arrow-right"></i></a>
                                @else
                                    <a class="btn btn-rounded btn-primary mb-3" href="{{ url('/Facturas')}}">EZPay <i class="ti-arrow-right"></i></a>                            
                                @endif
                            
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Conoce más en: <a href="https://pay.ezrose.com/">pay.ezrose.com</a></p><br>
                            <p class="text-muted">
                            Este mensaje se dirige exclusivamente a su destinatario y puede contener información privilegiada o confidencial. Si no es ud. el destinatario indicado, queda notificado de que la utilización, divulgación y/o copia sin autorización está prohibida en virtud de la legislación vigente. Si ha recibido este mensaje por error, le rogamos que nos lo comunique inmediatamente por esta misma vía y proceda a su destrucción. </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>