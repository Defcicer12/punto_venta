<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

class PagoController extends Controller
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
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                    'tipo' => ['required'],
                    'monto' => ['required', 'numeric','gt:0'],
                    'id_venta' =>['required', 'exists:venta,id'] ,
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
        $monto_venta =  Venta::where('id',$data['id_venta'])->sum('precio');
        $monto_cubierto = Pago::where('id_venta',$data['id_venta'])->sum('monto');
        $monto_total = $monto_cubierto+$data['monto'];
        if($monto_venta < $monto_total)
            return ['success' => 0, 'errors' => 'El pago sobrepasa el monto de la venta'];
        $new = Pago::create([
                'fecha' => date("Y-m-d H:i:s"),
                'tipo' => $data['tipo'],
                'monto' => $data['monto'],
                'id_venta' => $data['id_venta'],
        ]);
        $monto_cubierto = Pago::where('id_venta',$data['id_venta'])->sum('monto');
        return ['new' =>$new,'data'=>['monto_cubierto' =>$monto_cubierto,'monto_venta'=>$monto_venta,'monto_por_cubrir'=>abs($monto_venta - $monto_cubierto)]];
    }

    public function addPago(Request $request)
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
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function search(Request $r)
    {
        $data= $r->all();
        $ventas = Pago::where('id_venta',$data['id_venta'])->get();
        if(count($ventas) > 0)
            return view('pages.maps',['ventas' => $ventas]);
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $r)
    {
        $data= $r->all();
        $pagos = Pago::where('id_venta',$data['id_venta'])->get();
        return view('pages.components.payments-table',compact('pagos'));
    }
}
