@extends('masterPage')
@section('Centro')
<div class="main-content-inner">
    <!-- sales report area start -->
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-users"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">CLientes</h4>                                        
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>500</h2>                                        
                        </div>
                    </div>
                    <canvas id="coin_sales1" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-report mb-xs-30">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="ti-receipt"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Facturas Ingresadas</h4>
                            <p>24 H</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2> 500</h2>
                            <span> $ 4,0000.00</span>
                        </div>
                    </div>
                    <canvas id="coin_sales2" height="100"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-eye"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h4 class="header-title mb-0">Facturas Pendientes</h4>
                            <p>24 H</p>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>300</h2>
                            <span>$ 1,000.00</span>
                        </div>
                    </div>
                    <canvas id="coin_sales3" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- sales report area end -->
    <!-- overview area start -->
    <div class="row">
        <div class="col-xl-8 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="header-title mb-0">Ventas</h4>
                        <select class="custome-select border-0 pr-3">
                            <option selected>Diciembre</option>                                        
                        </select>
                    </div>
                    <div id="verview-shart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Mejores Compradores</h4>
                        <div class="cripto-live mt-5">
                            <ul>
                                <li>
                                    <div class="icon b">b</div> Bettys Flowers<span><i class="fa fa-long-arrow-up"></i>$8769.00</span></li>
                                <li>
                                    <div class="icon l">l</div> Lisas Flowers<span><i class="fa fa-long-arrow-up"></i>$2979.00</span></li>
                                <li>
                                    <div class="icon d">d</div> D Flowers<span><i class="fa fa-long-arrow-up"></i>$1329.00</span></li>
                                <li>
                                    <div class="icon b">E</div> Ecua Flowers<span><i class="fa fa-long-arrow-down"></i>$568.890</span></li>                                        
                            </ul>
                        </div>
                    </div>
                </div>
            </div>                    
    </div>
    <!-- overview area end -->
    <!-- market value area start -->
    <div class="row mt-5 mb-5">
        
    </div>
    <!-- market value area end -->
    <!-- row area start -->
    <div class="row">
        <!-- Live Crypto Price area start -->
        
        <!-- Live Crypto Price area end -->
        <!-- trading history area start -->
        <div class="col-lg-12 mt-sm-30 mt-xs-30">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h4 class="header-title">Facturas recientes</h4>
                        <div class="trd-history-tabs">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#buy_order" role="tab">Pendientes</a>
                                </li>                                            
                            </ul>
                        </div>
                        <select class="custome-select border-0 pr-3">
                            <option selected>Hoy</option>                                        
                        </select>
                    </div>
                    <div class="trad-history mt-4">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="buy_order" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="dbkit-table">
                                        <tr class="heading-td">
                                            <td>ID</td>
                                            <td>Hora</td>
                                            <td>Estado</td>
                                            <td>Total</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>78211</td>
                                            <td>4.00 AM</td>
                                            <td>Pendientes</td>
                                            <td>$758.90</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>782782</td>
                                            <td>4.00 AM</td>
                                            <td>Pendientes</td>
                                            <td>$77878.90</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>89675978</td>
                                            <td>4.00 AM</td>
                                            <td>Pendientes</td>
                                            <td>$0768.90</td>
                                            
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sell_order" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="dbkit-table">
                                        <tr class="heading-td">
                                            <td>Trading ID</td>
                                            <td>Time</td>
                                            <td>Status</td>
                                            <td>Amount</td>
                                            <td>Last Trade</td>
                                        </tr>
                                        <tr>
                                            <td>8964978</td>
                                            <td>4.00 AM</td>
                                            <td>Pendientes</td>
                                            <td>$445.90</td>
                                            <td>$094545.090</td>
                                        </tr>
                                        <tr>
                                            <td>89675978</td>
                                            <td>4.00 AM</td>
                                            <td>Pendientes</td>
                                            <td>$78.90</td>
                                            <td>$074852945.090</td>
                                        </tr>
                                        <tr>
                                            <td>78527878</td>
                                            <td>4.00 AM</td>
                                            <td>Pendientes</td>
                                            <td>$0768.90</td>
                                            <td>$65465.090</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- trading history area end -->
    </div>
</div>
@endsection