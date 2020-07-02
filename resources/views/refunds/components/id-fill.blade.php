                @isset($orden)
                    <div class="input-group{{ $errors->has('id_orden') ? ' has-danger' : '' }}" hidden>
                        <input type="text" id="id_orden" name="id_orden" class="form-control{{ $errors->has('id_orden') ? ' is-invalid' : '' }}" placeholder="{{ __('id_orden') }}" value="{{$orden->id}}">
                            @include('alerts.feedback', ['field' => 'id_orden'])
                    </div>
                @endisset
