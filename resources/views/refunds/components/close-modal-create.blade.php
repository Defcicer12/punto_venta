@isset($orden)

    <div class="card" id="register-card">
        <form class="form" method="patch" action="{{ route('register-users') }}" id="close-form">
        <div id="id-close-fill">
        @include('refunds.components.id-close-fill')
        </div id="close-form1">
        @include('refunds.components.edit-close-form')
        </form>
    </div>
@endisset
<script>

    async function cerrar(){
        console.log($('#close-create').get());
        data = $('#close-form').serialize();
        id = $('#close-form').find('input[name="id"]').val();
        console.log(id);
        await $.ajax({
            type: "PUT",
            url: "{{ route('orden.cerrar') }}",
            data: data,
            success: function(response){
                if (response['error']) {
                                $('#close-create').html(response['html']);
                            } else {

                                $('#close-create').html(response['html']);
                                reloadTable();
                                generarTicket(id);
                            }
                        }
        });
    }

    async function generarTicket(id){
        url = "http://punto_venta.test/pdf/ticket-pago/"+id;
        window.open(url);
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
