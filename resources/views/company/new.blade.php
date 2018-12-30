@extends('masterPage')

@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                       <h4 class="header-title">Datos de la Empresa <small>{{ $company->name }}</small></h4>
                        <form class="needs-validation" novalidate="" name="Form1" id="Form1" novalidate method="POST"  action="{{url($urlForm)}}"> 
                            {!! csrf_field() !!}
                            @if (!$isnew)
                                {{ method_field('PUT') }}
                            @endif
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="ruc">RUC/CI/ID</label>
                              <input type="text" class="form-control" id="ruc" name="ruc" placeholder="ex. 1724195191001" value="{{ old('ruc',$company->ruc) }}" required="">
                              <div class="invalid-feedback">
                               Este campo es obligatorio
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="lastName">Razón social</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Ex. Flowers Company" value="{{ old('name',$company->name) }}" required="">
                              <div class="invalid-feedback">
                                  Este campo es obligatorio
                              </div>
                            </div>
                          </div>

                          <div class="mb-3">
                            <label for="email">Email para facturacion </label>
                            <input type="email" class="form-control"  id="email" name="email" placeholder="Ex: ejemplo@correo.com" value="{{ old('email',$company->email) }}" required>
                            <div class="invalid-feedback">
                             Por favor ingrese un email correcto.
                            </div>
                          </div>
              
                          <div class="mb-3">
                            <label for="address">Dirrección</label>
                            <input type="text" class="form-control"  id="address" name="address" placeholder="" value="{{ old('address',$company->address) }}" required="">
                            <div class="invalid-feedback">
                             Este campo es obligatorio
                            </div>
                          </div>
              
                          <div class="row">
                            <div class="col-md-3 mb-3">
                              <label for="country">Pais<span class="text-muted">(Opcional)</span></label>
                              <select class="custom-select d-block w-100" id="country" name="country" >
                                <option value="" disabled>Seleccione...</option>
                                <option value="EC">Ecuador</option>                                
                              </select>
                              <div class="invalid-feedback">
                                  Este campo es obligatorio
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="state">Provincia<span class="text-muted">(Opcional)</span></label>
                              <select class="custom-select d-block w-100" id="state" name="state" placeholder="">
                                <option value="" disabled >Seleccine...</option>
                                @foreach ($estados as $key =>$item )
                                @if ($company->state == $key)
                                  <option value="{{ $key }}" selected>{{ $item }}</option>    
                                @else
                                  <option value="{{ $key }}">{{ $item }}</option>
                                @endif                                
                                @endforeach                                
                              </select>
                              <div class="invalid-feedback">
                                Please provide a valid state.
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="postal_code">Ciudad<span class="text-muted">(Opcional)</span></label>
                              <input type="text" class="form-control" id="city" name="city" value="{{ old('city',$company->city) }}" >
                              <div class="invalid-feedback">
                                  Este campo es obligatorio
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="postal_code">Codigo Postal<span class="text-muted">(Opcional)</span></label>
                              <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code',$company->postal_code) }}" >
                              <div class="invalid-feedback">
                                  Este campo es obligatorio
                              </div>
                            </div>
                          </div>
                          <hr class="mb-4">      
                          <h4 class="header-title">Datos de contacto</h4>    
                            <div class="mb-3">
                                <label for="">Nombre <span class="text-muted">(Opcional)</span></label>
                                <input type="text" class="form-control" id="contact" name="contact" placeholder="" value="{{ old('contact',$company->contact) }}" >
                                <div class="invalid-feedback">
                                .*.
                                </div>
                            </div>
                            <div class="mb-3">
                                    <label for="">Telefono <span class="text-muted">(Opcional)</span></label>
                                    <input type="text" class="form-control" id="phone1" name="phone1" placeholder=""  value="{{ old('contact',$company->phone1) }}" >
                                    <div class="invalid-feedback">
                                     .*.
                                    </div>
                            </div>
                            <div class="mb-3">
                                        <label for="email">Observaciones <span class="text-muted">(Opcional)</span></label>
                                        <textarea class="form-control" id="notes" name="notes" placeholder="" >
                                            {{ old('notes',$company->notes) }}
                                        </textarea>
                                        <div class="invalid-feedback"
                                        .*.
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