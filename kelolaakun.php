<?php 

session_start();
include('function.php');



if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}


$query = "SELECT *FROM barang";
$result = mysqli_query($conn, $query);




if (isset($_POST['kelolaakun'])) {
     $username= trim($_POST['namapengguna']);
     $password= trim($_POST['password']);

     if ($username =="" || $password =="") {
        echo "<script>

      window.addEventListener('load',function(){
        
      Swal.fire('Gagal','Silahkan masukan nama pengguna dan password ','error');
      
      });

      </script>
    ";
     }

     $sql=mysqli_query($conn,"SELECT * FROM admin where username='$username'AND password='$password' ");

     if (mysqli_num_rows($sql) !=0) {
        $row =mysqli_fetch_assoc($sql);
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['akun']= true ;


      $nip = $row['nip'];

      $enkrip = base64_encode($nip);

    
        

        echo "<script>

      window.addEventListener('load',function(){
        
      Swal.fire('Berhasil','Login berhasil ','success');
      setTimeout(function(){

        document.location.href = 'akun.php?nip=$enkrip';


        },1000);
      });

      </script>
    ";
     }

     else{
       echo "<script>

      window.addEventListener('load',function(){
        
      Swal.fire('Gagal','Nama pengguna atau password salah ','error');
      
      });

      </script>
    ";
     }



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
        <link href="css/kelolaakun.css" rel="stylesheet" />
        
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
            <div id="layoutSidenav_content" style="background-image: url(img/tambahuser1.jpg);background-size: cover;">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active">Kelola akun</li>
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
                                  
                                 
                                  <!-- Awal tambah obat-->
                                      <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Tambah Barang Baru</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->

                                            <form action="function.php" method="POST">

                                            <div class="modal-body">
                                              <input type="text" name="nokode" placeholder="No Kode (Maksimal-12-karakter" class="form-control" required autocomplete="off">
                                              <br>
                                              <input type="text" name="namabarang" placeholder="Nama barang (Maksimal-25-karakter)" class="form-control" required autocomplete="off">
                                              <br>
                                             <input type="text" name="satuan" placeholder="Satuan Barang (Maksimal-20-karakter)" class="form-control" autocomplete="off" required>
                                             <br> 
                                            <input type="number" name="harga_perolehan" placeholder="Harga Perolehan (Rp)" class="form-control" autocomplete="off" required>
                                            <br> 
                                              <!-- <input type="text" name="keterangan" placeholder="Keterangan" class="form-control" autocomplete="off"><br> -->

                                             <input type="date" name="tanggal_daluwarsa" placeholder="" class="form-control" autocomplete="off" required>
                                            <br> 
                                              <div class="form-group">
                                                <textarea class="form-control" id="keterangan" rows="3" placeholder="Keterangan....." name="keterangan" autocomplete="off"></textarea>
                                             </div>
                                              
                                              <button type="reset" class="btn btn-link">Reset</button>
                                            </div>
                                           
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="submit" name="tambahdatabarang" class="btn btn-primary" >Masukan</button>
                                            </div>
                                             </form>
                                            </div>
                                        </div>

                                      </div>  


                                        <!-- Akhir tambah obat -->


                            
                            <div class="card-body  mt-4 bg-light shadow-lg" >

                              <!-- awal kelola akun -->
                              <h1 class="text-center konfirmasi">Konfirmasi pengguna</h1>

                                <form class="row g-3 mt-4 " action="" method="POST">
                                    <div class="col-md-6">
                                      <label for="inputusername" class="form-label">Nama pengguna</label>
                                      <input type="text" class="form-control" id="inputusername" name="namapengguna">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="inputPassword4" class="form-label">Password</label>
                                      <input type="password" class="form-control" id="inputPassword4" name="password">
                                    </div>
                                    <!-- <div class="col-12">
                                      <label for="inputAddress" class="form-label">Address</label>
                                      <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                    </div>
                                    <div class="col-12">
                                      <label for="inputAddress2" class="form-label">Address 2</label>
                                      <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                    </div>
                                    <div class="col-md-6">
                                      <label for="inputCity" class="form-label">City</label>
                                      <input type="text" class="form-control" id="inputCity">
                                    </div> -->
                                   <!--  <div class="col-md-4">
                                      <label for="inputState" class="form-label">State</label>
                                      <select id="inputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                      </select>
                                    </div> -->
                                   <!--  <div class="col-md-2">
                                      <label for="inputZip" class="form-label">Zip</label>
                                      <input type="text" class="form-control" id="inputZip">
                                    </div> -->
                                   <!--  <div class="col-12">
                                      <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                          Check me out
                                        </label>
                                      </div>
                                    </div> -->
                                    <div class="col-12 text-right mt-4">
                                      <a href="lupasandi.php" class="btn btn-link ">Lupa password ? </a>
                                      <button type="submit" class="btn btn-primary" name="kelolaakun">konfirmasi</button>
                                    </div>
                                  </form>
                              <!-- akhir kelola akun -->
                            

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
