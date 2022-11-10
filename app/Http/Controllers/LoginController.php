<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class LoginController extends Controller
{

    public function index(Request $request) {

        $error = $request->get('erro');

        if ($error == 1) {
            $error = 'Usuário e/ou senha não existe';

        } else if ($error == 2) {
            $error = 'Necessário realizar login para ter acesso!';

        } else {
            $error = '';

        }

        return view('site.login', ['titulo' => 'Login', 'error' => $error]);

    }

    public function autenticar(Request $request) {
        $rules = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        $feedback = [
            'usuario.email' => 'O campo usuário (e-mail) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório'
        ];

        $request->validate($rules, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');

        $user = new User();
        $userFromDb = $user->where('email', $email)
            ->where('password', $password)
            ->get()
            ->first();

        if (isset($userFromDb->name)) {
            session_start();
            $_SESSION['nome']  = $userFromDb->name;
            $_SESSION['email'] = $userFromDb->email;
            return redirect()->route('app.clientes');

        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }

    }

}
