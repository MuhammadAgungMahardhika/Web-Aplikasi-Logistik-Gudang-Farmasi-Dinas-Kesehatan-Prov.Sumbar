<?php 
session_start();
include('function.php');

if (!isset($_SESSION['login'])) {
  header("Location: index.php");
  exit; 
}
$yearnow = date('Y');

$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$yearnow' ";
$result = mysqli_query($conn,$query);


if(isset($_GET['menukategori'])){
  $bulan1 = $_GET['bulan1'];
  $bulan2 = $_GET['bulan2'];
  $tahun = $_GET['tahun'];
  $sumber = $_GET['sumber'];
  $yearnow = date('Y');

if ($bulan1=='null'&& $bulan2=='null' && $tahun=='null' && $sumber=='null') {
   header('Location:laporan_barang.php');

 }else if($bulan1 && $bulan2=='null' && $tahun=='null' && $sumber=='null') {
$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$yearnow' AND month(tanggal_masuk) = '$bulan1'  ";

 }else if($bulan1=='null' && $bulan2=='null' && $tahun=='null' && $sumber) {
$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE sumber.sumber = '$sumber'  ";

 }else if($bulan1 && $bulan2=='null' && $tahun=='null' && $sumber) {
$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE sumber.sumber = '$sumber' 
AND month(tanggal_masuk) = '$bulan1' 
AND year(tanggal_masuk) = '$yearnow' ";

 }else if ($bulan1=='null' && $bulan2 && $tahun=='null' && $sumber=='null') {
 $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$yearnow' 
AND month(tanggal_masuk) = '$bulan2'  ";
 }else if($bulan1=='null' && $bulan2 && $tahun=='null' && $sumber) {
$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE sumber.sumber = '$sumber' 
AND month(tanggal_masuk) = '$bulan2' 
AND year(tanggal_masuk) = '$yearnow' ";

 }else if($bulan1=='null' && $bulan2=='null' && $tahun && $sumber) {
$query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE sumber.sumber = '$sumber'  
AND year(tanggal_masuk) = '$tahun' ";

 }elseif ($bulan1=='null' && $bulan2=='null'&& $tahun && $sumber=='null') {
  $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$tahun' ";
 }else if ($bulan1 && $bulan2 && $tahun=='null' && $sumber=='null') {
    $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$yearnow' AND month(tanggal_masuk) between '$bulan1' 
AND '$bulan2' ";
 }elseif ($bulan1 && $bulan2=='null' && $tahun && $sumber=='null') {
 $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$tahun' 
AND month(tanggal_masuk)= '$bulan1' ";
 }elseif ($bulan1 && $bulan2=='null' && $tahun && $sumber) {
 $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$tahun' 
AND month(tanggal_masuk)= '$bulan1' 
AND sumber.sumber = '$sumber' ";
 }elseif ($bulan1=='null'&& $bulan2 && $tahun && $sumber=='null') {
  $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$tahun' 
AND month(tanggal_masuk) = '$bulan2' ";
 }elseif ($bulan1 && $bulan2 && $tahun && $sumber=='null') {
   $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$tahun' 
AND month(tanggal_masuk) between '$bulan1' 
AND '$bulan2' ";
 }elseif ($bulan1 && $bulan2 && $tahun=='null' && $sumber) {
   $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE  month(tanggal_masuk) between '$bulan1' 
AND '$bulan2' 
AND sumber.sumber = '$sumber' ";
 }elseif ($bulan1 && $bulan2 && $tahun && $sumber) {
   $query = "SELECT *FROM detail_barang_masuk 
LEFT JOIN detail_barang_keluar 
on detail_barang_keluar.id_barang = detail_barang_masuk.id_barang and
detail_barang_keluar.id_masuk = detail_barang_masuk.id_masuk
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
WHERE year(tanggal_masuk) = '$tahun' 
AND month(tanggal_masuk) between '$bulan1' 
AND '$bulan2' 
AND sumber.sumber = '$sumber' ";
 }

    $result = mysqli_query($conn,$query);

}



?>


<!DOCTYPE html>
<html lang="en">
    <heabald>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content=""/>
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
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" >
            <a class="navbar-brand" href="index.php">Dinkes Sumbar</a>
            <button class="btn btn-link btn-lg order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="barangmasuk.php" method="GET">
              <!--   <div class="input-group">
                    <input class="form-control" name="cari" type="text" placeholder="Cari barang.." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" />
                    <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" name="menucari"><i class="fas fa-search"></i></button>
                    </div>
                </div> -->
            </form>
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
                            <li class="breadcrumb-item active">Data Barang</li>
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
                                              <!--  <a href="ekspor/pdf.php" class="btn btn-danger " target="_blank" title="Ekspor to PDF" style=""><i class="fas fa-file-pdf" ></i>  PDF</a> -->


                                   <!-- Akhir ekspor -->


                                    <!-- Awal jenis barang -->
                                   <!-- <form action="" method="GET" class="form-inline mt-2 mb-2">
                                    


                                      
                                     <button type="submit" name="menukategori" class="btn btn-primary pt-2 pb-2 mr-2"><i class="fas fa-sync-alt"></i></button>

                                   </form>
 -->
                                
                             
                                   <!-- Akhir jenis barang -->

                                          <!-- Awal cari kategori-->
                                   <form action="" method="GET" class="form-inline mt-2 mb-2">
                                     <select name="bulan1" class="form-control mr-1">

                                      <option value="null">Dari bulan </option>
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
                                     <select name="bulan2" class="form-control mr-1">

                                      <option value="null">Ke bulan</option>
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
                                        <option value="null">Pilih Tahun </option>
                                        <?= pilih_tahun_masuk(); ?>
                                       </select>


                                        <select name="sumber" class="form-control mr-1">

                                      <option value="null">Pilih sumber</option>
                                       <?= pilih_sumber(); ?>
                                       
                                     </select>

                                     

                                     <button type="submit" name="menukategori" class="btn btn-primary pt-2 pb-2 ml-1 mr-2"><i class="fas fa-sync-alt"></i></button>

                                   </form>
                                   <!-- Akhir cari kategori -->

                                    </div>
                                  
                                  
  
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                        <thead>
                                          <tr>
                                            <th colspan="11" class="text-center">Laporan Data Barang</th>
                                          </tr>
                                          <tr>
                                            <th >No </th>
                                            <th >Nama Barang</th>
                                            <th >Satuan</th>
                                            <th >Stok awal</th>
                                            <th >Perolehan</th>
                                            <!-- <th >Pengembalian</th> -->
                                            <th >Pengeluaran</th>
                                            <th >Harga Perolehan</th>
                                            <th >Batch</th>
                                            <th >Stok akhir</th> 
                                            <th >Sumber</th>
                                           
                                          </tr>

                                        </thead>
            
                                            <tbody>

                                              <!--  -->
                                              <?php 

                                            


                                              $no = 1;
                                              while ($row = mysqli_fetch_assoc($result)) {

                                             $id_barang = $row['id_barang'];
                                             $namabarang = $row['nama_barang'];
                                             $satuan = $row['satuan'];
                                             $id_satuan = $row['id_satuan'];
                                             $stok = $row['stok'];
                                             $pemasukan = $row['pemasukan'];
                                             $pengeluaran = $row['pengeluaran'];
                                             $harga_perolehan = $row['harga_perolehan'];
                                             $no_batch = $row['no_batch'];
                                             $sumber = $row['sumber'];
                                             $id_sumber = $row['id_sumber'];
                                            
                                             $jenis_barang =$row['jenis_barang'];
                                             $id_jenis_barang =$row['id_jenis_barang'];
                                             
                                             
                                            
                                           
                                           
                                             

                                               ?>

                                               <!--  -->
                                                <tr>
                                                  <td ><?=$no++?></td>
                                                  <td ><?= $namabarang ?></td>
                                                  <td ><?= $satuan ?></td>
                                                  <td ><?= $stok+$pengeluaran ?></td>
                                                  <td ><?= $pemasukan ?></td>
                                                  <!-- <td > </td> -->
                                                  <td ><?= $pengeluaran ?></td>
                                                  <td >Rp.<?= $harga_perolehan ?></td>
                                                  <td ><?= $no_batch ?></td>
                                                  <td ><?= $stok ?></td>
                                                  <td ><?= $sumber ?></td>
                                                  
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
                        
                                                          <input type="hidden" name="id_barang" value="<?= $id_barang?>" class="form-control"  autocomplete="off">
                                                          <span style="opacity: 0.5;">Nama barang </span>
                                                          <br>  
                                                          <input type="text" name="nama_barang" value="<?= $namabarang ?>" class="form-control" autocomplete="off" required>
                                                          <br>
                                                           <span style="opacity: 0.5;">Jenis barang </span>
                                                          <br>  
                                                          <select name="jenis_barang" class="form-control">
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM jenis_barang WHERE id_jenis_barang != $id_jenis_barang";
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
                                                          <br>
                                                          
                                                          <br>
                                                          <span style="opacity: 0.5;">Satuan</span>
                                                          <br>  
                                                            <select name="satuan" class="form-control">
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM satuan WHERE id_satuan != $id_satuan";
                                                                $result_st = mysqli_query($conn, $query);
                                                                while ($row_st = mysqli_fetch_assoc($result_st)) {
                                                                   $satuan1= $row_st['satuan'];
                                                                   $id_satuan1 = $row_st['id_satuan'];
                                                                  

                                                                

                                                                ?>

                                                                <option value="<?= $id_satuan1; ?>"><?= $satuan1; ?></option>

                                                                <?php 
                                                                }
                                                                ?>
                                                                <option value="<?= $id_satuan ?>" selected="" id="sumber1"><?= $satuan ?></option>
                                                           </select>
                                                         <br> 
                                                         <span  style="opacity: 0.5;">program</span>
                                                          <br>  
                                                          <select name="program" class="form-control">
                                                               <?php 
                                                                
                                                               $query = "SELECT * FROM program WHERE id_program != $id_program";
                                                                $result_sp = mysqli_query($conn, $query);
                                                                while ($row_sp = mysqli_fetch_assoc($result_sp)) {
                                                                   $program1= $row_sp['program'];
                                                                   $id_program1 = $row_sp['id_program'];
                                                                 
                                                                ?>

                                                                <option value="<?= $id_program1; ?>"><?= $program1; ?></option>

                                                                <?php 
                                                                }
                                                                ?>
                                                                <option value="<?= $id_program ?>" selected="" id="program1"><?= $program ?></option>
                                                           </select>
                                                          <br>
                                                          <span style="opacity: 0.5;">Harga perolehan (Rupiah)</span>
                                                         <br> 
                                                        <input type="number" name="harga_perolehan" value="<?= $harga_perolehan ?>" class="form-control" autocomplete="off">
                                                       
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
                                                          <br>
                                                    
                                                         
                                                     
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">

                                                          <p style="color: red; font-size: 13px;">*Note : Jika data barang di hapus, semua data transaksi <?= $namabarang ?> (barang masuk dan barang keluar) juga ikut terhapus</p>
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
                <script type="text/javascript" src="js/datatables.js" crossorigin="anonymous"></script>
                
                <script src="js/dataTables-1.10.23/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
            

    </body>
</html>
