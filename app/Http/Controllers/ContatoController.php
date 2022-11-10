<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request) {

        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);

    }

    public function salvar(Request $request) {

        $rules = [
            'nome' => 'required|min:3|max:40',
            'telefone' => 'required',
            'email' => 'email|unique:site_contatos',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:250',

        ];

        $feedback = [
            'nome.min' => 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no máximo 3 caracteres',
            'email.email'  => 'O campo email deve ser uma email válido.',
            'email.unique'  => 'Este email já está sendo utilizado.',
            'required' =>  'O campo :attribute deve ser preenchido.'
        ];

        $request->validate($rules, $feedback);

        SiteContato::create($request->all());

        return redirect()->route('site.index');

    }

}
