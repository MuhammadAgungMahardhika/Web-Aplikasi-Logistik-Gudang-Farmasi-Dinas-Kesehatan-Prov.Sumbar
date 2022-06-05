<?php 
session_start();
include('function.php');

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}


$query = "SELECT barang.id_barang,
barang.nama_barang,
barang.id_jenis_barang,
jenis_barang.id_jenis_barang,
jenis_barang.jenis_barang,
satuan.satuan ,
detail_barang_masuk.stok FROM barang 
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang 
LEFT JOIN  detail_barang_masuk
on detail_barang_masuk.id_barang = barang.id_barang
LEFT JOIN satuan 
on  satuan.id_satuan = detail_barang_masuk.id_satuan 
ORDER BY barang.id_barang DESC LIMIT 0";
$result = mysqli_query($conn, $query);

if (isset($_GET['menukategori'])) {
$jenis_barang = $_GET['jenis_barang'];

  if ($jenis_barang=='null') {
   header('Location:obat.php');
  }else if ($jenis_barang) {
   
   $query = "SELECT barang.id_barang,
barang.nama_barang,
barang.id_jenis_barang,
jenis_barang.id_jenis_barang,
jenis_barang.jenis_barang,
satuan.satuan ,
detail_barang_masuk.stok FROM barang 
LEFT JOIN jenis_barang 
on jenis_barang.id_jenis_barang = barang.id_jenis_barang 
LEFT JOIN  detail_barang_masuk
on detail_barang_masuk.id_barang = barang.id_barang
LEFT JOIN satuan 
on  satuan.id_satuan = detail_barang_masuk.id_satuan
WHERE jenis_barang = '$jenis_barang'";
  
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
        <meta name="description" content=""/>
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
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div> Data
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
                                  Kategori Barang
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
                            <li class="breadcrumb-item active">Barang</li>
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
                            <li class="breadcrumb-item"> <?= date('l - d - m - Y'); ?> </li>
                        </ol>
                        
                        <div class="card mb-4 ">
                            <div class="card-header">

                                 <!-- Button to Open the Modal -->
                                 
                                   <div class="col">
                                    
                                    <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#myModal" title="Tambah Data Barang Baru">
                                    <i class="fas fa-plus-square fa-lg"></i> Tambah Barang
                                    </button>

                                   

                                    <a class="btn btn-info" href="laporan_barang.php">Laporan Barang</a>

                                    <!-- Awal jenis barang -->
                                   <form action="" method="GET" class="form-inline mt-2 mb-2">
                                     <select name="jenis_barang" class="form-control mr-1">

                                      <option value="null">Pilih jenis barang</option>
                                       <?= pilih_jenis_barang(); ?>
                                       
                                     </select>
                                      
                                     <button type="submit" name="menukategori" class="btn btn-primary pt-2 pb-2 mr-2"><i class="fas fa-sync-alt"></i></button>

                                   </form>

                                 </div>
                             
                                   <!-- Akhir jenis barang -->

                                 
                                  <!-- Awal tambah Barang-->  

                                   <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Tambah barang </h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->
                                            <form action="function.php" method="POST">
                                         
                                              <div class="modal-body">

                                              <div class="input-group mb-3">
                                                <span class="input-group-text" style="width: 9rem;">Nama barang</span>
                                                 <input type="text" name="namabarang" id="nama_barang" class="form-control" required autocomplete="off">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" style="width: 9rem;">Jenis barang</span>
                                                <select name="jenis_barang" id="jenis_barang" class="form-control bg-light" required>
                                                         <?php 
                                                
                                               $query = "SELECT * FROM jenis_barang ORDER BY jenis_barang";
                                                $result1 = mysqli_query($conn, $query);
                                                while ($row1 = mysqli_fetch_assoc($result1)) {
                                                   $jenis_barang= $row1['jenis_barang'];
                                                   $id_jenis_barang = $row1['id_jenis_barang'];
                                                  

                                                

                                                ?>

                                                <option value="<?= $id_jenis_barang; ?>" ><?= $jenis_barang; ?></option>

                                                <?php 
                                                }
                                                ?>
                                                <option value="" selected="">-pilih jenis barang-</option>
                                           </select>
                                            </div>

                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="submit" id="doubleclick" name="tambahdatabarang" class="btn btn-primary ">Masukan</button>
                                            </div>
                                                
                                         </form>
                                            </div>
                                        </div>
                                      </div>

                                             

                                      
                                  <!-- Akhir tambah barang-->  
  
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                        <thead>
                                          <tr>
                                            <th >No </th>
                                            <th >Nama Barang</th>
                                            <th >Jenis Barang</th>
                                            <th >Satuan</th>
                                            <th >Stok</th>
                                            <th class="text-center">Aksi</th>
                                          </tr>

                                        </thead>
            
                                            <tbody>

                                              <!--  -->
                                              <?php 

                                            


                                              $no = 1;
                                              while ($row = mysqli_fetch_assoc($result)) {

                                             $id_barang = $row['id_barang'];
                                             $namabarang = $row['nama_barang'];
                                             $jenis_barang =$row['jenis_barang'];
                                             $id_jenis_barang =$row['id_jenis_barang'];
                                             $satuan = $row['satuan'];
                                             $stok = $row['stok'];
                                        
                                             

                                               ?>

                                               <!--  -->
                                                <tr>
                                                  <td ><?= $no++ ?></td>
                                                  <td ><?= $namabarang ?></td>
                                                  <td ><?= $jenis_barang ?></td>
                                                  <td ><?= $satuan ?></td>
                                                  <td ><?= $stok; ?></td>
                                                  <td class="text-center">
                                                   
                                                  <button type="button"  class="fa fa-edit mr-3" style="color: #6bb4ff;" data-toggle="modal" data-target="#edit<?=$id_barang;?>" title="Edit"></button>

                                                  <button type="button" class="fa fa-trash" style="color: #e60003;" data-toggle="modal" data-target="#hapus<?=$id_barang;?>" title="Hapus "></button>
                                                  
                                                  
                                                   
                                                  </td> 
                                                </tr>   

                                                 <!-- awal edit modal -->
                                                <div class="modal fade" id="edit<?=$id_barang;?>">

                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Edit Data Barang</h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->

                                          <form action="function.php" method="POST">
                                           <div class="modal-body">
                        
                                       <input type="hidden" name="id_barang" value="<?=$id_barang?>" class="form-control" >

                                              <div class="input-group mb-3">
                                                 <span class="input-group-text" style="width: 9rem;">Nama barang</span>
                                                   <input type="text" name="nama_barang" value="<?= $namabarang ?>" class="form-control" autocomplete="off" required> 
                                               </div>
                                               <div class="input-group mb-3">
                                                 <span class="input-group-text" style="width: 9rem;">Jenis barang</span>
                                                    <select name="jenis_barang" class="form-control">
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM jenis_barang";
                                                                $result_jb = mysqli_query($conn, $query);
                                                                while ($row_jb = mysqli_fetch_assoc($result_jb)) {
                                                                   $jenis_barang1= $row_jb['jenis_barang'];
                                                                   $id_jenis_barang1 = $row_jb['id_jenis_barang'];
                                                                  

                                                                

                                                                ?>

                                                                <option value="<?= $id_jenis_barang1; ?>"><?= $jenis_barang1; ?></option>

                                                                <?php 
                                                                }
                                                                ?>

                                                                <option value="<?= $id_jenis_barang ?>" selected=""><?= $jenis_barang ?></option>
                                                           </select> 
                                               </div>
                                              
                                                    </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                          <button type="submit" name="editbarang" class="btn btn-primary">Edit barang</button>
                                                        </div>
                                                         </form>
                                                        
                                                       </div>
                                                    </div>
                                                 </div> 


                                              <!-- akhir edit modal -->

                                               <!-- awal hapus modal -->
                                                <div class="modal fade" id="hapus<?=$id_barang;?>">

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
                                                           <input type="hidden" name="id_barang" value="<?= $id_barang?>" class="form-control"  autocomplete="off">
                                                          Apakah anda yakin ingin menghapus <?= $namabarang ?> ? 
                                                         
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                          <p style="color: red; font-size: 13px;">*Note : Barang yang bisa dihapus adalah barang yang belum pernah melakukan transaksi</p>
                                                          <button type="submit" name="hapusbarang" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                         </form>
                                                        </div>

                                                    </div>
                                                   </div> 

                                              <!-- akhir hapus modal -->
                                            <?php  } ?>
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
          


               <!-- Sweetalert -->
              <script src="js/dist/sweetalert2.all.min.js"></script>

                <!-- Jquery -->
               <script src="js/jquery/jquery-3.5.1.js" ></script>
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
