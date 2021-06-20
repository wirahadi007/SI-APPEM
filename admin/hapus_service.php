<?php
	include "../fungsi/koneksi.php";

	if(isset($_GET['id'])){
		$id=$_GET['id'];
		
	    $query = mysqli_query($koneksi,"delete from laporanservice where id_laporan='$id'");
	    if ($query) {
	    	header("location:index.php?p=service-laporan");
	    } else {
	    	echo 'gagal';
	    }
	
	}
?>