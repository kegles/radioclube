<?php

namespace App\Models;

use CodeIgniter\Model;

class Socios extends Model
{
	
    protected $table = 'socios';
    protected $primaryKey = 'id';
    

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField = '_created';
    protected $updatedField = '_updated';
    protected $deletedField = '_deleted';

    protected $allowedFields = ['email','senha','nome','telefone','cpf','dataNascimento','indicativo'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function newSocio($data) {
        //senha é criptografada
        $data['senha'] = rcPassword($data['senha']);
        //data de nascimento vai para formato do MySQL
        $data['dataNascimento'] = rcDateToDb($data['dataNascimento']);
        //indicativo vai pra tabela socios-licencas
        $indicativo = strtoupper($data['indicativo']);
        unset($data['indicativo']);
        //insere os dados
        $result=false;
        if ($this->save($data)) {
            $data = array(
                'idSocio' => $this->db->insertID(),
                'indicativo' => $indicativo,
            );
            $result = $this->db->table('socios-licencas')->insert($data);
        }
        return $result;       
    }

}
