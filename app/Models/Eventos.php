<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Cookie\Cookie;


class Eventos extends Model
{

    protected $table = 'eventos';
    protected $primaryKey = 'id';
    

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField = '_created';
    protected $updatedField = '_updated';
    protected $deletedField = '_deleted';

    protected $allowedFields = ['ativo','data','titulo'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    /*
    * getById
    * @description: pega um evento por id
    * @param: <string> id do sócio
    * @return: <object> Model\Evento
    */    
    public function getById($id) {
        $data = $this->where('id',$id)->where('_deleted',null)->first();
        return $data;
    }     



}
