<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{

    protected $table = 'pago';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo',
        'monto',
        'id_venta',
        'fecha'
    ];

}
