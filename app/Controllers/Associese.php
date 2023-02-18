<?php

namespace App\Controllers;
use App\Models\Socios;

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
            'dataNascimento' => 'required|valid_date',
            'email' => 'required|valid_email|is_unique[socios.email]',
            'telefone' => 'required',
            'indicativo' => 'required|min_length[4]',
            'senha' => 'required|min_length[4]',
            'confirmacao' => 'required|matches[senha]',
        ],[
            'cpf' => [
                'required' => _('Digite corretamente seu CPF'),
                'is_unique' => _('CPF já cadastrado'),
            ],
            'nome' => [
                'required' => _('Digite seu nome completo'),
            ],
            'dataNascimento' => [
                'required' => _('Digite sua data de nascimento'),
                'valid_date' => _('Digite corretamente sua data de nascimento'),
            ],
            'email' => [
                'required' => _('Digite seu endereço de e-mail'),
                'valid_email' => _('Digite corretamente seu e-mail'),
                'is_unique' => _('Seu e-mail já está cadastrado'),
            ],
            'telefone' => [
                'required' => _('Digite seu telefone'),
            ],
            'indicativo' => [
                'required' => _('Digite seu indicativo'),
                'min_length' => _('Digite corretamente seu indicativo'),
            ],
            'senha' => [
                'required' => _('Digite uma senha para acesso na área de sócios'),
                'min_length' => _('A senha precisa ter no mínimo 4 caracteres'),
            ],
            'confirmacao' => [
                'required' => _('Digite novamente a senha neste campo'),
                'matches' => _('Senha e confirmação da senha devem ser iguais'),
            ],
        ]);

        if (!$validacao) {
            return redirect()->route('associe-se')->withInput()->with('errors', $this->validator->getErrors());
        }
        elseif ($this->request->getPost('concordo')==null) {
            $msg = _('Você precisa aceitar os termos para prosseguir.');
            return redirect()->route('associe-se')->withInput()->with('error',$msg);
        }
        else {
            $socios = new Socios();
            $inserted = $socios->newSocio($this->request->getPost());
            if ($inserted) {
                $msg = _('Pré-associação enviada com sucesso, aguarde a aprovação em assembléia, você será avisado por e-mail.');
                return redirect()->route('entrar')->with('success',$msg);
            }
            else {
                $msg = _('Ocorreu um erro não esperado ao inserir sua pré-associação<br>entre em contato conosco para mais informações.');
                return redirect()->route('associe-se')->withInput()->with('error',$msg);
            }
        }
    }
}
