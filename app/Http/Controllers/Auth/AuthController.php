<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    protected function getAutenticado(){
        return Auth::user();
    }
    
    /**
     * Autenticando usuário
     *
     * @return boolean
     */
    protected function autenticar(Request $request){
        
        $data = $request->all();
        if(Auth::attempt($data)){
            return ['login' => true];
        }else{
            return ['login' => false];
        }
    }
    
    /**
     *  Realizando logout
     *
     *  @return boolean
     */
    protected function logout(){
        if(Auth::Logout()){
            return ['logout' => true];
        }else{
            return ['logout' => true];
        }
    }    
}
