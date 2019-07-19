<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

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
    
    public function transferir(float $valor, User $user) {
        if($this->saldo < $valor) {
            return [
                'success' => false,
                'message' => 'Saldo Insuficiente',
            ];
        }
        
        DB::beginTransaction();
        
        /**********************************************************************/
        /***********************Atualiza o próprio Saldo***********************/
        /**********************************************************************/
        
        $total_antes = $this->saldo ? $this->saldo : 0;
        $this->saldo-= number_format($valor, 2, '.', '');
        $transferir = $this->save();
        
        $historico = auth()->user()->historicos()->create([
            'tipo'                  => 'T', 
            'saldo'                 => number_format($valor, 2, '.', ''),
            'total_antes'           => $total_antes,
            'total_depois'          => $this->saldo,
            'user_id_transaction'   => $user->id,
            'data'                  => date('Ymd'),
        ]);
        
        /**********************************************************************/
        /********************Atualiza o Saldo do Recebedor*********************/
        /**********************************************************************/
        
        $user_saldo = $user->saldo()->firstOrCreate([]);
        $total_antes_user = $user_saldo->saldo ? $user_saldo->saldo : 0;
        $user_saldo->saldo+= number_format($valor, 2, '.', '');
        $transferir_user = $user_saldo->save();
        
        $historico_user = $user->historicos()->create([
            'tipo'                  => 'E',
            'saldo'                 => number_format($valor, 2, '.', ''),
            'total_antes'           => $total_antes_user,
            'total_depois'          => $user_saldo->saldo,
            'user_id_transaction'   => auth()->user()->id,
            'data'                  => date('Ymd'),
        ]);
        
        if($transferir && $historico && $transferir_user && $historico_user) {
            DB::commit();
            
            return [
                'success' => true,
                'message' => 'Sucesso ao transferir'
            ];
        }

        DB::rollback();

        return [
            'success' => false,
            'message' => 'Falha ao retirar'
        ];
    }
}
