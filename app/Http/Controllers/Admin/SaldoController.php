<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo;

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
    
    public function store(Request $request) {
        $saldo = auth()->user()->saldo()->firstOrCreate([]);
        $saldo->deposito($request->txt_valor);
    }
}
