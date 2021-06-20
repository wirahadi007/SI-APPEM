 
<?php 
  
    $page = isset($_GET['p']) ? $_GET['p'] : "";

    if ($page == 'formpesan') {
        include_once "formpesan.php";
    } else if ($page=="") {
        include_once "main.php";
    } else if ($page=="datapesanan") {
        include_once "datapesanan.php";
    }  else if ($page=="material") {
        include_once "material.php";

    }else if($page=="materialpidana"){
        include_once "materialpidana.php";
    }else if($page=="materialperdata"){
        include_once "materialperdata.php";
    }else if($page=="materialhukum"){
        include_once "materialhukum.php";
    }else if($page == "materialptip"){
        include_once "materialptip.php";

    }else if ($page=="tambahmaterial") {
        include_once "tambahmaterial.php";
    }else if($page=="tambahpidana"){
        include_once "tambahpidana.php";
    }else if($page=="tambahperdata"){
        include_once "tambahperdata.php";
    }else if($page=="tambahhukum"){
        include_once "tambahhukum.php";
    }else if($page == "tambahptip"){
        include_once "tambahptip.php";

    }else if ($page=="user") {
        include_once "user.php";

    }  else if ($page=="edit") {
        include_once "editmaterial.php";
    }else if($page=="editpi"){
        include_once "editpidana.php";
    }else if($page=="editp"){
        include_once "editperdata.php";
    }else if($page=="edith"){
        include_once "edithukum.php";
    }else if($page == "edit_service"){
        include_once "edit_service.php";


    }else if ($page=="hapus") {
        include_once "hapusmaterial.php";
    }else if($page=="hapuspidana"){
        include_once "hapuspidana.php";
    }else if($page=="hapusperdata"){
        include_once "hapusperdata.php";
    }else if($page=="hapush"){
        include_once "hapusservice.php";
    }else if($page == "hapusptip"){
        include_once "hapusptip.php";
    
    
    }else if ($page=="hapususer") {
        include_once "hapususer.php";
    } else if ($page=="edituser") {
        include_once "edituser.php";
    } else if ($page=="tambahuser") {
        include_once "tambahuser.php";

    } else if ($page=="cetakstok") {
        include_once "halcetak.php";
    }else if($page=="cetakpidana"){
        include_once "cetakpidana.php";
    }else if($page=="cetakperdata"){
        include_once "cetakperdata.php";
    }else if($page=="cetakhukum"){
        include_once "cetakhukum.php";
    }else if($page == "cetakptip"){
        include_once "cetakptip.php";

    }else if($page == "detil"){
        include_once "detilpesan.php";
    }else if($page == "lapumum"){
        include_once "lapumum.php";
    }else if ($page == "service-laporan") {
        include_once "laporan-service.php";
    }else if ($page == "tambahservice") {
        include_once "tambah-service.php";
    }else if($page == "cekanggaran"){
        include_once "anggaranKeluar.php";
    }else if($page == "hapus_service"){
        include_once "hapus_service.php";
    }
 ?>
 
