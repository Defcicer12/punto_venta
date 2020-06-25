@foreach ($sales as $sale)
    <tr>
        <td>{{$sale['fecha']}}</td>
        <td>
            {{$sale->empleado->name}}
        </td>
        <td>{{$sale->cliente->nombre}}</td>
        <td>{{$sale['estado']}}</td>
    </tr>
@endforeach
