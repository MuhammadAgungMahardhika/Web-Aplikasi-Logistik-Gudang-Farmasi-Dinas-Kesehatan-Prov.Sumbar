<?php
include '../connect.php';


$id_keluar = $_GET['id_keluar'];

$query = "SELECT * FROM detail_barang_keluar
JOIN barang_keluar
on barang_keluar.id_keluar = detail_barang_keluar.id_keluar
JOIN detail_barang_masuk
on detail_barang_masuk.id_barang = detail_barang_keluar.id_barang AND
detail_barang_masuk.id_masuk = detail_barang_keluar.id_masuk
JOIN satuan 
on satuan.id_satuan = detail_barang_masuk.id_satuan
JOIN sumber
on sumber.id_sumber = detail_barang_masuk.id_sumber
JOIN barang
on barang.id_barang = detail_barang_masuk.id_barang
WHERE detail_barang_keluar.id_keluar = '$id_keluar'  ";
$result = mysqli_query($conn,$query);
?>
<html>
<head>
  <title>Daftar pengeluaran barang</title>
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
      <h2 >Laporan barang keluar</h2>

      <a href="../detail_barang_keluar.php?id_keluar=<?= $id_keluar;?> " class="btn btn-success mr-1 mb-1 mt-1">Kembali</a>
     

     <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-family: 'roboto';">
                                        <thead>

                                          <tr>
                                            <th colspan="14" class="text-center">Daftar barang keluar</th>
                                          </tr>
                                          <tr>

                                            <?php 
                                            $keluar = mysqli_query($conn,"SELECT * FROM barang_keluar WHERE id_keluar = '$id_keluar' ");
                                            $keluar_row = mysqli_fetch_assoc($keluar);
                                            $id_keluar_row = $keluar_row['id_keluar'];
                                            $tanggal_keluar_row = $keluar_row['tanggal_keluar'];
                                            $penerima_keluar_row = $keluar_row['penerima']; ?>
                                        <td colspan="14"  class="text-start">No keluar : <?=$id_keluar_row; ?><br> Tanggal keluar : <?= $tanggal_keluar_row; ?><br> penerima : <?= $penerima_keluar_row; ?></td>
                                          </tr>
                                         
                                        
                                          <tr>
                                            
                                            <th >No</th>
                                            <th >Nama Barang</th>
                                            <th >Satuan</th>
                                            <th >Pengeluaran</th>
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
                                               
                                              $no_stock_keluar = $row['id_keluar'];
                                              $id_satuan = $row['id_satuan'];
                                              $satuan = $row['satuan'];
                                              $id_barang = $row['id_barang'];
                                              $id_sumber = $row['id_sumber'];
                                              $no_batch = $row['no_batch']; 
                                              $nama_barang = $row['nama_barang'];
                                              $pengeluaran =$row['pengeluaran'];
                                              $harga_perolehan = $row['harga_perolehan'];
                                              $tanggal_keluar = $row['tanggal_keluar'];
                                              $tanggal_daluwarsa= $row['tanggal_daluwarsa'];
                                              $penerima = $row['penerima'];
                                              $sumber = $row['sumber'];
                                              $ket_keluar = $row['ket_keluar'];

                                               ?>

                                               <!--  -->

                                        
                                                <tr>
                                                  <td ><?=$no++; ?> </td>
                                                  <td ><?=$nama_barang; ?></td>
                                                  <td ><?=$satuan; ?></td>
                                                  <td ><?=$pengeluaran; ?></td>
                                                  <td ><?=$sumber; ?></td>
                                                  <td ><?=$harga_perolehan;?></td>
                                                  <td ><?=$no_batch; ?></td>  
                                                  <td class="text-center"><?= date("d-m-Y",strtotime($tanggal_daluwarsa)); ?></td>
                                                  <td ><?= $ket_keluar; ?></td>
                                             
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
            'copy','csv','excel'
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