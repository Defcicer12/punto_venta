<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    public function producto()
	{
        return $this->belongsTo('App\Productos','id_producto','id');
    }

    public static $reglas_crear = [
        'id_venta' => ['required', 'numeric', 'exists:venta,id'],
        'descripcion' => ['required', 'max:30'],
    ];
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
        'id_producto',
        'cantidad',
        'precio'
    ];


}
