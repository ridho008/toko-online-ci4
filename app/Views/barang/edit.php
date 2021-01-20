<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row mt-5">
      <div class="col-6 offset-md-3 shadow-sm mt-5">
         <h3 class="text-center"><?= $title; ?></h3>
         <div class="row mt-5">
            <div class="col-md-12">
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
               <?= form_open_multipart('barang/edit/' . $barang->id); ?>
               <?= csrf_field(); ?>
               <input type="hidden" value="<?= $barang->gambar; ?>" name="gambarLama">
               <div class="form-group">
                  <label for="nama">Nama Barang</label>
                  <input type="text" name="nama" id="nama" class="form-control" value="<?= (old('nama')) ? old('nama') : $barang->nama ?>">
               </div>
               <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" name="harga" id="harga" min="0" class="form-control" value="<?= (old('harga')) ? old('harga') : $barang->harga ?>">
               </div>
               <div class="form-group">
                  <label for="stok">Stok</label>
                  <input type="number" name="stok" id="stok" min="0" class="form-control" value="<?= (old('stok')) ? old('stok') : $barang->stok ?>">
               </div>
               <div class="form-group">
                  <label for="gambar">Gambar</label><br>
                  <img src="/uploads/<?= $barang->gambar ?>" width="100">
                  <input type="file" name="gambar" id="gambar" class="form-control-file">
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-dark">Tambah</button>
               </div>
               <?= form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>