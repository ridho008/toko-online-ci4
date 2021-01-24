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
            <div class="col-md-6">
               <img src="/uploads/<?= $barang->gambar ?>" class="img-fluid">
            </div>
            <div class="col-md-6">
               <h5>Harga : <?= number_format($barang->harga,0,',','.'); ?></h5>
               <h5>Stok : <?= $barang->stok; ?></h5>
               <hr>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select name="provinsi" id="provinsi" class="form-control">
                           <option value="">-- Pilih Provinsi --</option>
                           <?php foreach($provinsi as $p) : ?>
                              <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="kabupaten">Kabupaten/Kota</label>
                        <select name="kabupaten" id="kabupaten" class="form-control">
                           <option value="">-- Pilih Kab/Kota --</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label for="services">Paket</label>
                        <select name="services" id="services" class="form-control">
                           <option value="">-- Pilih Paket --</option>
                        </select>
                     </div>
                  </div>
               </div>
               <strong>Estimasi : <span id="estimasi"></span></strong>
               <hr>
               <?= form_open('etalase/beli'); ?>
               <?= csrf_field(); ?>
               <!-- <input type="hidden" name="id" value="<?= $barang->id ?>"> -->
               <input type="hidden" name="id_barang" value="<?= $barang->id ?>">
               <input type="hidden" name="id_pembeli" value="<?= session()->get('id') ?>">
               <div class="form-group">
                  <label for="jumlah">Jumlah Pembelian</label>
                  <input type="number" name="jumlah" max="<?= $barang->stok ?>" id="jumlah" min="1" class="form-control">
               </div>
               <div class="form-group">
                  <label for="total_harga">Total Harga</label>
                  <input type="number" name="total_harga" readonly id="total_harga" min="0" class="form-control">
               </div>
               <div class="form-group">
                  <label for="ongkir">Ongkos Kirim</label>
                  <input type="number" name="ongkir" readonly id="ongkir" min="0" class="form-control">
               </div>
               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" name="alamat" id="alamat" class="form-control">
               </div>
               <div class="form-group">
                  <button type="submit" id="submit" class="btn btn-dark">Beli</button>
               </div>
               <?= form_close(); ?>
            </div>
         </div>
      </div>
   </div>
   <!-- Komentar -->
   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">
               <div class="row">
                  <div class="col-md-6">
                     <h4>Komentar</h4>
                  </div>
                  <div class="col-md-6 text-right">
                     <a href="<?= base_url('komentar/create/' . $barang->id) ?>" class="btn btn-link">Tinggalkan Komentar</a>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12">
                     <?php foreach($komentar as $k) : ?>
                     <?php 
                        $modelUser = new \App\Models\UserModel();
                        $namaUser = $modelUser->find($k->id_user)->username;
                     ?>
                     <strong><?= $namaUser; ?></strong><br>
                     <?= $k->komentar ?>
                     <hr>
                     <?php endforeach; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
   $(document).ready(function() {
      var jumlah_pembelian = 1;
      $('#jumlah').val(jumlah_pembelian);
      var harga = <?= $barang->harga; ?>;
      var ongkir = 0;
      $('#provinsi').change(function() {
      $('#kabupaten').empty();
         var id_province = $(this).val();
         // console.log(id_province);

         $.ajax({
            url: "<?= base_url('/etalase/getCity'); ?>",
            type: "GET",
            data: {
               "id_province" : id_province
            },
            dataType: "json",
            success: function(data) {
               var results = data["rajaongkir"]["results"];
               // console.log(results);
               for (var i = 0; i < results.length; i++) {
                  $('#kabupaten').append($('<option>', {
                     value : results[i]["city_id"],
                     text : results[i]["city_name"]
                  }));
               }
            }
         });
      })

      $('#kabupaten').change(function(){
         var city_id = $(this).val();
         console.log(city_id);

         $.ajax({
            url : "<?= base_url('/etalase/getCost'); ?>",
            type: 'get',
            data : {
               'origin' : 166,
               'destination' : city_id,
               'weight' : 1000,
               'courier' : 'jne'
            },
            dataType : 'json',
            success : function(data)
            {
               console.log(data);
               var results = data["rajaongkir"]["results"][0]["costs"];
               for(var i = 0; i < results.length; i++) {
                  var text = results[i]["description"] + "(" + results[i]["service"] + ")" + results[i]["cost"][0]["value"];
                  $('#services').append($('<option>', {
                     value : results[i]["cost"][0]["value"],
                     text : text,
                     etd : results[i]["cost"][0]["etd"]
                  }));
               }
            }
         });
      })

      $('#services').change(function() {
         var estimasi = $('option:selected', this).attr('etd');
         ongkir = parseInt($(this).val());
         $('#ongkir').val(ongkir);
         $('#estimasi').html(estimasi + " Hari");
         var total_harga = (jumlah_pembelian * harga) + ongkir;
         $('#total_harga').val(total_harga);
      })

      $('#jumlah').change(function() {
         jumlah_pembelian = $('#jumlah').val();
         var total_harga = (jumlah_pembelian * harga) + ongkir;
         $('#total_harga').val(total_harga);
      })

   });
</script>
<?= $this->endSection(); ?>