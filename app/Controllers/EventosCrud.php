<?php

namespace App\Controllers;

use App\Models\Eventos;
use \Hermawan\DataTables\DataTable;


class EventosCrud extends BaseController
{
	
    private $data = [];

    public function index()
    {
      rcStartup();
      return view('admin/eventos-grid',$this->data);
    }

    public function jsonGrid() {
      $db = db_connect();
      $builder_sub = $db->
                  table('eventos-participantes')->select('count(*)')->where('idEvento','eventos.id');
      $builder = $db->
                  table('eventos')->
                  select('
                          id, 
                          titulo, 
                          date_format(data,"%d/%m/%Y"), 
                          IF(ativo=TRUE,"'._('Sim').'","'._('Não').'")
                  ')->
                  selectSubquery($builder_sub,'_PARTICIPANTES')->
                  where('_deleted',null);
      return DataTable::of($builder)->toJson();      
    }

    public function insert() 
    {
      $this->data['ativo']='Y';
      $this->data['data'] = null;
      $this->data['titulo'] = null;
      return view('admin/eventos-ficha',$this->data);
    }

    public function insertPost() 
    {
      $validation = $this->validaInfos(0);
      if (count($validation)>0) {
        session()->setFlashdata('errors',$validation);
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        echo view('admin/eventos-ficha', $this->data);
      }
      else {
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        (new Eventos())->insert($this->request->getPost());
        $toastr = array('type'=>'success','text'=>_('Evento inserido com sucesso!'));                
        return redirect()->route('eventos')->with('toastr',$toastr); 
      }
    }

    public function update($cid) 
    {
      $this->data = (array)(new Eventos())->getById($cid);
      return view('admin/eventos-ficha',$this->data);
    }

    public function updatePost($cid) 
    {
      $validation = $this->validaInfos($cid);
      if (count($validation)>0) {
        session()->setFlashdata('errors',$validation);
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        echo view('admin/eventos-ficha', $this->data);
      }
      else {
        $this->data = $this->request->getPost();
        $this->dataTransforms();
        (new Eventos())->update($cid,$this->data);
        $toastr = array('type'=>'success','text'=>_('Evento atualizado com sucesso!'));                
        return redirect()->route('eventos')->with('toastr',$toastr); 
      }
    }

    public function delete($cid) 
    {
      $this->data = (array)(new Eventos())->getById($cid);
      return view('admin/eventos-delete',$this->data);
    }

    public function deletePost($cid) 
    {
      (new Eventos())->delete($cid);
      $toastr = array('type'=>'success','text'=>_('Evento apagado com sucesso!'));                
      return redirect()->route('eventos')->with('toastr',$toastr); 
    }

    private function validaInfos($cid) {
        $val =  $this->validate([
          'ativo' => 'required',
          'titulo' => 'required',
          'data' => 'required|valid_date[d/m/Y]',
        ],[
          'ativo' => [
              'required' => _('Selecione se está ativo ou não')
          ],
          'titulo' => [
              'required' => _('Digite o título do evento'),
          ],
          'data' => [
              'required' => _('Digite a data do evento'),
              'valid_date' => _('Digite corretamente a data do evento'),
          ],
      ]);
      if (!$val) {
        return $this->validator->getErrors();
      }
      return [];
    }

    private function dataTransforms() {
      $this->data['data'] = rcDateToDb($this->data['data']);
    }

}
