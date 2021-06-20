<?php  

	include "../fungsi/koneksi.php";


	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = mysqli_query($koneksi, "SELECT * FROM laporanservice WHERE id_laporan = '$id' ");
		if (mysqli_num_rows($query)) {
			while($row2 = mysqli_fetch_assoc($query)):

?>

<section class="content">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Update Data Service</h3>
                </div>
                <form method="post"  action="edit_process.php" class="form-horizontal">
                    <div class="box-body">
                    	<input type="hidden" name="id_laporan" value="<?= $row2['id_laporan']; ?>">
						<!-- <div class="form-group">
                            <label for="jumlah" class="col-sm-offset-1 col-sm-3 control-label">Tanggal Masuk</label>
                             <div class="col-sm-4">
                                <input type="text" class="form-control tanggal" value="<?= $row2['tgl_masuk']; ?>" name="tgl_masuk">
                            </div> 
                        </div> -->
                        <div class="form-group ">
                            <label for="id_laporan" class="col-sm-offset-1 col-sm-3 control-label">Id Laporan</label>
                            <div class="col-sm-4">
                                <input type="text" readonly value="<?= $row2['id_laporan']; ?>" class="form-control" name="kode_brg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="unit" class="col-sm-offset-1 col-sm-3 control-label">uUnit</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= $row2['unit']; ?>" name="unit">
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="jenis_brg" class="col-sm-offset-1 col-sm-3 control-label">Jenis Barang</label>
                            <div class="col-sm-4">
                                <select id="jenis_brg" required="isikan dulu" class="form-control" name="id_jenis">
                                <option value="">--Pilih Jenis Barang--</option>
                                <?php  
                                    
                                    $queryJenis = mysqli_query($koneksi, "select * from jenis_barang");
                                    if (mysqli_num_rows($queryJenis)) {
                                        $selected = "";
                                        while($row=mysqli_fetch_assoc($queryJenis)):
                                           
                                    ?>                                        
                                        <option <?php if($row2['id_jenis']==$row['id_jenis']) echo "selected"; ?>  value="<?= $row['id_jenis']; ?>"><?= $row['jenis_brg']; ?></option>
                                    <?php endwhile; } ?>                                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="tes"for="nama_brg" class="col-sm-offset-1 col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= $row2['nama_brg']; ?>" name="nama_brg">
                            </div>
                        </div>
						<div class="form-group">
                            <label for="jumlah" class="col-sm-offset-1 col-sm-3 control-label">Nup</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" readonly  value="<?= $row2['nup']; ?>" name="nup">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-offset-1 col-sm-3 control-label">Status</label>
                            <div class="col-sm-4">
                                <select id="status" required="isikan dulu" class="form-control" name="id_service">
                                <option value="">--Pilih Jenis Barang--</option>
                                <?php  
                                    include "../fungsi/koneksi.php";
                                    $queryJenis = mysqli_query($koneksi, "select * from hasilservice");
                                    if (mysqli_num_rows($queryJenis)) {
                                        while($row=mysqli_fetch_assoc($queryJenis)):
                                    ?>                                        
                                        <option value="<?= $row['id_service']; ?>"><?= $row['status']; ?></option>
                                    <?php endwhile; } ?>                                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi" class="col-sm-offset-1 col-sm-3 control-label">Deskripsi</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?= $row2['deskripsi']; ?>" name="deskripsi">
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="biaya" class="col-sm-offset-1 col-sm-3 control-label">Biaya</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" value="<?= $row2['biaya']; ?>" name="biaya">
                            </div>
                        </div>
                       <!-- <div class="form-group ">
                            <label for="kode_brg" class="col-sm-offset-1 col-sm-3 control-label">Bagian</label>
                            <div class="col-sm-4">
                                <input type="text" readonly  value="<?= $row2['bagian']; ?>" class="form-control" name="kode_brg">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <input type="submit" name="update" class="btn btn-primary col-sm-offset-4 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endwhile; } }  ?>

<script>
    $(document).ready(function(){
        $('.tanggal').datepicker({
            format:"yyyy-mm-dd",
            autoclose:true
        });
    });
</script>