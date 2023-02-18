<?php

namespace App\Controllers;

class Home extends BaseController
{
	
    public function index()
    {
      if (!(new \App\Models\Socios())->isLogged()) {
        return redirect()->route('entrar');
      }
      else {
        return view('home');
      }
    }
}
