<?php

namespace App\Controllers;

class Home extends BaseController
{
	
	protected $helpers = array('startup');
	
    public function index()
    {
		rcStartup();
        return view('welcome_message');
    }
}
