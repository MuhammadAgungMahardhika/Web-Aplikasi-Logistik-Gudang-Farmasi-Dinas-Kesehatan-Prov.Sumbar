<?php 
session_start();
include('function.php');

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}

$kadaluarsa_sekarang = date('Y-m-d');

$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
LEFT JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
WHERE detail_barang_masuk.tanggal_daluwarsa <= '$kadaluarsa_sekarang' 
ORDER BY detail_barang_masuk.tanggal_daluwarsa DESC  LIMIT 100";
$result = mysqli_query($conn,$query);

if (isset($_GET['menukategori'])) {
  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];

  if ($bulan=='null' && $tahun=='null' ) {
    header('Location:expired.php');
  }else if ($tahun <= date('Y') && $bulan=='null') {
    $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
LEFT JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
WHERE detail_barang_masuk.tanggal_daluwarsa <= '$kadaluarsa_sekarang' AND
 year(tanggal_daluwarsa)='$tahun' ";
    
  }else if ($bulan && $tahun=='null') {
   
   $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
LEFT JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
WHERE detail_barang_masuk.tanggal_daluwarsa <= '$kadaluarsa_sekarang' AND
 month(tanggal_daluwarsa)='$bulan'";
  }else if ($bulan=='null' && $tahun ) {
   $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
LEFT JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
WHERE detail_barang_masuk.tanggal_daluwarsa <= '$kadaluarsa_sekarang' AND 
 year(tanggal_daluwarsa)='$tahun'  ";
  }else if ($bulan && $tahun ) {
   $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
LEFT JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
WHERE detail_barang_masuk.tanggal_daluwarsa <= '$kadaluarsa_sekarang' AND 
 year(tanggal_daluwarsa)='$tahun'  AND
month(tanggal_daluwarsa)='$bulan' ";
  }

  $result = mysqli_query($conn, $query);
  
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SISTEM INFORMASI LOGISTIK DINAS KESEHATAN</title>
        <link rel="icon" href="img/dinkes.png">

        <!-- My css -->
        <link href="css/obat.css" rel="stylesheet" />
        <style>  
        tbody tr:hover {background-color: #f5f5f5;}
</style>
       
        <!-- data table -->
         <link rel="stylesheet" type="text/css" href="js/DataTables-1.10.23/css/dataTables.bootstrap4.min.css"/>

        <!-- font awesome -->
        <script src="fontawesome-free-5.15.2-web/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" style="font-family: roboto">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" >
            <a class="navbar-brand" href="index.php">Dinkes Sumbar</a>
            <button class="btn btn-link btn-lg order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
             <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
              <!--   <div class="input-group">
                    <input class="form-control" name="cari" type="text" placeholder="Cari barang.." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" />
                    <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="menucari"><i class="fas fa-search"></i></button>
                    </div>
                </div> -->
            </div>
            <!-- Navbar-->
             <!-- Alarm -->
            <ul class="navbar-nav ml-auto ml-md-0" >
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <i class="fas fa-bell fa-fw "></i>
                        <span>
                            <span class="badge badge-pill badge-danger" style=" color: white;"><?= nilai_alarm(); ?></span>
                            <span class="sr-only">unread messages</span>
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right p-1" style="max-height: 300px; overflow: auto; border-radius: 5px;" aria-labelledby="userDropdown">


                        <?= alarm(); ?>
                        <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
                        
                        
                    </div>
                </li>
            </ul>

            <!-- Alarm -->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                       <a class="dropdown-item" href="kelolaakun.php">Kelola akun</a>
                        <!-- <a class="dropdown-item" href="#">Activity Log</a> -->
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" >
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                           <!--  <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-home"></i></div>
                                Beranda
                            </a>
                           
                           <!-- awal data barang -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Data Barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                 <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link " href="obat.php"> Barang</a>
                                    <a class="nav-link" href="expired.php"> Barang Kadaluarsa</a>
                                 
                                  </nav>
                            </div>

                                <!-- akhir data barang -->

                              <!-- awal transaksi -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fa fa-list"></i></div> Data
                                Transaksi
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                     <a class="nav-link" href="barangmasuk.php"> <i class="fas fa-plus-square mr-1"></i>Barang Masuk</a>
                                    <a class="nav-link" href="barangkeluar.php"> <i class="fas fa-minus-square mr-1"></i> Barang Keluar</a>
                                    
                                </nav>
                            </div>

                                <!-- akhir transaksi -->

                                <!-- awal Laporan barang -->

                                 <div class="sb-sidenav-menu-heading">Laporan</div>
                            
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts4" aria-expanded="false" aria-controls="collapseLayouts">
                                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                                          Laporan Barang
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                    <div class="collapse" id="collapseLayouts4" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                        <nav class="sb-sidenav-menu-nested nav">
                                           <a class="nav-link " href="laporan_barang.php"><i class="fas fa-layer-group mr-1"></i> Laporan Periode</a>
                                          
                                          
                                        </nav>
                                  </div>

                                <!-- akhir Laporan barang -->

   

                     
                           <div class="sb-sidenav-menu-heading">Pengaturan</div>
                  
                                  <!-- awal data barang -->
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                                  Kategori barang
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link " href="jenis_barang.php"><i class="fas fa-layer-group mr-1"></i> Jenis Barang</a>
                                    <a class="nav-link " href="sumber.php"><i class="fas fa-comment-dollar mr-1"></i> Sumber Anggaran</a>
                                    <a class="nav-link " href="satuan.php"><i class="fab fa-unity mr-1"></i> Satuan Barang</a>

                                    <a class="nav-link " href="program.php"><i class="fas fa-address-book mr-1"> </i> Program </a>
                                  
                                </nav>
                            </div>

                                <!-- akhir data barang -->
                        </div>

                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Nama pengguna</div>
                        <?= user(); ?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active"> Barang kadaluarsa </li>
                            <li class="breadcrumb-item">
                                
                                 <!-- AWal jam digital -->
                                <div class="jam-digital-malasngoding text-center">
                                    <div class="kotak"> 
                                        <a id="jam"></a>
                                        <a >:</a>
                                        <a id="menit"></a>
                                        <a >:</a>
                                        <a id="detik"></a>
                                    </div>
                                </div>


                             <!-- akhir jam digital -->



                            </li>
                            <li class="breadcrumb-item"> <?= date('d-m-Y'); ?> </li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">

                                 <!-- Button to Open the Modal -->
                               

                                  <!-- Awal ekspor -->
                                    <script>
       function tableHtmlToExcel(tableID, filename = ''){
          var downloadLink;
          var dataType = 'application/vnd.ms-excel';
          var tableSelect = document.getElementById(tableID);
          var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
         
          filename = filename?filename+'.xls':'excel_data.xls';
         
          downloadLink = document.createElement("a");
          
          document.body.appendChild(downloadLink);
          
          if(navigator.msSaveOrOpenBlob){
              var blob = new Blob(['\ufeff', tableHTML], {
                  type: dataType
              });
              navigator.msSaveOrOpenBlob( blob, filename);
          }else{
              downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
         
              downloadLink.download = filename;
             
              downloadLink.click();
          }
      }

                                              </script>

 
                                               <button class="btn btn-success" onclick="tableHtmlToExcel('dataTable')"><i class="fas fa-file-excel"></i> Ms Excel</button>
                                              

                                   <!-- Akhir ekspor -->
                                  
                                           <!-- Awal cari kategori-->
                                   <form action="" method="GET" class="form-inline mt-2 mb-2">
                                     <select name="bulan" class="form-control mr-1">

                                      <option value="null">Bulan kadaluarsa</option>
                                      <option value="01">Januari</option>
                                      <option value="02">Februari</option>
                                      <option value="03">Maret</option>
                                      <option value="04">April</option>
                                      <option value="05">Mei</option>
                                      <option value="06">Juni</option>
                                      <option value="07">Juli</option>
                                      <option value="08">Agustus</option>
                                      <option value="09">September</option>
                                      <option value="10">Oktober</option>
                                      <option value="11">November</option>
                                      <option value="12">Desember</option>
                                       
                                     </select>

                                      <select name="tahun" class="form-control mr-1">
                                        <option value="null">Tahun kadaluarsa</option>
                                        <?= pilih_tahun_daluwarsa(); ?>
                                       </select>

                                     <button type="submit" name="menukategori" class="btn btn-primary pt-2 pb-2 ml-1 mr-2"><i class="fas fa-sync-alt"></i></button>

                                   </form>
                                   <!-- Akhir cari kategori -->
                          

                            </div>

                         
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-family: 'roboto';">
                                        <thead>

                                          <tr>
                                            <th colspan="10" class="text-center">Daftar barang kadaluarsa</th>
                                          </tr>
                                          
                                          <tr>
                                            
                                            <th >No</th>
                                            <th >No Masuk</th>
                                            <th >Tanggal Masuk</th>
                                            <th >Nama Barang</th>
                                            <th >Jenis Barang</th>
                                            <th >Jumlah Barang</th>
                                            <th >Batch</th>
                                            <th class="text-center">Kadaluarsa</th>
                                            <th class="text-center">Aksi</th>
                                         
                                          </tr>

                                        </thead>
            
                                        <tbody>

                                                <!--  -->
                                              <?php 
                                              
                                              $no=1; 
                                              while($row = mysqli_fetch_assoc($result)){
                                               
                                              $no_stock_masuk = $row['id_masuk'];
                                              $id_barang = $row['id_barang'];
                                              $no_batch = $row['no_batch']; 
                                              $nama_barang = $row['nama_barang'];
                                              $jenis_barang = $row['jenis_barang'];
                                              $pemasukan =$row['pemasukan'];
                                              $tanggal_masuk = $row['tanggal_masuk'];
                                              $tanggal_daluwarsa= $row['tanggal_daluwarsa'];
                                              $pengirim = $row['pengirim'];
                                            
                                           

                                               ?>

                                               <!--  -->

                                        
                                                <tr>
                                                  <td ><?=$no++; ?> </td>
                                                  <td ><?=$no_stock_masuk; ?></td>
                                                  <td ><?=date("d-m-Y",strtotime($tanggal_masuk)); ?></td>
                                                  <td ><?=$nama_barang; ?></td>
                                                  <td class=""><?=$jenis_barang; ?></td>
                                                  <td ><?=$pemasukan; ?></td>
                                                 
                                                  <td ><?=$no_batch; ?></td>  
                                                  <td class="text-center"><?= date("d-m-Y",strtotime($tanggal_daluwarsa)); ?></td>
                                                  <td class="text-center"><a href="detail_barang_masuk.php?id_masuk=<?=$no_stock_masuk; ?>" class="btn btn-outline-primary"><i class="fa fa-search" title="Telusuri"></i></a></td>
                                              
                                                </tr>

                                       
                                            <?php  

                                              } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Dinas Kesehatan Provinsi Sumatera Barat 2021</div>
                            <div>
                                <!-- <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a> -->
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Jquery -->
               <script src="js/jquery/jquery-3.5.1.js" crossorigin="anonymous"></script>
               <!-- akhir Jquery -->


                <!-- Css Js Bootsrap 4 -->
                     <script src="css/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


                 <!--My Js  -->

                <script src="assets/demo/datatables-demo.js"></script>
                <!-- akhir My Js -->
                       
                <!-- data table -->
                <script type="text/javascript" src="js/datatables.min.js" crossorigin="anonymous"></script>
                
                <script src="js/dataTables-1.10.23/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    </body>
</html>
