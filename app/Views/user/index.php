<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row mt-5">
      <div class="col-md-10 offset-md-1 shadow-sm mt-5">
         <div class="table-responsive">
            <table class="table table-striped">
               <thead>
                  <tr>
                     <td>No</td>
                     <td>Username</td>
                     <td>Created By</td>
                     <td>Created Date</td>
                     <td>Aksi</td>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($model as $value => $u) : ?>
                  <tr>
                     <td><?= $u->id ?></td>
                     <td><?= $u->username ?></td>
                     <td><?= $u->created_by ?></td>
                     <td><?= $u->created_date ?></td>
                     <td></td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <?= $pager->links('default', 'custom_pagination'); ?>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>