@isset($order)

@foreach ($order->insumos as $insumo)
    <tr>
        <td>{{$insumo->insumo->nombre}}</td>
        <td>
            {{$insumo->cantidad}}
        </td>
        <td>{{$insumo->precio}}</td>
        <td>{{$insumo->cantidad * $insumo->precio}}</td>
    </tr>
@endforeach
<tr>
    <td>Subtotal: {{ $subtotal }} </td>
    <td>IVA: {{ $subtotal * 0.16 }} </td>
    <td>Total: {{ $subtotal * 1.16 }} </td>
</tr>
@endisset
