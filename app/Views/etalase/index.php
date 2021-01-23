<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row" style="margin-top: 100px;">
      <?php foreach($barangs as $barang) : ?>
         <div class="col-md-4 mb-4">
            <div class="card">
               <div class="card-body text-center">
                  <img src="/uploads/<?= $barang->gambar ?>" class="img-fluid" style="max-height: 200px;">
                  <h5><strong><?= $barang->nama; ?></strong></h5>
                  <h5>Harga : Rp.<?= number_format($barang->harga, 2, ',', '.'); ?></h5>
                  <p>Stok <?= $barang->stok; ?></p>
                  <div class="row">
                     <div class="col-md-12">
                        <a href="/etalase/beli/<?= $barang->id ?>" class="btn btn-dark btn-block">Masukan Keranjang</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      <?php endforeach ; ?>
   </div>
</div>
<?= $this->endSection(); ?>