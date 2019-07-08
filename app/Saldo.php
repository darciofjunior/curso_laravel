<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    public $timestamps = false;
    
    public function deposito($valor) {
        dd($valor);
    }
}
