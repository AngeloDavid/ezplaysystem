<tbody>
    @foreach ($companies as $company)
        <tr>
            <th scope="row">{{ $company->ruc }}</th>
            <td>{{ $company->name }}</td>
            <td>{{ $company->created_at }}</td>
            <td>
                {{ $company->address }} - {{ $company->state }} -
                {{ $company->country }}
            </td>
            </td>
            <td>
                @if ($company->status == 1)
                    <span class="status-p bg-success">Habilitado</span></td>
                @else
                    <span class="status-p bg-danger">Deshabilidado</span></td>
                @endif
                
            <td>
                <ul class="d-flex justify-content-center notification-area">
                        <li class="mr-3"><a href="{{ url('/Empresas/'.$company->id.'/delete')}}" class="text-danger"><i class="ti-trash"></i></a></li>    
                    @if ($company->status == 1)
                        <li class="mr-3" ><a href="{{ url('/Empresas/'.$company->id.'/edit')}}" class="text-secondary"> <i class="fa fa-edit"></i></a></li>                        
                        @if (count($company->invoices->whereBetween('status',[1,3])) != 0)
                            <li  class="mr-3"><a href="{{ url('/TodasFacturas/'.$company->id)}}" class="text-info" title="Facturas Pendientes"><i class="ti-view-list-alt"><span>{{ count($company->invoices->whereBetween('status',[1,3])) }}</span> </i> </a> </li>
                        @endif
                    
                    @endif
                    
                </ul>
            </td>
        </tr>
    @endforeach
        
        
    </tbody>