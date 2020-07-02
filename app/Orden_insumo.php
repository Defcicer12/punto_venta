<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden_insumo extends Model
{

    public function orden()
    {
        return $this->hasOne('App\Orden_servicio', 'id', 'id_orden');
    }
    public function insumo()
    {
        return $this->hasOne('App\Productos', 'id', 'id_insumo');
    }

    protected $table = 'orden_insumo';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_orden',
        'id_insumo',
        'cantidad',
        'precio',
    ];

}
