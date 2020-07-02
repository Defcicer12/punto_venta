<div class="card" id="edit-card">
    <div class="card-header">
        <h5 class="title">{{ __('Editar producto') }}</h5>
    </div>
    <form method="post" action="{{ route('profile.update') }}" autocomplete="off" id="modal-edit-form">
    @include('refunds\components\edit-profile-form')
    </form>
</div>
<script>
    async function diagnosticar(){
        data  = await $('#modal-edit-form').serialize();
        console.log(data)
        await $.ajax({
            type: "PUT",
            url: "{{ route('orden.diagnosticar') }}",
            data: data,
            success: function(response){
                            reloadTable();
                            $('#modal-edit-form').html(response)
                        }
        });
    }
</script>
