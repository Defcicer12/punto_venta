<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Devolucion_producto extends Model
{

    protected $table = 'devolucion_producto';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_devolucion',
        'id_producto',
        'precio',
        'cantidad',
    ];


}
