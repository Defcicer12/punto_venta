<div class="card">
    <div class="card-header">
        <h5 class="title">{{ __('Productos en la venta') }}</h5>
    </div>
    <div class="">
        <table class="table tablesorter ">
            <thead class=" text-primary">
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">folio venta</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Cantidad a devolver</th>
                    <th scope="col">Razón</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="users-table">
                @include('refunds.components.edit-password-form')
            </tbody>
        </table>
    </div>
    @if (isset($suma))
        <div class="card-footer">
            <h5 class="title">{{ __('Total de venta: '.$suma) }}</h5>
        </div>
    @endif
</div>
<div class="card">
    <div class="card-header">
        <h5 class="title">{{ __('Productos devueltos') }}</h5>
    </div>
    <div class="">
        <table class="table tablesorter ">
            <thead class=" text-primary">
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad devuelta</th>
                    <th scope="col">Razón</th>
                </tr>
            </thead>
            <tbody id="table">
                @include('refunds.components.edit-profile-form')
            </tbody>
        </table>
    </div>

</div>
<script>
    async function devolverProducto(devolucion){
        console.log(devolucion)
        precio = $('#cantidad-'+devolucion['id_producto']).val() * devolucion['precio'];
        descripcion  = await $('#'+devolucion['id_producto']).val();
        cantidad = await $('#cantidad-'+devolucion['id_producto']).val();
        await $.ajax({
            type: "POST",
            url: "{{ route('refund.create') }}",
            data:
            {
                _token: '{{csrf_token()}}',
                id_producto: devolucion['id_producto'],
                cantidad: cantidad,
                precio: precio,
                id_venta: devolucion['id_venta'],
                descripcion: descripcion
            },
            success: function(response){
                            // reloadTable();
                            if(response['success']==0){
                                showNotification(response['errors'],'danger');
                            }else{
                                console.log(response);
                                showNotification('Devolución creada con exito','success');
                                $('#table').html(response)
                            }
                        }
        });
    }
    async function editarPassword(){
        data  = await $('#modal-password-form').serialize();
        await $.ajax({
            type: "PUT",
            url: "{{ route('profile.passwordSeparate') }}",
            data: data,
            success: function(response){
                            $('#modal-password-form').html(response)
                        }
        });
    }
</script>
