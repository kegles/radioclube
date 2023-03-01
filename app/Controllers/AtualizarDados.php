<?php

namespace App\Controllers;
use App\Models\Socios;

class AtualizarDados extends BaseController
{

    private $data = [];

    public function index($data=[])
    {
		rcStartup();
        $data = array_merge(
                $this->data,
                (new Socios())->getUserData(false),
                array('licencas'=>(new Socios())->getUserLicencas()),
        );
        return view('atualizar-dados',$data);
    }

    public function atualizarDadosBasicos() {
        $data = array(
            'email' => $this->request->getPost('email'),
            'telefone' => $this->request->getPost('telefone'),
        );
        if ((new Socios())->updateUserData($data)) {
            $this->data['toastr'][] = array('type'=>'success','text'=>_('Dados atualizados com sucesso!'));
        }
		return $this->index($this->data);
    }
  
    public function incluirEstacao() {
        if (!(new Socios())->isLogged()) { die('Usuário não está logado'); }
        if (empty($this->request->getPost('indicativo'))) { die('Falta indicativo da licença'); }
        if (empty($this->request->getPost('tipo'))) { die('Falta o tipo de licença'); }
        $data = array(
            'indicativo' => strtoupper($this->request->getPost('indicativo')??''),
            'tipo' => $this->request->getPost('tipo'),
        );
        if (count((new Socios())->getEstacao($data['indicativo']))>0) {
            $this->data['toastr'][] = array('type'=>'error','text'=>_('Estação já está cadastrada.'));
        }
        else {
            if ((new Socios())->addEstacao($data)) {
                $this->data['toastr'][] = array('type'=>'success','text'=>_('Estação incluída com sucesso!'));
            }
        }
        return $this->index($this->data);
    }  

    public function excluirEstacao() {
        if (!(new Socios())->isLogged()) { die('Usuário não está logado'); }
        if (empty($this->request->getPost('indicativo'))) { die('Falta indicativo da licença'); }
        else {
            $indicativo = $this->request->getPost('indicativo');
            if (count((new Socios())->getEstacao($indicativo))<=0) {
                $this->data['toastr'][] = array('type'=>'error','text'=>_('Estação não existe.'));
            }
            else {
                if ((new Socios())->remEstacao($indicativo)) {
                    $this->data['toastr'][] = array('type'=>'success','text'=>_('Estação excluída com sucesso!'));
                }
            }
            return $this->index($this->data);
        }
    }

}
