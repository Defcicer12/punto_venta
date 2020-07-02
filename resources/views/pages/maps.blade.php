@extends('layouts.app', ['page' => __('Orden de servicio'), 'pageSlug' => 'caja'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="title">{{ __('Agregar cliente') }} <span id='ct' ></span></h5></h5>
            </div>
            <div class="card-body">
            <form id="order-info">
                @csrf
                <div id="load-select">
                    @include('pages\components\clients-select')
                </div>

                <div class="card-footer" id="client-fill">
                    @include('pages\components\clients-fill')
                </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="title">{{ __('Datos de equipo') }}</h5></h5>
        </div>
        <div class="card-body">
            <div class="input-group{{ $errors->has('equipo') ? ' has-danger' : '' }}">

                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-laptop"></i>
                    </div>
                </div>
                <input type="email" id="equipo" name="equipo" class="form-control{{ $errors->has('equipo') ? ' is-invalid' : '' }}" placeholder="{{ __('Equipo') }}" value="{{ old('equipo', '') }}">
                @include('alerts.feedback', ['field' => 'equipo'])
            </div>
            <div class="input-group{{ $errors->has('falla') ? ' has-danger' : '' }}">

                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-settings"></i>
                    </div>
                </div>
                <input type="email" id="falla" name="falla" class="form-control{{ $errors->has('falla') ? ' is-invalid' : '' }}" placeholder="{{ __('Falla del equipo') }}" value="{{ old('falla', '') }}">
                @include('alerts.feedback', ['field' => 'falla'])
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="title">{{ __('Agregar técnico') }} <span id='ct' ></span></h5></h5>
        </div>
        <div class="card-body">

            <div id="load-select">
                @include('pages\components\tecnico-select')
            </div>

            <div class="card-footer" id="tecnico-fill">
                @include('pages\components\tecnico-fill')
            </div>
            <button onclick="capturarOrden()" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#clientes-modal-create">Añadir insumo</button>
        </form>
    </div>
</div>

<script>
    window.onload = hideElement;
    window.onload = display_ct;
    productos_agregados = [];
    pagos_agregados = [];
    venta = [];
    precio_venta = 0;
    contador_pagos = 1;

    function addProducto(producto) {
        if ( !$( ".tr-"+producto.id ).length ) {
            productos_agregados['prod'+producto.id] = producto;
            html = `<tr class="tr-`+producto.id+`">
                        <td>
                            `+producto.id+`
                        </td>
                        <td>
                            `+producto.nombre+`
                        </td>
                        <td>
                            `+producto.existencia+`
                        </td>
                        <td>
                            $`+producto.precio+`
                        </td>
                        <td class="text-primary" style="width: 10%;">
                            <input type="number" value="1" class="form-control" onchange="totales()" name="cantidad`+producto.id+`">
                        </td>
                    </tr>`
            $('#' + producto.id).css('border-width', "5px");
            $('#t-body').append(html);
            totales();
        }else{
            delete productos_agregados['prod'+producto.id];
            $('#' + producto.id).css('border-width', "1px");
            $( ".tr-"+producto.id ).remove();
        }
    }

    async function totales()
    {
        subtotal = 0;
        for (var key in productos_agregados) {
            productos_agregados[key].cantidad  = await $('input[name ="cantidad'+productos_agregados[key].id+'"]').val();
            subtotal += productos_agregados[key].precio * productos_agregados[key].cantidad;
            subtotal = subtotal;
            iva = subtotal * 0.16;
            precio_venta = subtotal+iva;
        }
        renderTotales(subtotal);
    }

    async function renderTotales(subtotal){
        await $.ajax({
            type: "post",
            url: "{{ route('components.sale-totals') }}",
            data:{
            _token: "{{ csrf_token() }}",
            subtotal: subtotal
            },
            success: function(response){
                            $('#totales').html(response)

                        }
        });
    }

    async function reloadFill(){
        await $.ajax({
            type: "post",
            url: "{{ route('components.client-fill') }}",
            data:{
            _token: "{{ csrf_token() }}",
            id: $("#select-cliente option:selected").val()
            },
            success: function(response){
                            $('#client-fill').html(response)

                        }
        });
        console.log(await $('#order-info').serialize());
    }

    async function capturarOrden(){
        order = await $('#order-info').serialize();
        await $.ajax({
            type: "post",
            url: "{{ route('orden.create') }}",
            data: order,
            success: function(response){
                            if(response['error'])
                            {
                                showNotification(response['message'],'danger');
                            }else{
                                showNotification(response['message'],'success');
                                generarTicket(response['new']);
                                setTimeout(() => {
                                    window.location.replace("{{ route('pages.maps') }}");
                                }, 4000);
                            }

                        }
        });
    }

    async function generarTicket(id){
        url = "http://punto_venta.test/pdf/ticket-cliente/"+id;
        window.open(url);
    }

    function downloadFile(response) {
        var blob = new Blob([response], {type: 'application/pdf'})
        console.log(blob);
        var link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = 'ticket';
        document.body.appendChild(link);

        link.click();

        document.body.removeChild(link);

    }

    async function reloadTecnicoFill(){
        await $.ajax({
            type: "post",
            url: "{{ route('components.tecnico-fill') }}",
            data:{
            _token: "{{ csrf_token() }}",
            id: $("#select-tecnico option:selected").val()
            },
            success: function(response){
                            $('#tecnico-fill').html(response)

                        }
        });
    }

    function hideElement(){
        $('#pagos').hide();
        $('#cerrar').hide();
        $('#cancelar').hide();
    }

    function addPago(pago) {
        if ( !$( ".tr-"+pago.id ).length ) {
            pagos_agregados['pago'+pago.id] = pago;
            html = `<tr class="tr-`+pago.id+`">
                        <td>
                            `+pago.id+`
                        </td>
                        <td>
                            `+pago.nombre+`
                        </td>
                        <td>
                            `+pago.existencia+`
                        </td>
                        <td>
                            $`+pago.precio+`
                        </td>
                        <td class="text-primary" style="width: 10%;">
                            <input type="number" value="1" class="form-control" name="cantidad`+pago.id+`">
                        </td>
                    </tr>`
            $('#' + pago.id).css('border-width', "5px");
            $('#t-body').append(html);
            contador++;
        }else{
            delete pagos_agregados['pago'+pago.id];
            $('#' + pago.id).css('border-width', "1px");
            $( ".tr-"+pago.id ).remove();
        }
    }

    async function Confirmar(){
        //searchw: http://punto_venta.test/product/searchw
        productos = [];
        for (var key in productos_agregados) {
            productos_agregados[key].cantidad  = await $('input[name ="cantidad'+productos_agregados[key].id+'"]').val();
            productos.push(productos_agregados[key]);
        }

        await $.ajax({
            type: "POST",
            url: "{{  route('sale.create') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id_empleado: "{{ Auth::user()->id }}",
                id_cliente: $("#select-cliente option:selected").val(),
                productos: productos,
                precio: precio_venta,
                    },
            success: function(response){
                console.log(response)
                            if(response['sucess'] == 0)
                            {
                                showNotification(response['errors'],'danger');
                            }
                            else{
                                venta = response;
                                for (var key in productos_agregados) {
                                    $('input[name ="cantidad'+productos_agregados[key].id+'"]').prop('readonly',true);
                                }
                                $('#labelpagos').append(' <p class="label_total" style="text-align: center;">Total de venta: '+venta.precio+'</p>');
                                $('#tabla-agregados').append(' <p class="label_total" style="text-align: center;">Total de venta: '+venta.precio+'</p>');
                                $('#pago-monto').append(`
                                <div hidden class="form-group{{ $errors->has('monto') ? ' has-danger' : '' }}" id="pago-monto">
                                    <label>{{ __('id_venta') }}</label>
                                    <input type="number" id="id_venta" hidden value="`+venta.id+`" name="id_venta" class="form-control{{ $errors->has('monto') ? ' is-invalid' : '' }}" placeholder="{{ __('Monto') }}" value="{{ old('monto', auth()->user()->monto) }}">
                                    @include('alerts.feedback', ['field' => 'monto'])
                                </div>`
                                )
                                showNotification('sicharcho','success');
                                $('#pagos').show();
                                $('#cerrar').show();
                                $('#confirmar').hide();
                                $('#cancelar').show();
                                $('#products-card').hide();
                            }
                        }
        });
    }

    async function Cerrar(){
        await $.ajax({
            type: "PUT",
            url: "{{ route('sale.close') }}",
            data: {
                _token: "{{ csrf_token() }}",
                tipo: $('#tipo-pago option:selected').val(),
                monto: $('#monto-pago').val(),
                id_venta: $('#id_venta').val()
            },
            success: function(response){
                if(response['success']==0){
                    showNotification(response['errors'],'danger');
                }else{
                    console.log(response);
                    // pagos_agregados.push() = response['new'];
                    $('.label_total').text('Total de venta:'+response['data']['monto_venta']+' Por Cubrir:'+response['data']['monto_por_cubrir']);
                    showNotification('Venta cerrada con éxito, redireccionando','success');
                    setTimeout(() => {
                        window.location.replace("{{ route('pages.maps') }}");
                        }, 2000);
                }
            }
        });
    }

    function cancelar(){
        window.location.replace("{{ route('pages.maps') }}");
    }

    async function mostrarPagos(){
        await $.ajax({
            type: "POST",
            url: "{{ route('payment.create') }}",
            data: {
                _token: "{{ csrf_token() }}",
                tipo: $('#tipo-pago option:selected').val(),
                monto: $('#monto-pago').val(),
                id_venta: $('#id_venta').val()
            },
            success: function(response){
                if(response['success']==0){
                    showNotification(response['errors'],'danger');
                }else{
                    console.log(response);
                    // pagos_agregados.push() = response['new'];
                    $('.label_total').text('Total de venta:'+response['data']['monto_venta']+' Por Cubrir:'+response['data']['monto_por_cubrir']);
                    showNotification(response['errors'],'success');
                    $('#cancelar').hide();
                }
            }
        });

        await $.ajax({
            type: "GET",
            url: "{{ route('payment.searchw') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id_venta: $('#id_venta').val()
            },
            success: function(response){
                            $('#t-body-pagos').html(response)
                        }
        });
    }

    async function searchWithoutReload(){
        //searchw: http://punto_venta.test/product/searchw
        search  = await $('#q').val();
        await $.ajax({
            type: "GET",
            url: "{{ route('product.searchw') }}",
            data: {q: search},
            success: function(response){
                            $('#product-selection').html(response)
                        }
        });
    }

    //notificacion
    function showNotification(message,type) {
    color = Math.floor((Math.random() * 4) + 1);

    $.notify({
      icon: "tim-icons icon-bell-55",
      message: message

    }, {
      type: type,
      timer: 5000,
      placement: {
        from: 'top',
        align: 'center'
      }
    });
  }

  function isEmpty(obj) {
    for(var key in obj) {
        if(obj.hasOwnProperty(key))
            return false;
    }
    return true;
    }

</script>

@endsection

<script type="text/javascript">
    function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
    }

    function display_ct() {
    var x = new Date().toLocaleString('es-MX',{timeZone: "America/Mexico_City"});
    document.getElementById('ct').innerHTML = x;
    display_c();
     }
</script>
