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
    * @param: <string> id do evento
    * @return: <object> Model\Evento
    */    
    public function getById($id) {
        $data = $this->where('id',$id)->where('_deleted',null)->first();
        return $data;
    }     

    /*
    * getAtivos
    * @description: pega eventos aativos
    * @param: <string> id do evento
    * @return: <array of object> Model\Evento
    */    
    public function getAtivos() {
        $data = $this->where('ativo','Y')->where('_deleted',null)->get()->getResultArray();
        return $data;
    }     

    /*
    * getParticipantesEvento
    * @description: pega os participantes do evento
    * @param: <integer> id do evento
    * @return: <array> de participantes
    */    
    public function getParticipantesEvento($id) {
        $data = $this->db->
            table('eventos-participantes')->
            select('`eventos-participantes`.id, `eventos-participantes`.idSocio, `eventos-participantes`.nome, `eventos-participantes`.indicativo')->
            where('idEvento',$id)->get()->getResultArray();
        return $data;
    }     


    /*
    * addEventoParticipante
    * @description: adiciona um participante do evento
    * @param: <array> dados da participacao [evento|nome|indicativo(opcional)|idSocio(opcional)]
    * @return: <boolean> se adicionou
    */    
    public function addEventoParticipante($data) {
        $data_to = array(
            'idEvento' => $data['evento'],
            'nome' => $data['nome'],
            'indicativo' => isset($data['indicativo'])?$data['indicativo']:'',
            'idSocio' => isset($data['idSocio'])?$data['idSocio']:0,
        );
        $this->db->table('eventos-participantes')->
        delete('
            idSocio='.$data_to['idSocio'].' 
            AND 
            idEvento='.$data_to['idEvento'].' 
            AND
            indicativo="'.$data_to['indicativo'].'"
            AND
            idSocio="'.$data_to['idSocio'].'"
            AND
            nome="'.$data_to['nome'].'"
        ');
        $confirm = $this->db->
            table('eventos-participantes')->
            replace($data_to);
        return $confirm;
    }     


    /*
    * getGridJson
    * @description: gera uma grid para participantes
    * @param: <integer> id do evento
    * @result: <array of object>
    */
    public function getGridJson() {
        $builder = $this->db->
        table('eventos')->
        select('
                id, 
                titulo, 
                date_format(data,"%d/%m/%Y"), 
                IF(ativo=TRUE,"'._('Sim').'","'._('Não').'"),
                (SELECT COUNT(*) FROM `eventos-participantes` WHERE `eventos-participantes`.idEvento=eventos.id) AS _PARTICIPANTES
        ')->
        where('_deleted',null);
        return $builder;
    }



}
