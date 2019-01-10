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
              <h4 class="modal-title">Condiciones de Uso de los Servicios Payezrose</h4>
              <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <div class="modal-body" stye="text-align: justify;">
              
              <p>Le damos la bienvenida a Payezrose.
              El presente Acuerdo es un contrato entre usted y Payezrose, se aplica a la utilización de todos los Servicios Payezrose. El uso de los Servicios Payezrose implica que usted debe aceptar todos los términos y condiciones contenidos en este Acuerdo. Usted debe leer atentamente todos estos términos.
              El presente es un documento importante que usted debe leer atentamente antes de decidir utilizar los Servicios Payezrose. Tenga en cuenta lo siguiente:
              Los pagos recibidos en su Cuenta podrán cancelarse posteriormente, por ejemplo, si un pago es objeto de un Contracargo, Cancelación, Reclamación o si se invalida por otra razón. Esto quiere decir que un pago se puede retirar de su Cuenta después de que usted haya entregado al comprador los bienes o servicios que fueron adquiridos.
              Si usted es un Vendedor, puede reducir los riesgos que conllevan las transacciones realizadas desde su Cuenta siguiendo los criterios establecidos en la cláusula Protección al Vendedor de Payezrose.
              Nosotros podemos cerrar, suspender o restringir el acceso a su Cuenta o a los Servicios Payezrose y/o restringir el acceso a sus fondos si infringe este Acuerdo, la Política de Uso Aceptable de Payezrose o cualquier otro acuerdo que haya usted celebrado con Payezrose.
              Este Acuerdo corresponde a una solicitud de los Servicios de Payezrose.</p><br><br>
              <h5>1. Servicios de pago y requisitos.</h5><br>
              <strong>1.1 Servicios de pago.</strong>
              <p>Payezrose es un proveedor de botones de pago y actúa como tal creando, hospedando, manteniendo y proporcionándole nuestros Servicios Payezrose a usted a través de Internet. Nuestros servicios le permiten recibir pagos de cualquier persona que tenga una tarjeta de crédito y recibir dichos pagos en aquellas cuentas donde se indique. La disponibilidad de nuestros servicios Payezrose varía según el país/la región
              Payezrose no es una empresa transportista común ni una empresa de servicios públicos.
              </p><br>
              <strong>1.2 Requisitos.</strong>
              <p>Para reunir los requisitos y poder utilizar los Servicios Payezrose, debe tener 18 años o más, en función de la mayoría de edad de su jurisdicción.            Usted debe colocar su país/región de residencia correcto en la Cuenta. <p><br>
              <strong>1.3 Información.</strong>
              <p>Para aperturar y mantener una Cuenta, debe proporcionarnos información correcta y actualizada.</p><br>
                <strong> a.	Su Información de Contacto.</strong> <p> Es su responsabilidad mantener actualizado su correo electrónico principal, de manera que Payezrose pueda comunicarse con usted de manera electrónica. Usted comprende y acepta que si Payezrose le envía una Comunicación electrónica y no la recibe debido a que su dirección principal de correo electrónico registrada es incorrecta, está desactualizada, está bloqueada por su proveedor de servicio, o por cualquier otro motivo no puede recibir Comunicaciones electrónicas, Payezrose considerará que dicha Comunicación sí ha sido enviada efectivamente. Tenga en cuenta que si utiliza un filtro de correo no deseado que bloquea o desvía los correos electrónicos de los remitentes que no aparecen en su libreta de direcciones de correo electrónico, deberá agregar a Payezrose a su libreta de direcciones para que pueda ver las Comunicaciones que le enviamos. </p><br>
                  <p>Puede actualizar su correo electrónico o domicilio principal en cualquier momento si inicia sesión en el sitio web de Payezrose. Si su correo ya no es válido y genera la devolución de las Comunicaciones electrónicas que le envía Payezrose, ésta considerará que su Cuenta está inactiva y no podrá hacer ningún movimiento con su cuenta Payezrose hasta que recibamos una dirección de correo electrónico principal válida y en funcionamiento de su parte.</p><br>
                <strong>b.	Verificación de Identidad.</strong><p> Usted autoriza a Payezrose, directamente o a través de terceros, a realizar todas las consultas que consideremos necesarias para validar su identidad. Dentro de estas consultas se incluye solicitarle más Información o documentación, tener que proporcionar su número de contribuyente o número de identificación nacional, realizar algunos pasos para confirmar la titularidad de su correo electrónico o de instrumentos financieros, solicitarle un reporte crediticio o comparar su Información con bases de datos de terceros o a través de otras fuentes.<p><br>
                <strong>c.	Autorización de Reporte Crediticio.</strong><p> Si usted abre una Cuenta Empresas, se considerará que está proporcionando a Payezrose instrucciones y autorización por escrito, de conformidad con cualquier ley aplicable, para que obtenga de un buró de crédito su reporte crediticio personal y/o comercial. También autoriza a que Payezrose obtenga su reporte crediticio personal y/o comercial: (a) cuando solicita ciertos productos nuevos, o (b) en cualquier momento en que Payezrose considere razonablemente que puede haber un nivel de riesgo mayor asociado a su Cuenta Empresas.</p><br>
              <strong>1.4 Dueño Beneficiario.</strong>
              <p>Usted debe ser el propietario real de la Cuenta y solo realizar negocios a nombre propio.</p><br>
              <strong>1.5 Presentación de Payezrose</strong>
              <p>Usted acepta proporcionar igual trato a Payezrose y/o a otras formas de pago o marcas que ofrezca en sus puntos de venta (por ejemplo, sitios web o aplicaciones móviles). Esto incluye al menos condiciones iguales o sustancialmente similares de: ubicación del logotipo, posición en cualquier punto de venta y trato en términos de flujo de pago, términos, condiciones, restricciones o comisiones, en cada caso según se compare con otras marcas y formas de pago en sus puntos de venta.</p><br>
              <p>En las declaraciones ante sus clientes o en comunicaciones públicas, usted acepta no describir en forma errónea a Payezrose como una forma de pago o mostrar preferencia por otras formas de pago por sobre Payezrose.  En todos sus puntos de venta, usted acepta no intentar disuadir o inhibir a sus clientes de utilizar Payezrose; así como tampoco instar al cliente a utilizar una forma de pago alternativa.  Si autoriza a sus clientes a pagar con Payezrose, cualquieras sean las formas de pago en exhibición que acepte (dentro de cualquier punto de venta o en sus materiales de marketing, publicidad y otras comunicaciones con el cliente), usted acepta mostrar las marcas de pago de Payezrose de forma al menos tan prominente y positiva como muestra todas las demás formas de pago.<p><br><br>
              <h5>2. Recibo de pagos.</h5><br>
              <strong>2.1 Límites de Cobro.</strong>
              <p>Nosotros podemos, a nuestra sola discreción, establecer límites para el importe de los cobros que usted puede enviar a través de los Servicios Payezrose. Usted puede ver su límite de envío, si lo tuviera, iniciando sesión en su Cuenta. Si verificó su Cuenta, podrá aumentar los límites de envío.</p><br>
              <strong>2.2 Retrasos de Procesamiento del Comercio.</strong>
              <p>Cuando usted envía cobros a ciertos Comercios, usted proporciona una autorización a dicho Comercio para que procese su pago y complete la transacción. El pago se retendrá como pendiente hasta que el Comercio procese el pago. Algunos Comercios pueden retrasarse en el procesamiento de su pago. En tales casos, su autorización seguirá siendo válida por hasta 30 Días. Si el pago requiere de conversión de divisas, el tipo de cambio se determinará en el momento en que el Comercio Payezrose procese el pago y complete la transacción. </p><br><br>
              <h5>3. Requisitos de uso.</h5><br>
              <strong>3.1 Capacidad para Recibir Pagos. </strong>
              <p>Payezrose puede permitir que cualquier persona (con o sin una cuenta Payezrose) inicie un pago a su cuenta Empresas.  Al integrarse a nuestro pago en línea/plataforma cualquier funcionalidad que tenga el propósito de habilitar a un pagador sin Cuenta para enviar un pago a su cuenta Empresas, usted acepta las condiciones de uso de dicha funcionalidad que Payezrose pone a su disposición en el sitio web </p><br>
              <strong>3.2 Sin Recargos.</strong>
              <p> Usted acepta que no impondrá ningún recargo o cualquier otra comisión por aceptar Payezrose como forma de cobro sin nuestro consentimiento previo por escrito. Usted puede cobrar una comisión de gestión relacionada con la venta de bienes o servicios, siempre y cuando dicha comisión no sea superior a la comisión de gestión que cobre por transacciones ajenas a Payezrose.</p><br><br>
              <h5>4. Saldos de la cuenta.</h5><br>
              <strong>4.1 Compensación de Importes Adeudados y cuyas fechas de pago han pasado.</strong>
              <p> Si usted adeuda cualquier cantidad a Payezrose, a una filial o a ezrose, Payezrose puede descontar de su Cuenta las cantidades necesarios para pagar los importes vencidos por más de 180 Días</p><br><br>
              <h5>5. Pago de fondos.</h5><br>
              <strong>5.1 ¿Cómo recibo mi dinero?</strong> 
              <p>En función del país/la región donde haya registrado su Cuenta, puede retirar los fondos de la Cuenta recibido por cualquiera de estos medios: (a) transferencia electrónica a su cuenta bancaria en EE. UU. o a su cuenta bancaria local, (b) transfiriéndolos electrónicamente a su tarjeta marca Visa, (c) a través de una transferencia automática iniciada por Payezrose a su instrumento financiero asociado o (d) por medio de la solicitud de un cheque físico por correo. En ciertos países, su capacidad para hacer retiros a una cuenta bancaria local podría requerir el uso de Payezrose Retiros. </p><br>
              <p>Por lo general, solo enviaremos cheques a direcciones confirmadas, a menos que tenga una Cuenta Verificada. No enviaremos cheques a apartados postales. Si desea enviar un cheque a una dirección que no cumple con estos requisitos, debe comunicarse con el Servicio de Atención al Cliente y proporcionar la documentación que solicitamos para verificar su asociación con la dirección. Si no cobra el cheque en el plazo de 180 días a partir de la fecha de emisión, retornaremos los fondos a su saldo (descontada una comisión).</p><br>
              <strong>5.2 Límites de Retiro.</strong>
              <p> En función del grado en que haya Verificado su Cuenta, nosotros podemos restringir su capacidad de retirar fondos.</p><br>
              <strong>5.3 Comisiones por Retiro.</strong>
              <p> Cuando retire su Saldo, y en función del método de retiro, se le cargará una comisión por retiro de Saldo (Comisiones). Además, si retira su saldo en una divisa distinta de la divisa en que está el saldo de su Cuenta, adicionalmente se le cargará una Comisión por Conversión de Divisas.</p><br><br>
              <h5>6. Cierre de su cuenta.</h5><br>
              <strong>6.1 Cómo cerrar su Cuenta.</strong>
              <p> Usted puede cancelar su Cuenta en cualquier momento siguiendo las instrucciones del Perfil de Cuenta. Después del cierre de una cuenta, se cancelará cualquier transacción en trámite y caducarán todos los saldos asociados a los Códigos de canje, a menos que no esté permitido por la ley. Debe retirar su Saldo antes de cancelar su Cuenta.</p><br>
              <strong>6.2 Restricciones del Cierre de la Cuenta.</strong>
              <p>Usted no puede evadir ninguna investigación mediante la cancelación de su Cuenta. Si cierra su Cuenta mientras estamos llevando a cabo una investigación, podemos retener sus fondos para proteger a Payezrose, sus filiales o a terceros, contra el riesgo de Cancelaciones, Contracargos, Reclamaciones, comisiones, multas, penalizaciones y otras responsabilidades. Usted seguirá siendo responsable de todas las obligaciones relacionadas con su Cuenta, incluso después de la cancelación de la misma.</p>
              
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