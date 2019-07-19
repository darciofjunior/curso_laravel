<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SaldoFormRequest;
use App\Historico;
use App\Saldo;
use App\User;

class SaldoController extends Controller
{
    private $total_paginas = 5;
    
    public function index() {
        $array  = auth()->user()->saldo;
        $saldo  = $array ? $array->saldo : 0;
        
        return view('admin/financeiro/saldo/index', compact('saldo'));
    }
    
    public function deposito() {
        return view('admin/financeiro/saldo/deposito');
    }
    
    public function depositostore(SaldoFormRequest $request) {
        $saldo      = auth()->user()->saldo()->firstOrCreate([]);
        $resposta   = $saldo->deposito($request->txt_valor);
        
        if($resposta['success'])
            return redirect()
                ->route('admin/financeiro/saldo/index')
                ->with('success', $resposta['message']);
        
        return redirect()
            ->back()
            ->with('error', $resposta['message']);
    }
    
    public function sacar() {
        return view('admin/financeiro/saldo/sacar');
    }
    
    public function sacarstore(SaldoFormRequest $request) {
        $saldo      = auth()->user()->saldo()->firstOrCreate([]);
        $resposta   = $saldo->saque($request->txt_valor);
        
        if($resposta['success'])
            return redirect()
                ->route('admin/financeiro/saldo/index')
                ->with('success', $resposta['message']);
        
        return redirect()
            ->back()
            ->with('error', $resposta['message']);
    }
    
    public function transferir() {
        return view('admin/financeiro/saldo/transferir');
    }
    
    public function confirmartransferencia(Request $request, User $user) {
        if(!$tabela_user = $user->recebedor($request->txt_recebedor))
            return redirect()
                ->back()
                ->with('error', 'Recebedor informado não foi encontrado !');
        
        if($tabela_user->id === auth()->user()->id)
            return redirect()
                ->back()
                ->with('error', 'Não é possível transferir para você mesmo !');
        
        $array  = auth()->user()->saldo;
        $saldo  = $array ? $array->saldo : 0;
            
        return view('admin/financeiro/saldo/confirmartransferencia', compact('tabela_user', 'saldo'));
    }
    
    public function transferirstore(SaldoFormRequest $request, User $user) {
        if(!$user = $user->find($request->user_id))
            return redirect()
                ->route('admin/financeiro/saldo/transferir')
                ->with('error', 'Recebedor não encontrado !');
        
        $saldo      = auth()->user()->saldo()->firstOrCreate([]);
        $resposta   = $saldo->transferir($request->txt_valor, $user);
        
        if($resposta['success'])
            return redirect()
                ->route('admin/financeiro/saldo/index')
                ->with('success', $resposta['message']);
        
        return redirect()
            ->route('admin/financeiro/saldo/transferir')
            ->with('error', $resposta['message']);
    }
    
    public function historico(Historico $historico) {
        $historicos = auth()->user()->historicos()->with(['user'])->paginate($this->total_paginas);
        $tipos      = $historico->tipos();
        
        return view('admin/financeiro/historico/index', compact('historicos', 'tipos'));
    }
    
    public function historicopesquisar(Request $request, Historico $historico) {
        $dados_formulario   = $request->except('_token');
        $historicos         = $historico->pesquisar($dados_formulario, $this->total_paginas);
        $tipos              = $historico->tipos();
        
        return view('admin/financeiro/historico/index', compact('historicos', 'tipos', 'dados_formulario'));
    }
}