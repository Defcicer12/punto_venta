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
    public function movimiento()
	{
    if($this->tipo =='Venta')
        return $this->belongsTo('App\Venta','id_movimiento','id');
    if($this->tipo =='Devolucion')
        return $this->belongsTo('App\Devolucion','id_movimiento','id');
    else
        return $this->belongsTo('App\Productos','id_movimiento','id');
    }
    protected $fillable = [
        'fecha',
        'tipo',
        'cantidad',
        'id_movimiento',
        'salida'
    ];


}
