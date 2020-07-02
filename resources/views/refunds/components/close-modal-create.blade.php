@isset($orden)

    <div class="card" id="register-card">
        <form class="form" method="patch" action="{{ route('register-users') }}" id="close-form">
        <div id="id-close-fill">
        @include('refunds.components.id-close-fill')
        </div>
        @include('refunds.components.edit-close-form')
        </form>
    </div>
@endisset
<script>
    async function agregarInsumo(){
        data  = await $('#close-form').serialize();
        console.log(data);
        await $.ajax({
            type: "POST",
            url: "{{ route('orden.insumo') }}",
            data: data,
            success: function(response){
                            if (response['error']) {
                                showNotification(response['message'],'danger')
                            } else {
                                showNotification(response['message'],'success')
                                reloadProductsTable(response['new']);

                            }


                        }
        });
    }

    async function reloadProductsTable(id){

        await $.ajax({
            type: "post",
            url: "{{ route('components.order-products-table') }}",
            data: {
            _token: "{{ csrf_token() }}",
            id: id},
            success: function(response){
                            reloadTable();
                            $('#added-table').html(response)
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
</script>
