<?= $this->extend('layouts/app'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row mt-5">
      <div class="col-8 offset-md-2 shadow-sm mt-5">
         <h3 class="text-center"><?= $title; ?></h3>
         <div class="row mt-5">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Gambar</th>
                                 <th>Barang</th>
                                 <th>Harga</th>
                                 <th>Stok</th>
                                 <th>Aksi</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php foreach($barangs as $index => $barang) : ?>
                              <tr>
                                 <td><?= ($index + 1) ?></td>
                                 <td>
                                    <img src="/uploads/<?= $barang->gambar ?>" width="100">
                                 </td>
                                 <td><?= $barang->nama ?></td>
                                 <td><?= number_format($barang->harga,0,',','.') ?></td>
                                 <td><?= $barang->stok ?></td>
                                 <td>
                                    <a href="/barang/view/<?= $barang->id ?>" class="btn btn-info btn-sm">View</a>
                                    <a href="/barang/edit/<?= $barang->id ?>" class="btn btn-success btn-sm">Edit</a>
                                    <a href="/barang/delete/<?= $barang->id ?>" class="btn btn-danger btn-sm">Hapus</a>
                                 </td>
                              </tr>
                              <?php endforeach; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>