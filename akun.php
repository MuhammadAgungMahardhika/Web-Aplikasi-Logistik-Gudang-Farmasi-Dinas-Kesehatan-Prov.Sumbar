<?php
require 'function.php';
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit; 
}else if (!isset($_SESSION['akun'])) {
  header("Location: kelolaakun.php");
  exit;
}

$dekrip = $_GET['nip'];

$nip = base64_decode($dekrip); 


if (isset($_POST["buatakun"])) {
    


   tambahuser($_POST);


}
    


?>
<!DOCTYPE html>
<html lang="en">
    <heabald>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SISTEM INFORMASI LOGISTIK DINAS KESEHATAN</title>
         <link rel="icon" href="img/dinkes.png">
        <link href="css/obat.css" rel="stylesheet" />
        
        <!-- data table -->
        <link rel="stylesheet" type="text/css" href="js/DataTables-1.10.23/css/dataTables.bootstrap4.min.css"/>

        <!-- font awesome -->
        <script src="fontawesome-free-5.15.2-web/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    
    <body class="sb-nav-fixed" style="font-family: roboto">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
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
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
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
            <div id="layoutSidenav_content" >
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active">Akun</li>
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
                            <li class="breadcrumb-item"> <?= date('l-d-M-Y'); ?> </li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                  
                                 <button class="btn btn-success" data-toggle="modal" data-target="#myModal" title="Tambah pengguna baru">Tambah pengguna baru</button>


                                  <!-- Awal tambah obat-->
                                      <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Tambah pengguna baru</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->

                                            <form action="" method="POST">

                                            <div class="modal-body">
                                              
                                              <input type="text" name="nip" placeholder="Masukan Nomor Induk Pegawai" class="form-control" required autocomplete="off">
                                              <br>
                                              <input type="text" name="namapengguna" placeholder="Nama pengguna" class="form-control" required autocomplete="off">
                                              <br>
                                              <input type="text" name="alamat" placeholder="Alamat" class="form-control"  autocomplete="off">
                                              <br>
                                              <input type="email" name="email" placeholder="Email" class="form-control"  autocomplete="off">
                                              <br>
                                              <input type="text" name="no_hp" placeholder="No hp" class="form-control"  autocomplete="off">
                                              <br>
                                              <input type="date" name="tanggal_lahir" placeholder="Tanggal lahir" class="form-control" required autocomplete="off">
                                              <br>
                                             <input type="Password" name="password" placeholder="Masukan password" class="form-control" autocomplete="off" required>
                                             <br> 
                                            <input type="Password" name="konfirmasi" placeholder="Masukan ulang password" class="form-control" autocomplete="off" required>
                                            <br> 
                                              <!-- <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" autocomplete="off"><br> -->

                                            
                                              
                                              <button type="reset" class="btn btn-link">Reset</button>
                                            </div>
                                           
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="submit" name="buatakun" class="btn btn-primary" >Masukan</button>
                                            </div>
                                             </form>
                                            </div>
                                        </div>

                                      </div>  


                                        <!-- Akhir tambah obat -->


                            
                            <div class="card-body  mt-4 bg-light shadow-lg " >

                              <!-- awal kelola akun -->
                              <h1 class="text-center">Data pengguna</h1>

                            <?php 


                            $result = mysqli_query($conn,"SELECT * FROM admin WHERE nip = '$nip' ");

                            while ($row = mysqli_fetch_assoc($result)) {
                           
                             ?>

                               <form class="row g-3 mt-4" method="POST" action="function.php">
                                          
                                            <label for="validationDefault01" class="form-label"></label>
                                            <input type="hidden" name="nip" class="form-control" id="validationDefault01" value="<?=$row['nip'] ?>"  required>
                                         
                                          <div class="col-md-4">
                                            <label for="validationDefault02" class="form-label">Nama pengguna</label>
                                            <input type="text" name="namapengguna" class="form-control" id="validationDefault02" value="<?=$row['username'] ?>" required>
                                          </div>

                                          <div class="col-md-4">
                                            <label for="validationDefault02" class="form-label">Alamat</label>
                                            <input type="text" name="alamat" class="form-control" id="validationDefault02" value="<?=$row['alamat'] ?>">
                                          </div>
                                          
                                          <div class="col-md-4">
                                            <label for="validationDefault02" class="form-label">E-mail</label>
                                            <input type="email" name="email" class="form-control" id="validationDefault02" value="<?=$row['email'] ?>" required>
                                          </div>

                                          <div class="col-md-4">
                                            <label for="validationDefault02" class="form-label">No hp</label>
                                            <input type="number" name="no_hp" class="form-control" id="validationDefault02" value="<?=$row['no_hp'] ?>" >
                                          </div>

                                          <div class="col-md-4">
                                            <label for="validationDefault02" class="form-label">Tanggal lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" id="validationDefault02" value="<?=$row['tanggal_lahir'] ?>" required>
                                          </div>

                                          <div class="col-md-4">
                                            <label for="inputPassword4" class="form-label">Password</label>
                                            <div class="input-group">
                                             
                                              <input type="text" name="password" class="form-control" id="inputPassword4" value="<?=$row['password'] ?>" required>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            
                                          </div>
                                          <div class="col-md-3">
                                            <!-- <label for="validationDefault04" class="form-label">State</label>
                                            <select class="form-select" id="validationDefault04" required>
                                              <option selected disabled value="">Choose...</option>
                                              <option>Indonesia</option>
                                              <option>Malaysia</option>
                                            </select> -->
                                          </div>
                                          <div class="col-md-3">
                                            <!-- <label for="validationDefault05" class="form-label">Zip</label>
                                            <input type="text" class="form-control" id="validationDefault05" required> -->
                                          </div>
                                          <div class="col-12 mt-4">
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                              <label class="form-check-label" for="invalidCheck2">
                                                check
                                              </label>
                                            </div>
                                          </div>
                                          <div class="col-12">
                                            <button class="btn btn-primary mt-4" type="submit" name="editpengguna">Ubah data</button>
                                            <a href="logoutakun.php" class="btn btn-danger mt-4">Keluar</a>
                                          </div>
                                        </form>
                              <!-- akhir kelola akun -->
                            <?php   
                            }
 ?>

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
