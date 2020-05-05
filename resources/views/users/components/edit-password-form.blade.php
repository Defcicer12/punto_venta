<div class="card-body">
    @csrf
    @method('put')

    @include('alerts.success')

    <div class="input-group{{ $errors->has('id') ? ' has-danger' : '' }}" hidden>
        <input type="text" name="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" placeholder="{{ __('id') }}" value="{{ old('id', '') }}">
        @include('alerts.feedback', ['field' => 'id'])
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
        <label>{{ __('Nueva contraseña') }}</label>
        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>
        @include('alerts.feedback', ['field' => 'password'])
    </div>
    <div class="form-group">
        <label>{{ __('Confirmar contraseña') }}</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('Confirm New Password') }}" value="" required>
    </div>
</div>
<div class="card-footer">
    <button type="button" onclick="editarPassword()" class="btn btn-fill btn-primary">{{ __('Change password') }}</button>
</div>
