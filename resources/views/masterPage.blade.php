@extends('base')
@section('Contenido')
@if(is_null(Session::get('user')))
    <script type="text/javascript">
        window.location = "{{url('/logout')}}";//here double curly bracket
    </script>
@else
    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="{{ url('/')}}"><img src="{{ asset('images/icon/ezplayrose.png')}}" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="active">
                                <a href="{{ url('/')}}" aria-expanded="true"><i class="ti-home"></i><span>Inicio</span></a>                                
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Clientes
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('/Clientes/create')}}">Nuevo Cliente</a></li>
                                    <li><a href="{{ url('/Clientes')}}">Lista de Clientes</a></li>
                                    {{--  <li><a href="datatable.html">Estado de cuenta por Cliente</a></li>  --}}
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-receipt"></i><span>Facturas</span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('/Facturas/create')}}">Nueva Factura</a></li>
                                    <li><a href="{{ url('/Facturas')}}">Historia de Facturas</a></li>
                                    @if(Session::get('user')->id_role=='1')          
                                    <li><a href="{{ url('/TodasFacturas') }}">Todas las facturas</a></li>
                                    @endif
                                </ul>
                            </li>
                            @if(Session::get('user')->id_role=='1')  
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-server"></i><span>Empresas
                                    </span></a>
                                <ul class="collapse">
                                    <li><a href="{{ url('/Empresas/create')}}">Nueva Empresa</a></li>
                                    <li><a href="{{ url('/Empresas')}}">Lista de Empresas</a></li>
                                </ul>
                            </li>
                            @endif
                            <li>
                                <a href="{{ url('/Perfil')}}" aria-expanded="true"><i class="ti-panel"></i><span>Perfil</span></a>                                
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <!-- <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div> -->
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            @yield('options')                       
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            {{--  <li class="dropdown">
                                <i class="ti-bell dropdown-toggle" data-toggle="dropdown">
                                    <span>2</span>
                                </i>                                
                            </li>  --}}
                            <!-- <li class="dropdown">
                                <i class="fa fa-envelope-o dropdown-toggle" data-toggle="dropdown"><span>3</span></i>
                                <div class="dropdown-menu notify-box nt-enveloper-box">
                                    <span class="notify-title">You have 3 new notifications <a href="#">view all</a></span>
                                    <div class="nofity-list">
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img1.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img2.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">When you can connect with me...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img3.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">I missed you so much...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img4.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Your product is completely Ready...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img2.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img1.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                        <a href="#" class="notify-item">
                                            <div class="notify-thumb">
                                                <img src="{{ asset('images/author/author-img3.jpg')}}" alt="image">
                                            </div>
                                            <div class="notify-text">
                                                <p>Aglae Mayer</p>
                                                <span class="msg">Hey I am waiting for you...</span>
                                                <span>3:15 PM</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li> -->
                            
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">{{ $title  }}</h4>
                            <ul class="breadcrumbs pull-left">
                                @foreach ($rutes as $key => $rute)
                                @if ($rute != "")
                                    <li><a href="{{ url($rute) }}">{{ $key }}</a></li>        
                                @else
                                <li><span>{{ $key }}</span></li>        
                                @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="{{ asset('images/author/avatar.png')}}" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                                {{ Session::get('user')->name }}
                                @if ( Session::get('user')->id_role==1)
                                    <strong>Administrador</strong>
                                @endif
                            <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                {{--  <a class="dropdown-item" href="#">Mensajes</a>  --}}
                                <a class="dropdown-item" href="{{ url('/Perfil')}}">Perfil</a>
                                <a class="dropdown-item" href="{{ url('/logout')}}">Cerrar Sesion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            @yield('Centro')
        </div>
        <!-- main content area end -->
        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>Creado Por <a href="https://ezrose.com">EZROSE</a>.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
@endif
@endsection