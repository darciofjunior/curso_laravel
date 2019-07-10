<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo;
use App\Http\Requests\SaldoFormRequest;

class SaldoController extends Controller
{
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
        
        return '#sacar';
    }
}