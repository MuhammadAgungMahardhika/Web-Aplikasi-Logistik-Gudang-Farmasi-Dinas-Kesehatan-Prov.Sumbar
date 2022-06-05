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
$html = '<center><h3 style="margin-top:-2%;">DAFTAR PENGELUARAN OBAT & PERBEKALAN KESEHATAN<br>
UNTUK DINKES...................................<br>
DARI DINKES PROV.SUMBAR<br>
No.442 &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Farmasi-SDK/II/2021</h3></center><br/>';
$html .= '<table border="1 " cellpadding="5" cellspacing="0" width="100%">
 <thead style="text-align:center;">

                            
                                          <tr >
                                            
                                            <th >No.</th>
                                            <th >Nama Barang</th>
                                            <th >Satuan / Kemasan </th>
                                            <th >Jumlah</th>
                                            <th >Sumber</th>
                                      
                                           
                                         
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
                                                  <td >".$sumber."</td>
                                               
                                                

                                               </tr>

                                               </tbody> 
                                               ";
}

$html .= "<table  cellspacing='0' cellpadding='0' style='width:100%;'> 
	
				<tr style='text-align:center;'>
					<td style='width:50%; text-align:left;'>
					<p style='text-align:center; float:left;'> Yang Menerima <br><br><br><br><br><br><br>
          Yulia Elfianti, Amd Farm <br>
          Nip 19730726 199503 2 001</p>
					</td>

					<td style='width:50%;'>
					<p style='text-align:center; float:right;'>Padang,&nbsp;". date("d - m - ") ."2021 <br>
					Yang Menyerahkan <br>
					Kasie. Kefarmasian Bid.SDK <br><br><br><br><br>
          Elfino Sabri,S.Si,Apt <br>
          Nip 19741123 200501 1 006</p>
					</td>
				<tr>

        <div style='text-align:center;clear: left;clear:right;'>
          Mengetahui,<br>
          Kepala Bidang Sumber Daya Kesehatan<br>
          Dinkes Prov.Sumbar<br><br><br><br>
          .........................................................<br>
          NIP......................................................
      </div>
          
      
			";
		
$html .= "</html>";
$dompdf->loadHtml($html);
// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'potrait');
// Rendering dari HTML Ke PDF

$dompdf->render();
// Melakukan output file Pdf
$dompdf->stream('Daftar pengeluaran barang'.date(" d-m-Y ").'.pdf', array('Attachment' => 0),);

                    ?> <script src="../css/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

