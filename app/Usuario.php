<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $fillable = ['nome', 'email', 'cpf', 'senha'];

    protected $hidden = ['senha'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function eventos_inclusao() {
        return $this->hasMany('App\Evento', 'usuario_inclusao_id');
    }

    public function eventos_responsavel() {
        return $this->hasMany('App\Evento', 'usuario_responsavel_id');
    }
}
