<?php

namespace App\Http\Controllers;

use App\Devolucion;
use App\Devolucion_producto;
use App\Http\Controllers\Controller;
use App\Movimiento_inventario;
use App\Pago;
use App\Productos;
use App\Venta;
use App\Proveedor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
use App\Venta_producto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DevolucionController extends Controller
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

    public function visual()
    {
        return view('create.productos',['proveedores' => Proveedor::all()]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @param  array  $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Venta
     */
    protected function create(array $data)
    {
        $concepto = Venta_producto::where('id_venta',$data['id_venta'])->where('id_producto',$data['id_producto'])->first();
        if($concepto['cantidad'] < $data['cantidad'] || $concepto['cantidad'] == 0)
            return ['success' => 0, 'errors' => 'La cantidad de producto ingresada es mayor a la cantidad en la venta'];

        $concepto->where('id_venta',$data['id_venta'])->where('id_producto',$data['id_producto'])->update(['cantidad'=>$concepto['cantidad']-$data['cantidad']]);

        $new = Devolucion::create([
                'fecha' => date("Y-m-d H:i:s"),
                'id_venta' => $data['id_venta'],
                'descripcion' => $data['descripcion'],
                'id_producto' => $data['id_producto'],
                'cantidad' => $data['cantidad'],
                'precio' => $data['precio'],
        ]);
        Movimiento_inventario::create([
            'fecha' => date("Y-m-d H:i:s"),
            'tipo' => 'Devolucion',
            'cantidad' => $data['cantidad'],
            'id_movimiento'=> $new['id'],
            'salida' => 0
        ]);
        $devoluciones = Devolucion::where('id_venta',$data['id_venta'])->get();
        return $devoluciones;
    }

    public function addDevolucion(Request $request)
    {
        $validator = $this->validator($request->all(),Devolucion::$reglas_crear);
        //return $validator->errors();
        if ($validator->fails()) {
            return ['success' => 0, 'errors' => $validator->errors()->first()];
        }

        $venta = $this->create($request->all());
        if(isset($venta['success']))
            return ['success' => 0, 'errors' => 'La cantidad de producto ingresada es mayor a la cantidad en la venta'];
        else
            return view('refunds.components.edit-profile-form',['devoluciones' => $venta]);
    }

    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        Venta::whereId($request->get('id_venta'))->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public static function pagar(int $id_venta)
    {
        $model  = Venta::where('id',$id_venta)
        ->update(['estado' => 'Pagada']);
        return ['success' => 1, 'data' => $model,'errors'=>'none'];
    }

    public function cerrar(Request $request)
    {
        $id_venta = $request->get('id_venta');

        $model  = Venta::where('id',$id_venta)
        ->first();
        if($model->estado != 'Pagada')
            return ['success' => 0, 'data' => $model,'errors'=>'Venta no pagada'];
        else
        {
            $model->update(['estado' => 'Cerrada']);
            $model->save();
            return ['success' => 1, 'data' => $model,'errors'=>'Venta cerrada con éxito!'];
        }
    }

    public function search(Request $request)
    {
        $q= $request->get('q');
        $ventas = Venta::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($ventas) > 0)
            return view('pages.maps',['ventas' => $ventas]);
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }

    public static function estaPagada(int $id_venta)
    {
        $monto_cubierto = Pago::where('id_venta',$id_venta)->sum('monto');
        $monto_venta = Venta::whereId($id_venta)->sum('precio');

        if($monto_cubierto != $monto_venta)
            return false;
        else
            return true;
    }
}
