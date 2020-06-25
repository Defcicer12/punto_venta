
<form method="post" autocomplete="off" id="modal-create-form">
@include('pages.forms.client-form')
</form>


<script>
    async function crearCliente(){
        data  = await $('#modal-create-form').serialize();
        console.log(data);
        await $.ajax({
            type: "POST",
            url: "{{ route('client.create') }}",
            data: data,
            success: function(response){
                            $('#create-client-card').html(response)
                            reloadSelect();
                        }
        });
    }
    async function reloadSelect(){
        await $.ajax({
            type: "GET",
            url: "{{ route('components.client-select') }}",
            data: data,
            success: function(response){
                            $('#load-select').html(response)
                        }
        });
    }
</script>
