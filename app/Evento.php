<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $fillable = ['nome', 'cidade', 'estado', 'pais', 'usuario_responsavel_id', 'usuario_inclusao_id', 'passaporte', 'destaque', 'ativo', 'img_topo', 'img_anuncio', 'img_rodape', 'descricao', 'exibir_valor', 'data', 'coordenadas'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    function usuario_responsavel() {
        return $this->belongsTo('App\Usuario');
    }

    function usuario_inclusao() {
        return $this->belongsTo('App\Usuario');
    }

    public function ambientes() {
        return $this->hasMany('App\Ambiente', 'evento_id');
    }
}
