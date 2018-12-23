@extends('masterPage')
@section('options')
  <li class="newCliente"  data-toggle="tooltip" data-placement="bottom" title="Nuevo Cliente" ><i class="ti-user"></i></li>    
@if ($isnew)
  <li class="newInvoice" data-toggle="tooltip" data-placement="bottom" title="Nuevo Factura" ><i class="ti-plus"></i></li>    
@else
  @if (! empty($invoice->file))
    <a target="_blank" href="{{ asset('storage/docs/'. $invoice->file )}}" class="text-secondary"><li  data-toggle="tooltip" data-placement="bottom" title="Descargar Factura" ><i class="ti-cloud-down"></i></li></a>
  @endif
@endif
@endsection
@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    @if(Session::has('flash_success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      <em><i class="fa fa-check-circle"></i>&nbsp;&nbsp;&nbsp;  {!! session('flash_success') !!}</em>
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        <strong><i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp; Por favor corrigan los siguientes errores:</strong><p></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>                          
                      </div>                        
                  @endif
                       <h4 class="header-title">Cliente</h4>
                        <form class="needs-validation" novalidate="" id="Form-create"  method="POST"  action="{{url($urlForm)}}" enctype="multipart/form-data"> 
                            {!! csrf_field() !!}
                            @if (!$isnew)
                                {{ method_field('PUT') }}
                            @endif
                          <input type="hidden" id="id_customer" name="id_customer" value="{{ old('ruc',$costumer->id) }}">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <label for="firstName">RUC/CI/ID</label>
                              <div class="input-group">
                                    <div class="input-group-prepend">

                                      <span class="input-group-text" data-toggle="modal" data-target="#exampleModalCenter"><i class="ti-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="ruc" name="ruc" placeholder="EX. 1724a983300001" value="{{ old('ruc',$costumer->ruc) }}" required="">
                                    <div class="invalid-feedback" style="width: 100%;">
                                      Your username is required.
                                    </div>
                                  </div>                                          
                            </div>
                            <div class="col-md-6 mb-3">
                              <label for="lastName">Razón social</label>
                              <input type="text" class="form-control" id="name" name="name" placeholder="Ex. Flowers Company" value="{{ old('name',$costumer->name) }}" required="">
                              <div class="invalid-feedback">
                                    Este campo es requerido
                              </div>
                            </div>
                          </div>

                          <div class="mb-3">
                            <label for="email">Email para facturacion </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ old('email',$costumer->email) }}" required>
                            <div class="invalid-feedback">
                             Por favor ingrese un email correcto.
                            </div>
                          </div>
              
                          <div class="mb-3">
                            <label for="address">Dirrección</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="{{ old('address',$costumer->address) }}"  required="">
                            <div class="invalid-feedback">
                             Este campo es requerido
                            </div>
                          </div>
              
                          <div class="row">
                            <div class="col-md-3 mb-3">
                              <label for="country">Pais<span class="text-muted">(Opcional)</span></label>
                              <select class="custom-select d-block w-100"  id="country" name="country" >
                                <option value="" disabled>Seleccione...</option>
                                <option value="US">United States</option>       
                              </select>
                              <div class="invalid-feedback">
                                Please select a valid country.
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="state">Estado<span class="text-muted">(Opcional)</span></label>
                              <select class="custom-select d-block w-100" id="state" name="state" >
                                <option disabled>Seleccione...</option>
                                @foreach ($estados as $key =>$item )
                                @if ($costumer->state == $key)
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
                              <input type="text" class="form-control" id="city" name="city" value="{{ old('city',$costumer->city) }}" >
                              <div class="invalid-feedback">
                                  Este campo es obligatorio
                              </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="zip">Codigo Postal<span class="text-muted">(Opcional)</span></label>
                              <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="" value="{{ old('postal_code',$costumer->postal_code) }}" >
                              <div class="invalid-feedback">
                                Zip code required.
                              </div>
                            </div>
                          </div>

                          <hr class="mb-4">      
                          <h4 class="header-title">Facturación</h4> 
                          <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="zip">Codigo</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="" required="" value="{{ old('code',$invoice->code) }}" >
                                <div class="invalid-feedback">
                                  Este campo es obligatorio
                                </div>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="zip">Observacion<span class="text-muted">(Opcional)</span></label>
                                <input type="text" class="form-control" id="desp" name="desp" placeholder="" value="{{ old('desp',$invoice->desp) }}" >
                                <div class="invalid-feedback">
                                  Este campo es obligatorio
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="zip">Fecha de Factura </label>
                              <input type="date" class="form-control" id="date" name="date" placeholder="" required="" value="{{ old('date',date('Y-m-d', strtotime($invoice->date))) }}" >
                              <div class="invalid-feedback">
                                Este campo es obligatorio
                              </div>
                            </div>
                          </div>
                          <div  class="row">
                                <div class="col-md-3 mb-3">
                                        <label for="subtotal">Total <span class="text-muted"></span></label>
                                        <input type="number" class="form-control" id="amount" name="amount" placeholder="" required="" value="{{ old('amount',$invoice->amount) }}" >
                                        <div class="invalid-feedback">
                                         Este campo es requerido
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                      <label for="state">IVA<span class="text-muted">(Opcional)</span></label>
                                      <select class="custom-select d-block w-100" id="IVA" name="IVA" >
                                        @if ($invoice->iva=="12%")
                                          <option  >0%</option>
                                          <option selected>12%</option>
                                        @else
                                          <option selected >0%</option>
                                          <option>12%</option>  
                                        @endif                                          
                                      </select>
                                      <div class="invalid-feedback">
                                         Please provide a valid state.
                                      </div>
                                    </div>                                    
                                    <div class="col-md-3 mb-3">
                                            <label for="file">Factura fisica
                                              @if (! empty($invoice->file))
                                                <a target="_blank" href="{{ asset('storage/docs/'. $invoice->file )}}" class="text-secondary"><i class="ti-cloud-down"></i></a>    
                                              @endif
                                              </label>
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="file" name="file" @if ($isnew) required="" @endif accept="application/pdf">
                                              <label class="custom-file-label" for="file" id="file-label">
                                                @if (empty($invoice->file) )
                                                Subir el archivo  
                                              @else
                                                Archivo ya subido
                                              @endif</label>
                                            </div>
                                            <div class="invalid-feedback">
                                                Este campo es requerido
                                            </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                      <label for="state">Forma de cobro</label>
                                      <select class="custom-select d-block w-100" id="wayToPay" name="wayToPay" >
                                        @if ($invoice->wayToPay =="Check")
                                          <option value="transfer"  >Transferencia Bancaria</option>
                                          <option value="check" selected >Cheque</option>  
                                        @else
                                          <option value="transfer" selected >Transferencia Bancaria</option>
                                          <option value="check" >Cheque</option>  
                                        @endif
                                          
                                      </select>
                                      <div class="invalid-feedback">
                                         Please provide a valid state.
                                      </div>
                                    </div>
                          </div> 
                          <hr class="mb-4">
                          <div class="custom-control custom-checkbox">
                            @if ($invoice->ivaincluded ==1)
                              <input type="checkbox" class="custom-control-input" id="ivaincluded" name="ivaincluded" checked="checked">  
                            @else
                              <input type="checkbox" class="custom-control-input" id="ivaincluded" name="ivaincluded" >  
                            @endif                              
                              <label class="custom-control-label" for="ivaincluded">IVA Includio</label>
                          </div>  
                          <div class="custom-control custom-checkbox">
                                  <input type="checkbox" class="custom-control-input"  name="terminos" id="terminos" required="">
                                  <label class="custom-control-label" for="terminos">Acepto <a href="#" data-toggle="modal" data-target="#TERMS">Ternimos y condiciones</a></label>
                                  <div class="invalid-feedback">
                                    Este campo es obligatorio
                                 </div>
                          </div>  
                          <div class="row">
                              <div class="col-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit"><i class="ti-location-arrow" ></i>&nbsp;&nbsp;&nbsp; Enviar</button>
                              </div>
                          </div>
                          
                        </form>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
<div class="modal fade" id="exampleModalCenter">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Buscar Clientes</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
              <div class="single-table">
                  <div class="table-responsive">
                      <table class="table table-hover text-center">
                          <thead class="text-uppercase">
                              <tr>
                                  <th scope="col">RUC/CI/ID</th>
                                  <th scope="col">Nombre</th>
                                  <th scope="col">Estado</th>
                                  <th scope="col">Seleccionar</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($customers as $customer)
                              <tr data-id="{{$customer->id}}" data-customer=' {!! json_encode($customer) !!}' >
                                  <th scope="row">{{ $customer->ruc }}</th>
                                  <td>{{$customer->name}}</td>
                                  <td>{{ $customer->state }} - {{ $customer->country }}</td>                                  
                                  <td><a href="#" class="btn-select"> <i class="fa fa-hand-pointer-o"></i></a></td>
                              </tr>                              
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="TERMS">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Terminos y Condiciones</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus imperdiet ipsum nec semper vestibulum. Curabitur fringilla fringilla aliquet. Sed nisi eros, egestas non dolor vel, efficitur gravida tellus. Fusce aliquet odio at est ornare, eget eleifend felis maximus. Nullam semper interdum augue at pellentesque. Curabitur volutpat mauris eros, sit amet finibus enim scelerisque nec. Quisque pretium vel nibh molestie pretium. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas eget convallis augue. Fusce leo orci, suscipit in tempus faucibus, varius id dui. Nunc dapibus mauris enim, molestie porttitor urna mollis at.</p>
            <p>Praesent quis ante a nibh eleifend euismod. Morbi venenatis in nulla nec laoreet. Integer dignissim erat in purus molestie, eu consectetur leo rutrum. Nulla posuere laoreet ante, ac sagittis velit lobortis sed. Sed gravida ut diam et volutpat. Nullam convallis, orci sit amet semper tincidunt, nisl nunc sollicitudin libero, sed viverra purus mi eu nibh. Praesent eu ullamcorper est, non pretium tortor. Donec et metus quis augue rhoncus pharetra ut a purus. Duis pulvinar congue enim, et scelerisque ante tristique ut.</p>
            <p>Duis vitae massa pretium, faucibus lacus sit amet, tempor turpis. Vestibulum pharetra ex dignissim sem rhoncus, eget pharetra libero molestie. Nullam ac vehicula leo. Integer imperdiet consequat consectetur. Morbi orci quam, lacinia vel tellus id, viverra mollis erat. Maecenas mollis est metus, non interdum purus pretium sed. Proin nec neque ut nunc elementum volutpat quis at velit. Praesent sed quam sed libero dictum sollicitudin non lacinia justo. Curabitur facilisis dui quis laoreet sagittis. Vivamus lacinia nunc at tellus aliquet dapibus.</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>              
          </div>
      </div>
  </div>
</div>
@endsection
@section('scriptjs')
  <script>
    $(document).ready(function (){
      @if ($isnew)
        cleanInvoice(); 
      @else
      var id_customer =$('#Form-create #id_customer').val();
        if(id_customer != null){
          cleanCustomer(true);
        }   
      @endif    
      
      
      $('.btn-select').click(function(){
        var row = $(this).parents('tr');
        var id = row.data('id');
        var data = JSON.parse( row.data('customer'));    
         //Ingresar los datos consultados
        $('#Form-create #id_customer').val(data.id);
        $('#Form-create #ruc').val(data.ruc);
        $('#Form-create #name').val(data.name);
        $('#Form-create #city').val(data.city);
        $('#Form-create #email').val(data.email);
        $('#Form-create #address').val(data.address);
        $('#Form-create #state').val(data.state);
        $('#Form-create #country').val(data.country);
        $('#Form-create #postal_code').val(data.postal_code);

        //Desactivar los input
        cleanCustomer(true);
        

        $('#exampleModalCenter').modal('hide');

      })
      $(".newCliente").click(function(){
        cleanCustomer(false);
        cleanCustomerdato();
      });

      $('.newInvoice').click(function(){
        cleanInvoice();
        cleanCustomerdato();
        cleanCustomer(false);
      })

      function cleanCustomer(dato){
       // $('#Form-create #ruc').prop('disabled', dato);
        $('#Form-create #name').prop('disabled', dato);
        $('#Form-create #email').prop('disabled', dato);
        $('#Form-create #address').prop('disabled', dato);
        $('#Form-create #state').prop('disabled', dato);
        $('#Form-create #country').prop('disabled', dato);
        $('#Form-create #postal_code').prop('disabled', dato);
        $('#Form-create #city').prop('disabled', dato);
       
      }

      function cleanInvoice(){

        var dt= new Date();
        $('#Form-create #date').val(dt.getFullYear()+'-'+(dt.getMonth()+1)+'-'+dt.getDate());
        $('#Form-create #code').val('');
        $('#Form-create #desp').val('');        
        $('#Form-create #amount').val(null);
        $('#Form-create #IVA').val('0%');
        $('#Form-create #city').val('');
        $('#Form-create #file-label').html('Subir su factura');
        $('#Form-create #wayToPay').val('transfer');
        //Checked iva 
        $('#Form-create #ivaincluded').prop( "checked", true );;
        $('#Form-create #postal_code').val('');
        $('#Form-create #file').val(null);                
      }
      function cleanCustomerdato(){
        $('#Form-create #id_customer').val('');
        $('#Form-create #ruc').val('');
        $('#Form-create #name').val('');
        $('#Form-create #email').val('');
        $('#Form-create #city').val('');
        $('#Form-create #address').val('');
        $('#Form-create #state').val('CA');
        $('#Form-create #country').val('US');
        $('#Form-create #postal_code').val('');
      }

      $('#Form-create #file').change(function(e){  
        if( e.target.files.length >0){
          var myfile =e.target.files[0].name;
          var ext = myfile.split('.').pop();
          if(ext=="pdf"){            
              $('#file-label').html(e.target.files[0].name);
          } else{
            $('#file-label').html('Subir su factura');
            $(this).val(null);
          }
        }
      });
    });
  </script>
@endsection