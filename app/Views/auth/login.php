<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row mt-5">
      <div class="col-6 offset-md-3 shadow-sm">
         <h3 class="text-center">Halaman Login</h3>
         <div class="row">
            <div class="col-md-12">
               <?php 
               $session = session();
               $errors = $session->getFlashdata('errors');
               ?>
               <?php if($errors != null) : ?>
                  <div class="alert alert-danger" role="alert">
                     <h4 class="alert-heading">Terjadi Kesalahan</h4>
                     <hr>
                     <p class="mb-0">
                        <?php foreach($errors as $err) : ?>
                           <?= $err ?><br>
                        <?php endforeach; ?>
                     </p>
                  </div>
               <?php endif; ?>
               <?= form_open('/auth'); ?>
               <?= csrf_field(); ?>
               <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" autofocus="on" name="username" id="username" class="form-control">
               </div>
               <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control">
               </div>
               <div class="form-group">
                  <button type="submit" class="btn btn-dark btn-block">Login</button>
               </div>
               <?= form_close(); ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>