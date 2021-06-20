<?php
session_start();

include "assets/firewall/firewall.php";
include "fungsi/koneksi.php";
include "fungsi/ceklogin.php";

$Firewall = new Firewall(); $Firewall->SecureUris();
$err="";

if(isset($_POST['login'])){
	$username = addslashes(trim($_POST['username']));
	$password = md5($_POST['password']);
	$level = $_POST['level'];

	$query = "SELECT * FROM user WHERE username='$username' && password='$password'";
	$hasil = mysqli_query($koneksi, $query);
	
	if (!$hasil) {
		echo "ada error";
	} 

	if (mysqli_num_rows($hasil) == 0) {
		$err="
		<div class='row' style='margin-top: 15px';>
	       <div class='col-md-12'>
	        	<div class='box box-solid bg-red'>
	        		<div class='box-header'>
	        			<h3 class='box-title'>Login Gagal!</h3>
	        		</div>
	        		<div class='box-body'>
	        			<p>Username atau password yang anda masukan salah.</p>
	        		</div>
			    </div>
			 </div>
		 </div>
	</div>";
	} else {
		$row = mysqli_fetch_array($hasil);
		$_SESSION['username'] = $row['username'];
		$_SESSION['level'] = $row['level'];

		if($row['level'] == "umum" && $level == "umum"  ) {
			$_SESSION['login'] = true;
			header("location:umum/index.php");
		} else if ($row['level'] == "pidana" && $level == "pidana" ) {
			$_SESSION['login'] = true;
			header("location:pidana/index.php");
			
		}else if ($row['level'] == "perdata" && $level == "perdata" ) {
			$_SESSION['login'] = true;
			header("location:perdata/index.php");
			
		}else if ($row['level'] == "hukum" && $level == "hukum" ) {
			$_SESSION['login'] = true;
			header("location:hukum/index.php");
			
		}else if ($row['level'] == "ptip" && $level == "ptip" ) {
			$_SESSION['login'] = true;
			header("location:ptip/index.php");
			
		}else if ($row['level'] == "admin" && $level == "admin" ) {
			$_SESSION['login'] = true;
			header("location:admin/index.php");
			
		} else if ($row['level'] == "pkk" && $level == "pkk") {
			$_SESSION['login'] = true;
			header("location:ppk/index.php");

		}else if($row['level'] == "teknisi" && $level == "teknisi"){
			$_SESSION['login'] = true;
			header("location:teknisi/index.php");

		}else if($row['level'] == "ketua" && $level == "ketua"){
			$_SESSION['login'] = true;
			header("location:ketua/index.php");

		}else if($row['level'] == "wakil" && $level == "wakil"){
			$_SESSION['login'] = true;
			header("location:wakil/index.php");

		}else if($row['level'] == "kepegawaian" && $level == "kepegawaian"){
			$_SESSION['login'] = true;
			header("location:kepegawaian/index.php");

		}else if($row['level'] == "ptsp" && $level == "ptsp"){
			$_SESSION['login'] = true;
			header("location:ptsp/index.php");

		}else if($row['level']== "hakim1" && $level == "hakim1"){
			$_SESSION['login'] == true;
			header("location:hakim1/index.php");
		}else if($row['level'] == "hakim2" && $level == "hakim2"){
			$_SESSION['login'] == true;
			header("location:hakim2/index.php");
		}else if($row['level'] == "sekretaris" && $level == "sekretaris"){
			$_SESSION['login'] == true;
			header("location:sekretaris/index.php");
		}
		else {
			$err="
		<div class='row' style='margin-top: 15px';>
	       <div class='col-md-12'>
	        	<div class='box box-solid bg-red'>
	        		<div class='box-header'>
	        			<h3 class='box-title'>Login Gagal!</h3>
	        		</div>
	        		<div class='box-body'>
	        			<p>Anda salah memilih level login.</p>
	        		</div>
			    </div>
			 </div>
		 </div>
	</div>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SI-APPEM</title>
	<!-- Icon  -->
	<link rel="shortcut icon" type="image/icon" href="pv.png">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/bootstrap/css/custom.css" rel="stylesheet">
    <link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" >
    <link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet">
    <link href="assets/fa/css/font-awesome.min.css" rel="stylesheet">  
</head>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">        
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      	<h3 class="text-center">SI-APPEM</h3>
      	<img src="pv.png" style="width: 120px; height: 100px;">        
        <form method="post">
          <div class="form-group">           	
          	<div class="input-group">
          		<span class="input-group-addon"><i class="fa fa-user"></i></span>
	            <input type="text" class="form-control" placeholder="Username" name="username" required  />	            
            </div>
          </div>
          <div class="form-group">
          	<div class="input-group">
	            <span class="input-group-addon"><i class="fa fa-unlock"></i></span>
	            <input  type="password" class="form-control" placeholder="Password" name="password"  required>
            </div>
          </div>
          <div class="form-group">
          	<div class="input-group col-md-7">          	
          		<span class="input-group-addon"><i class="fa fa-shield"></i></span>
	            <select class="form-control" name="level" required>            	
	            	<option value>[Pilih Level]</option>
	            	<option value="umum">Umum</option>
					<option value="ketua">Ketua</option>
					<option value="wakil">Wakil</option>
					<option value="kepegawaian">Kepegawaian</option>
					<option value="ptsp">PTSP</option>
					<option value="pidana">Pidana</option>
					<option value="perdata">Perdata</option>
					<option value="hukum">Hukum</option>
					<option value="ptip">PTIP</option>
	            	<option value="admin">Admin</option>
	            	<option value="pkk">PPK</option>
					<option value="teknisi">Teknisi</option>
					<option value="hakim1">Hakim1</option>
					<option value="hakim2">Hakim2</option>
					<option value="sekretaris">Sekretaris</option>
	            </select>
            </div>            
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="submit" class="btn btn-primary btn-block btn-flat pull-right" value="Login" name="login"/>
            
            </div><!-- /.col -->
          </div>
        </form>
       

      </div>
      <?= $err; ?>
      <!-- /.login-box-body 
      <div class="row" style="margin-top: 15px;">
	       <div class="col-md-12">
	        	<div class="box box-solid bg-red">
	        		<div class="box-header">
	        			<h3 class="box-title">Gagal Login</h3>
	        		</div>
	        		<div class="box-body">
	        			<p>Username atau password salah</p>
	        		</div>
	        	</div>
	        </div>
        </div>
    </div>
	-->     
    <!-- /.login-box -->

    <script src="assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
