<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                    'nombre' => ['required', 'string', 'max:45'],
                    'telefono' => ['required', 'numeric', 'digits:10'],
                    'correo' =>['required', 'email', 'max:45', new Custom_email] ,
                    'direccion' =>['required', 'max:30'],
                    'rfc' => ['required', 'max:13','unique:cliente,rfc'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Pago
     */
    protected function create(array $data)
    {

        $new = Cliente::create([
                'nombre' => $data['nombre'],
                'telefono' => $data['telefono'],
                'correo' => $data['correo'],
                'direccion' => $data['direccion'],
                'rfc' => $data['rfc']
        ]);

        return ['new' =>$new,'data'=>[],'errors' => 'Venta pagada'];
    }

    public function addCliente(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('pages.forms.client-form')
            ->withErrors($validator->errors());
        }

        $pago = $this->create($request->all());

        session()->flashInput($request->all());
        session()->flash('status','Cliente creado correctamente');

        return view('pages.forms.client-form');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('clients\components\edit-profile-form')
            ->withErrors($validator->errors());
        }

        $pago = Cliente::whereId($request->get('id'))->update($request->except('_token','_method'));

        session()->flashInput($request->all());
        session()->flash('status','Insumo modificado correctamente');

        return view('clients\components\edit-profile-form');
    }

    public function search(Request $request)
    {
        $q= $request->get('q');
        $clients = Cliente::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($clients) > 0)
            return compact('clients');
        else return view ('clients\components\clients-table')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $request)
    {
        $q= $request->get('q');
        $clients = Cliente::where('nombre','LIKE','%'.$q.'%')->get();
        return view('pages.components.select-products-table',compact('clients'));
    }
}
