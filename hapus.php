<?php 

require 'function.php';

$no_kode =$_GET["no_kode"];
if (deletebarang($no_kode) >0) {
	echo "
	<script>
	alert('data berhasil dihapus');
	document.location.href='home.php';
	</script>
	";
}else{
	var_dump(mysqli_error($conn));
}



 ?>