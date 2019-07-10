<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = ['tipo', 'saldo', 'total_antes', 'total_depois', 'user_id_transaction', 'data'];
}
