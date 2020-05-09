<div class="card">
    <div class="card-header">
        <h5 class="title">{{ __('Password') }}</h5>
    </div>
    <div class="">
        <table class="table tablesorter ">
            <thead class=" text-primary">
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Empleado</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Cantidad a devolver</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody id="users-table">
                @include('refunds.components.edit-password-form')
            </tbody>
        </table>
    </div>

</div>
<script>
    async function editarUsuario(){
        data  = await $('#modal-edit-form').serialize();
        await $.ajax({
            type: "PUT",
            url: "{{ route('profile.updateSeparate') }}",
            data: data,
            success: function(response){
                            reloadTable();
                            $('#modal-edit-form').html(response)
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
