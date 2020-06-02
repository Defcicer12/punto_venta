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
                    'rfc' => ['required', 'max:13'],
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
            return ['success' => 0, 'errors' => $validator->errors()->first()];
        }

        $pago = $this->create($request->all());
        return $pago;
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Cliente::whereId($request->get('id_venta'))->update($request->all());

        return back()->withStatus(__('Client successfully updated.'));
    }

    public function search(Request $r)
    {
        $data= $r->all();
        $ventas = Cliente::where('id_venta',$data['id_venta'])->get();
        if(count($ventas) > 0)
            return view('pages.maps',['ventas' => $ventas]);
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $r)
    {
        $data= $r->all();
        $pagos = Cliente::where('id_venta',$data['id_venta'])->get();
        return view('pages.components.payments-table',compact('pagos'));
    }
}
