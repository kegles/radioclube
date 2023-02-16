<?php

namespace App\Controllers;

class Entrar extends BaseController
{
	
    public function index()
    {
		rcStartup();
        return view('entrar');
    }
}
