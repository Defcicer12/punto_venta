<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    public function cliente()
	{
	return $this->belongsTo('App\Cliente','id_cliente','id');
    }
    public function detalles()
	{
	return $this->hasMany('App\Venta_producto','id_venta','id');
    }
    public function pagos()
	{
	return $this->hasMany('App\Pago','id_venta','id');
    }
    public function empleado()
	{
	return $this->belongsTo('App\User','id_empleado','id');
    }
    public static $reglas_crear = [
        'id_empleado' => ['required', 'numeric', 'exists:users,id'],
        'id_cliente' => ['required', 'numeric', 'exists:cliente,id'],
        'productos' => ['required', 'array'],
    ];
    public static $reglas_productos = [
        'id' => ['required', 'numeric', 'exists:producto,id'],
        'cantidad' => ['required', 'numeric','gt:0'],
        'precio' => ['required','numeric'],
    ];
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
