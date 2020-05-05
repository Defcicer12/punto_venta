<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Rules\Custom_email;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new Custom_email],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'departamento' => ['required', 'string', 'in:Compras,Ventas,Almacén'],
            'telefono' => ['required', 'numeric', 'digits:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'departamento' => $data['departamento'],
            'telefono' => $data['telefono'],
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());
        //return $validator->errors();
        if ($validator->fails()) {
            $data = $request->all();
            $data['success'] = 0;
            session()->flashInput($data);
            return view('users\components\modal-create')
            ->withErrors($validator->errors())
            ->withInput($request->all());
        }

        $user = $this->create($request->all());

        session()->flash('status','Usuario creado correctamente');

        return view('users\components\modal-create');
    }
}
