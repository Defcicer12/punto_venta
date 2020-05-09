<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{

    protected $table = 'devolucion';
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
        'id_venta',
        'descripcion',
    ];


}
