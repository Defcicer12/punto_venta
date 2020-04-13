<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{

    protected $table = 'producto';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'precio',
        'id_proveedor',
        'existencia',
        'cantidad_minima',
        'cantidad_maxima',
    ];

}
