<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable =  ['produto', 'codigo_barra', 'preco', 'categoria', 'descricao'];
    protected $guarded  = ['id', 'created_at', 'updated_at'];
    protected $table    = 'produtos';
    
    /*public $rules = [
        'produto' => 'required|min:10|max:50',
        'codigo_barra' => 'required|numeric',
        'preco' => 'required',
        'categoria' => 'required',
        'descricao' => 'min:3|max:255'
    ];*/
}