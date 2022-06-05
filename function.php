<?php 						
include('connect.php');


function total_stok($data){

	$id_barang = $data;
	global $conn;
	$result = mysqli_query($conn,"SELECT SUM(stok) FROM detail_barang_masuk 
		WHERE id_barang='$id_barang' ");

	while ($row= mysqli_fetch_assoc($result)) {
		$total = $row['SUM(stok)'];

		echo $total;
	}



}

function user(){
	global $conn ; 

	$nip = $_COOKIE['nip'];
	$query = "SELECT * FROM admin WHERE nip='$nip' ";


$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];

echo $username;
}

function pilih_tahun_masuk(){
global $conn;

$query = "SELECT distinct year(tanggal_masuk) FROM barang_masuk ORDER BY year(tanggal_masuk) DESC";

$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($result)) {
	$tahun = $row['year(tanggal_masuk)'];
	?><option value="<?=$tahun;?>"><?=$tahun; ?></option><?php
}
}

function pilih_tahun_keluar(){
global $conn;

$query = "SELECT distinct year(tanggal_keluar) FROM barang_keluar ORDER BY year(tanggal_keluar) DESC";

$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($result)) {
	$tahun = $row['year(tanggal_keluar)'];
	?><option value="<?=$tahun;?>"><?=$tahun; ?></option><?php
}
}

function pilih_tahun_daluwarsa(){
global $conn;

$query = "SELECT distinct year(tanggal_daluwarsa) FROM detail_barang_masuk ORDER BY year(tanggal_daluwarsa) DESC";

$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($result)) {
	$tahun = $row['year(tanggal_daluwarsa)'];
	?><option value="<?=$tahun;?>"><?=$tahun; ?></option><?php
}
}

function pilih_sumber(){
global $conn;

$query = "SELECT sumber
FROM sumber";

$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($result)) {
	$sumber = $row['sumber'];
	?><option value="<?=$sumber;?>"><?=$sumber; ?></option><?php
}
}
function pilih_jenis_barang(){
global $conn;

$query = "SELECT jenis_barang
FROM jenis_barang";

$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($result)) {
	$jenis_barang = $row['jenis_barang'];
	?><option value="<?=$jenis_barang;?>"><?=$jenis_barang; ?></option><?php
}

}

function pilih_program(){
global $conn;

$query = "SELECT program
FROM program";

$result = mysqli_query($conn,$query);

while ($row = mysqli_fetch_assoc($result)) {
	$program = $row['program'];
	?><option value="<?=$program;?>"><?=$program; ?></option><?php
}

}


function nilai_alarm(){
global $conn;
$bulan_sekarang = date('m');
$tahun_sekarang = date('Y');

$query = "SELECT month(tanggal_daluwarsa),year(tanggal_daluwarsa)
 FROM detail_barang_masuk
WHERE month(tanggal_daluwarsa) = '$bulan_sekarang' AND
year(tanggal_daluwarsa)= '$tahun_sekarang' ";

$result = mysqli_query($conn,$query);

$jumlah_data = mysqli_num_rows($result);
echo $jumlah_data;
}

function alarm(){

	global $conn;
	$query = "SELECT * FROM detail_barang_masuk JOIN barang on barang.id_barang = detail_barang_masuk.id_barang ORDER BY tanggal_daluwarsa DESC  ";
	$result = mysqli_query($conn,$query);
	$tanggal_sekarang = date('m-Y');

	while ($row = mysqli_fetch_assoc($result)) {
		$tanggal_daluwarsa1 = $row['tanggal_daluwarsa'];

		$tanggal_daluwarsa = date("m-Y",strtotime($tanggal_daluwarsa1));
		$nama_barang = $row['nama_barang'];
		$no_stock_masuk = $row['id_masuk'];
		$no_batch = $row['no_batch'];
		

		if ($tanggal_daluwarsa == $tanggal_sekarang ) {
			?>
			
			<form action="detail_barang_masuk.php" method="GET">
            <button class="btn btn-outline-danger text-left" type="submit" style="min-width: 18rem;" name="kadaluarsa"><input name="id_masuk" type="hidden"  autocomplete="off" value="<?=$no_stock_masuk;?>"  /><span style="font-size: 12px; font-family: Roboto; "> <b><?=$no_stock_masuk;?> - <?= $nama_barang;   ?> (<?=$no_batch?>) </b><br>  kadaluarsa pada <?= date("d - m - Y",strtotime($tanggal_daluwarsa1)); ?></span></button>
            </form><?php

            

			if (!isset($_SESSION['alarm'])) {
		    	echo "<script>
			
					Swal.fire('Ditemukan barang kadaluarsa!',' Silahkan lihat di bel notifikasi!','info');

					</script>
				";
		    
			}
			$_SESSION['alarm'] = true;
		}
	}


}


// menambah data barang
if (isset($_POST['tambahdatabarang'])) {
$nama_barang = htmlspecialchars($_POST['namabarang']);
$id_jenis_barang = htmlspecialchars($_POST['jenis_barang']);

$jk_nama_barang = strlen($nama_barang);


if ($jk_nama_barang>100 ) {

	echo "
		<script>
			alert('Gagal menambahkan ! Nama barang melebihi maksimal karakter');
			document.location.href = 'obat.php';

		</script>
		";
	

}else{

$query = "INSERT INTO barang (id_barang,nama_barang,id_jenis_barang) 
			VALUES (id_barang,'$nama_barang','$id_jenis_barang' )";

$result = mysqli_query($conn,$query);

if ($result) {

	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menambah data barang!','success');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";
}else{

	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menambah data barang!','error');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";


}


}
}

// akhir tambah data obat

// awal edit data

if (isset($_POST['editbarang'])) {

	
	$id_barang = htmlspecialchars($_POST['id_barang']);
	$nama_barang = htmlspecialchars($_POST['nama_barang']);
	$id_jenis_barang =htmlspecialchars($_POST['jenis_barang']);

	$jk_edit_nama_barang = strlen($nama_barang);
	
	$jk_jenis_barang = strlen($id_jenis_barang);
	
	

// update barang
	

	if($jk_edit_nama_barang>100) {
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit data barang! nama barang melebihi maksimal karakter','error');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";
	}else if ($jk_jenis_barang>15) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit data barang! jenis barang melebihi maksimal karakter','error');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";
	}else{
		
 			$query = "UPDATE barang set 
				nama_barang='$nama_barang',
				id_jenis_barang='$id_jenis_barang'
				WHERE barang.id_barang= '$id_barang' ";


	 $result =  mysqli_query($conn,$query);
	 
	 if ($result) {
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit data barang!','success');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";
	 }else{
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit data barang!','error');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";
	 }
	}

}

// akhir edit data obat


// awal edit barang masuk

if (isset($_POST['editbarangmasuk'])) {

	
	
	$id_masuk = htmlspecialchars($_POST['id_masuk']);
	$tanggal_masuk = htmlspecialchars($_POST['tanggal_masuk']);
	$pengirim = htmlspecialchars($_POST['pengirim']);
	$pj = htmlspecialchars($_POST['pj']);

	

// update barang
	
		
 			$query = "UPDATE `kp_baru`.`barang_masuk` 
 			SET `tanggal_masuk` = '$tanggal_masuk', 
 			`pengirim` = '$pengirim',
 			`pj` = '$pj'
 			  WHERE (`id_masuk` = '$id_masuk'); ";

	 $result =  mysqli_query($conn,$query);
	 
	 if ($result) {
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit no masuk $id_masuk!','success');
			setTimeout(function(){

				document.location.href = 'barangmasuk.php';


				},500);
			});

			</script>
		";
	 }else{
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit no masuk $id_masuk!','error');
			setTimeout(function(){

				document.location.href = 'barangmasuk.php';


				},500);
			});

			</script>
		";
	 }
	

}

// akhir edit barang masuk

// awal edit barang keluar

if (isset($_POST['editbarangkeluar'])) {

	
	
	$id_keluar = htmlspecialchars($_POST['id_keluar']);
	$tanggal_keluar = htmlspecialchars($_POST['tanggal_keluar']);
	$penerima = htmlspecialchars($_POST['penerima']);
	$pj = htmlspecialchars($_POST['pj']);

	

// update barang
	
		
 			$query = "UPDATE `kp_baru`.`barang_keluar` 
 			SET `tanggal_keluar` = '$tanggal_keluar', 
 			`penerima` = '$penerima',
 			`pj` = '$pj'
 			  WHERE (`id_keluar` = '$id_keluar'); ";

	 $result =  mysqli_query($conn,$query);
	 
	 if ($result) {
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit no keluar $id_keluar!','success');
			setTimeout(function(){

				document.location.href = 'barangkeluar.php';


				},500);
			});

			</script>
		";
	 }else{
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit no keluar $id_keluar!','error');
			setTimeout(function(){

				document.location.href = 'barangkeluar.php';


				},500);
			});

			</script>
		";
	 }
	

}

// akhir edit barang keluar

// awal edit detail barang masuk

if (isset($_POST['edit_detail_barang_masuk'])) {

	
	$id_barang = htmlspecialchars($_POST['id_barang']);
	$id_masuk = htmlspecialchars($_POST['id_masuk']);
	$no_batch = htmlspecialchars($_POST['no_batch']);
	$tanggal_daluwarsa = htmlspecialchars($_POST['tanggal_daluwarsa']);
	$id_satuan = htmlspecialchars($_POST['satuan']);
	$id_sumber = htmlspecialchars($_POST['sumber']);
	$harga_perolehan = htmlspecialchars($_POST['harga_perolehan']);
	$ket_masuk = htmlspecialchars($_POST['ket_masuk']);
	

// update barang
	
		
 			$query = "UPDATE `kp_baru`.`detail_barang_masuk` 
 			SET `id_sumber` = '$id_sumber', 
 			`id_satuan` = '$id_satuan', 
 			`harga_perolehan` = '$harga_perolehan', 
 			`no_batch` = '$no_batch', 
 			`tanggal_daluwarsa` = '$tanggal_daluwarsa',
 			 `ket_masuk` = '$ket_masuk'
 			  WHERE (`id_barang` = '$id_barang') and (`id_masuk` = '$id_masuk'); ";

	 $result =  mysqli_query($conn,$query);
	 
	 if ($result) {
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit data barang!','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';


				},500);
			});

			</script>
		";
	 }else{
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit data barang!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';


				},500);
			});

			</script>
		";
	 }
	

}

// akhir edit detail barang masuk 

// awal edit detail barang keluar

if (isset($_POST['edit_detail_barang_keluar'])) {

	
	$id_barang = $_POST['id_barang'];
	$id_masuk = $_POST['id_masuk'];
	$id_keluar = $_POST['id_keluar'];
	$ket_keluar = htmlspecialchars($_POST['ket_keluar']);
	

// update barang
	
		
 			$query = "UPDATE `kp_baru`.`detail_barang_keluar` 
 			SET `ket_keluar` = '$ket_keluar'
 			  WHERE (`id_barang` = '$id_barang') 
 			  and (`id_masuk` = '$id_masuk') 
 			  and (`id_keluar` = '$id_keluar') ";

	 $result =  mysqli_query($conn,$query);
	 
	 if ($result) {
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit data barang!','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";
	 }else{
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit data barang!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";
	 }
	

}

// akhir edit detail barang keluar

// awal edit detail barang return

if (isset($_POST['edit_detail_barang_return'])) {

	
	$id_barang = $_POST['id_barang'];
	$id_masuk = $_POST['id_masuk'];
	$id_keluar = $_POST['id_keluar'];
	$id_return = $_POST['id_return'];
	$ket_return = htmlspecialchars($_POST['ket_return']);
	

// update barang
	
		
 			$query = "UPDATE `kp_baru`.`detail_barang_return` 
 			SET `ket_return` = '$ket_return'
 			  WHERE (`id_barang` = '$id_barang') 
 			  and (`id_masuk` = '$id_masuk') 
 			  and (`id_keluar` = '$id_keluar') 
 			  and (`id_return` = '$id_return') ";

	 $result =  mysqli_query($conn,$query);
	 
	 if ($result) {
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit data barang!','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_return.php';


				},500);
			});

			</script>
		";
	 }else{
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit data barang!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_return.php';


				},500);
			});

			</script>
		";
	 }
	

}

// akhir edit detail barang return

// awal edit jenis barang

if (isset($_POST['editjenisbarang'])) {

	$id_jenis_barang = $_POST['id_jenis_barang'];
	$jenis_barang = htmlspecialchars($_POST['jenis_barang']);
	$jk_edit_jenis_barang = strlen($jenis_barang);
	

// update barang
	

	if($jk_edit_jenis_barang>20) {
		
	echo "
		<script>
			alert('Gagal menambahkan ! Jenis barang melebihi maksimal karakter');
			document.location.href = 'jenis_barang.php';

		</script>
		";
		exit();
	}else{
		
$query = "UPDATE `kp_baru`.`jenis_barang` SET `jenis_barang` = '$jenis_barang' WHERE (`id_jenis_barang` = '$id_jenis_barang');";


$result = mysqli_query($conn,$query);
	
	if ($result) {
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit jenis barang!','success');
			setTimeout(function(){

				document.location.href = 'jenis_barang.php';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Jenis barang gagal ditambahkan!','error');
			setTimeout(function(){

				document.location.href = 'jenis_barang.php';


				},500);
			});

			</script>
		";

	}
	
		
	}

}

// akhir edit jenis barang


// awal edit sumber 
if (isset($_POST['editsumberbarang'])) {

	$id_sumber = $_POST['id_sumber'];
	$sumber = htmlspecialchars($_POST['sumber']);
	$jk_edit_sumber_barang = strlen($sumber);
	

// update barang
	

	if($jk_edit_sumber_barang>20) {
		
	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal',' Sumber melebihi maksimal karakter','error');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);

			});

		</script>";
		exit();
	}else{
		
$query = "UPDATE `kp_baru`.`sumber` SET `sumber` = '$sumber' WHERE (`id_sumber` = '$id_sumber');";


$result = mysqli_query($conn,$query);

if ($result) {
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Sumber berhasil diedit','success');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);

			});

		</script>";
		
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Sumber gagal diedit','error');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);

			});

		</script>";

	}
	
	}

}

// akhir edit sumber

// awal edit satuan
if (isset($_POST['editsatuanbarang'])) {

	$id_satuan = $_POST['id_satuan'];
	$satuan = htmlspecialchars($_POST['satuan']);
	$jk_edit_satuan_barang = strlen($satuan);
	

// update satuan
	

	if($jk_edit_satuan_barang>150) {
		
	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit jumlah satuan melebihi maksimal karakter','error');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);

			});

		</script>";
	}else{
		
$query = "UPDATE `kp_baru`.`satuan` SET `satuan` = '$satuan' WHERE (`id_satuan` = '$id_satuan');";


$result = mysqli_query($conn,$query);
	if ($result) {
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Satuan berhasil diedit','success');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);

			});

		</script>";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Satuan gagal diedit','error');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);

			});

		</script>";
	}
	}

}

// akhir edit satuan barang

// awal edit program 
if (isset($_POST['editprogrambarang'])) {

	$id_program = $_POST['id_program'];
	$program = htmlspecialchars($_POST['program']);
	$jk_edit_program_barang = strlen($program);
	

// update barang
	

	if($jk_edit_program_barang>20) {
		
	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal',' program melebihi maksimal karakter','error');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);

			});

		</script>";
		exit();
	}else{
		
$query = "UPDATE `kp_baru`.`program` SET `program` = '$program' WHERE (`id_program` = '$id_program');";


$result = mysqli_query($conn,$query);

if ($result) {
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','program berhasil diedit','success');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);

			});

		</script>";
		
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','program gagal diedit','error');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);

			});

		</script>";

	}
	
	}

}

// akhir edit program


// awal hapus data Barang

if (isset($_POST['hapusbarang'])) {

	
	$id_barang = $_POST['id_barang'];

// update barang
	
	
	$query = "DELETE FROM `kp_baru`.`barang` WHERE (`id_barang` = '$id_barang') ";


	$hapusDataBarang = mysqli_query($conn,$query);
	

	if($hapusDataBarang) {
		
	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menghapus data barang!','success');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";

	}else{
		
 		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menghapus data barang!','error');
			setTimeout(function(){

				document.location.href = 'obat.php';


				},500);
			});

			</script>
		";
	}

}

// akhir hapus data Barang

// awal hapus barang masuk

if (isset($_POST['hapusbarangmasuk'])) {

   $id_masuk = $_POST['id_masuk'];

	$query = "DELETE FROM barang_masuk WHERE id_masuk = '$id_masuk' ";
	
	$addToKeluar = mysqli_query($conn,$query);


		if ($addToKeluar) {

		
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menghapus barang masuk!','success');
			setTimeout(function(){

				document.location.href = 'barangmasuk.php';


				},500);
			});

			</script>
		";
		}else{
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menghapus barang masuk!','error');
			setTimeout(function(){

				document.location.href = 'barangmasuk.php';


				},500);
			});

			</script>
		";
		}

	
}

// akhir hapus Barang masuk

// awal hapus barang keluar

if (isset($_POST['hapusbarangkeluar'])) {

   $id_keluar = $_POST['id_keluar'];

	$query = "DELETE  FROM barang_keluar WHERE id_keluar = '$id_keluar' ";
	
	$addToKeluar = mysqli_query($conn,$query);


		if ($addToKeluar) {

		
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menghapus barang keluar $id_keluar!','success');
			setTimeout(function(){

				document.location.href = 'barangkeluar.php';


				},500);
			});

			</script>
		";
		}else{
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menghapus barang keluar $id_keluar!','error');
			setTimeout(function(){

				document.location.href = 'barangkeluar.php';


				},500);
			});

			</script>
		";
		}

	
}

// akhir hapus Barang keluar


// awal hapus detail barang masuk

if (isset($_POST['hapusdetailbarangmasuk'])) {

   $id_barang = $_POST['id_barang'];
   $id_masuk = $_POST['id_masuk'];

	$query = "DELETE  FROM detail_barang_masuk WHERE id_barang = '$id_barang' AND 
	id_masuk = '$id_masuk' ";
	
	$addToKeluar = mysqli_query($conn,$query);


		if ($addToKeluar) {

		
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menghapus barang !','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';


				},500);
			});

			</script>
		";
		}else{
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menghapus barang !','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';


				},500);
			});

			</script>
		";
		}

	
}

// akhir hapus detail Barang masuk

// awal hapus detail barang keluar

if (isset($_POST['hapusdetailbarangkeluar'])) {

   $id_barang = $_POST['id_barang'];
   $id_masuk = $_POST['id_masuk'];
   $id_keluar = $_POST['id_keluar'];


   // cek stok sekarang
	$cekStok = mysqli_query($conn,"SELECT stok FROM detail_barang_masuk WHERE id_barang = '$id_barang' AND id_masuk = '$id_masuk'  ");
	$ambilStok = mysqli_fetch_assoc($cekStok);
	$cekStokSekarang = $ambilStok['stok'];


	// cek pengeluaran
	$cekPengeluaran = mysqli_query($conn,"SELECT pengeluaran FROM detail_barang_keluar WHERE id_barang = '$id_barang' AND id_masuk = '$id_masuk' AND id_keluar = '$id_keluar' ");
	$ambilPengeluaran = mysqli_fetch_assoc($cekPengeluaran);
	$cekPengeluaranSekarang = $ambilPengeluaran['pengeluaran'];


	// update stok
	$updateStok = $cekStokSekarang + $cekPengeluaranSekarang;

// hapus
	$addToKeluar = mysqli_query($conn,"DELETE FROM detail_barang_keluar WHERE id_barang = '$id_barang' AND 
	id_masuk = '$id_masuk' AND
	id_keluar = '$id_keluar' ");

		if ($addToKeluar) {
		
		$updateStokAkhir = mysqli_query($conn,"UPDATE detail_barang_masuk SET stok='$updateStok' WHERE id_barang = '$id_barang' AND id_masuk = '$id_masuk' ");

			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menghapus barang !','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";
		}else{
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menghapus barang !','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";
		}

	
}

// akhir hapus detail Barang keluar


// awal hapus jenis Barang

if (isset($_POST['hapusjenisbarang'])) {

	
	$id_jenis_barang = $_POST['id_jenis_barang'];

// update barang
	
	
	$query = "DELETE FROM jenis_barang WHERE id_jenis_barang = '$id_jenis_barang' ";


	$hapusDataBarang = mysqli_query($conn,$query);

	if($hapusDataBarang){		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menghapus jenis barang!','success');
			setTimeout(function(){

				document.location.href = 'jenis_barang.php';


				},500);
			});

			</script>
		";
	}else{
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menghapus jenis barang ','error');
			setTimeout(function(){

				document.location.href = 'jenis_barang.php';


				},500);
			});

			</script>
		";
	}

}

// akhir hapus jenis Barang

// awal hapus sumber Barang

if (isset($_POST['hapussumberbarang'])) {

	
	$id_sumber = $_POST['id_sumber'];
	
	$query = "DELETE FROM sumber WHERE id_sumber = '$id_sumber' ";


	$hapusDataBarang = mysqli_query($conn,$query);

	if($hapusDataBarang){
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Sumber berhasil dihapus','success');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);

			});

		</script>";
	}else{
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Sumber gagal dihapus','error');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);

			});

		</script>";
	}

}

// akhir hapus sumber Barang

// awal hapus satuan barang

if (isset($_POST['hapussatuanbarang'])) {

	
	$id_satuan = $_POST['id_satuan'];


	
	
	$query = "DELETE FROM satuan WHERE id_satuan = '$id_satuan' ";


	$hapusDataBarang = mysqli_query($conn,$query);

	if($hapusDataBarang){

		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Satuan berhasil dihapus','success');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);

			});

		</script>";
		
		
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Satuan gagal dihapus!','success');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);

			});

		</script>";
		
	}

}

// akhir hapus satuan Barang

// awal hapus program Barang

if (isset($_POST['hapusprogrambarang'])) {

	
	$id_program = $_POST['id_program'];
	$query = "DELETE FROM program WHERE id_program = '$id_program' ";


	$hapusDataBarang = mysqli_query($conn,$query);

	if($hapusDataBarang){
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','program berhasil dihapus','success');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);

			});

		</script>";
	}else{
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','program gagal dihapus','error');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);

			});

		</script>";
	}

}

// akhir hapus program Barang

// awal hapus barang program

if (isset($_POST['hapusbarangprogram'])) {
	
	$id_program = $_POST['id_program'];
	$id_barang = $_POST['id_barang'];
	$query = "DELETE FROM detail_program WHERE id_barang = '$id_barang' AND
	id_program = $id_program ";


	$hapusDataBarang = mysqli_query($conn,$query);

	if($hapusDataBarang){
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Barang berhasil dihapus dari program','success');
			setTimeout(function(){

				document.location.href = 'detail_program.php?id_program=$id_program';


				},500);

			});

		</script>";
	}else{
		
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Barang gagal dihapus dari program','error');
			setTimeout(function(){

				document.location.href = 'detail_program.php?id_program=$id_program';


				},500);

			});

		</script>";
	}

}

// akhir hapus barang program


// menambah barang masuk

if (isset($_POST['barangmasuk'])) {

	
	$id_masuk = $_POST['id_masuk'];
	$tanggal_masuk = htmlspecialchars($_POST['tanggal_masuk']);
	$pengirim 	= htmlspecialchars($_POST['pengirim']);
	$pj 	= htmlspecialchars($_POST['pj']);

	


	$query = "INSERT INTO barang_masuk(id_masuk,tanggal_masuk,pengirim,pj) VALUES ('$id_masuk','$tanggal_masuk','$pengirim','$pj')";
	
	$addToMasuk = mysqli_query($conn,$query);


// cek stok sekarang
	// $cekStok = mysqli_query($conn,"SELECT * FROM detail_barang_masuk WHERE id_barang = $id_barang ");
	// $ambilStok = mysqli_fetch_assoc($cekStok);
	// $nama_barang = $ambilStok['nama_barang'];
	// $cekStokSekarang = $ambilStok['stok'];


	// $updateStok = $cekStokSekarang+$kuantitas;

	
	// $updateStokMasuk = mysqli_query($conn,"UPDATE barang set stok='$updateStok' WHERE id_barang= $id_barang ");

	if($addToMasuk) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menambahkan barang masuk $id_masuk','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menambahkan barang masuk $id_masuk!','error');
			setTimeout(function(){

				document.location.href = 'barangmasuk.php';

				},500);
			});

			</script>
		";
	}

}
// Akhir menambah barangmasuk

// menambah detail barang masuk

if (isset($_POST['detail_barang_masuk'])) {

	$id_barang = $_POST['id_barang'];
	$id_masuk = $_POST['id_masuk'];
	$id_satuan = $_POST['satuan'];
	$id_sumber = $_POST['sumber'];
	$harga_perolehan = htmlspecialchars($_POST['harga_perolehan']);
	$no_batch = htmlspecialchars($_POST['no_batch']);
	$tanggal_daluwarsa = htmlspecialchars($_POST['tanggal_daluwarsa']);
	$kuantitas 	= htmlspecialchars($_POST['kuantitas']);
	$keterangan = htmlspecialchars($_POST['ket_masuk']);


	$query = "INSERT INTO detail_barang_masuk(id_barang,id_masuk, id_satuan,id_sumber,harga_perolehan,no_batch,tanggal_daluwarsa,pemasukan,ket_masuk) VALUES ('$id_barang','$id_masuk','$id_satuan','$id_sumber','$harga_perolehan','$no_batch','$tanggal_daluwarsa','$kuantitas','$keterangan')";
	
	$addToMasuk = mysqli_query($conn,$query);


// cek stok sekarang
	$cekStok = mysqli_query($conn,"SELECT * FROM detail_barang_masuk WHERE id_barang = '$id_barang' AND id_masuk = '$id_masuk' ");
	$ambilStok = mysqli_fetch_assoc($cekStok);
	$cekStokSekarang = $ambilStok['stok'];


	$updateStok = $cekStokSekarang+$kuantitas;

	

	if($addToMasuk) {
		$updateStokMasuk = mysqli_query($conn,"UPDATE detail_barang_masuk set stok='$updateStok' WHERE id_barang= '$id_barang' AND id_masuk = '$id_masuk' ");
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menambahkan barang baru kedalam $id_masuk!','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menambahkan barang baru kedalam $id_masuk!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_masuk.php?id_masuk=$id_masuk';

				},500);
			});

			</script>
		";
	}

}

// akhir menambah detail barang masuk


// menambah detail barang keluar

if (isset($_POST['detail_barang_keluar'])) {

	$id_keluar = $_POST['id_keluar'];
	$id_barang = $_POST['id_barang'];
	$id_masuk = $_POST['id_masuk'];
	$kuantitas 	= htmlspecialchars($_POST['kuantitas']);
	$keterangan = htmlspecialchars($_POST['ket_keluar']);


// cek stok sekarang
	$cekStok = mysqli_query($conn,"SELECT * FROM detail_barang_masuk WHERE id_barang = '$id_barang' AND id_masuk = '$id_masuk'  ");

	$ambilStok = mysqli_fetch_assoc($cekStok);

	$cekStokSekarang = $ambilStok['stok'];

	$updateStok = $cekStokSekarang-$kuantitas;


	$query = "INSERT INTO detail_barang_keluar(id_keluar,id_barang,id_masuk,pengeluaran,ket_keluar) VALUES ('$id_keluar','$id_barang','$id_masuk','$kuantitas','$keterangan')";

	if($updateStok>=0) {

		$addToOut = mysqli_query($conn,$query);

		if ($addToOut) {
			$updateStokMasuk = mysqli_query($conn,"UPDATE detail_barang_masuk set stok='$updateStok' WHERE id_barang= '$id_barang' AND id_masuk = '$id_masuk' ");
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menambahkan barang baru kedalam $id_keluar!','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";
		}else{
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menambahkan barang baru kedalam $id_keluar!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';

				},500);
			});

			</script>
		";
		}
		
	}else if ($updateStok<0) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Stok barang tidak mencukupi!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";

	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menambahkan barang baru kedalam $id_keluar!','error');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';

				},500);
			});

			</script>
		";
	}

}

// akhir menambah detail barang keluar

// menambah barang keluar


if (isset($_POST['barangkeluar'])) {

	
	$id_keluar = $_POST['id_keluar'];
	$tanggal_keluar = htmlspecialchars($_POST['tanggal_keluar']);
	$penerima 	= htmlspecialchars($_POST['penerima']);
	$pj 	= htmlspecialchars($_POST['pj']);

	


	$query = "INSERT INTO barang_keluar(id_keluar,tanggal_keluar,penerima,pj) VALUES ('$id_keluar','$tanggal_keluar','$penerima','$pj')";
	
	$addToMasuk = mysqli_query($conn,$query);


// cek stok sekarang
	// $cekStok = mysqli_query($conn,"SELECT * FROM detail_barang_masuk WHERE id_barang = $id_barang ");
	// $ambilStok = mysqli_fetch_assoc($cekStok);
	// $nama_barang = $ambilStok['nama_barang'];
	// $cekStokSekarang = $ambilStok['stok'];


	// $updateStok = $cekStokSekarang+$kuantitas;

	
	// $updateStokMasuk = mysqli_query($conn,"UPDATE barang set stok='$updateStok' WHERE id_barang= $id_barang ");

	if($addToMasuk) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil menambahkan barang keluar $id_keluar','success');
			setTimeout(function(){

				document.location.href = 'detail_barang_keluar.php?id_keluar=$id_keluar';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal menambahkan barang keluar $id_keluar!','error');
			setTimeout(function(){

				document.location.href = 'barangkeluar.php';

				},500);
			});

			</script>
		";
	}

}
// Akhir menambah barangkeluar




// awal edit pengguna

if (isset($_POST['editpengguna'])) {

	$nip = htmlspecialchars($_POST['nip']);
	$nama_pengguna = htmlspecialchars($_POST['namapengguna']);
	$alamat = htmlspecialchars($_POST['alamat']);
	$email = htmlspecialchars($_POST['email']);
	$no_hp = htmlspecialchars($_POST['no_hp']);
	$tanggal_lahir = htmlspecialchars($_POST['tanggal_lahir']);
	$password = htmlspecialchars($_POST['password']);
	// $tanggal_daluwarsa = htmlspecialchars($_POST['tanggal_daluwarsa']);
	// $keterangan = htmlspecialchars($_POST['keterangan']);

	// $jk_edit_nama_barang = strlen($nama_barang);
	// $jk_edit_satuan = strlen($satuan);

// update pengguna
	

	// if($jk_edit_nama_barang>25) {
		
	// echo "
	// 	<script>
	// 		alert('Gagal menambahkan ! Nama barang melebihi maksimal karakter');
	// 		document.location.href = 'obat.php';

	// 	</script>
	// 	";
	// }else if ($jk_edit_satuan>20) {
	// 	echo "
	// 	<script>
	// 		alert('Gagal mengedit barang ! Satuan barang melebihi maksimal karakter');
	// 		document.location.href ='obat.php';

	// 	</script>
	// 	";
	// }
	// else{
		
 			$query = "UPDATE admin set 
				
				username='$nama_pengguna',
				alamat='$alamat',
				email='$email',
				no_hp='$no_hp',
				tanggal_lahir='$tanggal_lahir',
				password='$password'

				WHERE nip='$nip' ";


	$berhasil =  mysqli_query($conn,$query);


	 if ($berhasil) {

	 	$enkrip = base64_encode($nip);
	 	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Berhasil mengedit pengguna!','success');
			setTimeout(function(){

				document.location.href = 'akun.php?nip=$enkrip';


				},500);
			});

			</script>
		";
	 }else{

     $enkrip = base64_encode($nip);
	 			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Gagal mengedit pengguna!','error');
			setTimeout(function(){

				document.location.href = 'akun.php?nip=$enkrip';


				},500);
			});

			</script>
		";
	 }
	// }

}

// akhir  data obat


// awal tambah jenis barang
if (isset($_POST['tambahjenisbarang'])) {
	
	$jenis_barang = $_POST['jenis_barang'];

	$cek_jenis_barang = strtolower(trim(htmlspecialchars($jenis_barang)));
	$cek_jenis_barang1 = str_replace(' ','', $cek_jenis_barang);

	$result2 = mysqli_query($conn,"SELECT * FROM jenis_barang  ");

	
	while ($row2 = mysqli_fetch_assoc($result2) ) {
		$jenis_barang2 = $row2['jenis_barang'];
		$cek_jenis_barang2 = strtolower(trim(htmlspecialchars($jenis_barang2)));
		$cek_jenis_barang3 = str_replace(' ', '', $cek_jenis_barang2);
		
		if ($cek_jenis_barang3 == $cek_jenis_barang1) {
			echo "<script>
				alert('gagal menambahkan ! Jenis barang sudah ada!');
				document.location.href = 'jenis_barang.php';
				
			</script>
		";
			exit();
		}
		
	}
	
	$query = "INSERT INTO jenis_barang(id_jenis_barang,jenis_barang)
				VALUES (id_jenis_barang,'$jenis_barang')"; 

	$result = mysqli_query($conn,$query);

	

	

	if($result) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Jenis Barang baru berhasil ditambahkan!','success');
			setTimeout(function(){

				document.location.href = 'jenis_barang.php';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Jenis Barang baru gagal ditambahkan!','error');
			setTimeout(function(){

				document.location.href = 'jenis_barang.php';


				},500);
			});

			</script>
		";

	}
	
}
// akhir tambah jenis barang

// awal tambah sumber

if (isset($_POST['tambahsumberbarang'])) {
	
	$sumber = $_POST['sumber'];

	$cek_sumber = strtolower(trim(htmlspecialchars($sumber)));
	$cek_sumber1 = str_replace(' ','', $cek_sumber);

	$result2 = mysqli_query($conn,"SELECT * FROM sumber  ");

	
	
	while ($row2 = mysqli_fetch_assoc($result2) ) {
		$sumber2 = $row2['sumber'];
		$cek_sumber2 = strtolower(trim(htmlspecialchars($sumber2)));
		$cek_sumber3 = str_replace(' ', '', $cek_sumber2);
		
		if ($cek_sumber3 == $cek_sumber1) {
			echo "<script>
				alert('gagal menambahkan ! sumber sudah ada!');
				document.location.href = 'sumber.php';
				
			</script>
		";
			exit();
		}
		
	}
	
	$query = "INSERT INTO sumber(id_sumber,sumber)
				VALUES (id_sumber,'$sumber')"; 

	$result = mysqli_query($conn,$query);

	

	

	if($result) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','sumber baru berhasil ditambahkan!','success');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','sumber baru gagl ditambahkan!','error');
			setTimeout(function(){

				document.location.href = 'sumber.php';


				},500);
			});

			</script>
		";

	}
	
}
// akhir tambah sumber

// awal tambah satuan

if (isset($_POST['tambahsatuanbarang'])) {
	
	$satuan = $_POST['satuan'];

	$cek_satuan = strtolower(trim(htmlspecialchars($satuan)));
	$cek_satuan1 = str_replace(' ','', $cek_satuan);

	$result2 = mysqli_query($conn,"SELECT * FROM satuan  ");

	
	
	while ($row2 = mysqli_fetch_assoc($result2) ) {
		$satuan2 = $row2['satuan'];
		$cek_satuan2 = strtolower(trim(htmlspecialchars($satuan2)));
		$cek_satuan3 = str_replace(' ', '', $cek_satuan2);
		
		if ($cek_satuan3 == $cek_satuan1) {
			echo "<script>
				alert('gagal menambahkan ! satuan sudah ada!');
				document.location.href = 'satuan.php';
				
			</script>
		";
			exit();
		}
		
	}
	
	$query = "INSERT INTO satuan(id_satuan,satuan)
				VALUES (id_satuan,'$satuan')"; 

	$result = mysqli_query($conn,$query);

	

	

	if($result) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Satuan baru berhasil ditambahkan!','success');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Satuan baru gagl ditambahkan!','error');
			setTimeout(function(){

				document.location.href = 'satuan.php';


				},500);
			});

			</script>
		";

	}
	
}
// akhir tambah satuan

// awal tambah program

if (isset($_POST['tambahprogrambarang'])) {
	
	$program = $_POST['program'];

	$cek_program = strtolower(trim(htmlspecialchars($program)));
	$cek_program1 = str_replace(' ','', $cek_program);

	$result2 = mysqli_query($conn,"SELECT * FROM program  ");

	
	
	while ($row2 = mysqli_fetch_assoc($result2) ) {
		$program2 = $row2['program'];
		$cek_program2 = strtolower(trim(htmlspecialchars($program2)));
		$cek_program3 = str_replace(' ', '', $cek_program2);
		
		if ($cek_program3 == $cek_program1) {
			echo "<script>
				alert('gagal menambahkan ! program sudah ada!');
				document.location.href = 'program.php';
				
			</script>
		";
			exit();
		}
		
	}
	
	$query = "INSERT INTO program(id_program,program)
				VALUES (id_program,'$program')"; 

	$result = mysqli_query($conn,$query);

	

	

	if($result) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','program baru berhasil ditambahkan!','success');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','program baru gagl ditambahkan!','error');
			setTimeout(function(){

				document.location.href = 'program.php';


				},500);
			});

			</script>
		";

	}
	
}
// akhir tambah program

// awal tambah barang program

if (isset($_POST['tambahbarangprogram'])) {
	
	$id_barang = $_POST['id_barang'];
	$id_program = $_POST['id_program'];

	$result2 = mysqli_query($conn,"INSERT INTO detail_program(id_barang,id_program) 
		VALUES('$id_barang','$id_program') ");

	
	if($result2) {
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','Barang berhasil ditambahkan ke program!','success');
			setTimeout(function(){

				document.location.href = 'detail_program.php?id_program=$id_program';


				},500);
			});

			</script>
		";
	}else{
		echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Barang gagal ditambahkan ke program !','error');
			setTimeout(function(){

				document.location.href = 'detail_program.php?id_program=$id_program';


				},500);
			});

			</script>
		";

	}
	
}
// akhir tambah barang program

function deletebarang($no_batch){
	global $conn;
	
	
$query = "DELETE FROM barang  WHERE no_batch='$no_batch' ";
mysqli_query($conn,$query);

return mysqli_affected_rows($conn);

}





function sisa_stok($a,$b){

	global $conn;
	$sisa_stok = $a-$b;
	return $sisa_stok;

}

function tambahuser($data) {
	global $conn;

	$nip = $data["nip"];
	$namapengguna = $data["namapengguna"];
	$alamat = $data["alamat"];
	$email = $data["email"];
	$no_hp = $data["no_hp"];
	$tanggal_lahir = $data["tanggal_lahir"];
	$password  = $data["password"];
	$konfirmasi = $data["konfirmasi"];

$result = mysqli_query($conn,"SELECT nip FROM admin");
$row = mysqli_fetch_assoc($result);

if ($password == $konfirmasi) {
	

//menambahkan data ke databse	
$query = "INSERT INTO admin (nip,username,alamat,email,no_hp,tanggal_lahir,password)
				values
		($nip,'$namapengguna','$alamat','$email','$no_hp','$tanggal_lahir','$password')";

$hasil =  mysqli_query($conn,$query);
		if ($hasil) {
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Berhasil','$namapengguna berhasil ditambahkan','success');
			setTimeout(function(){

			
				},500);
			});

			</script>
		";
		}else{
			echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Nip sudah digunakan','error');
			setTimeout(function(){

			
				},500);
			});

			</script>
		";
		}


}else if ($password != $konfirmasi) {
	echo "<script>

			window.addEventListener('load',function(){
				
			Swal.fire('Gagal','Kombinasi password tidak sama','error');
			setTimeout(function(){

			

				},500);
			});

			</script>
		";
}



}


















 ?>
<script src="js/dist/sweetalert2.all.min.js"></script>
