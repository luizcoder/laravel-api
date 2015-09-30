<?php

/*
|--------------------------------------------------------------------------
| Rotas da aplicação
|--------------------------------------------------------------------------
|
| Aqui estão registradas todas as rotas da aplicação.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace' => 'Auth'], function()
{
    /**
     * Rotas para autenticação
     */
    Route::post('auth/login', 'AuthController@autenticar');   
    Route::get('auth/login', 'AuthController@getAutenticado');
    Route::get('auth/logout', 'AuthController@logout');

    
    /**
     * Rotas para cadastro e listagem de usuários
     */
    Route::get('auth/usuario', 'UsuarioController@listarUsuario');
    Route::post('auth/usuario', 'UsuarioController@criarUsuario');
    
});




