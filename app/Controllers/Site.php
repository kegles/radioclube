<?php

namespace App\Controllers;

use App\Models\Eventos;
use App\Models\Socios;

class Site extends BaseController
{
	
    private $data = [];

    public function estatuto()
    {
        return view('site/estatuto');
    }

    public function participe()
    {
        $socio_object  = new Socios();
        $socio_data = [];
        if ($socio_object->isLogged()) {
            $socio_data = $socio_object->getUserData(false);
        }
        $this->data = array_merge(
            $this->data,
            array(
                'nome' => $socio_object->isLogged()?$socio_data['nome']:null,
                'indicativo' => $socio_object->isLogged()?$socio_object->getSimpleIndicativo():null,
                'eventos' => (new Eventos())->getAtivos()
            ),
        );
        //se já está pré-selecionado um evento
        if ($this->request->getGet('evento')>0) {
            foreach ($this->data['eventos'] as $index => $evento) {
                if ($evento['id']==$this->request->getGet('evento')) {
                    unset($this->data['eventos']);
                    $this->data['eventos'][] = $evento;
                }
            }
        }
        return view('site/participe',$this->data);
    }

    public function participePost()
    {
        $this->data = array_merge(
            $this->data,
            array(
                'nome' => $this->request->getPost('nome'),
                'indicativo' => $this->request->getPost('indicativo'),
                'evento' => $this->request->getPost('evento'),
                'idSocio' => (new Socios())->isLogged()?session()->get()['id']:0,
            ),
        );
        if ((new Eventos())->addEventoParticipante($this->data)) {
            if (!(new Socios())->isLogged()) {
                session()->setFlashdata('success',_('Presença confirmada, até logo!'));
                return $this->participe();
            }
            else {
                return redirect('/');
            }
        }
        else {
            die(_('Ocorreu um erro ao gravar sua participação no evento, tente novamente.'));
        }
    }    

    public function contato() {
      echo 'E-mail de contato: <a href="mailto:radioclubepelotas@gmail.com">radioclubepelotas@gmail.com</a>';
    }

    public function contatoPost() {
        echo 'E-mail de contato: <a href="mailto:radioclubepelotas@gmail.com">radioclubepelotas@gmail.com</a>';
    }

}
