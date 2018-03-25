<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $fillable = ['nome', 'evento_id', 'grupo_ambiente_id', 'img_topo', 'img_rodape'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function grupo_ambiente() {
        return $this->belongsTo('App\GrupoAmbiente');
    }

    public function evento() {
        return $this->belongsTo('App\Evento');
    }
}
