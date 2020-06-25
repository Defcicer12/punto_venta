<div class="card card-register" id="register-card">
    <div class="card-header">
        <img class="card-img" style="height: 250px; width: 440px; margin-top: 30px;" src="{{ asset('black') }}/img/card-primary.png" alt="Card image">
        <h4 class="card-title">{{ __('Empleados') }}</h4>
    </div>
    <form class="form" method="patch" action="{{ route('register-users') }}" id="create-form">
        @csrf
        @include('alerts.success')

        <div class="card-body">
            <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', '') }}">
                @include('alerts.feedback', ['field' => 'name'])
            </div>
            <div class="input-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-email-85"></i>
                    </div>
                </div>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', '') }}">
                @include('alerts.feedback', ['field' => 'email'])
            </div>
            <div class="input-group{{ $errors->has('tipo') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <select type="select" name="tipo" class="form-control{{ $errors->has('tipo') ? ' is-invalid' : '' }}">
                    <option style="color:white; background-color:#27293D;" {{ old('tipo') == '' ? 'selected' : '' }}>Tipo</option>
                    <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Técnico' ? 'selected' : '' }} value="Técnico">Técnico</option>
                    <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Gerente' ? 'selected' : '' }} value="Gerente">Gerente</option>
                    <option style="color:white; background-color:#27293D;" {{ old('tipo') == 'Almacén' ? 'selected' : '' }} value="Almacén">Almacén</option>
                </select>
                @include('alerts.feedback', ['field' => 'tipo'])
            </div>
            <div class="input-group{{ $errors->has('telefono') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-single-02"></i>
                    </div>
                </div>
                <input type="number" name="telefono" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" placeholder="{{ __('Telefono') }}" value="{{ old('telefono', '') }}">
                @include('alerts.feedback', ['field' => 'telefono'])
            </div>
            <div class="input-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password', '') }}">
                @include('alerts.feedback', ['field' => 'password'])
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="tim-icons icon-lock-circle"></i>
                    </div>
                </div>
                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm Password') }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="button" onclick="crearUsuario()" class="btn btn-primary btn-round btn-lg">{{ __('Crear Empleado') }}</button>
        </div>
    </form>
</div>
<script>
    async function crearUsuario(){
        data  = await $('#create-form').serialize();
        console.log(data);
        await $.ajax({
            type: "POST",
            url: "{{ route('register-users') }}",
            data: data,
            success: function(response){
                            $('#register-card').html(response)

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
