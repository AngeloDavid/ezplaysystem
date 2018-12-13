@extends('masterPage')
@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                       <h4 class="header-title">Cliente</h4>
                        <form class="needs-validation" novalidate=""> 
                          <div class="row">
                              
                            <div class="col-md-6 mb-3">
                              <label for="firstName">RUC/CI/ID</label>
                              <div class="input-group">
                                    <div class="input-group-prepend">

                                      <span class="input-group-text" data-toggle="modal" data-target="#exampleModalCenter"><i class="ti-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="firstName" placeholder="EX. 1724a983300001" required="">
                                    <div class="invalid-feedback" style="width: 100%;">
                                      Your username is required.
                                    </div>
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
                          <h4 class="header-title">Facturación</h4> 
                          <div  class="row">
                                <div class="col-md-3 mb-3">
                                        <label for="subtotal">Total <span class="text-muted"></span></label>
                                        <input type="number" class="form-control" id="subtotal" placeholder="" required="" >
                                        <div class="invalid-feedback">
                                         Este campo es requerido
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                            <label for="state">IVA<span class="text-muted">(Opcional)</span></label>
                                            <select class="custom-select d-block w-100" id="state" >
                                                <option selected >0%</option>
                                                <option>12%</option>
                                            </select>
                                            <div class="invalid-feedback">
                                              Please provide a valid state.
                                            </div>
                                          </div>
                                    <div class="col-md-6 mb-3">
                                            <label for="exampleFormControlFile1">Subir la factura</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1" required="">
                                            <div class="invalid-feedback">
                                                Este campo es requerido
                                            </div>
                                    </div>
                          </div> 
                          <hr class="mb-4">         
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">IVA Includio</label>
                            </div>          
                            <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="same-address">
                                    <label class="custom-control-label" for="same-address">Guardar nuevo Cliente</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="same-address">
                                    <label class="custom-control-label" for="same-address">Acpeto <a href="#">Ternimos y condiciones</a></label>
                            </div>
                          <button class="btn btn-primary btn-lg btn-block" type="submit">Guardar</button>
                        </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection