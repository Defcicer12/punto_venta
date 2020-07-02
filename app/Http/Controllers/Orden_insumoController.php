<?php

namespace App\Http\Controllers;

use App\Orden_insumo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
use Illuminate\Support\Facades\Validator;

class Orden_insumoController extends Controller
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
            'id_orden' => ['required','exists:orden_servicio,id'],
            'id_insumo' => ['required','exists:insumo,id'],
            'cantidad' => ['required','numeric'],
            'precio' => ['required','numeric'],
        ]);
    }
    protected function validateDiagnostico(Array $data)
    {
        return Validator::make($data, [
            'diagnostico' => ['required','max:100'],
        ]);

    }
    protected function validatePendiente(Array $data)
    {
        return Validator::make($data, [
            'observaciones'=> ['nullable','max:100'],
            'costo_servicio' => ['required','numeric'],
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

        $new = Orden_insumo::create([
                'id_orden' => $data['id_orden'],
                'id_insumo' => $data['id_insumo'],
                'cantidad' => $data['cantidad'],
                'precio' => $data['precio'],
        ]);

        return $new;
    }

    public function addOrdenInsumo(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return ['error'=>1,'message' => $validator->errors()->first()];
        }

        $new = $this->create($request->all());

        session()->flashInput($request->all());

        return ['error'=>0,'message' => 'Orden correctamente creada','new' => $new['id_orden']];
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

        $pago = Orden_insumo::whereId($request->get('id'))->update($request->except('_token','_method'));

        session()->flashInput($request->all());
        session()->flash('status','Insumo modificado correctamente');

        return view('clients\components\edit-profile-form');
    }

    public function search(Request $request)
    {
        $q= $request->get('q');
        $clients = Orden_insumo::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($clients) > 0)
            return compact('clients');
        else return view ('clients\components\clients-table')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $request)
    {
        $q= $request->get('q');
        $orders = Orden_insumo::where('id','LIKE','%'.$q.'%')->get();
        return view('refunds\components\refunds-table',compact('orders'));
    }

    public function diagnosticar(Request $request)
    {
        $validator = $this->validateDiagnostico($request->all());

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('refunds\components\edit-profile-form')
            ->withErrors($validator->errors());
        }
        Orden_insumo::whereId($request->get('id'))->update(['status' =>'Con diagnóstico']);
        $pago = Orden_insumo::whereId($request->get('id'))->update($request->except('_token','_method'));

        session()->flashInput($request->all());
        session()->flash('status','Orden Diagnosticada correctamente');

        return view('refunds\components\edit-profile-form');
    }

    public function pendiente(Request $request)
    {

        return Orden_insumo::whereId($request->get('id'))->update(['status' =>'Pendiente por cliente']);

    }

    public function reparacion(Request $request)
    {

        return Orden_insumo::whereId($request->get('id'))->update(['status' =>'En reparación']);

    }
}
