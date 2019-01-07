@extends('base')
@section('Contenido')
    <div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form>
                <div class="login-form-head">
                    <img src="{{ asset('images/icon/ezplayrose.png')}}" alt="logo">
                    <h4>Inicio de sesion</h4>
                    <p></p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <label for="userApp">RUC o CI</label>
                        <input type="text" id="userApp">
                        <i class="ti-user"></i>
                    </div>
                    <div class="form-gp">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password">
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