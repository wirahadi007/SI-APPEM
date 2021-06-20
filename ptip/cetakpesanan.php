<?php 
  
  include "../fungsi/koneksi.php";
  include "../fungsi/fungsi.php";

  ob_start(); 
  $id  = isset($_GET['id']) ? $_GET['id'] : false;


  $unit = $_GET['unit'];
  $tgl= $_GET['tgl'];
    
?>
<!-- Setting CSS bagian header/ kop -->
<style type="text/css">
  table.page_header {width: 1020px; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
  table.page_footer {width: 1020px; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
  
 
</style>
<!-- Setting Margin header/ kop -->
  <!-- Setting CSS Tabel data yang akan ditampilkan -->
  <style type="text/css">
  .tabel2 {
    border-collapse: collapse;
    margin-left: 145px;
    
  }
  .tabel2 th, .tabel2 td {
      padding: 5px 5px;
      border: 1px solid #000;

  }

   table.isi {
    margin: 0 170px;

  }

  .isi td {
    padding: 15px 15px;
  }

  div.kanan {
     position: absolute;
     bottom: 100px;
     right: 50px;
     
  }

  div.tengah {
     position: absolute;
     bottom: 100px;
     right: 330px;
     
  }

  div.kiri {
     position: absolute;
     bottom: 100px;
     left: 10px;     
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
  <p align="center" style="font-weight: bold; font-size: 18px;"><u>BUKTI PENGELUARAN PERMINTAAN BARANG (BPP)</u></p>
  <br><br>
  <h4 style="color: black; text-align: center;">Pengeluaran Permintaan Barang dari Bagian : <?= $unit; ?></h4>
  <div class="isi" style="margin: 0 auto;">
   <table class="tabel2">
    <thead>
      <tr>
        <td style="text-align: center; "><b>No.</b></td>        
        <td style="text-align: center; "><b>Kode Barang</b></td>
        <td style="text-align: center; "><b>Nama Barang</b></td>
		<td style="text-align: center; "><b>Nup</b></td> 
        <td style="text-align: center; "><b>Biaya</b></td>                                        
      </tr>
    </thead>
    <tbody>
      <?php

       
       $query = mysqli_query($koneksi, "SELECT permintaan.deskripsi, permintaan.kode_brg, unit, nama_brg, nup, jumlah, tgl_permintaan FROM permintaan INNER JOIN stokbarang_ptip ON permintaan.kode_brg = stokbarang_ptip.kode_brg  WHERE unit='$unit' AND  status=1 AND tgl_permintaan='$tgl' "); 
      $i   = 1;
      while($data=mysqli_fetch_array($query))
      {
      ?>
      <tr>
        <td style="text-align: center;"><?php echo $i; ?></td>             
        <td style="text-align: center;"><?php echo $data['kode_brg']; ?></td>
        <td style="text-align: center;"><?php echo $data['nama_brg']; ?></td>
		<td style="text-align: center;"><?php echo $data['nup']; ?></td>  
        <td style="text-align: center;"><?php echo $data['jumlah']; ?></td>                            
      </tr>
    <?php
    $i++;
    }
    ?>
    </tbody>
  </table>
  <?php 

  $query2 = mysqli_query($koneksi, "SELECT permintaan.deskripsi FROM permintaan WHERE unit='$unit' AND  status=1 AND tgl_permintaan='$tgl' ");  
  $data2 = mysqli_fetch_assoc($query2);

  ?>

  <p>Pada hari ini tanggal : <b> <?=  tanggal_indo($tgl); ?></b> telah dikeluarkan bukti pelaporan perbaikan barang.</p>
  <p>Pelapor Perbaikan Barang :  <?= $unit; ?></p>
  </div>
 
  <?php 

      $query2 = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$unit' ");
      if ($query2){                
        $data = mysqli_fetch_assoc($query2);

      } else {
        echo 'gagal';
      }
   ?>

  <div class="kiri">
      <p>Diminta Oleh :<br>Admin </p>
      <br>
      <br>
      <br>
      <b><p><u><?= $data['asmen'] ?></u></p></b>
  </div>

  <div class="tengah">
      <p>Disetujui Oleh :<br>Panitia Pengambil Keputusan </p>
      <br>
      <br>
      <br>
      <b><p><u><?= $data['manajer'] ?></u></p></b>
  </div>

  <div class="kanan">
      <p>Dikeluarkan Oleh Bagian :<br> <?= $unit; ?> </p>
      <br>
      <br>
      <br>
      <b><p><u>Roozelfelt</u></p></b>
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
    $html2pdf->Output('bukti_permintaan_dan_pengeluaran_barang.pdf');
}
catch(HTML2PDF_exception $e) {
    echo $e;
    exit;
}
?>