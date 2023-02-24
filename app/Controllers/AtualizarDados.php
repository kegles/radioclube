<?php

namespace App\Controllers;
use App\Models\Socios;

class AtualizarDados extends BaseController
{

    public function index($data=[])
    {
		rcStartup();
        $data = array_merge($data,(new Socios())->getUserData(false));
        return view('atualizar-dados',$data);
    }

    public function atualizarPost() {
        $data = array(
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
        );
        if ((new Socios())->updateUserData($data)) {
            $data['toastr'][] = array('type'=>'success','text'=>_('Dados atualizados com sucesso!'));
        }
		return $this->index($data);
    }

}
