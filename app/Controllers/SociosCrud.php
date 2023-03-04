<?php

namespace App\Controllers;

use App\Models\Socios;
use \Hermawan\DataTables\DataTable;


class SociosCrud extends BaseController
{
	
    public function index()
    {
      rcStartup();
      $data = [];
      return view('admin/socios-grid',$data);
    }

    public function jsonGrid() {
      $db = db_connect();
      $builder = $db->table('socios')->select('id, cpf, nome, email, telefone');
      return DataTable::of($builder)->toJson();
    }

    public function insert() 
    {

    }

    public function insertPost() 
    {

    }

    public function update($cid) 
    {

    }

    public function updatePost($cid) 
    {
      
    }

    public function delete($cid) 
    {

    }

    public function deletePost($cid) 
    {

    }

}
