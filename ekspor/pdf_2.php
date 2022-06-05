<?php
include('../connect.php');
require_once("../dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$id_keluar = $_GET['id_keluar'];
$query ="SELECT * FROM detail_barang_keluar
LEFT JOIN barang_keluar
on barang_keluar.id_keluar = detail_barang_keluar.id_keluar
LEFT JOIN detail_barang_masuk
on detail_barang_masuk.id_barang = detail_barang_keluar.id_barang AND
detail_barang_masuk.id_masuk = detail_barang_keluar.id_masuk
LEFT JOIN satuan 
on satuan.id_satuan = detail_barang_masuk.id_satuan
LEFT JOIN sumber
on sumber.id_sumber = detail_barang_masuk.id_sumber
LEFT JOIN barang
on barang.id_barang = detail_barang_masuk.id_barang
WHERE detail_barang_keluar.id_keluar = '$id_keluar' ";
$result = mysqli_query($conn,$query);
$html = '
<h5 style="border-bottom:1px solid black;display:inline-block;">DINAS KESEHATAN PROVINSI <br>
SUMATERA BARAT </h5><br><br>
<center><h3 style="margin-top:-2%; text-decoration:underline;">SURAT BUKTI BARANG KELUAR<br>
</h3><span style="padding-left:-33%;">NOMOR:</span></center><br/>
Untuk :<br>
Berdasarkan surat,<br>
<center><p>Tanggal:____________________________________________<br><br>
Nomor :____________________________________________</p></center>';
$html .= '<hr>
<table border="1 " cellpadding="5" cellspacing="0" width="100%">
 <thead style="text-align:center;">

                            
                                          <tr >
                                            
                                            <th >No.</th>
                                            <th >Nama Barang</th>
                                            <th >Satuan / Kemasan </th>
                                            <th >Jumlah</th>
                                            <th >No.Stok</th>
                                      
                                            <th >Keterangan</th>
                                         
                                          </tr>

                                        </thead>';
$no=1; 
                                              while($row = mysqli_fetch_assoc($result)){
                                               
                                              $no_stock_keluar = $row['id_keluar'];
                                              $no_stock_masuk = $row['id_masuk'];
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
 $html .= " 								
  <tbody style='text-align:center;'>
 <tr>
                                                  <td >".$no++."</td>
                                                  <td >".$nama_barang."</td>
                                                  <td >".$satuan."</td>
                                                  <td >".$pengeluaran."</td>
                                                  <td >".$no_stock_masuk."</td>
                                                  <td >".$ket_keluar."</td> 

                                               </tr>

                                               </tbody> 
                                               ";
}

$html .= "<table   cellspacing='0' cellpadding='0' style='width:100%;'> 
	
				<tr style='text-align:center;'>
					<td style='width:33%; padding-top:3%;'>
					<p style='text-align:center; '> Yang Menerima <br><br><br><br><br><br><br>
          <br>
          (.................................................)</p>
				
            <td style='width:33%; padding-top:3%;'>
          <p style='text-align:center; '> Pembantu Pengelola Barang<br><br><br><br><br><br><br>
          <br>
          (.................................................)</p>
          </td>

            </td>

          <td style='width:33%;'>
          <p style='text-align:center;'>Padang,&nbsp;". date("d - m - ") ."2021 <br><br>
          Yang Menyerahkan <br>
          Pengelola barang <br><br><br><br><br><br><br>
           <br>
          (.................................................)</p>
          </td>

				<tr>

			";
		
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF

$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Daftar pengeluaran barang '.date(" d-m-Y ").'.pdf', array('Attachment' => 0),);

                    ?> <script src="../css/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

