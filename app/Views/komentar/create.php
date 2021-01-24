<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<?php  
   $komentar = [
      'name' => 'komentar',
      'id' => 'komentar',
      'value' => null,
      'class' => 'form-control'
   ];

   $barang = [
      'name' => 'id_barang',
      'id' => 'id_barang',
      'value' => $id_barang,
      'type' => 'hidden'
   ];

   $user = [
      'name' => 'id_user',
      'id' => 'id_user',
      'value' => session()->get('id'),
      'type' => 'hidden'
   ];

   $submit = [
      'name' => 'submit',
      'type' => 'submit',
      'value' => 'Submit',
      'class' => 'btn btn-dark'
   ];
?>
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
         <h3 class="text-center"><?= $title; ?></h3><hr>
         <h3 class="text-center"><?= $brg->nama; ?></h3><hr>
         <h6 class="text-center"><a href="/etalase/beli/<?= $id_barang ?>">Detail</a></h6>
         <div class="row mt-5">
            <div class="col-md">
            <?= form_open('komentar/create/'. $id_barang); ?>
            <?= form_input($user); ?>
            <?= form_input($barang); ?>
            <div class="form-group">
               <?= form_label('Komentar', 'komentar'); ?>
               <?= form_textarea($komentar); ?>
            </div>
            <div class="form-group">
               <?= form_input($submit); ?>
            </div>
            <?= form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="/ckeditor5-build-classic/ckeditor.js"></script>
<style>
   .ck-editor__editable_inline {
      min-height: 200px;
   }
</style>
<script>
   ClassicEditor
       .create( document.querySelector('#komentar') )
       .then( editor => {
           console.log( editor );
       } )
       .catch( error => {
           console.error( error );
       } );
</script>
<?= $this->endsection(); ?>