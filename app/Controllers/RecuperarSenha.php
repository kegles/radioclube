<?php

namespace App\Controllers;

use App\Models\Socios;

class RecuperarSenha extends BaseController
{
	
    private $data = [];

    public function index()
    {
        rcStartup();
        $data['email'] = $data['email']??'';
        return view('recuperar-senha',$data);
    }

    public function indexPost() {
        $validacao = $this->validate([
            'email' => 'required|valid_email',
        ],[
            'email' => [
                'required' => _('Digite seu endereço de e-mail'),
                'valid_email' => _('Digite corretamente seu e-mail'),
            ],
        ]);
        if (!$validacao) {
            return redirect()->route('recuperar-senha')->withInput()->with('errors', $this->validator->getErrors());
        }
        else {
            $socio = (new Socios())->getByEmail($this->request->getPost('email'));
            if (!$socio) {
                $errors['email'] = _('O e-mail informado não existe.');
                return redirect()->route('recuperar-senha')->withInput()->with('errors',$errors);
            }
            else {
                //gera o hash
                $hash = (new Socios())->generateRecuperacaoHashToUser($socio->id);
                if (!$hash)  { 
                    $msg = _('Ocorreu um erro não esperado ao recuperar sua senha<br>entre em contato conosco para mais informações.');
                    return redirect()->route('recuperar-senha')->withInput()->with('error',$msg);
                }
                else {
                    $link = base_url('recuperar-senha').'/hash/'.$hash;

                    $mensagem = rcEmailTemplate(sprintf(_('
                            Olá <b>%s</b>,<br><br>
                            Você ou outra pessoa enviou um pedido de recuperação de senha no sistema do <b>%s</b>.<br><br>
                            <b>Clique no link a seguir para redefinir sua senha:</b>
                            <a href="%s">%s</a>
                        '),
                        $socio->nome,
                        rcTitle(),
                        $link,
                        $link
                    ));

                    //envia o e-mail
                    $email = \Config\Services::email();
                    $email->setTo($socio->email);
                    $email->setSubject(_('Recuperação de senha'));
                    $email->setMessage($mensagem);
                    $recovered = $email->send();                     
                    if ($recovered) {
                        $msg = _('Um link para redefinição de senha foi enviado para seu e-mail.');
                        return redirect()->route('entrar')->with('success',$msg);
                    }
                    else {
                        $msg = _('Ocorreu um erro não esperado ao recuperar sua senha<br>entre em contato conosco para mais informações.');
                        return redirect()->route('entrar')->withInput()->with('error',$msg);
                    }
                }
            }
        }
    }

    public function novaSenha($hash) { //recebe o parametro do Routes.php
        $id_socio = (new Socios())->getSocioByHashRecuperacaoSenha($hash);
        if (!$id_socio) {
            $msg = _('Não foi possível validar o link de recuperação, talvez ele seja inválido ou já tenha sido usado. Refaça o processo de recuperação de senha.');
            return redirect()->route('entrar')->withInput()->with('error',$msg);
        }
        else {
            rcStartup();
            $data['email'] = (new Socios())->getById($id_socio)->email;
            $data['hash'] = $data['hash']??'';
            return view('recuperar-nova-senha',$data);
        }      
    }

    public function novaSenhaPost($hash) { //parametro vem do Routes.php
        $validacao = $this->validate([
            'email' => 'required|valid_email',
            'novaSenha' => 'required|min_length[4]',
            'confirmacao' => 'required|matches[novaSenha]',
        ],[
            'email' => [
                'required' => _('Digite seu endereço de e-mail'),
                'valid_email' => _('Digite corretamente seu e-mail'),
            ],
            'novaSenha' => [
                'required' => _('Digite uma senha para acesso na área de sócios'),
                'min_length' => _('A senha precisa ter no mínimo 4 caracteres'),
            ],
            'confirmacao' => [
                'required' => _('Digite novamente a senha neste campo'),
                'matches' => _('Senha e confirmação da senha devem ser iguais'),
            ],
        ]);
        if (!$validacao) {
            return redirect()->to(base_url('recuperar-senha/hash/'.$hash))
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        else {
            $senha = $this->request->getPost('novaSenha') ?? '';
            $socio_id = (new Socios())->getSocioByHashRecuperacaoSenha($hash);
            if ((new Socios())->updateUserPassword($senha,$socio_id)) {
                return redirect()->to(base_url('entrar'))
                ->with('success', _('Senha alterada com sucesso, agora você pode acessar o sistema.'));
            }
            else {
                return redirect()->to(base_url('recuperar-senha/hash/'.$hash))
                ->withInput()
                ->with('errors', $this->validator->getErrors());                
            }
        }
    }

}
