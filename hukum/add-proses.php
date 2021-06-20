<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$unit = $_POST['unit'];
		$kode_brg = $_POST['kode_brg'];
		$nup = $_POST['nup'];
		$jumlah = $_POST['jumlah'];		
		$tgl_pemesanan = date('Y-m-d');
		$id_jenis = $_POST['id_jenis'];
		$deskripsi = $_POST['deskripsi'];
		

		$query = "INSERT into sementara (unit, kode_brg, nup, id_jenis,  jumlah, tgl_permintaan, deskripsi ) VALUES 
										('$unit', '$kode_brg', '$nup', '$id_jenis', '$jumlah', '$tgl_pemesanan', '$deskripsi')

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=formpesan");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}
?>