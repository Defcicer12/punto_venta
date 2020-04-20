<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    // public function cliente()
	// {
	// return $this->belongsTo('App\Cliente','id_usuario','id');
    // }
    public function detalles()
	{
	return $this->hasMany('App\Venta_producto','id_venta','id');
    }
    public function empleado()
	{
	return $this->belongsTo('App\Users','id_empleado','id');
    }

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
        'id_cliente',
        'estado'
    ];

}
