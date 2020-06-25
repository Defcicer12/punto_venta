<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flujo_efectivo extends Model
{

    protected $table = 'flujo_efectivo';
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
        'monto',
        'id_vendedor'
    ];


}
