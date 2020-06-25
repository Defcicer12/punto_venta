<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{

    protected $table = 'insumo';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
    ];

}
