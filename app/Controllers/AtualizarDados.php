<?php

namespace App\Controllers;
use App\Models\Socios;

class AtualizarDados extends BaseController
{

    public function index()
    {
		rcStartup();
        return view('atualizar-dados');
    }

}
