<tbody>
    @foreach ($invoices as $invoice)
        <tr>
            <th scope="row">{{ $invoice->code }}</th>
            <td>{{ $invoice->name }}</td>
            <td>{{ $invoice->desp }}</td>
            <td> {{ date('d/m/Y', strtotime($invoice->date))}}</td>            
            <td> $ {{ $invoice->amount }} </td>            
            <td>
                @switch($invoice->status)
                            @case(1)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 33.33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <span class="status-p bg-primary">Enviado</span></td>    
                                @break
                            @case(2)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 66.66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <span class="status-p bg-warning">Reccibida</span></td>    
                                @break
                            @case(3)
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div><br>
                                <span class="status-p bg-success">Cancelada</span></td>    
                                @break
                            @default
                                <span class="status-p bg-danger">Anulado</span></td>                            
                @endswitch                                                                   
            <td>
                <ul class="d-flex justify-content-center">
                    @if ($invoice->status == 1)
                        <li class="mr-3"><a href="{{ url('/Clientes/'.$invoice->id.'/edit')}}" class="text-secondary"><i class="ti-cloud-down"></i></a></li>
                        <li class="mr-3"><a href="{{ url('/Clientes/'.$invoice->id.'/edit')}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                        <li><a href="{{ url('/Clientes/'.$invoice->id.'/delete')}}" class="text-danger"><i class="ti-trash"></i></a></li>
                    @else                    
                        <li><a href="{{ url('/Clientes/'.$invoice->id.'/delete')}}" class="text-success"><i class="ti-trash"></i></a></li>
                    @endif
                </ul>
            </td>
        </tr>
    @endforeach
</tbody>