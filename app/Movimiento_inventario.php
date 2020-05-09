<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento_inventario extends Model
{

    protected $table = 'movimiento_inventario';
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
        'tipo',
        'cantidad',
    ];


}
