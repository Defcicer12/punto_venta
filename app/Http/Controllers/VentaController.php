<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Productos;
use App\Venta;
use App\Proveedor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
use App\Venta_producto;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class VentaController extends Controller
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
            'id_empleado' => ['required', 'numeric', 'exists:users,id'],
            'id_cliente' => ['required', 'numeric', 'exists:cliente,id'],
            'productos' => ['required', 'array'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Venta
     */
    protected function create(array $data)
    {
        $precio = 0;
        foreach ($data['productos'] as $producto){
            $precio += $producto['precio'] * $producto['cantidad'];
        }
        $new = Venta::create([
                'fecha' => date("Y-m-d H:i:s"),
                'precio' => $precio,
                'id_empleado' => $data['id_empleado'],
                'id_cliente' => $data['id_cliente'],
        ]);

        foreach ($data['productos'] as $producto) {
            Venta_producto::create([
                'id_venta' => $new['id'],
                'id_producto' => $producto['id'],
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                ]);
        };

        return $new;
    }

    public function addVenta(Request $request)
    {
        $validator = $this->validator($request->all());
        //return $validator->errors();
        if ($validator->fails()) {
            return ['sucess' => 0, 'errors' => $validator->errors()->first()];
        }

        $venta = $this->create($request->all());
        $venta->detalles;
        return $venta;
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
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function search(Request $r)
    {
        $q= $r->get('q');
        $ventas = Venta::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($ventas) > 0)
            return view('pages.maps',['ventas' => $ventas]);
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }
}
