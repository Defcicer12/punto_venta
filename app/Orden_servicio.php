<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden_servicio extends Model
{

    public function empleado()
    {
        return $this->hasOne('App\User', 'id', 'id_empleado');
    }
    public function cliente()
    {
        return $this->hasOne('App\Cliente', 'id', 'id_cliente');
    }
    public function insumos()
    {
        return $this->hasMany('App\Orden_insumo', 'id_orden', 'id');
    }

    protected $table = 'orden_servicio';
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
        'id_cliente',
        'equipo',
        'falla',
        'id_empleado',
        'diagnostico',
        'obervaciones',
        'costo_servicio',
        'fecha_entrega',
        'status',
    ];

}
