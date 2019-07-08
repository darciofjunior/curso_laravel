<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Produto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoFormRequest;

class ProdutoController extends Controller
{
    public function index() {
        $produtos   = Produto::paginate(3);
        //$produtos   = Produto::all();
        $title      = 'Listagem de Produtos';

        return view('admin/produtos/index', compact('produtos', 'title'));
    }
    
    public function create() {
        $title      = 'Cadastrar Produtos';
        $categorias = ['Eletrônicos', 'Móveis', 'Limpeza', 'Banho'];
        
        return view('admin/produtos/create-edit', compact('title', 'categorias'));
    }
    
    public function store(ProdutoFormRequest $request) {
        $produto            = new Produto;
        $dataForm           = $request->all();
        
        $dataForm['preco']  = str_replace('.', '', $dataForm['preco']);
        $dataForm['preco']  = str_replace(',', '.', $dataForm['preco']);
        
        /***************Procedimento feito através de Model***************/
        /*$messages           = [
            'produto.required' => 'O campo Produto deve ser preenchido.',
        ];
        
        //$this->validate($request, $produto->rules);//Uma maneira de validar ...
        
        $validate           = validator($dataForm, $produto->rules, $messages);
        if($validate->fails()) {
            return redirect()
                ->route('create')
                ->withErrors($validate)
                ->withInput();
        }*/
        /*****************************************************************/
        
        $insert             = $produto->create($dataForm);
 
        if($insert) //Ok ...
            return redirect()->route('admin/produtos/index')->with('message', 'Produto inserido com sucesso !');
        else //Ruim ...
            return redirect()->back()->with('error', 'Produto não foi inserido !');
    }
    
    public function edit($id) {
        $produto    = Produto::findOrFail($id);
        $title      = 'Alterar Produtos';
        $categorias = ['Eletrônicos', 'Móveis', 'Limpeza', 'Banho'];
        
        return view('admin/produtos/create-edit', compact('produto', 'title', 'categorias'));
    }
      
    public function update(ProdutoFormRequest $request, $id) {
        $dataForm   = $request->all();
        
        $dataForm['preco']  = str_replace('.', '', $dataForm['preco']);
        $dataForm['preco']  = str_replace(',', '.', $dataForm['preco']);
        
        $produto    = Produto::findOrFail($id);
        $update     = $produto->update($dataForm);
        
        if($update) {//Ok ...
            return redirect()->route('admin/produtos/index')->with('message', 'Produto alterado com sucesso !');
        }else {//Ruim ...
            return redirect()->route('admin/produtos/create-edit')->with('errors', 'Falha ao Editar !');
        }
    }
    
    public function show($id) {
        $produto    = Produto::findOrFail($id);
        $title      = 'Produto: ';
        
        return view('admin/produtos/show', compact('produto', 'title'));
    }
    
    public function destroy($id) {
        $produto    = Produto::findOrFail($id);
        $delete     = $produto->delete();
        
        if($delete) //Ok ...
            return redirect()->route('admin/produtos/index')->with('message', 'Produto excluído com Sucesso !');
        else //Ruim ...
            return redirect()->route('admin/produtos/show')->with('errors', 'Falha ao Deletar !');
    }
}