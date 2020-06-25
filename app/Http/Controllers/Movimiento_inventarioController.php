<?php

namespace App\Http\Controllers;

use App\Movimiento_inventario;
use App\Http\Controllers\Controller;
use App\Productos;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
use Illuminate\Support\Facades\Validator;

class Movimiento_inventarioController extends Controller
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
            'tipo' => ['required','in:Venta,Devolucion,Compra,Otros'],
            'cantidad'=> ['required','numeric'],
            'id_movimiento'=> ['required'],
            'salida'=> ['boolean','nullable']
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

        $new = Movimiento_inventario::create([
                'fecha'=> date("Y-m-d H:i:s"),
                'tipo'=> $data['tipo'],
                'descripcion'=> $data['descripcion'],
                'cantidad'=> $data['cantidad'],
                'id_movimiento'=> $data['id_movimiento'],
                'salida'=> $data['salida']
        ]);

        return ['new' =>$new,'data'=>[],'errors' => 'Venta pagada'];
    }

    public function addMovimiento(Request $request)
    {
        $validator = $this->validator($request->all());
        $productos = Productos::all();
        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('inventory\components\create-form',['productos' => $productos])
            ->withErrors($validator->errors());
        }

        $pago = $this->create($request->all());

        session()->flashInput($request->all());
        session()->flash('status','Movimiento creado correctamente');

        return view('inventory\components\create-form',['productos' => $productos]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        Movimiento_inventario::whereId($request->get('id'))->update($request->all());

        return back()->withStatus(__('Client successfully updated.'));
    }

    public function search(Request $r)
    {
        $data= $r->all();
        $ventas = Movimiento_inventario::where('id',$data['id'])->get();
        if(count($ventas) > 0)
            return view('inventory\components\products-table',['movements' => $ventas]);
        else return view ('inventory\components\products-table')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $request)
    {
        $q= $request->get('q');
        $movements = Movimiento_inventario::where('id_movimiento','LIKE','%'.$q.'%')->get();
        return view('inventory\components\products-table',compact('movements'));
    }
}
