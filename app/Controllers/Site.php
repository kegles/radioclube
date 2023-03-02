<?php

namespace App\Controllers;


class Site extends BaseController
{
	
    private $data = [];

    public function estatuto()
    {
        return view('site/estatuto');
    }

}
