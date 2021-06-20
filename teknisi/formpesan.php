<?php  
    include "../fungsi/koneksi.php";
    $error = "";


?>

<section class="content">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Form Permintaan Barang</h3>
                </div>
                <form method="post" id="tes"  action="add-proses.php" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="nama_brg" class="a col-sm-3 control-label">Bagian</label>
                            <div class="col-sm-3">
                                <input type="text" readonly value="<?= $_SESSION['username']; ?>" class="form-control" name="unit">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_brg" class=" col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-5">
                                <input id="nama_brg" type="text" required="isikan dulu" class="form-control" name="nama_brg" required>                                
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="jenis_brg" class=" col-sm-3 control-label">Jenis Barang</label>
                            <div class="col-sm-5">
                                <select id="jenis_brg" required="isikan dulu" class="form-control" name="id_jenis">
                                <option value="">--Pilih Jenis Barang--</option>
                                <?php  
                                    include "../fungsi/koneksi.php";
                                    $queryJenis = mysqli_query($koneksi, "select * from jenis_barang");
                                    if (mysqli_num_rows($queryJenis)) {
                                        while($row=mysqli_fetch_assoc($queryJenis)):
                                    ?>                                        
                                        <option value="<?= $row['id_jenis']; ?>"><?= $row['jenis_brg']; ?></option>
                                    <?php endwhile; } ?>                                      
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status" class=" col-sm-3 control-label">Status</label>
                            <div class="col-sm-5">
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
                            <label for="jumlah" class=" col-sm-3 control-label">Total Biaya</label>
                            <div class="col-sm-4">
                                <input id="jumlah" type="number" class="form-control" name="jumlah" required>                                
                            </div>
                            <span class="col-sm-7"> <?php echo $error; ?></span>
                        </div>
						<div class="form-group">
                            <label for="deskripsi" class=" col-sm-3 control-label">Deskripsi</label>
                            <div class="col-sm-5">
                                <input id="deskripsi" type="text" required="isikan dulu" class="form-control" name="deskripsi" required>                                
                            </div>
                            <span class="col-sm-7"> <?php echo $error; ?></span>
                        </div>
                         
                        
                        <div class="form-group">
                            <input type="submit" id="simpan" name="simpan" class="btn btn-primary col-sm-offset-3 " value="Simpan" > 
                            &nbsp;
                            <input type="reset" class="btn btn-danger" value="Batal">                                                                              
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-6 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Service Hari Ini</h3>
                </div>
                
                    <table class="table table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jenis</th>
                            <th>Status</th>
                            <th>Biaya</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Input</th>
                            <th>Aksi</th>
                        </tr>
                        <tr>
                        <?php 
                            $sekarang  = date("Y-m-d");
                            $queryTampil = mysqli_query($koneksi, "SELECT laporanservice.deskripsi,laporanservice.id_laporan, laporanservice.id_jenis, hasilservice.status, laporanservice.nama_brg, hasilservice.status, laporanservice.biaya, laporanservice.tgl_laporan FROM laporanservice INNER JOIN hasilservice ON laporanservice.id_service  = hasilservice.id_service"  );
                            $no = 1;
                            if(mysqli_num_rows($queryTampil) > 0) {
                                while($row = mysqli_fetch_assoc($queryTampil)):
                            

                         ?>  
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['nama_brg']; ?></td>
                            <td><?php echo $row['id_jenis']?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td><?php echo $row['biaya'] ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                            <td><?php echo $row['tgl_laporan']; ?></td>
                            
                            <td><a href="hapusps.php?id=<?php echo $row['id_laporan']; ?>" class="btn btn-danger">Hapus</a></td>
                        </tr>
                    <?php $no++; endwhile; } else { echo "<tr><td>Tidak ada pelaporan service saat ini</td></tr>"; } ?>
                    </table>    
                <!-- <div class="box-body">
                    <a class="btn btn-success" href="pesan.php" >Ajukan Perbaikan</a>
                </div> -->
            </div>
        </div>
    </div>
</section>

<script>
    // $(document).ready(function(){
    //     $("#jenis_brg").change(function(){
    //         var jenis = $(this).val();
    //         var dataString = 'jenis='+jenis;
    //         $.ajax({
    //             type:"POST",
    //             url:"getdata.php",
    //             data:dataString,
    //             success:function(html){
    //                 $("#nama_brg").html(html);                    
    //             }
    //         });
    //     });

    //     $("#nama_brg").change(function(){
    //         var kode = $(this).val();
    //         var dataString = 'kode='+kode;
    //         $.ajax({
    //             type:"POST",
    //             url:"getkode.php",
    //             data:dataString,
    //             success:function(html){
    //                 $("#stok").val(html);        
    //             }
    //         });
    //     });
				       
    // });


	
	//  function cek_stok(){
    //             var jumlah = $("#jumlah").val();                
    //             var kode_brg = $("#nama_brg").val();   
    //             $.ajax({
    //                 url: 'cekstok.php',
    //                 data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
    //                 dataType:'json',
    //             }).success(function (data) {                                      
                                      
                   
    //                     if(data.hasil == 1){                            
    //                         $("#tes").submit(function(e){
    //                             e.preventDefault();
    //                             alert(data.pesan);
    //                         });
    //                     }
                        
                   

                });
            }

   function sendAjax() {
    setTimeout(
        function() {
            var jumlah = $("#jumlah").val();                
                var kode_brg = $("#nama_brg").val();   
                $.ajax({
                    url: 'cekstok.php',
                    data:"jumlah="+jumlah+"&kode_brg="+kode_brg,
                    dataType:'json',
                }).success(function (data) {                                      
                                      
                   
                        if(data.hasil == 1){                            
                            
                                alert(data.pesan);
                                $("#jumlah").val("");
                            
                        }
                        
                   

                });
        }, 1000);
}
</script>