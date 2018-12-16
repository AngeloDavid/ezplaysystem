<tbody>
    @foreach ($customers as $customer)
        <tr>
            <th scope="row">{{ $customer->ruc }}</th>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->created_at }}</td>
            <td>
                {{ $customer->address }} - {{ $customer->state }} -
                {{ $customer->country }}
            </td>
            {{-- <td>
                <div class="progress" style="height: 8px;">
                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
            </td>
            <td>
                @if ($customer->status == 1)
                    <span class="status-p bg-success">Habilitado</span></td>
                @else
                    <span class="status-p bg-danger">Deshabilidado</span></td>
                @endif
                
            <td>
                <ul class="d-flex justify-content-center">
                    @if ($customer->status == 1)
                        <li class="mr-3"><a href="{{ url('/Clientes/'.$customer->id.'/edit')}}" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                        <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                    @else                    
                        <li><a href="#" class="text-success"><i class="ti-trash"></i></a></li>
                    @endif
                </ul>
            </td>
        </tr>
    @endforeach
        
        
    </tbody>