<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário e/ou senha não existe';
        }

        if ($request->get('erro') == 2) {
            $erro = 'Necessário realizar login para ter acesso à página.';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        $regras = [
            'usuario' => 'required|email',
            'senha' => 'required',
        ];

        $feedback = [
            'usuario.required' => 'O campo usuário (e-mail) é obrigatório',
            'usuario.email' => 'O e-mail informado não é válido',
            'senha.required' => 'O campo senha é obrigatório.',
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        $usuario = User::where('email', $email)->first();

        if ($usuario && Hash::check($password, $usuario->password)) {
            Auth::login($usuario);
            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair()
    {
        Auth::logout();
        return redirect()->route('site.index');
    }
}
