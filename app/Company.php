<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticable;
use Illuminate\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticable as AuthenticableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Company extends Model implements AuthenticableContract, CanResetPasswordContract
{
    use Authenticable, CanResetPassword;
    
    protected $fillable = ['name', 'email', 'website', 'logo', 'password'];

    protected $hidden = ['password'];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function jobs() {
        return $this->hasMany('App\Job');
    }
}
