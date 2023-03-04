<?php

namespace App\Controllers;


class Site extends BaseController
{
	
    private $data = [];

    public function estatuto()
    {
        return view('site/estatuto');
    }


    public function contato() {
      echo 'E-mail de contato: <a href="mailto:radioclubepelotas@gmail.com">radioclubepelotas@gmail.com</a>';
    }

    public function contatoPost() {
        echo 'E-mail de contato: <a href="mailto:radioclubepelotas@gmail.com">radioclubepelotas@gmail.com</a>';
    }

}
