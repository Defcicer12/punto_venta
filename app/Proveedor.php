<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{

    protected $table = 'proveedor';
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
        'telefono',
        'correo',
    ];

    public function proveedor()
	{
		return $this->belongsTo('App\Proveedor','id','id');
	}
}
