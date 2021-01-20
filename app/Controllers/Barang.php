<?php namespace App\Controllers;

class Barang extends BaseController
{
   public function __construct()
   {
      helper('form');
      $this->validation = \Config\Services::validation();
      $this->session = session();
   }

	public function index()
	{
      $barangModel = new \App\Models\BarangModel();
      $barangs = $barangModel->findAll();
      $data = [
         'title' => 'Daftar Barang',
         'barangs' => $barangs
      ];
		return view('barang/index', $data);
	}

   public function view()
   {
      $id = $this->request->uri->getSegment(3);
      $barangModel = new \App\Models\BarangModel();
      $barang = $barangModel->find($id);
      return view('barang/view', [
         'barang' => $barang,
         'title' => $barang->nama
      ]);
   }

   public function create()
   {
      if($this->request->getPost()) {
         $field = $this->request->getPost();
         $this->validation->run($field, 'barang');
         $errors = $this->validation->getErrors();

         if(!$errors) {
            $barangModel = new \App\Models\BarangModel();
            $barang = new \App\Entities\Barang();
            $barang->fill($field);
            $barang->gambar = $this->request->getFile('gambar');
            $barang->created_by = $this->session->get('id');
            $barang->created_date = date('Y-m-d H:i:s');
            $barangModel->save($barang);

            $id = $barangModel->insertID();
            $segments = ['barang', 'view', $id];
            return redirect()->to(base_url($segments));
         }

         $this->session->setFlashdata('errors', $errors);
         return redirect()->to('/barang/create');
      }
      $data = [
         'title' => 'Tambah Barang'
      ];
      return view('barang/create', $data);
   }

   public function edit()
   {
      // getSegment = menggambil url
      $id = $this->request->uri->getSegment(3);
      $barangModel = new \App\Models\BarangModel();
      $barang = $barangModel->find($id);

      if($this->request->getPost()) {
         $data = $this->request->getPost();
         // menjalankan validation di folder Config > Validation.php
         $this->validation->run($data, 'barangupdate');
         $errors = $this->validation->getErrors();

         // jika tidak ada input error
         if(!$errors) {
            // menggunakan fitur entities
            $barang = new \App\Entities\Barang();
            $barang->id = $id;
            $barang->fill($data);

            if($this->request->getFile('gambar')->isValid()) {
               $barang->gambar = $this->request->getFile('gambar');
               unlink('uploads/'. $this->request->getPost('gambarLama'));
            }

            $barang->updated_by = $this->session->get('id');
            $barang->updated_date = date('Y-m-d H:i:s');
            $barangModel->save($barang);

            $segments = ['barang', 'view', $id];
            return redirect()->to(base_url($segments));
         }
         $this->session->setFlashdata('errors', $errors);
         return redirect()->to('/barang/edit/' . $id);
      }
      return view('barang/edit', [
         'title' => 'Ubah Data ' . $barang->nama,
         'barang' => $barang
      ]);
   }

   public function delete()
   {
      $id = $this->request->uri->getSegment(3);
      $barangModel = new \App\Models\BarangModel();
      $barangModel->delete($id);
      return redirect()->to('/barang');
   }

	//--------------------------------------------------------------------

}
