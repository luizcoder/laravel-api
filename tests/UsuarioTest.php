<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsuarioTest extends TestCase
{
    
    use WithoutMiddleware,DatabaseTransactions;
    
    /**
     * Usuário para testes
     */
    protected $usuario =  ['name' => 'Usuário', 'email' => 'usuario@exemplo.com', 'password' =>'123456','password_confirmation' => '123456'];
    
    /**
     * Testando cadastro de usuários
     *
     * @return void
     */
    public function testCadastro()
    {
        $this->post('/auth/usuario', $this->usuario)
        ->seeJson(['created' => true]);
    }
    
    /**
     * testando listagem de usuários
     *  @return void
     */
    public function testListagem()
    {
        $this->post('/auth/usuario', $this->usuario);
        $this->get('/auth/usuario')->seeJson(['name'=>'Usuário']);
    }
    
    /**
     * Testando a autenticação
     *
     * @return void
     */
    public function testAutenticacao()
    {
        $this->post('/auth/usuario', $this->usuario);
        $this->post('/auth/login',['email' => 'usuario@exemplo.com', 'password' =>'123456'])->seeJson(['login'=>true]);
    }
    
    /**
     * Testando retorno do usuário autenticado
     *
     * @return void
     */
    public function testAutenticado()
    {
        $this->post('/auth/usuario', $this->usuario);
        $this->post('/auth/login',$this->usuario)->seeJson(['login'=>true]);
        $this->get('/auth/login')->seeJson(['name' => 'Usuário']);
    }    
    
    /**
     * Testando erro na autenticação
     *
     * @return void
     */
    public function testErroAutenticacao()
    {
        $this->post('/auth/usuario', $this->usuario);
        $this->post('/auth/login',['email' => 'usuario@exemplo.com', 'password' =>''])->seeJson(['login'=>false]);
    }
    
    /**
     * Testando o logout
     *
     * @return void
     */
    public function testLogout()
    {
        $this->post('/auth/usuario', $this->usuario);        
        $this->usuario['password'] = "incorreto";
        $this->post('/auth/login', $this->usuario)->seeJson(['login'=>false]);
        $this->get('/auth/logout')->seeJson(['logout' => true]);
    }    

}
