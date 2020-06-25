@foreach ($movements as $movement)
    @if ($movement['tipo'] == 'Devolucion')
    <tr>
        <td>{{$movement->id}}</td>
        <td>{{$movement->movimiento->id}}</td>
        <td>
            {{$movement['tipo']}}
        </td>
        <td>{{$movement['fecha']}}</td>
        <td>{{ $movement['salida'] == 1 ? '-' : '+' }}{{$movement->movimiento->cantidad}}</td>
        <td>
            {{$movement->movimiento->producto->nombre}}
        </td>
    </tr>
    @endif
    @if ($movement['tipo'] == 'Venta')
        @foreach ($movement->movimiento->detalles as $detalle)
            <tr>
                <td>{{$movement->id}}</td>
                <td>{{$movement->movimiento->id}}</td>
                <td>
                    {{$movement['tipo']}}
                </td>
                <td>{{$movement['fecha']}}</td>
                <td>{{ $movement['salida'] == 1 ? '-' : '+' }}{{$detalle->cantidad}}</td>
                <td>
                    {{$detalle->producto->nombre}}
                </td>
            </tr>
        @endforeach
    @endif
    @if ($movement['tipo'] == 'Compra' || $movement['tipo'] == 'Otros')
    <tr>
        <td>{{$movement->id}}</td>
        <td>{{$movement->movimiento->id}}</td>
        <td>
            {{$movement['tipo']}}
        </td>
        <td>{{$movement['fecha']}}</td>
        <td>{{ $movement['salida'] == 1 ? '-' : '+' }}{{$movement->cantidad}}</td>
        <td>
            {{$movement->movimiento->nombre}}
        </td>
    </tr>
    @endif
@endforeach
