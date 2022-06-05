<?php 
session_start();
include('function.php');

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}

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

if (isset($_GET['kadaluarsa'])) {

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
WHERE 
detail_barang_masuk.id_masuk = '$id_masuk'
";
 
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
                            <li class="breadcrumb-item"><a href="barangmasuk.php">Barang masuk</a></li>

                            <li class="breadcrumb-item active">Detail Barang Masuk </li>
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
                                   <i class="fas fa-plus-square fa-lg"></i>  Barang 
                                  </button>


                                 <a href="ekspor/export_detail_barang_masuk.php?id_masuk=<?=$id_masuk; ?>" class="btn btn-info">Ekspor</a>
                                  
                                  
                                  


                            </div>

                              <!-- Awal tambah barang masuk-->
                                      <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Barang Masuk </h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->

                                            <form action="function.php" method="POST">
                                            <div class="modal-body">

                                            <input type="hidden" name="id_masuk" value="<?=$id_masuk;?>">
                                 
                                            <div class="input-group mb-3">
                                               <span class="input-group-text" style="width: 9rem;">Nama barang</span>
                                              <select name="id_barang" class="form-control">
                                               <?php 
                                                
                                                $query_bar = "SELECT * from barang where
                                                NOT EXISTS (select id_barang from detail_barang_masuk where barang.id_barang= detail_barang_masuk.id_barang AND detail_barang_masuk.id_masuk = '$id_masuk')  
                                                ORDER BY nama_barang ASC ";
                                                
                                                $result_bar = mysqli_query($conn,$query_bar);

                                                while ($row1 = mysqli_fetch_assoc($result_bar)) {
                                                   $nama_barang = $row1['nama_barang'];
                                                   $id_barang = $row1['id_barang'];

                                                

                                                ?>

                                                <option value="<?= $id_barang; ?>"> <?= $nama_barang ; ?></option>

                                                <?php 
                                                }
                                                ?>
                                           </select> 
                                        </div>


                                        
                                         <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">Jumlah masuk</span>

                                               <input type="number" name="kuantitas" id="kuantitas"  class="form-control" autocomplete="off" required>
                                        </div>

                                         <div class="input-group mb-3">
                                                <span class="input-group-text" style="width: 9rem;">Satuan</span>
                                                 <select name="satuan" id="satuan" class="form-control bg-light" required>
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM satuan ORDER BY satuan";
                                                                $result_st = mysqli_query($conn, $query);
                                                while ($row_st = mysqli_fetch_assoc($result_st)) {
                                                                   $satuan= $row_st['satuan'];
                                                                   $id_satuan = $row_st['id_satuan'];
                                                                  

                                                                

                                                                ?>

                                                                <option value="<?= $id_satuan; ?>"><?= $satuan; ?></option>

                                                                <?php 
                                                                }
                                                                ?>
                                                                <option value="" selected="">-pilih satuan barang-</option>
                                            </select>
                                            </div>
                                         
                                        
                                        <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">Sumber</span>

                                                <select name="sumber" id="sumber" class="form-control bg-light" required>
                                               <?php 
                                                
                                               $query = "SELECT * FROM sumber ORDER BY sumber";
                                                $result_s = mysqli_query($conn, $query);
                                                while ($row_s = mysqli_fetch_assoc($result_s)) {
                                                   $sumber= $row_s['sumber'];
                                                   $id_sumber = $row_s['id_sumber'];
                                                  

                              
                                                ?>

                                                <option value="<?= $id_sumber; ?>"><?= $sumber; ?></option>

                                                <?php 
                                                }
                                                ?>
                                                 <option value="" selected="">-pilih sumber barang-</option>
                                           </select>
                                        </div>
                                        <div class="input-group mb-3">
                                                <span class="input-group-text" style="width: 9rem;">Harga satuan</span>
                                                 <input type="number" name="harga_perolehan" id="harga_perolehan" placeholder="IDR" class="form-control" autocomplete="off" required>
                                        </div>

                                        <div class="input-group mb-3">
                                              <span class="input-group-text" style="width: 9rem;">No batch</span>

                                               <input type="text" name="no_batch" id="no_batch"  class="form-control" autocomplete="off" required> 
                                        </div>

                                         
                                            
                                            <div class="input-group mb-3">
                                                  <span class="input-group-text" style="width: 9rem;">Kadaluarsa</span>
                                                  <input type="date" name="tanggal_daluwarsa" id="tanggal_daluwarsa" class="form-control" autocomplete="off" required> 
                                            </div>
                                          

                                             <div class="input-group mb-3">
                                                 <span class="input-group-text" style="width: 9rem;">Keterangan</span>
                                                   <textarea class="form-control" id="ket_masuk" rows="3"  name="ket_masuk" autocomplete="off"></textarea>
                                            </div>
                                             


                                              <button type="Reset" class="btn btn-link">Reset</button>
                                              
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              
                                <button type="submit" id="doubleclick" name="detail_barang_masuk" class="btn btn-primary ">Masukan</button>
                                            </div>
                                            
                                            </form>
                                            </div>
                                        </div>
                                      </div>


                                        <!-- Akhir tambah barang masuk -->
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
                                            <th class="text-center">Aksi</th>
                                            
                                         
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
                                                  <td class="text-center"> 
                                                    
                                                  <button type="button"  class="fa fa-edit mr-3" style="color: #6bb4ff;" data-toggle="modal" data-target="#edit<?=$id_barang;?>&&<?=$no_stock_masuk; ?>" title="Edit"></button>

                                                  
                                                   <button type="button" class="fa fa-trash " style="color: #e60003;" data-toggle="modal" data-target="#hapus<?=$id_barang;?>&&<?=$no_stock_masuk; ?>" title="Hapus "></button>
                                                  
                                                  </td> 
                                                   
                                                </tr>

                                         <!-- awal edit modal -->
                                            <div class="modal fade" id="edit<?=$id_barang;?>&&<?=$no_stock_masuk ?>">

                                                    <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title"><?= $no_stock_masuk ?> - 
                                                            <?=$nama_barang ?></h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->

                                                        <form action="function.php" method="POST">
                                                        <div class="modal-body">
                        
                                                          <input type="hidden" name="id_masuk" value="<?= $no_stock_masuk?>" class="form-control"  autocomplete="off">
                                                           <input type="hidden" name="id_barang" value="<?= $id_barang?>" class="form-control"  autocomplete="off">

                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">satuan</span>
                                                            <select name="satuan" class="form-control">
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM satuan WHERE id_satuan != $id_satuan";
                                                                $result_sb = mysqli_query($conn, $query);
                                                                while ($row_sb = mysqli_fetch_assoc($result_sb)) {
                                                                   $satuan1= $row_sb['satuan'];
                                                                   $id_satuan1 = $row_sb['id_satuan'];
                                                                  

                                                                

                                                                ?>

                                                                <option value="<?= $id_satuan1; ?>"><?= $satuan1; ?></option>

                                                                <?php 
                                                                }
                                                                ?>
                                                                <option value="<?= $id_satuan ?>" selected="" id="satuan1"><?= $satuan ?></option>
                                                           </select>
                                                           
                                                          </div>


                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Sumber</span>
                                                            <select name="sumber" class="form-control">
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM sumber WHERE id_sumber != $id_sumber";
                                                                $result_sb = mysqli_query($conn, $query);
                                                                while ($row_sb = mysqli_fetch_assoc($result_sb)) {
                                                                   $sumber1= $row_sb['sumber'];
                                                                   $id_sumber1 = $row_sb['id_sumber'];
                                                                

                                                                ?>

                                                                <option value="<?= $id_sumber1; ?>"><?= $sumber1; ?></option>

                                                                <?php 
                                                                }
                                                                ?>
                                                                <option value="<?= $id_sumber ?>" selected="" id="sumber1"><?= $sumber ?></option>
                                                           </select>
                                                           
                                                          </div>
                                                           <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Harga perolehan</span>
                                                            <input type="number" name="harga_perolehan" value="<?= $harga_perolehan?>" class="form-control"  autocomplete="off">
                                                          </div>

                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Batch</span>
                                                            <input type="text" name="no_batch" value="<?= $no_batch?>" class="form-control"  autocomplete="off">
                                                          </div>
                                  
                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text " style="width: 9rem;">Kadaluarsa</span>
                                                            <input type="date" name="tanggal_daluwarsa"  value="<?= $tanggal_daluwarsa?>" class="form-control" autocomplete="off" required> 
                                                          </div>

                                                          <div class="input-group mb-3">
                                                            <span class="input-group-text" style="width: 9rem;">Keterangan</span>
                                                            <input type="textarea" name="ket_masuk" value="<?= $ket_masuk ?>" class="form-control" autocomplete="off" > 
                                                          </div>
                                    
                                                          </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                          <button type="submit" name="edit_detail_barang_masuk" class="btn btn-primary">Edit barang masuk</button>
                                                        </div>
                                                         </form>
                                                        
                                                       </div>
                                                    </div>
                                                 </div> 


                                              <!-- akhir edit modal -->

                                              <!-- awal hapus modal -->
                                                <div class="modal fade" id="hapus<?=$id_barang;?>&&<?=$no_stock_masuk; ?>">

                                                      <div class="modal-dialog">
                                                      <div class="modal-content">
                                                      
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                          <h4 class="modal-title">Hapus detail barang masuk</h4>
                                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        
                                                        <!-- Modal body -->

                                                        <form action="function.php" method="POST">
                                                        <div class="modal-body">

                                                          <input type="hidden" name="id_masuk" value="<?= $no_stock_masuk?>" class="form-control"  autocomplete="off">
                                                           <input type="hidden" name="id_barang" value="<?= $id_barang?>" class="form-control"  autocomplete="off">
                                                          
                                                          Apakah anda yakin ingin menghapus barang <?= $nama_barang; ?> dari no masuk <?= $no_stock_masuk; ?>? 
                                                          <br>
                                                    
                                                         
                                                     
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                          <p style="color: red; font-size: 13px;">*Note : Jika barang dihapus, maka semua data transaksi yang terkait dengan barang dengan no masuk ini juga ikut terhapus (termasuk barang keluar)</p>
                                                          <button type="submit" name="hapusdetailbarangmasuk" class="btn btn-danger">Hapus</button>
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
