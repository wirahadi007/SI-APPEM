<?php  

	if (isset($_SESSION['login'])) {
		if ($_SESSION['level'] == "admin") {
			header("location:admin/index.php");
		} else if ($_SESSION['level'] == "pkk"){
			header("location:pkk/index.php");
		} else if ($_SESSION['level'] == "user"){
			header("location:umum/index.php");
		} else {
			header("location:index.php");
		}
	}

?>