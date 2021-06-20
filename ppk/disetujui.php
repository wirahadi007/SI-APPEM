
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

    
    $query = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.kode_brg, tgl_permintaan, unit, nama_brg, jumlah, permintaan.nup,  status FROM permintaan INNER JOIN stokbarang ON permintaan.nup = stokbarang.nup WHERE status=1 ORDER BY tgl_permintaan DESC "); 
    // $query2 = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.kode_brg, tgl_permintaan, unit, nama_brg, jumlah, nup,  status FROM permintaan INNER JOIN stokbarang_pidana ON permintaan.kode_brg = stokbarang_pidana.kode_brg WHERE status=1 ORDER BY tgl_permintaan DESC ");
    // $query3 = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.kode_brg, tgl_permintaan, unit, nama_brg, jumlah, nup,  status FROM permintaan INNER JOIN stokbarang_perdata ON permintaan.kode_brg = stokbarang_perdata.kode_brg WHERE status=1 ORDER BY tgl_permintaan DESC ");
    // $query4 = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.kode_brg, tgl_permintaan, unit, nama_brg, jumlah, nup,  status FROM permintaan INNER JOIN stokbarang_hukum ON permintaan.kode_brg = stokbarang_hukum.kode_brg WHERE status=1 ORDER BY tgl_permintaan DESC ");
    // $query5 = mysqli_query($koneksi, "SELECT permintaan.id_permintaan, permintaan.kode_brg, tgl_permintaan, unit, nama_brg, jumlah, nup,  status FROM permintaan INNER JOIN stokbarang_ptip ON permintaan.kode_brg = stokbarang_ptip.kode_brg WHERE status=1 ORDER BY tgl_permintaan DESC ");
    
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Pengeluaran Perbaikan Barang</h3>
                </div>    
                <div class="box-body"> 
				<a href="cetakbarang.php" target="_blank" style="margin:10px;" class="btn btn-success"><i class='fa fa-print'> Cetak Laporan</i></a>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center" id="datapesanan">
                            <thead  > 
                                <tr>
                                    <th>No</th> 
									<th>Tanggal Permintaan</th>
                                    <th>Unit Pelayanan</th>                                                                
                                    <th>Nama Barang</th>
									<th>Nup</th>
                                    <th>Jumlah</th>                                                           
                                    <th>Status</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

                                     ?>
                                        <td> <?= $no; ?> </td>   
										<td> <?= tanggal_indo($row['tgl_permintaan']); ?> </td>										
                                        <td> <?= $row['unit']; ?> </td>
                                        <td> <?= $row['nama_brg']; ?> </td> 
										<td> <?= $row['nup']; ?> </td>										
                                        <td> <?= $row['jumlah']; ?> </td>
                                        <td > <?php
                                                if ($row['status'] == 0){
                                                    echo '<span class=text-warning>Belum Disetujui</span>';
                                                } elseif ($row['status'] == 1) {
                                                    echo '<span class=text-primary>Telah Disetujui</span>';
                                                } else {
                                                    echo '<span class=text-danger>Tidak Disetujui</span>';
                                                }
                                               ?> 
                                         </td>     
                                                                                                                                   
                            </tr>
                            
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Belum ada permintaan disetujui</td></tr>" . mysqli_error($koneksi);} ?>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>



</section>


