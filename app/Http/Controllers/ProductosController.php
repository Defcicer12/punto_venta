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
            'nombre' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric'],
            'id_proveedor' => ['required', 'numeric', 'exists:proveedor,id'],
            'existencia' => ['required', 'numeric', 'lt:cantidad_maxima'],
            'cantidad_minima' => ['required', 'numeric', 'lt:cantidad_maxima'],
            'cantidad_maxima' => ['required', 'numeric','gt:cantidad_minima'],
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
            'id_proveedor' => $data['id_proveedor'],
            'existencia' => $data['existencia'],
            'cantidad_minima' => $data['telefono'],
            'cantidad_maxima' => $data['cantidad_maxima']
        ]);
    }

    public function addProducto(Request $request)
    {
        $validator = $this->validator($request->all());
        //return $validator->errors();
        if ($validator->fails()) {
            return redirect()->to('/create_productos')
            ->withErrors($validator->errors())
            ->withInput($request->all());
        }

        $user = $this->create($request->all());

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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
        $productos = Productos::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($productos) > 0)
            return compact('productos');
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }

    public function searchWithoutReload(Request $r)
    {
        $q= $r->get('q');
        $productos = Productos::where('nombre','LIKE','%'.$q.'%')->get();
        return view('pages.components.select-products-table',compact('productos'));
    }
}
