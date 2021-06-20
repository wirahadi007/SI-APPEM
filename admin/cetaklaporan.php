<?php ob_start();
	include "../fungsi/fungsi.php";

 ?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #3C8DBC; color: #fff; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #3C8DBC; border-top: solid 1mm #AAAADD; padding: 2mm}
  h1 {color: #000033}
  h2 {color: #000055}
  h3 {color: #000077}
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 20px;    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #959595;
  }

   div.kanan {
     width:300px;
	 float:right;
     margin-left:25px;
     margin-top:-140px;
  }

  div.kiri {
	  width:300px;
	  float:left;
	  margin-left:20px;
	  display:inline;
  }
  
  </style>
  <table>
    <tr>
    <th rowspan="3"><img src="../gambar/Jemrana.png" style="width:100px;height:100px" /></th>
      <td align="center" style="width: 520px;"><font style="font-size: 18px"><b>PEMERINTAH KABUPATEN JEMBRANA <br> PENGADILAN NEGERI NEGARA</b></font>
      <br><br>Jl. Mayor Sugianyar No. 1 Negara, Bali, Indonesia <br> Telp :  0365- 41204  | Fax : 0365 - 41204 </td>
	  <th rowspan="3"><img src="../gambar/Pengadilan.jpg" style="width:100px;height:80px" /></th>
    </tr>
  </table>
  <hr>
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>LAPORAN PENGELUARAN BARANG</u></p>
  <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>
		<td style="text-align: center; "><b>Tanggal Lapor</b></td>
        <td style="text-align: center; "><b>Bagian</b></td>
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nup</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
        <td style="text-align: center; "><b>Kondisi</b></td>
        <td style="text-align: center; "><b>Deskripsi</b></td>
      </tr>
    </thead>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query = mysqli_query($koneksi, "SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, laporan_sementara.tgl_lapor, laporan_sementara.unit, stokbarang.nama_brg,stokbarang.kode_brg, stokbarang.nup  FROM laporan_sementara INNER JOIN stokbarang ON laporan_sementara.kode_brg  = stokbarang.kode_brg " ); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data['tgl_lapor']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data['unit']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data['nup']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data['nama_brg']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['kondisi']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['deskripsi']; ?></td>                   
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query2 = mysqli_query($koneksi,"SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, laporan_sementara.tgl_lapor, laporan_sementara.unit , stokbarang_pidana.nama_brg,stokbarang_pidana.kode_brg, stokbarang_pidana.nup  FROM laporan_sementara INNER JOIN stokbarang_pidana ON laporan_sementara.kode_brg  = stokbarang_pidana.kode_brg"); 
      $i   = 1;
      while($data2=mysqli_fetch_array($query2))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data2['tgl_lapor']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data2['unit']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data2['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data2['nup']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data2['nama_brg']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['kondisi']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['deskripsi']; ?></td>                  
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query3 = mysqli_query($koneksi, "SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, laporan_sementara.tgl_lapor, laporan_sementara.unit, stokbarang_perdata.nama_brg,stokbarang_perdata.kode_brg, stokbarang_perdata.nup  FROM laporan_sementara INNER JOIN stokbarang_perdata ON laporan_sementara.kode_brg  = stokbarang_perdata.kode_brg " ); 
      $i   = 1;
      while($data3=mysqli_fetch_array($query3))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data3['tgl_keluar']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data3['unit']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data3['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data3['nup']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data3['nama_brg']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['kondisi']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['deskripsi']; ?></td>                  
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query4 = mysqli_query($koneksi, "SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, laporan_sementara.tgl_lapor, laporan_sementara.unit, stokbarang_hukum.nama_brg,stokbarang_hukum.kode_brg, stokbarang_hukum.nup  FROM laporan_sementara INNER JOIN stokbarang_hukum ON laporan_sementara.kode_brg  = stokbarang_hukum.kode_brg " ); 
      $i   = 1;
      while($data4=mysqli_fetch_array($query4))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data4['tgl_keluar']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data4['unit']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data4['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data4['nup']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data4['nama_brg']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['kondisi']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['deskripsi']; ?></td>                 
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
    <tbody>
      <?php

       include "../fungsi/koneksi.php";
       $query5 = mysqli_query($koneksi, "SELECT laporan_sementara.unit, laporan_sementara.deskripsi, laporan_sementara.id_sementara, laporan_sementara.kondisi, laporan_sementara.tgl_lapor, laporan_sementara.unit, stokbarang_ptip.nama_brg,stokbarang_ptip.kode_brg, stokbarang_ptip.nup  FROM laporan_sementara INNER JOIN stokbarang_ptip ON laporan_sementara.kode_brg  = stokbarang_ptip.kode_brg"); 
      $i   = 1;
      while($data5=mysqli_fetch_array($query5))
      {
      ?>
      <tr>
        <td style="text-align: center; width=15px;"><?php echo $i; ?></td>
		<td style="text-align: center; width=70px;"><?php echo tanggal_indo($data5['tgl_keluar']); ?></td>
        <td style="text-align: center; width=70px;"><?php echo $data5['unit']; ?></td>        
        <td style="text-align: center; width=120px;"><?php echo $data5['kode_brg']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data5['nup']; ?></td>
        <td style="text-align: center; width=120px;"><?php echo $data5['nama_brg']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['kondisi']; ?></td>
        <td style="text-align: center; width=50px;"><?php echo $data['deskripsi']; ?></td>                  
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  
  <div class="kiri">
      <p>Mengetahui :<br>Pengadaan</p>
      <br>
      <br>
      <br>
      <p><b><u>Admin</u><br>NIK : </b></p>
  </div>

  <div class="kanan">
      <p>Mengetahui :<br>Manager </p>
      <br>
      <br>
      <br>
      <p><b><u>pkk</u><br>NIK: ?</b></p>
  </div>

<!-- Memanggil fungsi bawaan HTML2PDF -->
<?php
$content = ob_get_clean();
 include '../assets/html2pdf/html2pdf.class.php';
 try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 4, 10));
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content);
    $html2pdf->Output('laporan_pengeluaran_barang.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>