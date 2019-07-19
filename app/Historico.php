<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Historico extends Model
{
    protected $fillable = ['tipo', 'saldo', 'total_antes', 'total_depois', 'user_id_transaction', 'data'];
    
    public function tipos($tipo = null) {
        $tipos = [
            'E' => 'Entrada',
            'S' => 'Saída',
            'T' => 'Transferência',
        ];
        
        if(!$tipo)
            return $tipos;
        
        if($this->user_id_transaction != null && $tipo == 'E')
            return 'Recebido';
        
        return $tipos[$tipo];
    }
    
    public function scopeUserAuth($sql) {
        return $sql->where('user_id', auth()->user()->id);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function user_transferidor() {
        return $this->belongsTo(User::class, 'user_id_transaction');
    }
    
    public function getDataAttribute($data) {
        return Carbon::parse($data)->format('d/m/Y');
    }
    
    public function pesquisar(Array $dados, $total_paginas) {
        return $this->where(function ($sql) use($dados) {
            if(isset($dados['id'])) 
                $sql->where('id', $dados['id']);
            
            if(isset($dados['data'])) 
                $sql->where('data', $dados['data']);
            
            if(isset($dados['tipo'])) 
                $sql->where('tipo', $dados['tipo']);
        })
        ->userAuth()
        ->with(['user'])
        ->paginate($total_paginas);
    }
}