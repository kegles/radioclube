<?php

namespace App\Models;

use CodeIgniter\Model;

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

    protected $allowedFields = ['email','senha','nome','telefone','cpf','dataNascimento','indicativo'];

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    /*
    * newSocio
    * @description: Adiciona um novo sócio na base de dados
    * @param: $data <array> dados do usuário
    * @return: <boolean> se incluiu ou não
    */
    public function newSocio($data) {
        //senha é criptografada
        $data['senha'] = password_hash($data['senha'],PASSWORD_DEFAULT);
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

    /*
    * login
    * @description: Faz o login do usuário no sistema
    * @param: $email <string> e-mail do usuário
    * @param: $senha <string> senha do usuário
    * @param<optional>: $lembrar <boolean> para gravar em uma sessão os dados ou não
    * @return: <int> [LOGIN_SUCCESS|LOGIN_ERROR_MAIL_DOEST_EXISTS|LOGIN_ERROR_PASSWORD]
    */    
    public function login($email,$senha,$lembrar=false) {
        $data = (new \App\Models\Socios())->where('email',$email)->first();
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
                if ($lembrar) {
                    set_cookie('email', $email, time()+(10*365*24*60*60));
                    set_cookie('senha','hash:'.$data->senha, time()+(10*365*24*60*60));
                }
                else {
                    delete_cookie('email');
                    delete_cookie('senha');
                }
            }
            return $error;
        }
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
    * getUserData
    * @description: busca dos dados que são atualizáveis do usuário
    * @return array of data
    */    
    public function getUserData($onlyUpdateable=true) {
        if (!$this->isLogged()) { return false; } 
        $userId = session()->get()['id'];
        $data = (new \App\Models\Socios())->where('id',$userId)->first();
        $return = array(
            'telefone' => $data->telefone,
            'email' => $data->email,
        );
        if (!$onlyUpdateable) {
            $return['nome'] = $data->nome;
            $return['cpf'] = $data->cpf;
            $return['dataNascimento'] = $data->dataNascimento;
        }
        return $return;
    }

    /*
    * updateUserData
    * @description: grava os dados que são atualizáveis pelo usuário
    * @param: dados <array> dados do usuário (email,telefone)
    * @return: <boolean> se atualizou
    */
    public function updateUserData($data) {
        if (!$this->isLogged()) { return false; }
        $where = 'id ='.session()->get()['id'];
        return $this->db->table('socios')->update($data,$where);
    }




}