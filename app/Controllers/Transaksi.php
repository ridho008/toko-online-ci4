<?php namespace App\Controllers;

use TCPDF;

class Transaksi extends BaseController
{
   public function __construct()
   {
      helper('form');
      $this->validation = \Config\Services::validation();
      $this->session = session();
   }

	public function view()
	{
      $id = $this->request->uri->getSegment(3);
      $transaksiModel = new \App\Models\TransaksiModel();
      $transaksi = $transaksiModel->join('barang', 'barang.id=transaksi.id_barang')
      ->join('user', 'user.id=transaksi.id_pembeli')
      ->where('transaksi.id', $id)
      ->first();

		return view('transaksi/view', [
         'title' => 'Transaksi',
         'transaksi' => $transaksi
      ]);
	}

   public function index()
   {
      $transaksiModel = new \App\Models\TransaksiModel();
      $model = $transaksiModel->findAll();
      return view('transaksi/index', [
         'title' => 'Daftar Transaksi',
         'model' => $model
      ]);
   }

   public function invoice()
   {
      $id = $this->request->uri->getSegment(3);
      $transaksiModel = new \App\Models\TransaksiModel();
      $transaksi = $transaksiModel->join('barang', 'barang.id=transaksi.id_barang')
      ->join('user', 'user.id=transaksi.id_pembeli')
      ->where('transaksi.id', $id)
      ->first();

      $html = view('transaksi/invoice', [
         'title' => 'invoice',
         'transaksi' => $transaksi
      ]);

      // create new PDF document
      $pdf = new TCPDF('PDF_PAGE_ORIENTATION', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Ridho Surya');
      $pdf->SetTitle('Invoice');
      $pdf->SetSubject('Invoice');

      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);

      $pdf->addPage();
      // output the HTML content
      $pdf->writeHTML($html, true, false, true, false, '');
      // khusus ci4
      $this->response->setContentType('application/pdf');
      //Close and output PDF document
      $pdf->Output('invoice.pdf', 'I');
   }

	//--------------------------------------------------------------------

}
