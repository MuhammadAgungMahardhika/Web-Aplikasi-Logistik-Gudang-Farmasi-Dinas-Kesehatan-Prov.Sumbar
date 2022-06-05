<?php 

session_start();
include('function.php');




if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}


$query = "SELECT *FROM obat";
$result = mysqli_query($conn, $query);

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
        <link href="css/obat.css" rel="stylesheet" />
       
        <!-- data table -->
        <link rel="stylesheet" type="text/css" href="js/DataTables-1.10.23/css/dataTables.bootstrap4.min.css"/>

        <!-- font awesome -->
        <script src="fontawesome-free-5.15.2-web/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">Dinkes Sumbar</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" >
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Activity Log</a>
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
                                     <a class="nav-link " href="obat.php"><i class="fa fa-medkit mr-2"> </i> Data Obat</a>
                                    <a class="nav-link" href="alkes.php"><i class="fa fa-stethoscope mr-2"> </i>Data Alkes</a>
                                    <a class="nav-link" href="vaksin.php"><i class="fa fa-sticky-note mr-2"> </i>Data Vaksin</a>
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
                                    <a class="nav-link" href="barangmasuk.php">Barang Masuk</a>
                                    <a class="nav-link" href="barangkeluar.php">Barang Keluar</a>
                                    
                                </nav>
                            </div>

                                <!-- akhir transaksi -->

                           
                            <div class="sb-sidenav-menu-heading">Transaksi</div>
                            <!-- <a class="nav-link" href="barangmasuk.php">
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="barangkeluar.php">
                                <div class="sb-nav-link-icon"><i class=""></i></div>
                                Barang Keluar
                            </a> -->
                        </div>

                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        SISTEM INFORMASI LOGISTIK
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active">Data Vaksin</li>
                            <li class="breadcrumb-item"> <?= date('H:i '); ?></li>
                            <li class="breadcrumb-item"> <?= date('l-d-M-Y'); ?> </li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">


                                 <!-- Button to Open the Modal -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                                    Tambah Obat
                                  </button>

                                  <!-- Awal tambah obat-->
                                      <div class="modal fade" id="myModal">
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                          
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Tambah Obat</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            
                                            <!-- Modal body -->

                                            <form action="function.php" method="POST">
                                            <div class="modal-body">
                                              <input type="text" name="nokode" placeholder="No Kode" class="form-control"><br>
                                              <input type="text" name="namaobat" placeholder="Nama Obat" class="form-control"><br>
                                              <input type="number" name="penerimaan" placeholder="Penerimaan" class="form-control"><br>
                                              <input type="number" name="pengeluaran" placeholder="Pengeluaran" class="form-control"><br>
                                              <input type="text" name="keterangan" placeholder="Keterangan" class="form-control"><br>
                                              <button type="submit" name="tambahdataobat" class="btn btn-primary">Masukan</button>
                                            </div>
                                            </form>
                                            
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                            
                                            </div>
                                        </div>


                                        <!-- Akhir tambah obat -->


                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                      <tr>
                        
                        <th class="text-center">Nama Barang</th>
                        <th class="text-center">Penerimaan</th>
                        <th class="text-center">Pengeluaran</th>
                        <th class="text-center">Sisa Stok</th>
                        <th class="text-center">Aksi</th>
                        <th>Tambah</th>
                      </tr>

                    </thead>
            
                    <tbody>

                      <!--  -->
                      <?php 

                        
                      while ($row = mysqli_fetch_assoc($result)) {
                     

                      

                       ?>

                       <!--  -->
                        <tr>
                          <th ><?=$row['nama_obat']; ?></th>

                          <td class="text-center"><?=$row['penerimaan']; ?></td>
                          <td class="text-center"><?=$row['pengeluaran']; ?></td>
                          <td class="text-center"><?= sisa_stok($row['penerimaan'],$row['pengeluaran']) ?></td>
                          <td class="text-center">

                            
                                <a href="detail_obat.php?id=<?=$row['no_kode']; ?>"title="Detail Data Obat" ><button class="fa fa-info mr-3"></button></a>

                                <a href="register.html"  title="Hapus Data Obat"><button class="fa fa-trash "></button></a>
                          
                          
                           
                          </td> 
                          <td> 6</td> 
                        </tr>


                        
                     

                      <!--  -->
                    <?php  

                      } ?>

                      <!--  -->
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
               <script src="js/jquery/jquery-3.5.1.slim.js" crossorigin="anonymous"></script>
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
