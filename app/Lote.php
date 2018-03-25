<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $fillable = ['nome', 'quantidade', 'ordem', 'status', 'valor', 'ambiente_id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function ambiente() {
        return $this->belongsTo('App\Ambiente');
    }

    public function ingressos() {
        return $this->hasMany('App\Ingresso');
    }
}
