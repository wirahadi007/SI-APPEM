<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$unit = $_POST['unit'];
		$nama_brg = $_POST['nama_brg'];
		$id_jenis = $_POST['id_jenis'];
		$status = $_POST['id_service'];	
		$jumlah = $_POST['jumlah'];	
		$tgl_pemesanan = date('Y-m-d');
		$deskripsi = $_POST['deskripsi'];
		

		$query = "INSERT into laporanservice (unit, nama_brg, id_jenis, id_service, biaya, tgl_laporan, deskripsi ) VALUES 
										('$unit', '$nama_brg', '$id_jenis', '$status','$jumlah', '$tgl_pemesanan', '$deskripsi')

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=formpesan");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}
?>