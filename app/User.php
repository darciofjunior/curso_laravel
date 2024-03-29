<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Saldo;
use App\Historico;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function saldo() {
        return $this->hasOne(Saldo::class);
    }
    
    public function historicos() {
        return $this->hasMany(Historico::class);
    }
    
    public function recebedor($recebedor) {
        return $this->where('name', 'LIKE', "%$recebedor%")
                    ->orWhere('email', $recebedor)
                    ->get()
                    ->first();
    }
}
