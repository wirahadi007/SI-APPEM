<?php  

	include "../fungsi/koneksi.php";

	if(isset($_POST['simpan'])) {

		$unit = $_POST['unit'];
		$kode_brg = $_POST['kode_brg'];
		$nup = $_POST['nup'];		
		$tgl_lapor = date('Y-m-d');
		$id_jenis = $_POST['id_jenis'];
        $id_kondisi = $_POST['kondisi'];
		$deskripsi = $_POST['deskripsi'];
		

		$query = "INSERT into laporan_sementara (unit, kode_brg, id_jenis, nup, kondisi, tgl_lapor, deskripsi) VALUES 
										('$unit', '$kode_brg', '$id_jenis', '$nup', '$id_kondisi', '$tgl_lapor', '$deskripsi')

			";

$curl = curl_init();
$authKey = "key=AAAADugpFrk:APA91bE6kj3DT8YCpidqQn5gT-D6hlN8Vi6WeORHcbn40L6NZY6neWLrOgQSwZLJ6bKmDUS7uGNYOo0oB7MAgDvnswPr66JSgyCM0K-aCMXXuqwRVfbfbqQ-9v-jnqniwWgP9sJYTfMH";
$registration_ids = '["eFHHsBnPFFA:APA91bHOYEXTS_tmXkdhZZIs0xSQJt_I8GKr4QZJlIQC0aPfUVUFWLuDL8LMBRPbQxdPQuNfQt_4yuS85PR2X_0QqJQymk8uzJ08VNCWKsDr9HQ6Zz4J4VWa8HJcQhg_I87GTWXj6V-o", "chKxo6SX1Po:APA91bGBbIwTiqCRn9w8GXYtBMtes65IXGsQliq-l694sy8Edhb3YTuN_Y_CKvuSRXl7EFtBfLeGyXGdVRtOJ40AdrLfvTXPI83rjGvzrIglETfaFJuiMLKPaPtktrDcrAixN05XLrbl"]';
curl_setopt_array($curl, array(
CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
CURLOPT_RETURNTRANSFER => true,
CURLOPT_ENCODING => "",
CURLOPT_MAXREDIRS => 10,
CURLOPT_TIMEOUT => 30,
CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
CURLOPT_CUSTOMREQUEST => "POST",
CURLOPT_POSTFIELDS => '{
				"registration_ids": ' . $registration_ids . ',
				"notification": {
					"title": "SI-APPEM",
					"body": "Anda Mempunyai 1 Pelaporan Bulanan PIDANA"
				}
			}',
CURLOPT_HTTPHEADER => array(
	"Authorization: " . $authKey,
	"Content-Type: application/json",
	"cache-control: no-cache"
),
));
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

		$hasil = mysqli_query($koneksi, $query);
		if ($hasil) {
			header("location:index.php?p=laporanbulanan");
		} else {
			die("ada kesalahan : " . mysqli_error($koneksi));
		}
	}
?>