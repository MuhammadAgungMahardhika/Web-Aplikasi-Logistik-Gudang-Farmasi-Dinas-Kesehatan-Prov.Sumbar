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
$html = '<h3 style="margin-top:-2%;">SURAT BUKTI BARANG KELUAR (SBK) DAN LAPORAN KEDATANGAN VAKSIN (VAR)
</h3>
<h4>KABUPATEN / KOTA :</h4>';
$html .= '<table border="1 " cellpadding="5" cellspacing="0" width="100%">
 <thead style="text-align:center;">

                            
                                          <tr >
                                            
                                            <th > NO.</th>
                                            <th > JENIS VAKSIN</th>
                                            <th > JUMLAH</th>
                                            <th > NO BATCH </th>
                                            <th > KADALUARSA</th>
                                            <th > KONDISI VVM</th>
                                            <th > LAPORAN VAR (VVM)</th>
                                            <th >KETERANGAN</th>
                                         
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
                                              
                                                  <td >".$pengeluaran."</td>
                                                  <td>".$no_batch."</td>
                                                  <td>".$tanggal_daluwarsa."</td>
                                                  <td ></td>
                                                  <td ></td>
                                                  <td style='text-align:justify; border:none; border-right:1px solid black;'></td>
                                    
                                               </tr>

                                               </tbody> 
                                               ";
}

$html .= "<table  cellspacing='0' cellpadding='0' style='width:100%;'> 
	
				<tr style='text-align:center;'>
					<td style='width:50%; text-align:left;'>
					<p style='text-align:left; float:left;'><br>Yang Menerima <br><br><br><br><br><br><br>
          Nip.</p>
					</td>

					<td style='width:50%;'>
					<p style='text-align:left; '>Padang,&nbsp;". date("d - m - ") ."2021 <br><br>
					Yang Menyerahkan <br>
					 <br><br><br><br><br><br>
          Nip.</p>
					</td>
				<tr>

      
			";
		
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
// Rendering dari HTML Ke PDF

$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Daftar pengeluaran vaksin '.date(" d-m-Y ").'.pdf', array('Attachment' => 0),);

                    ?> <script src="../css/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

