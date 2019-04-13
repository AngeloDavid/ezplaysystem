@extends('masterPage')
@section('options')
@if (!$isnew and !$isprofile)
  <a href="{{ url('/Empresas/'.$company->id.'/resetarPWD')}}">
    <li class="newInvoice" data-toggle="tooltip" data-placement="bottom" title="Resetear Contraseña" ><i class="ti-unlock"></i></li>    
  </a>
@endif
@endsection
@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('errmsj'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                      {{ session('errmsj') }}
                    </div>
                    @endif
                    @if(Session::has('flash_success'))
                    <div class="alert alert-success alert-dismissible fade show">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span class="fa fa-times"></span>
                          </button>
                      <em><i class="fa fa-check-circle"></i>&nbsp;&nbsp;&nbsp;  {!! session('flash_success') !!}</em>
                    </div>
                    @endif
                    <h4 class="header-title">Datos de la Empresa <small>{{ $company->name }}</small></h4>

                        <form class="needs-validation" novalidate="" name="Form1" id="Form1" novalidate method="POST"  action="{{ url($urlForm) }}" enctype="multipart/form-data"> 
                            {!! csrf_field() !!}
                            @if (!$isnew)
                                {{ method_field('PUT') }}
                            @endif
                            <input type="hidden" value="{{ $isprofile }}" name="isprofile" id="isprofile">
                            <div class="row" >
                              <div class="col-md-2 text-center">
                                  @if (! empty($company->logo))
                                      <img id="img-logo"  class="align-self-center img-fluid mr-4" src="{{ asset('storage/logo/'. $company->logo )}}" alt="image" width="150px" >                                    
                                    @else
                                      <img id="img-logo"  class="align-self-center img-fluid mr-4" src="{{ asset('images/author/build.png')}}" alt="image" width="150px" >
                                  @endif
                                  
                                    <div class="image-upload">
                                        <label for="logo">
                                            <i class="fa fa-camera"></i>  
                                        </label>
                                        <input type="file" id="logo" name="logo" @if ($isnew) required="" @endif accept="image/*" />
                                    </div>
                                    
                              </div>                                
                                <div class="col-md-10">
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
                          @if (!$isprofile)
                          <hr class="mb-4"> 
                          <div class="row">
                              <div class="col-md-6 mb-3">
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
                              </div>
                              <div class="col-md-6 mb-3">
                                  <h4 class="header-title">Representante Legal</h4>    
                                  <div class="mb-3">
                                      <label for="">Nombre </label>
                                      <input type="text" class="form-control" id="legalRepre" name="legalRepre" placeholder=""  value="{{ old('legalRepre',$company->legalRepre) }}"  required="" >
                                      <div class="invalid-feedback">
                                      .*.
                                      </div>
                                  </div>
                                  <div class="mb-3" >
                                      <label for="file">Nombramiento Legal
                                          @if (! empty($company->documentNom))
                                            <a target="_blank" href="{{ asset('storage/docsNom/'. $company->documentNom )}}" class="text-secondary"><i class="ti-cloud-down"></i></a>    
                                          @endif
                                          </label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="documentNom" name="documentNom" @if ($isnew) required="" @endif accept="application/pdf">
                                          <label class="custom-file-label" for="documentNom" id="file-documentNom">
                                            @if (empty($company->documentNom) )
                                            Subir el archivo  
                                          @else
                                            Archivo ya subido
                                          @endif</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Este campo es requerido
                                        </div>
                                  </div>
                                  <div class="mb-3" >
                                      <label for="file">Copia de Cédula
                                          @if (! empty($company->documentID))
                                            <a target="_blank" href="{{ asset('storage/docsID/'. $company->documentID )}}" class="text-secondary"><i class="ti-cloud-down"></i></a>    
                                          @endif
                                          </label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="documentID" name="documentID" @if ($isnew) required="" @endif accept="application/pdf">
                                          <label class="custom-file-label" for="documentID" id="file-documentID">
                                            @if (empty($company->documentID) )
                                            Subir el archivo  
                                          @else
                                            Archivo ya subido
                                          @endif</label>
                                        </div>
                                        <div class="invalid-feedback">
                                            Este campo es requerido
                                        </div>
                                  </div>
                              </div>
                          </div>
                            
                            
                          <hr class="mb-4"> 
                            <div class="mb-3">
                                        <label for="email">Observaciones <span class="text-muted">(Opcional)</span></label>
                                        <textarea class="form-control" id="notes" name="notes" placeholder="" >
                                            {{ old('notes',$company->notes) }}
                                        </textarea>
                                        <div class="invalid-feedback"
                                        .*.
                                        </div>
                            </div>
                          @endif   
                          @if ($isprofile)
                            <hr class="mb-4">                   
                            <h4 class="header-title">Contraseña</h4>    
                            <div class="row">
                              <div class="col-md-4 mb-3">
                                <label for="postal_code">Contraseña Anterior</label>
                                <input type="password" class="form-control" id="userApp" name="passwordold"  >
                                <div class="invalid-feedback">
                                    Este campo es obligatorio
                                </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="postal_code">Nueva Contraseña </label>
                                <input type="password" class="form-control" id="passwordnow" name="passwordnow"  >
                                <div class="invalid-feedback">
                                    Este campo es obligatorio
                                </div>
                              </div>
                              <div class="col-md-4 mb-3">
                                <label for="postal_code">Confirmar Contraseña </label>
                                <input type="password" class="form-control" id="passwordconf" name="passwordconf"  >
                                <div class="invalid-feedback">
                                    Este campo es obligatorio
                                </div>
                              </div>
                            </div>   
                          @endif                                                  
                          <hr class="mb-4">                   
                          <button class="btn btn-primary btn-lg btn-block" type="submit">Guardar</button>
                        </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection

@section('scriptjs')
    <script>
        $(document).ready(function (){
        $('#documentNom').change(function(e){  
          if( e.target.files.length >0){
            var myfile =e.target.files[0].name;
            var ext = myfile.split('.').pop();
            if(ext=="pdf"){            
                $('#file-documentNom').html(e.target.files[0].name);
            } else{
              $('#file-documentNom').html('Subir su factura');
              $(this).val(null);
            }
          }
        });

        $('#documentID').change(function(e){  
          if( e.target.files.length >0){
            var myfile =e.target.files[0].name;
            var ext = myfile.split('.').pop();
            if(ext=="pdf"){            
                $('#file-documentID').html(e.target.files[0].name);
            } else{
              $('#file-documentID').html('Subir su factura');
              $(this).val(null);
            }
          }
        });

        $('#logo').change(function(e){
          if( e.target.files.length > 0){
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-logo').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
          }
        });
      });
    </script>
@endsection