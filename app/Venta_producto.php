<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta_producto extends Model
{

    public function venta()
	{
	return $this->belongsTo('App\Venta','id_venta','id');
    }
    public function producto()
	{
	return $this->belongsTo('App\Producto','id_producto','id');
    }

    protected $table = 'venta_producto';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio',
    ];

}
