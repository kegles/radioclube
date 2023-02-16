<?php

namespace App\Controllers;

class Associese extends BaseController
{
	
    public function index()
    {
		rcStartup();
        return view('associese');
    }

    public function associarPost() {

        $validacao = $this->validate([
            'cpf' => 'required|is_unique[socios.cpf]',
            'nome' => 'required',
            'email' => 'required|valid_email|is_unique[socios.email]',
            'celular' => 'required',
            'indicativo' => 'required|min_length[4]',
            'senha' => 'required|min_length[4]'
        ],[
            'cpf' => [
                'required' => 'Digite corretamente seu CPF',
                'is_unique' => 'CPF já cadastrado',
            ],
            'nome' => [
                'required' => 'Digite seu nome completo',
            ],
            'email' => [
                'required' => 'Digite seu endereço de e-mail',
                'valid_email' => 'Digite corretamente seu e-mail',
                'is_unique' => 'Seu e-mail já está cadastrado',
            ],
            'celular' => [
                'required' => 'Digite seu celular ou de algum contato',
            ],
            'indicativo' => [
                'required' => 'Digite seu indicativo',
                'min_length' => 'Digite corretamente seu indicativo',
            ],
            'senha' => [
                'required' => 'Digite uma senha para acesso na área de sócios',
                'min_length' => 'A senha precisa ter no mínimo 4 caracteres'
            ],
        ]);

        if (!$validacao) {
            return redirect()->route('associe-se')->with('errors', $this->validator->getErrors());
        }
        else {

        }
        var_dump($this->validator->getErrors());
        die();

        $data = array(
            'cpf' => '',
            'nome' => '',
            'telefone' => '',
            'email' => '',
            'senha' => '',
        );
        $dataIndicativo = array(
            'idSocio' => '',
            'indicativo' => '',
        );
        return json_encode(array('erro'=>true));
    }

}
