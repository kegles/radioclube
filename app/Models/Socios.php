<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Cookie\Cookie;


class Socios extends Model
{

    const LOGIN_SUCCESS = 0;
    const LOGIN_ERROR_MAIL_DOEST_EXISTS = 1;
    const LOGIN_ERROR_PASSWORD = 2;
	
    protected $table = 'socios';
    protected $primaryKey = 'id';
    

    protected $returnType = 'object';
    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField = '_created';
    protected $updatedField = '_updated';
    protected $deletedField = '_deleted';

    protected $allowedFields = ['ativo','aprovado','email','senha','nome','telefone','cpf','dataNascimento','indicativo'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public $tipos_licenca = ['CA','CB','CC','PX','EE','ER'];
    public $tipos_licenca_labels = [];

    /*
    * constructor
    */
    function __construct() {
        parent::__construct();
        //popula os labels com nomes traduzidos
        $this->tipos_licenca_labels = array(
            _('Classe A'),
            _('Classe B'),
            _('Classe C'),
                _('PX'),
            _('Estação especial'),
            _('Estação repetidora')
        );
    }

    /*
    * newSocio
    * @description: Adiciona um novo sócio na base de dados
    * @param: $data <array> dados do usuário
    * @return: <boolean> se incluiu ou não
    */
    public function newSocio($data) {
        //nome formatado (ucfirst)
        $data['nome'] = rcFormataNome($data['nome']);
        //senha é criptografada
        $data['senha'] = password_hash($data['senha'],PASSWORD_DEFAULT);
        //data de nascimento vai para formato do MySQL
        $data['dataNascimento'] = rcDateToDb($data['dataNascimento']);
        //indicativo vai pra tabela socios-licencas
        $indicativo = $data['indicativo'];
        $indicativo = strtoupper($indicativo);
        $indicativo = str_replace(chr(32),'',$indicativo);
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

    /*
    * login
    * @description: Faz o login do usuário no sistema
    * @param: $email <string> e-mail do usuário
    * @param: $senha <string> senha do usuário
    * @param<optional>: $lembrar <boolean> para gravar em uma sessão os dados ou não
    * @return: <int> [LOGIN_SUCCESS|LOGIN_ERROR_MAIL_DOEST_EXISTS|LOGIN_ERROR_PASSWORD]
    */    
    public function login($email,$senha,$lembrar=false) {
        $data = $this->where('email',$email)->where('_deleted',null)->first();
        if (!$data) {
            return self::LOGIN_ERROR_MAIL_DOEST_EXISTS;
        }
        else {
            $error = self::LOGIN_ERROR_PASSWORD;
            if (substr($senha,0,5)=='hash:') {
                if (substr($senha,5,strlen($senha))==$data->senha) {
                    $error = self::LOGIN_SUCCESS;
                }
            }
            else {
                if (password_verify($senha,$data->senha)) {
                    $error = self::LOGIN_SUCCESS;
                }
            }
            if ($error==0) {
                $ses_data = [
                    'id' => $data->id,
                    'nome' => $data->nome,
                    'email' => $data->email
                ];
                session()->set($ses_data);
            }
            return $error;
        }
    }


    /*
    * isAdministrador
    * @description: verifica se o usuário é administrador
    * @return: <boolean>
    */    
    public function isAdministrador() {
        $admins = [1,2,10];
        return in_array(session()->get()['id'],$admins)?true:false;
    }    

    /*
    * isLogged
    * @description: verifica se o sócio está logado
    * @return: <boolean>
    */    
    public function isLogged() {
        return (isset(session()->get()['id']) && (session()->get()['id']>0))?true:false;
    }

    /*
    * logout
    * @description: sai do sistema
    */    
    public function logout() {
        $sessdata = ['id'=>null,'nome'=>null,'email'=>null];
        return session()->set($sessdata);
    }

    /*
    * getSimpleIndicativo 
    * @description: busca o indicativo do usuário por ordem de importância
    * @return: <string> indicativo do usuário
    */
    public function getSimpleIndicativo() {
        if (!$this->isLogged()) { return false; }
        $sql = 'SELECT indicativo,tipo FROM `socios-licencas` WHERE idSocio='.session()->get()['id'];
        $indicativo = null;
        $classe = null;
        //'CA','CB','CC','PX','EE','ER'
        foreach ($this->db->query($sql)->getResultArray() as $licenca) {
            if ($licenca['tipo']=='CA') { $indicativo=$licenca['indicativo']; break; }
        }       
        if ($indicativo==null) {
            foreach ($this->db->query($sql)->getResultArray() as $licenca) {
                if ($licenca['tipo']=='CB') { $indicativo=$licenca['indicativo']; break; }
            }       
        }
        if ($indicativo==null) {
            foreach ($this->db->query($sql)->getResultArray() as $licenca) {
                if ($licenca['tipo']=='CC') { $indicativo=$licenca['indicativo']; break; }
            }       
        }
        if ($indicativo==null) {
            foreach ($this->db->query($sql)->getResultArray() as $licenca) {
                if ($licenca['tipo']=='PX') { $indicativo=$licenca['indicativo']; break; }
            }       
        }
        if ($indicativo==null) {
            foreach ($this->db->query($sql)->getResultArray() as $licenca) {
                if ($licenca['tipo']=='EE') { $indicativo=$licenca['indicativo']; break; }
            }       
        }
        if ($indicativo==null) {
            foreach ($this->db->query($sql)->getResultArray() as $licenca) {
                if ($licenca['tipo']=='ER') { $indicativo=$licenca['indicativo']; break; }
            }       
        }
        return $indicativo; 
    }

    /*
    * getUserData
    * @description: busca dos dados que são atualizáveis do usuário
    * @return array of data
    */    
    public function getUserData($onlyUpdateable=true) {
        if (!$this->isLogged()) { return false; } 
        $userId = session()->get()['id'];
        $data = (new \App\Models\Socios())->where('id',$userId)->where('_deleted',null)->first();
        $return = array(
            'telefone' => $data->telefone,
            'email' => $data->email,
        );
        if (!$onlyUpdateable) {
            $return['nome'] = $data->nome;
            $return['cpf'] = $data->cpf;
            $return['dataNascimento'] = $data->dataNascimento;
            $return['indicativo'] = $this->getSimpleIndicativo();
        }
        return $return;
    }

    /*
    * updateUserData
    * @description: grava os dados que são atualizáveis pelo usuário
    * @param: dados <array> dados do usuário (email,telefone)
    * @param: id <integer> id do usuário
    * @return: <boolean> se atualizou
    */
    public function updateUserData($data,$id=null) {
        if ($id==null) {
            if (!$this->isLogged()) { return false; }
            $id=session()->get()['id'];
        }
        $where = 'id='.$id;
        return $this->db->table('socios')->update($data,$where);
    }


    /*
    * getUserLicencas
    * @description: busca as licenças de estação (indicativos) do usuário
    * @return: <array> dados de indicativos
    */
    public function getUserLicencas() {
        if (!$this->isLogged()) { return false; }
        return $this->getLicencasFrom(session()->get()['id']);   
    }

    /*
    * getLicencasFrom
    * @description: busca as licenças de estação (indicativos) do usuário indicado
    * @param: <int> id do usuário
    * @return: <array> dados de indicativos
    */    
    public function getLicencasFrom($id) {
        $sql = 'SELECT indicativo,tipo FROM `socios-licencas` WHERE idSocio='.$id.' ORDER BY tipo ASC';
        return $this->db->query($sql)->getResultArray();        
    }

    /*
    * addEstacao
    * @description: inclui uma nova estação para o usuário
    * @return: <boolean> se teve sucesso
    */
    public function addEstacao($data) {
        if (!(new Socios())->isLogged()) { throw new \Exception('Usuário não está logado'); }
        elseif (empty($data['indicativo'])) { throw new \Exception('Falta indicativo da licença'); }
        elseif (empty($data['tipo'])) { throw new \Exception('Falta tipo da licença'); }
        else { 
            $data['idSocio'] = session()->get()['id'];
            return $this->db->table('socios-licencas')->insert($data); 
        }
    }      


    /*
    * getEstacao
    * @description: busca uma estação de um usuário
    * @param: <string> indicativo
    * @return: <array> dados da estação
    */
    public function getEstacao($indicativo) {
        if (!(new Socios())->isLogged()) { throw new \Exception('Usuário não está logado'); }
        elseif (empty($indicativo)) { throw new \Exception('Falta indicativo da licença'); }
        else { 
            $sql='SELECT 
                    idSocio, 
                    indicativo, 
                    tipo 
                FROM 
                    `socios-licencas` 
                WHERE 
                    idSocio='.session()->get()['id'].' AND indicativo="'.$indicativo.'"';
            return $this->db->query($sql)->getResultArray(); 
        }
    } 

    /*
    * remEstacao
    * @description: exclui estação para o usuário
    * @param: <string> indicativo
    * @return: <boolean> se teve sucesso
    */
    public function remEstacao($indicativo) {
        if (!(new Socios())->isLogged()) { throw new \Exception('Usuário não está logado'); }
        elseif (empty($indicativo)) { throw new \Exception('Falta indicativo da licença'); }
        else { 
            $where='idSocio='.session()->get()['id'].' AND indicativo="'.$indicativo.'"';
            return $this->db->table('socios-licencas')->delete($where); 
        }
    }     


    /*
    * getIdSocioByHashRecuperacaoSenha
    * @description: busca o id de um sócio na tabela de hashs
    * @param: <string> hash
    * @return: <integer> id do sócio
    */    
    public function getSocioByHashRecuperacaoSenha($hash) {
        $sql='SELECT 
                idSocio 
                FROM 
                    `recuperacao-senha` 
                WHERE 
                    hash="'.$hash.'"';
        $data =  $this->db->query($sql)->getResultArray(); 
        if (!$data) { return null; }
        else {
            return $data[0]['idSocio'];
        }
    }    


    /*
    * generateRecuperacaoHashToUser
    * @description: gera um hash de recuperação de senha para um usuário
    * @param: <integer> id do usuário
    * @return: <string> hash gerado
    */    
    public function generateRecuperacaoHashToUser($id) {
        $data = (new \App\Models\Socios())->where('id',$id)->first();
        if (!$data) { return null; }
        else {
            $hash = substr(md5($data->email . $data->id . time()),0,32);
            $data = array(
                'idSocio' => $id,
                'hash' => $hash
            );
            if ($this->db->table('recuperacao-senha')->insert($data)) {
                return $hash;
            }
        }
    }    


    /*
    * getByEmail
    * @description: pega um sócio por e-mail
    * @param: <string> e-mail do sócio
    * @return: <object> Model\Socio
    */    
    public function getByEmail($email) {
        $data = (new \App\Models\Socios())->where('email',$email)->where('_deleted',null)->first();
        return $data;
    }    


    /*
    * getById
    * @description: pega um sócio por id
    * @param: <string> e-mail do sócio
    * @return: <object> Model\Socio
    */    
    public function getById($id) {
        $data = (new \App\Models\Socios())->where('id',$id)->where('_deleted',null)->first();
        return $data;
    }     

    /*
    * getUserSenhaHash
    * @description: busca a senha do usuário em hash
    * @return: <string> hash
    */    
    public function getUserSenhaHash() {
        $data = (new \App\Models\Socios())->where('id',session()->get()['id'])->first();
        return $data->senha;
    }

    /*
    * updateUserPassword
    * @description: altera a senha do usuário
    * @param: <string> nova senha
    * @param: <integer> id do usuário para alterar a senha
    * @return: <boolean> se foi alterada
    */    
    public function updateUserPassword($pass,$id=null) {
        if ($id==null) { $id = session()->get()['id']; }
        //apaga hashs de recuperação
        $this->db->table('recuperacao-senha')->delete(array('idSocio'=>$id));
        //altera a senha
        $data = array('senha'=>password_hash($pass,PASSWORD_DEFAULT));
        return (new \App\Models\Socios())->update($id,$data);
    }

    /*
    * getLicencasTipos
    * @description: pega os tipos de licença
    * @return: <array> tipos de licença de estação
    */ 
    public function getLicencasTipos() {
        $tipos = [];
        foreach ($this->tipos_licenca as $ti => $tl) {
            $tipos[$tl] = $this->tipos_licenca_labels[$ti];
        }
        return $tipos;
    }


    /*
    * updateSocioLicencas
    * @description: atualiza as licenças de um sócio
    * @param: <int> id do usuario
    * @param: <array[indicativo|tipo]> licenças do usuário
    */ 
    public function updateSocioLicencas($cid,$licencas) {
        $this->db->table('socios-licencas')->delete(array('idSocio'=>$cid));
        foreach ($licencas as $licenca) {
            $data = array_merge(array('idSocio'=>$cid),$licenca);     
            $this->db->table('socios-licencas')->insert($data);    
        }
        
    }

    /*
    * getProximosAniversarios
    * @description: Busca os próximos 5 aniversários
    * @return array<nome|data> of aniversários (string)
    */
    public function getProximosAniversarios() {
        $sql='SELECT 
                    nome,
                    DATE_FORMAT(dataNascimento,"%d/%m") AS `data` 
                FROM 
                    `socios` 
                WHERE 
                    DATE_ADD(dataNascimento, 
                    INTERVAL YEAR(CURDATE())-YEAR(dataNascimento)
                            + IF(DAYOFYEAR(CURDATE()) > DAYOFYEAR(dataNascimento),1,0)
                    YEAR)  
                    BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
                ORDER BY
                    dataNascimento ASC
        ';
        $data =  $this->db->query($sql)->getResultArray(); 
        if (!$data) { return null; }
        else {
            return $data;
        }        
    }


}
