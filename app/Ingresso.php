<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingresso extends Model
{
    protected $fillable = ['sexo', 'pedido_id', 'lote_id', 'codigo_leitura', 'leitor_id', 'status', 'valor', 'data_leitura'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function leitor() {
        return $this->belongsTo('App\Usuario', 'leitor_id');
    }

    public function lote() {
        return $this->belongsTo('App\Lote');
    }
}