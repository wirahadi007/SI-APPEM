
<?php  
    include "../fungsi/koneksi.php";
	include "../fungsi/fungsi.php";

    if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];
        echo $id;

        if ($_GET['konfirmasi'] == 'edit') {
            header("location:?p=edit&id=$id");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapus&id=$id");
        } 
    }

    $sekarang  = date("Y-m-d");
    $query = mysqli_query($koneksi, "SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, laporan_sementara.tgl_lapor, laporan_sementara.unit, stokbarang.nama_brg,stokbarang.kode_brg, stokbarang.nup  FROM laporan_sementara INNER JOIN stokbarang ON laporan_sementara.nup  = stokbarang.nup " ); 
    
    
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Laporan Bulanan Bagian</h3>
                </div>    
                <div class="box-body"> 
				<a href="cetaklaporan.php" target="_blank" style="margin:10px;" class="btn btn-success"><i class='fa fa-print'> Cetak Laporan</i></a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="datapesanan">
                            <thead  > 
                                <tr>
                                    <th>No</th>
                                    <th>Bagian</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Barang</th>
                                    <th>Nup</th>
                                    <th>Kondisi</th>
                                    <th>Tgl_Lapor</th>
                                    <th>Deskripsi</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

                                     ?>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $row['unit']; ?></td>
                                        <td><?php echo $row['nama_brg']; ?></td>
                                        <td><?php echo $row['kode_brg']; ?></td>
                                        <td><?php echo $row['nup'] ?></td>
                                        <td><?php echo $row['kondisi']; ?></td>
                                        <td><?php echo $row['tgl_lapor']; ?></td>
                                        <td><?php echo $row['deskripsi']; ?></td>
                                                                                                                                   
                            </tr>
                            
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Belum ada data laporan lain</td></tr>" . mysqli_error($koneksi);} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>



</section>

