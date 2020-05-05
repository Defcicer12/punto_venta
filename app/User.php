<?php

namespace App;

use App\Rules\Custom_email;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public static function reglasCrear()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new Custom_email],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'departamento' => ['required', 'string', 'in:Compras,Ventas,Almacen'],
            'telefono' => ['required', 'numeric', 'digits:10'],
        ];
    }
    public static function reglasEditar(){
        return [
            'id' => ['required', 'numeric', 'exists:users,id'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users', new Custom_email],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'departamento' => ['nullable', 'string', 'in:Compras,Ventas,Almacen'],
            'telefono' => ['nullable', 'numeric', 'digits:10'],
        ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','departamento','telefono'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
