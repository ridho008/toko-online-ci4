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
                     <td>Barang</td>
                     <td>Pembeli</td>
                     <td>Alamat</td>
                     <td>Jumlah</td>
                     <td>Harga</td>
                     <td>Aksi</td>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($model as $value => $m) : ?>
                  <tr>
                     <td><?= ($value + 1) ?></td>
                     <td><?= $m->id_barang ?></td>
                     <td><?= $m->id_pembeli ?></td>
                     <td><?= $m->alamat ?></td>
                     <td><?= $m->jumlah ?></td>
                     <td><?= $m->total_harga ?></td>
                     <td>
                        <a href="/transaksi/view/<?= $m->id ?>" class="btn btn-success btn-sm">View</a>
                        <a href="/transaksi/invoice/<?= $m->id ?>" class="btn btn-info btn-sm">Invoice</a>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>