<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoAmbiente extends Model
{
    protected $fillable = ['usuario_id', 'nome', 'max_quant'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function eventos() {
        return $this->hasMany('App\Ambiente', 'grupo_ambiente_id');
    }

    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }
}
