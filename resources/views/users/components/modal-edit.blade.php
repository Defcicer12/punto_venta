<div class="card" id="edit-card">
    <div class="card-header">
        <h5 class="title">{{ __('Editar perfil') }}</h5>
    </div>
    <form method="post" action="{{ route('profile.update') }}" autocomplete="off" id="modal-edit-form">
    @include('users\components\edit-profile-form')
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="title">{{ __('Password') }}</h5>
    </div>
    <form method="post" action="{{ route('profile.passwordSeparate') }}" autocomplete="off" id="modal-password-form">
        @include('users\components\edit-password-form')
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
