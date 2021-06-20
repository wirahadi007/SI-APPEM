<?php  
    include "../fungsi/koneksi.php";
    include "../fungsi/fungsi.php";

	if (isset($_GET['aksi']) && isset($_GET['tgl'])) {
		//die($id = $_GET['id']);
		$tgl = $_GET['tgl'];
		echo $tgl;

		if ($_GET['aksi'] == 'detil') {
			header("location:?p=detil&tgl=$tgl");
		} 
	}
	
	$query = mysqli_query($koneksi, "SELECT tgl_laporan, count(id_laporan)  FROM laporanservice WHERE unit= '$_SESSION[username]'  GROUP BY tgl_laporan  ");	
    
?>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-sm-12">
			 <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="text-center">Pelaporan hasil service</h3>
                </div>                
                <div class="box-body">
                    <a href="index.php?p=formpesan" style="margin:10px 15px;" class="btn btn-success"><i class='fa fa-plus'> Form Permintaan Barang</i></a>
                	<div class="table-responsive">
                		<table class="table text-center">
                			<thead  > 
	                			<tr>
	                				<th>No</th>	                			                                                   				
                                    <th>Tanggal Permintaan</th>
                                    <th>Jumlah Permintaan</th>	                				
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
                						<td> <?= $no; ?> </td>                						
                					    <td> <?= tanggal_indo($row['tgl_laporan']); ?> </td>	
                                        <td> <?= $row['count(id_laporan)']; ?> </td>    
                						<td>                                                                                                                                                                                                          
											<a href="?p=datapesanan&aksi=detil&tgl=<?= $row['tgl_laporan']; ?>"><span data-placement='top' data-toggle='tooltip' title='Detail Permintaan'><button    class="btn btn-info">Detail Permintaan</button></span></a>                  
                						</td>
								</tr>    
								
                            <?php $no++; endwhile; }else {echo "<tr><td colspan=9>Tidak ada permintaan material teknik.</td></tr>";} ?>
							
                            </tbody>
                		</table>
                	</div>                	
                </div>
            </div>
		</div>
	</div>


</section>

