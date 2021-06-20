<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['update'])) {
        
        $id_laporan = $_POST['id_laporan'];
		$unit = $_POST['unit'];
		$nama_brg = $_POST['nama_brg'];
		$nup = $_POST['nup'];
		$id_jenis = $_POST['id_jenis'];
		$status = $_POST['id_service'];	
		$biaya = $_POST['biaya'];	
		//$tgl_pemesanan = date('Y-m-d');
		$deskripsi = $_POST['deskripsi'];
		

		$query = mysqli_query($koneksi, "UPDATE laporanservice SET unit='$unit', nama_brg='$nama_brg', nup='$nup', id_jenis='$id_jenis', id_service='$status', biaya='$biaya', deskripsi='$deskripsi' WHERE id_laporan = '$id_laporan' ");
		//$hasil = mysqli_query($koneksi, $query);
		if ($query) {
			header("location:index.php?p=service-laporan");
		} else {
			echo 'error' . mysqli_error($koneksi);
		}
	}
?>