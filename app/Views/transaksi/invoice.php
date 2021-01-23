<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Invoice <?= $transaksi->username ?></title>
   <style>
      table {
         border-collapse: collapse;
         width: 100%;
         text-align: center;
      }

      td, th {
         border: 1px solid #888;
      }
   </style>
</head>
<body>
   <div style="font-size: 64px; color: #999;"><i>Invoice</i></div>
   <p>
      <i>Ridho Surya</i><br>
      Pekanbaru, Riau <br>
      1342374
   </p>
   <hr>
   <p>
      Pembeli : <?= $transaksi->username ?><br>
      Alamat : <?= $transaksi->alamat ?><br>
      Transaksi No : <?= $transaksi->no ?><br>
      Tanggal : <?= date('d-m-Y', strtotime($transaksi->created_date)) ?><br>
   </p>
   <table cellpadding="6">
      <tr>
         <th>Barang</th>
         <th>Harga Satuan</th>
         <th>Jumlah</th>
         <th>Ongkir</th>
         <th>Total Harga</th>
      </tr>
      <tr>
         <td><?= $transaksi->nama ?></td>
         <td>Rp.<?= number_format($transaksi->harga, 2, ',', '.') ?></td>
         <td><?= $transaksi->jumlah ?></td>
         <td>Rp.<?= number_format($transaksi->ongkir, 2, ',', '.') ?></td>
         <td>Rp.<?= number_format($transaksi->total_harga, 2, ',', '.') ?></td>
      </tr>
   </table>
</body>
</html>