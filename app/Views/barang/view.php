<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row mt-5">
      <div class="col-6 offset-md-3 shadow-sm mt-5">
         <h3 class="text-center"><?= $title; ?></h3>
         <div class="row mt-5">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">
                           <img src="/uploads/<?= $barang->gambar ?>" class="img-fluid">
                        </div>
                        <div class="col-md-6">
                           <h3><?= $barang->nama; ?></h3>
                           <h4>Harga : <?= $barang->harga; ?></h4>
                           <h4>Stok : <?= $barang->stok; ?></h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>