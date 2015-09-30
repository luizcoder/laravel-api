<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{

    /**
     * Validação de usuário
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Inserindo usuário na base de dados
     *
     * @param  array  $data
     * @return User
     */
    protected function criarUsuario(Request $request)
    {
        $data = $request->all();
        
        if($this->validator($data)->fails()){
            return ['created' => false , 'msg' => 'Erro na validação'];
        }
        
        $usuario = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
        if(! $usuario){
            return ['created' => false , 'msg' => 'Erro ao salvar o usuário'];
        }
        
        return ['created' => true ];
    }
    
    /**
     * Listando usuários
     *
     * @return array
     */
    protected function listarUsuario()
    {
        return User::all();
    }
    

   
}
