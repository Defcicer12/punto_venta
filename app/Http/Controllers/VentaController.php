<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Venta;
use App\Proveedor;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Rules\Custom_email;
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
            'fecha' => ['required', 'date_format:Y-m-d H:i:s'],
            'precio' => ['required', 'numeric'],
            'id_empleado' => ['required', 'numeric', 'exists:users,id'],
            'id_usuario' => ['required', 'numeric', 'exists:users,id'],
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
        return Venta::create([
            'nombre' => $data['nombre'],
            'precio' => $data['precio'],
            'id_proveedor' => $data['id_proveedor'],
            'existencia' => $data['existencia'],
            'cantidad_minima' => $data['telefono'],
            'cantidad_maxima' => $data['cantidad_maxima']
        ]);
    }

    public function addVenta(Request $request)
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
        $productos = Venta::where('nombre','LIKE','%'.$q.'%')->get();
        if(count($productos) > 0)
            return view('pages.maps',['productos' => $productos]);
        else return view ('pages.maps')->withMessage('No Details found. Try to search again !');
    }
}
