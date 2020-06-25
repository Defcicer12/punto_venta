<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Productos;
use App\Proveedor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Util\Json;

class ProductosController extends Controller
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
            'nombre' => ['required', 'string', 'max:45'],
            'precio' => ['required', 'numeric'],
            'descripción' => ['nullable', 'string', 'max:45'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Productos
     */
    protected function create(array $data)
    {
        return Productos::create([
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'descripcion' => $data['descripcion'],
        ]);
    }

    public function addProducto(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('products\components\create-form')
            ->withErrors($validator->errors());
        }

        $pago = $this->create($request->all());

        session()->flashInput($request->all());
        session()->flash('status','Insumo creado correctamente');

        return view('products\components\create-form');
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
    public function update(Request $request)
    {


        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            session()->flashInput($request->all());
            return view('products\components\edit-profile-form')
            ->withErrors($validator->errors());
        }

        $pago = Productos::whereId($request->get('id'))->update($request->except('_token','_method'));

        session()->flashInput($request->all());
        session()->flash('status','Insumo modificado correctamente');

        return view('products\components\edit-profile-form');
    }

    public function search(Request $request)
    {
        $q= $request->get('q');
        $productos = Productos::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($productos) > 0)
            return compact('productos');
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $request)
    {
        $q= $request->get('q');
        $productos = Productos::where('nombre','LIKE','%'.$q.'%')->get();
        return view('pages.components.select-products-table',compact('productos'));
    }
}
