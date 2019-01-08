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
<a href="{{ url('/Facturas')}}"> <li data-toggle="tooltip" data-placemet="bottom" title="Lista de Facturas"><i class="ti-view-list-alt"></i></li></a>
@endsection
@section('Centro')
<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    @if(Session::has('flash_success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span class="fa fa-times"></span>
                        </button>
                    <em><i class="fa fa-check-circle"></i>&nbsp;&nbsp;&nbsp;  {!! session('flash_success') !!}</em>
                  </div>
                  @if(session()->has('errmsj'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span class="fa fa-times"></span>
                        </button>
                      {{ session('errmsj') }}
                    </div>
                    @endif
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
                                      <label for="state">IVA <span class="text-muted">(Opcional)</span></label>
                                      <select class="custom-select d-block w-100" id="IVA" name="IVA" >
                                        
                                        @if ($invoice->IVA=="12%")
                                          <option value="0%" >0%</option>
                                          <option value="12%" selected>12%</option>
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
                                        @if ($invoice->wayToPay =="check")
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
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Terminos y Condiciones</h5>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body">
              <h4>Condiciones de Uso de los Servicios Payezrose</h4>
              <p>Le damos la bienvenida a Payezrose.
              El presente Acuerdo es un contrato entre usted y Payezrose, se aplica a la utilización de todos los Servicios Payezrose. El uso de los Servicios Payezrose implica que usted debe aceptar todos los términos y condiciones contenidos en este Acuerdo. Usted debe leer atentamente todos estos términos.
              El presente es un documento importante que usted debe leer atentamente antes de decidir utilizar los Servicios Payezrose. Tenga en cuenta lo siguiente:
              Los pagos recibidos en su Cuenta podrán cancelarse posteriormente, por ejemplo, si un pago es objeto de un Contracargo, Cancelación, Reclamación o si se invalida por otra razón. Esto quiere decir que un pago se puede retirar de su Cuenta después de que usted haya entregado al comprador los bienes o servicios que fueron adquiridos.
              Si usted es un Vendedor, puede reducir los riesgos que conllevan las transacciones realizadas desde su Cuenta siguiendo los criterios establecidos en la cláusula Protección al Vendedor de Payezrose.
              Nosotros podemos cerrar, suspender o restringir el acceso a su Cuenta o a los Servicios Payezrose y/o restringir el acceso a sus fondos si infringe este Acuerdo, la Política de Uso Aceptable de Payezrose o cualquier otro acuerdo que haya usted celebrado con Payezrose.
              Este Acuerdo corresponde a una solicitud de los Servicios de Payezrose.</p><br><br>
              <h5>1. Servicios de pago y requisitos.</h5><br>
              <strong>1.1 Servicios de pago. Payezrose es un proveedor de botones de pago y actúa como tal creando, hospedando, manteniendo y proporcionándole nuestros Servicios Payezrose a usted a través de Internet. Nuestros servicios le permiten recibir pagos de cualquier persona </strong>
              <p>que tenga una tarjeta de crédito y recibir dichos pagos en aquellas cuentas donde se indique. La disponibilidad de nuestros servicios Payezrose varía según el país/la región
              Payezrose no es una empresa transportista común ni una empresa de servicios públicos.
              </p><br>
              <strong>1.2 Requisitos. Para reunir los requisitos y poder utilizar los Servicios Payezrose, debe tener 18 años o más, en función de la mayoría de edad de su jurisdicción.</strong>
              <p>Usted debe colocar su país/región de residencia correcto en la Cuenta. <p><br>
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
        var month = dt.getMonth()<10? '0'+(dt.getMonth()+1):dt.getMonth();
        var day = dt.getDate()<10? '0'+dt.getDate():dt.getDate();
        $('#Form-create #date').val(dt.getFullYear()+'-'+month+'-'+day);
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