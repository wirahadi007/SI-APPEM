<?php  

    include_once "../fungsi/koneksi.php";

    if(isset($_POST['simpan'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $level = $_POST['level'];
        $manajer = $_POST['manajer'];
        $asmen = $_POST['asmen'];

        //$query = mysqli_query($koneksi, "INSERT INTO user VALUES ('', '$username', '$password', '$level','$manajer','$asmen') "); 
        $query = mysqli_query($koneksi, "INSERT INTO user (username, password, level, manajer, asmen)
                                            VALUES ('$username', '$password', '$level', '$manajer', '$asmen');");
        if ($query) {
            header("location:index.php?p=user");
        } else {
            echo 'gagal : ' . mysqli_error($koneksi);
        }
    }


?>

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Tambah Data User</h3>
                </div>
                <form method="post"  action="" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="username" class="col-sm-offset-1 col-sm-3 control-label">Username</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="username">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="paswword"class="col-sm-offset-1 col-sm-3 control-label">Password</label>
                            <div class="col-sm-4">
                                <input required type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="manajer" class="col-sm-offset-1 col-sm-3 control-label">Manajer</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="manajer">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="asmen" class="col-sm-offset-1 col-sm-3 control-label">Asmen</label>
                            <div class="col-sm-4">
                                <input  required type="text"  class="form-control" name="asmen">
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label id="tes"for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Level</label>
                            <div class="col-sm-4">
                                <select required name="level" class="form-control">
                                        <option value>[Pilih Level]</option>
                                        <option value="umum">Umum</option>
                                        <option value="pidana">Pidana</option>
                                        <option value="perdata">Perdata</option>
                                        <option value="hukum">Hukum</option>
                                        <option value="ptip">PTIP</option>
                                        <option value="admin">Admin</option>
                                        <option value="pkk">PPK</option>
                                        <option value="kepegawaian">Kepeg</option>
                                        <option value="ptsp">PTSP</option>
                                        <option value="teknisi">Teknisi</option>
                                        <option value="hakim1">Hakim1</option>
                                        <option value="hakim2">Hakim2</option>
                                        <option value="ketua">Ketua</option>
                                        <option value="wakil">Wakil</option>
                                        <option value="sekretaris">sekretaris</option>
                                </select>
                            </div>
                        </div>                         
                        <div class="form-group">
                            <input type="submit" name="simpan" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


