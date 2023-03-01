<?php

namespace App\Controllers;

use App\Models\Socios;

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
        $data = array_merge(
                $this->data,
                (new Socios())->getUserData(false),
        );
        return view('home',$data);
      }
    }
}
