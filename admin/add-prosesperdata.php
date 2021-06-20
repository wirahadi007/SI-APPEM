<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$kode_brg = $_POST['kode_brg'];
		$id_jenis = $_POST['id_jenis'];
		$nama_brg = $_POST['nama_brg'];
		$stok = $_POST['jumlah'];
		$nup = $_POST['nup'];
		//$suplier = $_POST['suplier'];
		$tgl_masuk = $_POST['tgl_masuk'];		

		//die($stok);

		$query = "INSERT into stokbarang_perdata (kode_brg, id_jenis, nama_brg, stok, tgl_masuk, nup, sisa) VALUES 
										('$kode_brg', '$id_jenis', '$nama_brg', '$stok', '$tgl_masuk', '$nup', '$stok');

			";
		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=material");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}

	}

?>