<?php  

	include "../fungsi/koneksi.php";

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		//$id_jenis = $_GET['id_jenis'];
		$tanggal = date('Y-m-d');
		
		$query1 = mysqli_query($koneksi, "UPDATE permintaan SET status=1 WHERE id_permintaan='$id' ");		

		$query2 = mysqli_query($koneksi, "SELECT * FROM permintaan WHERE id_permintaan='$id'");
		
		$row = mysqli_fetch_assoc($query2);

		  $query3 = mysqli_query($koneksi, "INSERT INTO pengeluaran (unit, kode_brg, nup, jumlah, tgl_keluar)
											VALUES ('$row[unit]', '$row[kode_brg]', $row[nup], '$row[jumlah]', '$tanggal' )");

		$query3 .= mysqli_query($koneksi, "UPDATE stokbarang SET sisa='stok- $row[jumlah]' where kode_brg='$row[kode_brg]' ");
		  //$query3 .= mysqli_query($koneksi, "UPDATE stokbarang SET sisa='stok - $row[jumlah]' where kode_brg='$row[kode_brg]' ");
		if($query3) {
			header("location:index.php?p=datapesanan");
		} else {
			echo "ada yang salah" . mysqli_error($koneksi);
		}
	}


?>