<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index(Request $request){
        $erro = '';
        if ($request->get('erro')==1);{
            $erro = 'Usuário e ou senha nao existe';
        }


        if ($request->get('erro')==2);{
            $erro = 'Necessário realizar login para ter acesso à página.';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request) {
        //regras de validacao
        $regras = [
            'usuario'=> 'email',
            'senha' => 'required',
        ];

        //as mensagens de feedback de validacao
        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório.'

        ];
        //se nao passar pelo validate
        $request->validate($regras, $feedback);

        //recuperamos os parametros do formulario
        $email = $request->get('usuario');
        $password = $request->get('senha');

        //echo "Usuário: $email | Senha: $password";
        //echo'<br>';

        //iniciar o Model User
        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first(); 
        
        //comparacao nao precisa de =

 if (isset($usuario->name)) {
    //echo 'Usuário existe';

    session_start();
    $_SESSION['nome'] = $usuario->name;
    $_SESSION['email'] = $usuario->email;

    return redirect()->route('app.home');

    //dd($_SESSION);


 } else {
    return redirect()->route('site.login', ['erro' => 1]);
 }

        

    }

    public function sair(){
        echo 'Sair';

    }
}
