<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Saldo extends Model
{
    public $timestamps = false;
    
    public function deposito(float $valor) {
        DB::beginTransaction();
        
        $total_antes = $this->saldo ? $this->saldo : 0;
        $this->saldo+= number_format($valor, 2, '.', '');
        $deposito = $this->save();
        
        $historico = auth()->user()->historicos()->create([
            'tipo'          => 'E', 
            'saldo'         => number_format($valor, 2, '.', ''),
            'total_antes'   => $total_antes,
            'total_depois'  => $this->saldo,
            'data'          => date('Ymd'),
        ]);
        
        if($deposito && $historico) {
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Sucesso ao recarregar'
            ];
        }else {
            DB::rollback();
            
            return [
                'success' => false,
                'message' => 'Falha ao recarregar'
            ];
        }
    }
    
    public function saque(float $valor) {
        if($this->saldo < $valor) {
            return [
                'success' => false,
                'message' => 'Saldo Insuficiente',
            ];
        }
        
        DB::beginTransaction();
        
        $total_antes = $this->saldo ? $this->saldo : 0;
        $this->saldo-= number_format($valor, 2, '.', '');
        $saque = $this->save();
        
        $historico = auth()->user()->historicos()->create([
            'tipo'          => 'S', 
            'saldo'         => number_format($valor, 2, '.', ''),
            'total_antes'   => $total_antes,
            'total_depois'  => $this->saldo,
            'data'          => date('Ymd'),
        ]);
        
        if($saque && $historico) {
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Sucesso ao retirar'
            ];
        }else {
            DB::rollback();
            
            return [
                'success' => false,
                'message' => 'Falha ao retirar'
            ];
        }
    }
}
