<?php namespace App\Controllers;

class Komentar extends BaseController
{
   public function __construct()
   {
      helper('form');
      $this->validation = \Config\Services::validation();
      $this->session = session();
   }

	public function create()
	{
      $id = $this->request->uri->getSegment(3);
      $komentarModel = new \App\Models\KomentarModel();
      $barangModel = new \App\Models\BarangModel();
      $barang = $barangModel->find($id);

      if($this->request->getPost()) {
         $field = $this->request->getPost();
         $this->validation->run($field, 'komentar');
         $errors = $this->validation->getErrors();

         if(!$errors) {
            $komentarEntities = new \App\Entities\Komentar();

            $komentarEntities->fill($field);
            $komentarEntities->created_by = $this->session->get('id');
            $komentarEntities->created_date = date('Y-m-d H:i:s');
            $komentarModel->save($komentarEntities);

            $segments = ['etalase', 'beli', $id];
            return redirect()->to(base_url($segments));
         }
         $segmentsKomentar = ['komentar', 'create', $id];
         $this->session->setFlashdata('errors', $errors);
         return redirect()->to(base_url($segmentsKomentar));
      }

      $data = [
         'title' => 'Buat Komentar',
         'id_barang' => $id,
         'model' => $komentarModel,
         'brg' => $barang
      ];
		return view('komentar/create', $data);
	}

	//--------------------------------------------------------------------

}
