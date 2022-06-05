<?php
include '../connect.php';


$id_masuk = $_GET['id_masuk'];

$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
LEFT JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
LEFT JOIN satuan 
on satuan.id_satuan = detail_barang_masuk.id_satuan
LEFT JOIN sumber
on sumber.id_sumber = detail_barang_masuk.id_sumber
WHERE detail_barang_masuk.id_masuk = '$id_masuk'";
$result = mysqli_query($conn,$query);
?>
<html>
<head>
  <title> Daftar pemasukan obat dan alkes  </title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
      <h2>Laporan barang keluar</h2>

      <a href="../detail_barang_masuk.php?id_masuk=<?= $id_masuk;?> " class="btn btn-success mr-1 mb-1 mt-1">Kembali</a>
     

     <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-family: 'roboto';">
                                        <thead>

                                          <tr>
                                            <th colspan="14" class="text-center">Daftar barang masuk</th>
                                          </tr>
                                          <tr>

                                            <?php 
                                            $masuk = mysqli_query($conn,"SELECT * FROM barang_masuk WHERE id_masuk = '$id_masuk' ");
                                            $masuk_row = mysqli_fetch_assoc($masuk);
                                            $id_masuk_row = $masuk_row['id_masuk'];
                                            $tanggal_masuk_row = $masuk_row['tanggal_masuk'];
                                            $pengirim_masuk_row = $masuk_row['pengirim']; ?>
                                        <td colspan="14"  class="text-start">No masuk : <?=$id_masuk_row; ?><br> Tanggal masuk : <?= $tanggal_masuk_row; ?><br> Pengirim : <?= $pengirim_masuk_row; ?></td>
                                          </tr>
                                         
                                        
                                          <tr>
                                            
                                            <th >No</th>
                                            <th >Nama Barang</th>
                                            <th >Stok</th>
                                            <th >Satuan</th>
                                            <th >Jenis Barang</th>
                                            <th >Pemasukan</th>
                                            <th >Sumber</th>
                                            <th >Harga Perolehan</th>
                                            <th >Batch</th>
                                            <th class="text-center">Kadaluarsa</th>
                                            <th class="text-center">Keterangan</th>
                                           
                                            
                                         
                                          </tr>

                                        </thead>
            
                                        <tbody>

                                                <!--  -->
                                              <?php 
                                              
                                              $no=1; 
                                              while($row = mysqli_fetch_assoc($result)){
                                               
                                              $no_stock_masuk = $row['id_masuk'];
                                              $id_satuan = $row['id_satuan'];
                                              $satuan = $row['satuan'];
                                              $id_barang = $row['id_barang'];
                                              $id_sumber = $row['id_sumber'];
                                              $no_batch = $row['no_batch']; 
                                              $nama_barang = $row['nama_barang'];
                                              $stok = $row['stok'];
                                              $jenis_barang = $row['jenis_barang'];
                                              $pemasukan =$row['pemasukan'];
                                              $harga_perolehan = $row['harga_perolehan'];
                                              $tanggal_masuk = $row['tanggal_masuk'];
                                              $tanggal_daluwarsa= $row['tanggal_daluwarsa'];
                                              $pengirim = $row['pengirim'];
                                              $sumber = $row['sumber'];
                                              $ket_masuk = $row['ket_masuk'];

                                               ?>

                                               <!--  -->

                                        
                                                <tr>
                                                  <td ><?=$no++; ?> </td>
                                                  <td ><?=$nama_barang; ?></td>
                                                  <td ><?=$stok; ?></td>
                                                  <td ><?=$satuan; ?></td>
                                                  <td class=""><?=$jenis_barang; ?></td>
                                                  <td ><?=$pemasukan; ?></td>
                                                  <td ><?=$sumber; ?></td>
                                                  <td ><?=$harga_perolehan;?></td>
                                                  <td ><?=$no_batch; ?></td>  
                                                  <td class="text-center"><?= date("d-m-Y",strtotime($tanggal_daluwarsa)); ?></td>
                                                  <td ><?= $ket_masuk; ?></td>
                                                  
                                                </tr>

                                            <?php  

                                              } ?>

                                        </tbody>
                                    </table>
                                </div>
        
</div>


     <!-- akhir tabel -->
          
        </div>
</div>
  
<script>
$(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

  

</body>

</html>