<div class="card" id="edit-card">
    <div class="card-header">
        <h5 class="title">{{ __('Editar Cliente') }}</h5>
    </div>
    <form method="post" action="{{ route('profile.update') }}" autocomplete="off" id="modal-edit-form">
    @include('clients\components\edit-profile-form')
    </form>
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
