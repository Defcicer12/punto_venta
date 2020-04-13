<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    protected $table = 'venta';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha',
        'precio',
        'id_empleado',
        'id_usuario',
    ];

}
