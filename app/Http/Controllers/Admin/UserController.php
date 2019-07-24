<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFormRequest;

class UserController extends Controller
{
    public function profile() {
        return view('admin/meu_perfil/profile');
    }
    
    public function profileatualizar(ProfileFormRequest $request) {
        $user               = auth()->user();
        $dados_formulario   = $request->all();
        
        if($dados_formulario['password'] != null) 
            $dados_formulario['password'] = bcrypt($dados_formulario['password']);
        else
            unset($dados_formulario['password']);
        
        $dados_formulario['image'] = $user->image;
        
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            if($user->image)
                $name = $user->image;
            else 
                $name       = $user->id.kebab_case($user->name);
            
            $extension  = $request->image->extension();
            $nameFile   = "{$name}.{$extension}";
            
            $dados_formulario['image'] = $nameFile;

            $upload     = $request->image->storeAs('user', $nameFile);
            
            if(!$upload)
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer o upload da imagem !');
        }
        
        $update = $user->update($dados_formulario);
            
        if($update)
            return redirect()
                ->route('admin/meu_perfil')
                ->with('success', 'Sucesso ao atualizar o perfil !');

        return redirect()
                ->back()
                ->with('error', 'Falha ao atualizar o perfil !');
    }
}