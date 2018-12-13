@extends('masterPage')
@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                       <h4 class="header-title">Datos de la empresa</h4>
                        <form class="needs-validation" novalidate=""> 
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="firstName">RUC/CI/ID</label>
                              <input type="text" class="form-control" id="firstName" placeholder="ex. 1724195191001" value="" required="">
                              <div class="invalid-feedback">
                               Este campo es requerido
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="lastName">Razón social</label>
                              <input type="text" class="form-control" id="lastName" placeholder="Ex. Flowers Company" value="" required="">
                              <div class="invalid-feedback">
                                    Este campo es requerido
                              </div>
                            </div>
                          </div>

                          <div class="mb-3">
                            <label for="email">Email para facturacion </label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                            <div class="invalid-feedback">
                             Por favor ingrese un email correcto.
                            </div>
                          </div>
              
                          <div class="mb-3">
                            <label for="address">Dirrección</label>
                            <input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
                            <div class="invalid-feedback">
                             Este campo es requerido
                            </div>
                          </div>
              
                          <div class="row">
                            <div class="col-md-5 mb-3">
                              <label for="country">Pais<span class="text-muted">(Opcional)</span></label>
                              <select class="custom-select d-block w-100" id="country">
                                <option value="">Choose...</option>
                                <option>United States</option>
                              </select>
                              <div class="invalid-feedback">
                                Please select a valid country.
                              </div>
                            </div>
                            <div class="col-md-4 mb-3">
                              <label for="state">Estado<span class="text-muted">(Opcional)</span></label>
                              <select class="custom-select d-block w-100" id="state" >
                                <option value="">Choose...</option>
                                <option>California</option>
                              </select>
                              <div class="invalid-feedback">
                                Please provide a valid state.
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="zip">Codigo Postal<span class="text-muted">(Opcional)</span></label>
                              <input type="text" class="form-control" id="zip" placeholder="" >
                              <div class="invalid-feedback">
                                Zip code required.
                              </div>
                            </div>
                          </div>
                          <hr class="mb-4">      
                          <h4 class="header-title">Datos de contacto</h4>    
                            <div class="mb-3">
                                <label for="">Nombre <span class="text-muted">(Opcional)</span></label>
                                <input type="text" class="form-control" id="email" placeholder="" >
                                <div class="invalid-feedback">
                                 Por favor ingrese un email correcto.
                                </div>
                            </div>
                            <div class="mb-3">
                                    <label for="">Telefono <span class="text-muted">(Opcional)</span></label>
                                    <input type="text" class="form-control" id="email" placeholder="" >
                                    <div class="invalid-feedback">
                                     Por favor ingrese un email correcto.
                                    </div>
                            </div>
                            <div class="mb-3">
                                        <label for="email">correo <span class="text-muted">(Opcional)</span></label>
                                        <input type="text" class="form-control" id="email" placeholder="" >
                                        <div class="invalid-feedback">
                                         Por favor ingrese un email correcto.
                                        </div>
                            </div>
                          <hr class="mb-4">                   
                          <button class="btn btn-primary btn-lg btn-block" type="submit">Guardar</button>
                        </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection