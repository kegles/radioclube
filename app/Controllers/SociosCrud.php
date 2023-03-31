<?php

namespace App\Controllers;

use App\Models\Socios;
use \Hermawan\DataTables\DataTable;


class SociosCrud extends BaseController
{
	
    private $data = [];
    private $data_licencas = [];

    public function index()
    {
      rcStartup();
      return view('admin/socios-grid',$this->data);
    }

    public function jsonGrid() {
      $db = db_connect();
      $builder = $db->table('socios')->select('id, cpf, nome, email, telefone')->where('_deleted',null);
      return DataTable::of($builder)->toJson();
    }

    public function insert() 
    {
      $this->data['ativo']='Y';
      $this->data['aprovado']='N';
      $this->data['cpf']=null;
      $this->data['nome']=null;
      $this->data['email']=null;
      $this->data['telefone']=null;
      $this->data['dataNascimento'] = null;
      $this->data['_LICENCAS'] = [];
      $this->data['_LICENCAS_TIPOS'] =  (new Socios())->getLicencasTipos();
      return view('admin/socios-ficha',$this->data);
    }

    public function insertPost() 
    {
      $validation = $this->validaInfos(0);
      if (count($validation)>0) {
        session()->setFlashdata('errors',$validation);
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        echo view('admin/socios-ficha', $this->data);
      }
      else {
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        $SocioAdapter = new Socios();
        $SocioAdapter->insert($this->request->getPost());
        $socio_id = $SocioAdapter->getInsertID();
        $SocioAdapter->updateSocioLicencas($socio_id,$this->data_licencas);
        $toastr = array('type'=>'success','text'=>_('Sócio inserido com sucesso!'));                
        return redirect()->route('socios')->with('toastr',$toastr); 
      }
    }

    public function update($cid) 
    {
      $this->data = (array)(new Socios())->getById($cid);
      $this->data['_LICENCAS'] = (array)(new Socios())->getLicencasFrom($cid);
      $this->data['_LICENCAS_TIPOS'] =  (new Socios())->getLicencasTipos();
      return view('admin/socios-ficha',$this->data);
    }

    public function updatePost($cid) 
    {
      $validation = $this->validaInfos($cid);
      if (count($validation)>0) {
        session()->setFlashdata('errors',$validation);
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        echo view('admin/socios-ficha', $this->data);
      }
      else {
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        $SocioAdapter = new Socios();
        $SocioAdapter->update($cid,$this->data);
        $SocioAdapter->updateSocioLicencas($cid,$this->data_licencas);
        $toastr = array('type'=>'success','text'=>_('Sócio atualizado com sucesso!'));                
        return redirect()->route('socios')->with('toastr',$toastr); 
      }
    }

    public function delete($cid) 
    {
      $this->data = (array)(new Socios())->getById($cid);
      return view('admin/socios-delete',$this->data);
    }

    public function deletePost($cid) 
    {
      (new Socios())->delete($cid);
      $toastr = array('type'=>'success','text'=>_('Sócio apagado com sucesso!'));                
      return redirect()->route('socios')->with('toastr',$toastr); 
    }

    private function validaInfos($cid) {
        $val =  $this->validate([
          'ativo' => 'required',
          'aprovado' => 'required',
          'cpf' => 'required|is_unique[socios.cpf,id,'.$cid.']',
          'nome' => 'required',
          'dataNascimento' => 'required|valid_date[d/m/Y]',
          'email' => 'required|valid_email|is_unique[socios.email,id,'.$cid.']',
          'telefone' => 'required',
        ],[
          'ativo' => [
              'required' => _('Selecione se está ativo ou não')
          ],
          'aprovado' => [
            'required' => _('Selecione se foi aprovado ou não')
          ],
          'cpf' => [
              'required' => _('Digite corretamente seu CPF'),
              'is_unique' => _('CPF já cadastrado'),
          ],
          'nome' => [
              'required' => _('Digite o nome completo'),
          ],
          'dataNascimento' => [
              'required' => _('Digite a data de nascimento'),
              'valid_date' => _('Digite corretamente a data de nascimento'),
          ],
          'email' => [
              'required' => _('Digite o endereço de e-mail'),
              'valid_email' => _('Digite corretamente o e-mail'),
              'is_unique' => _('O e-mail já está cadastrado'),
          ],
          'telefone' => [
              'required' => _('Digite seu telefone'),
          ],
      ]);
      if (!$val) {
        return $this->validator->getErrors();
      }
      return [];
    }

    private function dataTransforms() {
      $this->data['dataNascimento'] = rcDateToDb($this->data['dataNascimento']);
      unset($this->data['_LICENCAS'][0]); //view insert field
      $this->data_licencas = $this->data['_LICENCAS'];
      unset($this->data['_LICENCAS']);
      unset($this->data['_LICENCAS_TIPOS']);
    }

}
