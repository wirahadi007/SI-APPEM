<?php  

	//use PHPMailer\PHPMailer\PHPMailer;
	//use PHPMailer\PHPMailer\Exception;

	//librrary
	// require_once "../assets/phpmailer/PHPMailer.php";
	// require_once "../assets/phpmailer/Exception.php";
	// require_once "../assets/phpmailer/OAuth.php";
	// require_once "../assets/phpmailer/POP3.php";
	// require_once "../assets/phpmailer/SMTP.php";

	require("../assets/phpmailer/PHPMailer.php");
 	require("../assets/phpmailer/SMTP.php");

	include "../fungsi/koneksi.php";
	$tgl = date('Y-m-d');

	

	$query =  "INSERT INTO permintaan SELECT * FROM sementara";
	$query2 = "DELETE FROM sementara WHERE tgl_permintaan='$tgl'";

	// $email_pengirim = "siapemapp@gmail.com";
	// 		$nama_pengirim = "umum";
	// 		$email_penerima = "charlesotojr@gmail.com";
	// 		$subjek= "Pengajuan Perbaikan Barang Rusak";
	// 		$pesan="Permintaan Pengajuan Perbaikan Barang Rusak";

	// 		$mail = new PHPMailer\PHPMailer\PHPMailer();
	// 		$mail->isSMTP();

	// 		$mail->Host = "smtp.gmail.com";
	// 		$mail->Username="siapemapp@gmail.com";
	// 		$mail->Password="kosfvgxrtynahiwj";
	// 		$mail->Port= 465;
	// 		$mail->SMTPAuth = true;
	// 		$mail->SMTPSecure = 'ssl';
	// 		$mail->SMTPDebug = 1;

	// 		$mail->setFrom($email_pengirim, $nama_pengirim);
	// 		$mail->addAddress($email_penerima);
	// 		$mail->isHTML(true);
	// 		$mail->Subject = $subjek;
	// 		$mail->Body=$pesan;

	// 		$send = $mail->send();
	// 		if ($send) {
	// 			echo"<h1>Email berhadil dikirim</h1>";
	// 		}else {
	// 			echo"<h1>Email gagal dikirim</h1>";
	// 		}

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
						"body": "Anda Mempunyai 1 Permintaan Perbaikan Barang HAKIM2"
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
			




	if(mysqli_query($koneksi, $query)){
			mysqli_query($koneksi, $query2);
			

			header("Location:index.php?p=datapesanan");
	} else {
		echo "gagal euy" . mysqli_error($koneksi);
	}


?>