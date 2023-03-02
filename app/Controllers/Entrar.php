<?php

namespace App\Controllers;

use App\Models\Socios;

class Entrar extends BaseController
{
	
    public function index()
    {
		rcStartup();
        $login_data = array(
            'email' => session()->get('lembrar_email'),
            'senha' => session()->get('lembrar_senha'),
            'lembrar' => (session()->get('lembrar_email') && session()->get('lembrar_senha'))?true:false,
        );
        return view('entrar',$login_data);
    }

    public function entrarPost() {
        $validacao = $this->validate([
            'email' => 'required|valid_email',
            'senha' => 'required|min_length[4]',
        ],[
            'email' => [
                'required' => _('Digite seu endereço de e-mail'),
                'valid_email' => _('Digite corretamente seu e-mail'),
            ],
            'senha' => [
                'required' => _('Digite sua senha'),
                'min_length' => _('Sua senha tem no mínimo 4 caracteres'),
            ],
        ]);
        if (!$validacao) {
            return redirect()->route('entrar')->withInput()->with('errors', $this->validator->getErrors());
        }
        else {
            $login = (new \App\Models\Socios())->login(
                    $this->request->getPost('email'),
                    $this->request->getPost('senha')
            );
            if ($login == \App\Models\Socios::LOGIN_SUCCESS) {
                if ($this->request->getPost('lembrar')!=null) {
                    $hash_senha = (new Socios())->getUserSenhaHash();
                    session()->set('lembrar_email', $this->request->getPost('email')??'');
                    session()->set('lembrar_senha', 'hash:'.$hash_senha);
                }
                else {
                    session()->set('lembrar_email');
                    session()->set('lembrar_senha');
                }
                return redirect()->route('/');

            }
            else {
                $msg = _('Erro inesperado');
                if ($login == \App\Models\Socios::LOGIN_ERROR_MAIL_DOEST_EXISTS) {
                    $msg = _('E-mail não encontrado');
                } 
                if ($login == \App\Models\Socios::LOGIN_ERROR_PASSWORD) {
                    $msg = _('Senha incorreta');
                } 
                return redirect()->route('entrar')->withInput()->with('error', $msg);
            }
        }
    }

    public function sair() {
        (new \App\Models\Socios())->logout();
        return redirect()->route('entrar')->withCookies()->with('success',_('Você saiu do sistema, até logo!'));
    }

}
