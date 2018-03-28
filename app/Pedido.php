<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['valor_bruto', 'valor_final', 'desconto', 'taxa_mp', 'data_aprovacao', 'usuario_id', 'pdv_id', 'status'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }

    public function pedidoComplemento() {
        return $this->hasOne('App\PedidoComplemento');
    }

    public function pdv() {
        return $this->belongsTo('App\Pdv');
    }
}
