<?php  

	include "../fungsi/koneksi.php";
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = mysqli_query($koneksi, "DELETE FROM laporanservice WHERE id_laporan='$id' ");

		if($query) {
			header("Location:index.php?p=formpesan");
		}
	}


?>