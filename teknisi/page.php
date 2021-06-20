 
<?php 
  
    $page = isset($_GET['p']) ? $_GET['p'] : "";

    if ($page == 'formpesan') {
        include_once "formpesan.php";
    } else if ($page=="") {
        include_once "main.php";
    } else if ($page=="datapesanan") {
        include_once "datapesanan.php";
    } else if ($page=="hapus") {
        include_once "hapusps.php";
    } else if($page == "detil"){
        include_once "detilpesan.php";
    }
 ?>
 
