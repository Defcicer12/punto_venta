<div class="card card-register" id="register-card">
    <div class="card-header">
        <img class="card-img" style="height: 250px; width: 440px; margin-top: 30px;" src="{{ asset('black') }}/img/card-primary.png" alt="Card image">
        <h4 class="card-title">{{ __('productos') }}</h4>
    </div>
    <form class="form" method="patch" action="{{ route('register-users') }}" id="create-form">
    @include('products.components.create-form')
    </form>
</div>
<script>
    async function crearUsuario(){
        data  = await $('#create-form').serialize();
        console.log(data);
        await $.ajax({
            type: "POST",
            url: "{{ route('product.create') }}",
            data: data,
            success: function(response){
                            $('#create-form').html(response)

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
