@extends('base')
@section('Contenido')
    <div class="login-area login-s2">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="post" action="{{url('validate')}}">
                {!! csrf_field()!!}
                <div class="login-form-head">
                    <img src="{{ asset('images/icon/ezplayrose.png')}}" alt="logo"  width="50%">
                    <p style="text-align:center" >Recibe pagos internacionales en tu cuenta local</p>                       
                </div>
                @if(session()->has('errmsj'))
                <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                            </button>
                  {{ session('errmsj') }}
                </div>
                @endif               
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="userApp">RUC o CI</label>
                        <input type="text" id="userApp" name="userApp">
                        <i class="ti-user"></i>
                    </div>
                    <div class="form-gp">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password">
                        <i class="ti-lock"></i>
                    </div>
                    <div class="row mb-4 rmber-area">
                        <div class="col-6">
                            {{--  <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                            </div>  --}}
                        </div>
                        <div class="col-6 text-right">
                            <a href="#">Olvide mi contraseña</a>
                        </div>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Ingresar <i class="ti-arrow-right"></i></button>
                        {{--  <div class="login-other row mt-4">
                            <div class="col-6">
                                <a class="fb-login" href="#">Log in with <i class="fa fa-facebook"></i></a>
                            </div>
                            <div class="col-6">
                                <a class="google-login" href="#">Log in with <i class="fa fa-google"></i></a>
                            </div>
                        </div>  --}}
                    </div>
                    <div class="form-footer text-center mt-5">
                        <p class="text-muted">Conoce más en: <a href="https://pay.ezrose.com/">pay.ezrose.com</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection