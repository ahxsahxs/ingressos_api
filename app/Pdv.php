<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdv extends Model
{
    protected $table = 'pdv';
    protected $fillable = ['data_entrega', 'serial', 'marca', 'modelo', 'taxa', 'tipo_pdv', 'usuario_id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }

    public function pedidos() {
        return $this->hasMany('App\Pedido', 'pdv_id');
    }
}
