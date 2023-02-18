<?php

namespace App\Controllers;

class Entrar extends BaseController
{
	
    public function index()
    {
		rcStartup();
        $loginData = array(
            'email' => get_cookie('email'),
            'senha' => get_cookie('senha'),
            'lembrar' => ((get_cookie('email')!=null) && (get_cookie('senha')!=null))?true:false,
        );
        return view('entrar',$loginData);
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
                    $this->request->getPost('senha'),
                    $this->request->getPost('lembrar')!=null?true:false
            );
            if ($login == \App\Models\Socios::LOGIN_SUCCESS) {
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
        return redirect()->route('entrar')->with('success',_('Você saiu do sistema, até logo!'));
    }

}
