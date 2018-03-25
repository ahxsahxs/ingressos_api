<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoComplemento extends Model
{
    protected $table = 'pedido_complemento';
    protected $fillable = ['pedido_id', 'forma_pagamento', 'cartao_numero', 'cartao_vencimento', 'parcelas'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function pedido() {
        return $this->belongsTo('App\Pedido');
    }
}
