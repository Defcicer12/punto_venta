<div class="card" id="edit-card">
    <div class="card-header">
        <h5 class="title">{{ __('Editar producto') }}</h5>
    </div>
    <form method="post" action="{{ route('profile.update') }}" autocomplete="off" id="modal-edit-form">
    @include('adjusments\components\edit-profile-form')
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
</script>
