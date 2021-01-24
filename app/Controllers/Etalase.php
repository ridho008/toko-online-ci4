<?php namespace App\Controllers;

class Etalase extends BaseController
{
   private $url = "https://api.rajaongkir.com/starter/";
   private $apiKey = "9000c3eb2c5a219fded1eb17cce0144f";

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
         'title' => 'Etalase',
         'barangs' => $barangs
      ];
		return view('etalase/index', $data);
	}

   public function beli()
   {
      // mengambil id
      $id = $this->request->uri->getSegment(3);
      $barangModel = new \App\Models\BarangModel();
      $komentarModel = new \App\Models\KomentarModel();
      $barang = $barangModel->find($id);
      $komentar = $komentarModel->where('id_barang', $id)->findAll();

      $province = $this->rajaongkir('province');

      if($this->request->getPost())
      {
        $field = $this->request->getPost();
        $this->validation->run($field, 'transaksi');
        $errors = $this->validation->getErrors();

        if(!$errors) {
          $transaksiModel = new \App\Models\TransaksiModel();
          $transaksi = new \App\Entities\Transaksi();

          // mengurangi stok
          $barangModel = new \App\Models\BarangModel();
          $id_barang = $this->request->getPost('id_barang');
          $jumlah_pembelian = $this->request->getPost('jumlah');
          $barang = $barangModel->find($id_barang);

          $entitiesBarang = new \App\Entities\Barang();
          $entitiesBarang->id = $id_barang;
          $entitiesBarang->stok = $barang->stok - $jumlah_pembelian;
          $barangModel->save($entitiesBarang);

          // simpan data transaksi
          $transaksi->fill($field);
          $transaksi->status = 0;
          $transaksi->created_by = $this->session->get('id');
          $transaksi->created_date = date('Y-m-d H:i:s');
          $transaksiModel->save($transaksi);

          $id = $transaksiModel->insertID();
          $segments = ['transaksi', 'view', $id];
          return redirect()->to(base_url($segments));
        }
        $this->session->setFlashdata('errors', $errors);
        return redirect()->to('/etalase/beli/' . $id);
      }


      return view('etalase/beli', [
         'title' => $barang->nama,
         'barang' => $barang,
         'komentar' => $komentar,
         'provinsi' => json_decode($province)->rajaongkir->results
      ]);
   }
   // 9000c3eb2c5a219fded1eb17cce0144f

   public function getCity()
   {
      if($this->request->isAJAX()) {
         $id_province = $this->request->getGet('id_province');
         $data = $this->rajaongkir('city', $id_province);
         return $this->response->setJSON($data);
      }
   }

   private function rajaongkir($method, $id_province = null)
   {
      $endPoint = $this->url.$method;
      if($id_province != null) {
         $endPoint = $endPoint."?province=".$id_province;
      }
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $endPoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key: ".$this->apiKey
        ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);
      return $response;
   }

   public function getCost()
   {
    if($this->request->isAJAX()) {
      $origin = $this->request->getGet('origin');
      $destination = $this->request->getGet('destination');
      $weight = $this->request->getGet('weight');
      $courier = $this->request->getGet('courier');
      $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
      return $this->response->setJSON($data);
    }
   }

   private function rajaongkircost($origin, $destination, $weight, $courier)
   {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: ".$this->apiKey
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    return $response;
   }

	//--------------------------------------------------------------------

}
