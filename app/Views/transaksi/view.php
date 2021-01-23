<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row mt-5">
      <div class="col-md-10 offset-md-1 shadow-sm mt-5">
         <?php $errors = session()->getFlashdata('errors'); if($errors != null) : ?>
         <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Terjadi Kesalahan</h4>
            <hr>
            <p class="mb-0">
               <?php foreach($errors as $err) : ?>
                  <?= $err ?><br>
               <?php endforeach; ?>
            </p>
         </div>
         <?php endif ?>
         <h3 class="text-center"><?= $title; ?></h3>
         <div class="row mt-5">
            <div class="table-responsive">
               <table class="table table-bordered">
                  <tr>
                     <td>Barang</td>
                     <td><?= $transaksi->nama; ?></td>
                  </tr>
                  <tr>
                     <td>Pembeli</td>
                     <td><?= $transaksi->username; ?></td>
                  </tr>
                  <tr>
                     <td>Alamat</td>
                     <td><?= $transaksi->alamat; ?></td>
                  </tr>
                  <tr>
                     <td>Jumlah</td>
                     <td><?= $transaksi->jumlah; ?></td>
                  </tr>
                  <tr>
                     <td>Total Harga</td>
                     <td><?= $transaksi->total_harga; ?></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>