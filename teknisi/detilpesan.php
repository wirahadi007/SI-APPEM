<?php  

    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";
    if (isset($_GET['tgl'])) {
        $tgl = $_GET['tgl'];
        $query = mysqli_query($koneksi, "SELECT laporanservice.deskripsi, laporanservice.id_jenis, hasilservice.status, laporanservice.nama_brg, hasilservice.status, laporanservice.biaya, laporanservice.tgl_laporan FROM laporanservice INNER JOIN hasilservice ON laporanservice.id_service  = hasilservice.id_service"  );
               
    }

    if(isset($_GET['aksi']) && isset($_GET['id'])) {
        $aksi = $_GET['aksi'];
        $id = $_GET['id'];
        if ($aksi == 'hapus') {
            $query2 = mysqli_query($koneksi, "DELETE FROM laporanservice WHERE id_laporan='$id' ");
            if ($query2) {
                header("location:?p=detil&tgl=".$tgl);
            } else {
                echo 'gagal';
            }
        }
    }
?>

<section class="content">
<!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-sm-12">
             <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Data Permintaan Perbaikan Barang Tanggal <?php echo tanggal_indo($tgl); ?></h3>
                </div>                
                <div class="box-body">                   
                    <a href="index.php?p=datapesanan" style="margin:10px;" class="btn btn-success"><i class='fa fa-backward'>  Kembali</i></a>
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead  > 
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
                            </thead>
                            <tbody>
                                <tr>
                                    <?php 
                                        $no =1 ;
                                        if (mysqli_num_rows($query)) {
                                            while($row=mysqli_fetch_assoc($query)):

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
                            
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>.</td></tr>";} ?>

                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>


</section>

