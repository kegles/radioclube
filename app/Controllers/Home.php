<?php

namespace App\Controllers;

use App\Models\Socios;
use App\Models\Eventos;

class Home extends BaseController
{
	
    private $data = [];

    public function index()
    {
      if (!(new \App\Models\Socios())->isLogged()) {
        return redirect()->route('entrar');
      }
      else {
        rcStartup();
        $this->data = array_merge(
                $this->data,
                (new Socios())->getUserData(false),
                array('eventos'=>(new Eventos())->getAtivos())
        );
        foreach ($this->data['eventos'] as $index => $evento) {
          $this->data['eventos'][$index]['_PARTICIPANTES'] = (new Eventos())->getParticipantesEvento($evento['id']);
        }
        return view('home',$this->data);
      }
    }
}
