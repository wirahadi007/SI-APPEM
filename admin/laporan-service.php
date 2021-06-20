<?php  
    include "../fungsi/koneksi.php";
	include "../fungsi/fungsi.php";


    if (isset($_GET['aksi']) && isset($_GET['id'])) {
        //die($id = $_GET['id']);
        $id = $_GET['id'];
        echo $id;

        if ($_GET['aksi'] == 'edit') {
            header("location:?p=edit_service&id=$id");
        } else if ($_GET['aksi'] == 'hapus') {
            header("location:?p=hapus_service&id=$id");
        } 
    }
	
	if(isset($_GET['id_jenis'])){
        $id_jenis = $_GET['id_jenis'];
        $query = mysqli_query($koneksi, "SELECT laporanservice.deskripsi, laporanservice.id_jenis, laporanservice.nama_brg, hasilservice.status, laporanservice.biaya, laporanservice.tgl_laporan FROM laporanservice INNER JOIN hasilservice ON laporanservice.id_service  = hasilservice.id_service " );    
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM laporanservice");        
    }

	

?>
<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-sm-12">
			 <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Olah Laporan</h3>
                </div>                
                <div class="box-body">
                <div class="row">
                    <div class="col-md-2">
                        <a href="index.php?p=tambahservice" class=" btn btn-primary"><i class="fa fa-plus"></i> Tambah Service</a><br>						
                    </div>
					
					<div class="col-md-2 pull-right">
						<a target="_blank" href="cetakstok.php?idjenis=<?= $id_jenis;  ?>" class="btn btn-success"><i class="fa fa-print"></i> Cetak Data Stok</a><br>
					</div>
                    <br><br>
                </div>                        
                	<div class="table-responsive">
                		<table class="table text-center" id="material">
                			<thead> 
	                			<tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Nup</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                    <th>Biaya</th>
                                    <th>Deskripsi</th>
                                    <th>Tgl Service</th>
                                    <th>Aksi</th>	                				
	                			</tr>
                			</thead>
                			<tbody>
                				<tr>
                					<?php 
                                    $queryTampil = mysqli_query($koneksi, "SELECT laporanservice.deskripsi,laporanservice.id_laporan, laporanservice.id_jenis, hasilservice.status, laporanservice.nup, laporanservice.nama_brg, laporanservice.biaya, laporanservice.tgl_laporan FROM laporanservice INNER JOIN hasilservice ON laporanservice.id_service  = hasilservice.id_service"  );
                						$no =1 ;
                						if (mysqli_num_rows($queryTampil)) {
                							while($row=mysqli_fetch_assoc($queryTampil)):

                					 ?>
                						<td><?php echo $no; ?></td>
                                        <td><?php echo $row['nama_brg']; ?></td>
                                        <td><?php echo $row['nup']; ?></td>
                                        <td><?php echo $row['id_jenis']; ?></td>
                                        <td><?php echo $row['status']; ?></td>
                                        <td><?php echo $row['biaya']; ?></td>
                                        <td><?php echo $row['deskripsi']; ?></td>
                                        <td><?php echo $row['tgl_laporan']; ?></td>
                                        
                                        
                						<td>
                                            <a href="?p=service-laporan&aksi=edit&id=<?= $row['id_laporan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Update'><button  class="btn btn-info">Update</button></span></a>                     

                                            <a href="?p=service-laporan&aksi=hapus&id=<?= $row['id_laporan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Hapus'><button  class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus ?')">Hapus</button></span></a>                    
                                        </td>              					
                				</tr>
                			    <?php $no++; endwhile; } ?>
                			</tbody>
                		</table>
                	</div>                	
                </div>
                </div>
            </div>
		</div>
	</div>
</section>
<script>
    $(function(){
        $("#material").DataTable({
             "language": {
            "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
            "sEmptyTable": "Tidak ada data di database"
            }
        });
    });
</script> 