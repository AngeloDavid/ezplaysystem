                                           
    @forelse ($invoices as $invoice)
        <tr>
            <th scope="row">{{ $invoice->code }} </th>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->desp }}</td>
            @if (Session::get('user')->id_role=='1' && $title !='Facturación')  
            <td>{{ $invoice->company }}</td>
            @endif
            <td> {{ date('d/m/Y', strtotime($invoice->date))}}</td>            
            <td> $ {{ $invoice->amount }} </td>            
            <td>
                @switch($invoice->status)
                            @case(1)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                @if (Session::get('user')->id_role=='1' && $title !='Facturación')  
                                <a class="text-secondary" href="{{ url('/Facturas/'.$invoice->id.'/status')}}" >
                                    <span class="status-p bg-primary">Ingresada</span></td>   
                                </a>
                                @else
                                    <span class="status-p bg-primary">Ingresada</span></td>    
                                @endif
                                @break
                            @case(2)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                @if (Session::get('user')->id_role=='1' && $title !='Facturación')  
                                <a href="{{ url('/Facturas/'.$invoice->id.'/status')}}" class="text-secondary">
                                    <span class="status-p bg-info">Enviada</span></td>    
                                </a>
                                @else
                                    <span class="status-p bg-info">Enviada</span></td>    
                                @endif
                                @break
                            @case(3)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                @if (Session::get('user')->id_role=='1' && $title !='Facturación')  
                                <a href="{{ url('/Facturas/'.$invoice->id.'/status')}}" class="text-secondary">
                                    <span class="status-p bg-warning">Pagada por cliente</span></td>    
                                </a>
                                @else
                                    <span class="status-p bg-warning">Pagada por cliente</span></td>    
                                @endif
                                @break
                            @case(4)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <span class="status-p bg-success">Depositado o transferencia completada</span></td>    
                                @break
                            @default
                                <span class="status-p bg-danger">Anulado</span></td>                            
                @endswitch                                                                   
            <td>
                <ul class="d-flex justify-content-center">
                    <li class="mr-3"><a href="{{ url('/Facturas/'.$invoice->id)}}" class="text-success"><i class="ti-receipt"></i></a></li>
                    @if (! @empty($invoice->file ) )
                        <li class="mr-3"><a target="_blank" href="storage/docs/{{ $invoice->file }}" class="text-secondary"><i class="ti-cloud-down"></i></a></li>
                    @endif  
                    @if ($invoice->status == 1 || $invoice->status == 2)                    
                        
                        {{-- @if ($title =='Facturación')                          --}}
                            @if (Session::get('user')->id== $invoice->id_company )                                               
                                <li class="mr-3"><a href="{{ url('/Facturas/'.$invoice->id.'/edit')}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                            @endif       
                        {{-- @endif --}}
                        <li><a href="{{ url('/Facturas/'.$invoice->id.'/delete')}}" class="text-danger"><i class="ti-trash"></i></a></li>
                    @endif
                    @if (Session::get('user')->id_role=='1' && $title !='Facturación') 

                    @endif
                </ul>
            </td>
        </tr>
        
    @empty        
        <tr >
            <td colspan="7">
                No existe registros
            </td>
        </tr>
    @endforelse
    {{-- paginacion de tabla  --}}
    <tr>
        <td colspan="8">
            @if($title !='Cuentas Por Cobrar' )
            {{ $invoices->links('pagination') }}
            @endif
        </td>
    </tr>
