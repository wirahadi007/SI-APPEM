<?php  
    include "../fungsi/koneksi.php";
    $error = "";

?>


<section class="content">
    <div class="row">
        <div class="col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Form Pelaporan Bulanan</h3>
                </div>
                <form method="post" id="tes"  action="addbulanan.php" class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group ">
                            <label for="nama_brg" class="a col-sm-3 control-label">Bagian</label>
                            <div class="col-sm-3">
                                <input type="text" readonly value="<?= $_SESSION['username']; ?>" class="form-control" name="unit">
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
                            <label  for="nama_brg" class="col-sm-3 control-label">Nama Barang</label>
                            <div class="col-sm-5">
                                <select id="nama_brg" required="isikan dulu" class="form-control" name="kode_brg">
                                <option value="">--Pilih Nama Barang--</option>                                                                  
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="nup" class="col-sm-3 control-label">Nup</label>
                            <div class="col-sm-4">
                                <input id="nup" value="" type="text" class="form-control" name="nup">
                            </div>                                                        
                        </div>
                        <div class="form-group">
                            <label for="kondisi" class=" col-sm-3 control-label">Kondisi Barang</label>
                            <div class="col-sm-5">
                                <select id="kondisi" required="isikan dulu" class="form-control" name="kondisi">
                                <option value="">--Pilih Kondisi Barang--</option>
                                <?php  
                                    include "../fungsi/koneksi.php";
                                    $queryKondisi = mysqli_query($koneksi, "select * from kondisi");
                                    if (mysqli_num_rows($queryKondisi)) {
                                        while($row=mysqli_fetch_assoc($queryKondisi)):
                                    ?>                                        
                                        <option value="<?= $row['kondisi']; ?>"><?= $row['kondisi']; ?></option>
                                    <?php endwhile; } ?>                                      
                                </select>
                            </div>
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
                    <h3 class="text-center">Data Laporan Hari Ini</h3>
                </div>
                
                    <table class="table table-responsive">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Kode Barang</th>
                            <th>Nup</th>
                            <th>Kondisi</th>
                            <th>Deskripsi</th>
                           <!-- <th>Aksi</th> -->
                        </tr>
                        <tr>
                        <?php 
                            $sekarang  = date("Y-m-d");
                            $queryTampil = mysqli_query($koneksi, "SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, stokbarang.nama_brg,stokbarang.kode_brg, stokbarang.nup  FROM laporan_sementara INNER JOIN stokbarang ON laporan_sementara.nup = stokbarang.nup WHERE tgl_lapor = '$sekarang' AND laporan_sementara.unit='$_SESSION[username]' "  );
                            $no = 1;
                            if(mysqli_num_rows($queryTampil) > 0) {
                                while($row = mysqli_fetch_assoc($queryTampil)):
                            

                         ?>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $row['nama_brg']; ?></td>
                            <td><?php echo $row['kode_brg']; ?></td>
                            <td><?php echo $row['nup'] ?></td>
                            <td><?php echo $row['kondisi'] ?></td>
                            <td><?php echo $row['deskripsi']; ?></td>
                            
                           <!-- <td><a href="hapusps.php?id=<?php echo $row['id_sementara']; ?>" class="btn btn-danger">Hapus</a></td> -->
                        </tr>
                    <?php $no++; endwhile; } else { echo "<tr><td>Tidak ada permintaan barang hari ini</td></tr>"; } ?>
                    </table>    
                <div class="box-body">
                   <!-- <a class="btn btn-success" href="pesan.php" >Ajukan Perbaikan</a> -->
                </div>
            </div>
        </div>
    </div>
</section>


        
<script>
    $(document).ready(function(){
        $("#jenis_brg").change(function(){
            var jenis = $(this).val();
            var dataString = 'jenis='+jenis;
            $.ajax({
                type:"POST",
                url:"getdata.php",
                data:dataString,
                success:function(html){
                    $("#nama_brg").html(html);                    
                }
            });
        });

        $("#nama_brg").change(function(){
            var kode = $(this).val();
            var dataString = 'kode='+kode;
            $.ajax({
                type:"POST",
                url:"getnup.php",
                data:dataString,
                success:function(html){
                    $("#nup").val(html);        
                }
            });
        });
				       
    });



</script>