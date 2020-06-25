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
            'tipo' => ['required', 'string', 'in:Gerente,Técnico,Almacén'],
            'telefono' => ['required', 'numeric', 'digits:10'],
        ];
    }
    public static function reglasEditar(){
        return [
            'id' => ['required', 'numeric', 'exists:users,id'],
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users', new Custom_email],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'tipo' => ['nullable', 'string', 'in:Gerente,Técnico,Almacén'],
            'telefono' => ['nullable', 'numeric', 'digits:10'],
        ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','tipo','telefono'
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
