<?php 
session_start();
include('function.php');

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}



$query = "SELECT *FROM barang_masuk 
 ORDER BY barang_masuk.tanggal_masuk DESC LIMIT 100";
$result = mysqli_query($conn,$query);

if (isset($_GET['menucari'])) {

  $cari = $_GET['cari'];
  $query = "SELECT *FROM detail_barang_masuk 
JOIN barang_masuk
on barang_masuk.id_masuk = detail_barang_masuk.id_masuk
JOIN barang 
on barang.id_barang = detail_barang_masuk.id_barang
JOIN jenis_barang
on jenis_barang.id_jenis_barang = barang.id_jenis_barang
JOIN satuan 
on satuan.id_satuan = detail_barang_masuk.id_satuan
JOIN sumber
on sumber.id_sumber = detail_barang_masuk.id_sumber

WHERE 
nama_barang LIKE '$cari'

";
 

$result = mysqli_query($conn, $query);
}

if (isset($_GET['menukategori'])) {
  $bulan = $_GET['bulan'];
  $tahun = $_GET['tahun'];

  if ($bulan=='null' && $tahun=='null' ) {
    header('Location:barangmasuk.php');
  }else if ($tahun && $bulan=='null') {
    $query = "SELECT *FROM barang_masuk 
WHERE year(tanggal_masuk)='$tahun' ";
    
  }else if ($bulan && $tahun=='null') {
   
   $query = "SELECT *FROM barang_masuk 
WHERE month(tanggal_masuk)='$bulan'";
  }else if ($bulan && $tahun ) {
   $query = "SELECT *FROM barang_masuk 
WHERE year(tanggal_masuk)='$tahun'  AND
month(tanggal_masuk)='$bulan' ";
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
                            <li class="breadcrumb-item active">Barang Masuk</li>
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
                                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" title="Tambah Data Barang Baru">
                                   <i class="fas fa-plus-square fa-lg"></i>  Barang Masuk 
                                  </button>

                                  <!-- Awal tambah barang masuk-->
                                      <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Tambah Barang Masuk </h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->

                                            <form action="function.php" method="POST">
                                            <div class="modal-body">

                                            <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">No masuk</span>

                                               <input type="text" name="id_masuk" id="no_batch"  class="form-control" autocomplete="off" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                  <span class="input-group-text" style="width: 9rem;">Tanggal masuk</span>
                                                  <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="<?= date('Y-m-d'); ?>" class="form-control" autocomplete="off" required> 
                                            </div>

                                            <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">Pengirim</span>

                                               <input type="text" name="pengirim" id="pengirim"  class="form-control" required>
                                            </div>

                                             <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">Penanggung J. </span>

                                               <input type="text" name="pj" class="form-control" required>
                                            </div>

                                              <button type="Reset" class="btn btn-link">Reset</button>
                                              
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              
                                              <button type="submit" id="doubleclick" name="barangmasuk" class="btn btn-primary ">Masukan</button>
                                            </div>
                                            
                                            </form>
                                            </div>
                                        </div>
                                      </div>


                                        <!-- Akhir tambah barang masuk -->
   
                                  <!-- Awal cari kategori-->
                                   <form action="" method="GET" class="form-inline mt-2 mb-2">
                                     <select name="bulan" class="form-control mr-1">

                                      <option value="null">Pilih Bulan Masuk</option>
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
                                        <option value="null">Pilih Tahun Masuk</option>
                                        <?= pilih_tahun_masuk(); ?>
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
                                            
                                            <th >No </th>
                                            <th >No masuk </th>
                                            <th >Tanggal masuk</th>
                                            <th >Pengirim</th>
                                            <th >Penanggung jawab</th>
                                            <th class="text-center">Aksi</th>

                                          </tr>

                                        </thead>
            
                                        <tbody>

                                                <!--  -->
                                              <?php 
                                              
                                              $no=1; 
                                              while($row = mysqli_fetch_assoc($result)){
                                               
                                              $no_stock_masuk = $row['id_masuk'];
                                              $tanggal_masuk = $row['tanggal_masuk'];
                                              $pengirim = $row['pengirim'];
                                              $pj = $row['pj'];

                                           
                                               ?>

                                               <!--  -->

                                        
                                                <tr>
                                                  <td ><?=$no++; ?> </td>
                                                  <td ><?=$no_stock_masuk; ?></td>
                                                  <td ><?=date('d-m-Y',strtotime($tanggal_masuk));  ?></td>
                                                  <td ><?=$pengirim; ?></td>
                                                  <td ><?=$pj; ?></td>

                                                 <td class="text-center">
                                                    
                                                    
                                                  <button type="button"  class="fa fa-edit mr-3" style="color: #6bb4ff;" data-toggle="modal" data-target="#edit<?=$no_stock_masuk;?>" title="Edit"></button>

                                                  <a  href="detail_barang_masuk.php?id_masuk=<?=$no_stock_masuk; ?>" title="Detail" style="text-decoration: none;" class="mr-3"><i class="fa fa-eye " style="color: #32CD32;" ></i> </a>

                                                  <button type="button" class="fa fa-trash" style="color: #e60003;" data-toggle="modal" data-target="#hapus<?=$no_stock_masuk;?>" title="Hapus "></button>
                                                  
                                                  
                                                  
                                               
                                                  </td> 
                                                   
                                                </tr>

                                         <!-- awal edit modal -->
                                            <div class="modal fade" id="edit<?=$no_stock_masuk ?>">

                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Edit no masuk <?= $no_stock_masuk; ?></h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->

                                                        <form action="function.php" method="POST">
                                                        <div class="modal-body">
                        
                                                          <input type="hidden" name="id_masuk" value="<?= $no_stock_masuk?>" class="form-control"  autocomplete="off">
                                                         
                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Tanggal masuk</span>
                                                            <input type="date" name="tanggal_masuk"  value="<?= $tanggal_masuk?>" class="form-control" autocomplete="off" required> 
                                                          </div>

                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Pengirim</span>
                                                            <input type="text" name="pengirim"  value="<?= $pengirim ?>" class="form-control" autocomplete="off" required> 
                                                          </div>

                                                           <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Penanggung</span>
                                                            <input type="text" name="pj"  value="<?= $pj ?>" class="form-control" autocomplete="off" required> 
                                                          </div>
                                                         
                                    
                                                          </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                          <button type="submit" name="editbarangmasuk" class="btn btn-primary">Edit barang masuk</button>
                                                        </div>
                                                         </form>
                                                        
                                                       </div>
                                                    </div>
                                                 </div> 


                                              <!-- akhir edit modal -->
                                                <!-- awal hapus modal -->
                                                <div class="modal fade" id="hapus<?=$no_stock_masuk;?>">

                                                      <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Hapus data barang</h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->

                                                        <form action="function.php" method="POST">
                                                        <div class="modal-body">

                                                           <input type="hidden" name="id_masuk" value="<?= $no_stock_masuk?>" class="form-control"  autocomplete="off">
                                                          
                                                          Apakah anda yakin ingin menghapus barang masuk dengan no <?= $no_stock_masuk ?> ? 
                                                          <br>
                                                    
                                                         
                                                     
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                          <p style="color: red; font-size: 13px;">*Note : Untuk menghapus barang masuk, hapus dulu semua barang didalam nomor masuk ini</p>
                                                          <button type="submit" name="hapusbarangmasuk" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                         </form>
                                                        </div>

                                                    </div>
                                                   </div> 

                                              <!-- akhir hapus modal -->

                                       

                                       
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
