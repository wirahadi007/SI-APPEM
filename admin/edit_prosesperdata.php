<?php  

include "../fungsi/koneksi.php";

if(isset($_POST['update'])) {
	
	$kode_brg = $_POST['kode_brg'];
	$nama_brg = $_POST['nama_brg'];
	$id_jenis = $_POST['id_jenis'];
	$tgl_masuk = $_POST['tgl_masuk'];
	$nup = $_POST['nup'];
	$stok = $_POST['jumlah'];

	

	$query = mysqli_query($koneksi, "UPDATE stokbarang_perdata SET nama_brg='$nama_brg', id_jenis='$id_jenis', tgl_masuk='$tgl_masuk', nup='$nup', stok='$stok', sisa=stok-keluar WHERE id_jenis ='$id_jenis' ");
	if ($query) {
		header("location:index.php?p=material");
	} else {
		echo 'error' . mysqli_error($koneksi);
	}

}



?>