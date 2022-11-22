<?php   
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['username']==""){
        echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
    }

    $session_username   = $_SESSION['username'];
    $session_nama       = $_SESSION['nama'];
    $session_jabatan    = $_SESSION['jabatan'];
    $session_level      = $_SESSION['level'];  
?>  
<html>
<head>
    <title>PT. Trafoindo | QR PLN</title>
</head>

<style type="text/css">

  @page {
    size: 11cm 6cm;
    margin: 0;
  }

  .page {
    margin: 0;
    width: 11cm;
    height: 6cm;
    background: white;
    page-break-after: avoid;
  }

  .kotak {
    margin: 0;
    float: left;
    width: 5cm;
    height: 5cm;
    border-width: 1px; 
    border-color: black; 
    border-style: solid; 
    text-align:center;
  }

  .qrcode {
    margin-top: 1px;
    height: 2.4cm;
    width: 2.5cm;
  }

  .barcode {
    width: 4.8cm;
    height: 2.4cm;
  }

  @media print {
    @page {
      size: 11cm 6cm;
      margin: 0;
    }

    .page {
      margin: 0;
      width: initial;
      height: initial;
      background: initial;
      page-break-after: avoid;
    }

    .kotak {
      margin: 0;
      float: left;
      max-width: 100%;
      max-height: 100%;
      width: 5cm;
      height: 5cm;
      border-width: 1px; 
      border-color: black; 
      border-style: solid; 
      text-align:center;
    }

    .qrcode {
      margin-top: 1px;
      height: 2.5cm;
      width: 2.5cm;
    }

    .barcode {
      width: 4.9cm;
      height: 2.4cm;
    }

  }
</style>
</head>

  <div class="page">
     <?php 
  // koneksi database
  include "koneksi.php";

  date_default_timezone_set('Asia/Jakarta');

  $kode_serial_material_from    = $_POST['kode_serial_material_from'];
  $kode_serial_material_to      = $_POST['kode_serial_material_to'];
  $kode_material_from           = $_POST['kode_material_from'];
  $kode_material_to             = $_POST['kode_material_to'];
  $sn_mc_pln_from               = $_POST['sn_mc_pln_from'];
  $sn_mc_pln_to                 = $_POST['sn_mc_pln_to'];
  $batch_produksi_from          = $_POST['batch_produksi_from'];
  $batch_produksi_to            = $_POST['batch_produksi_to'];
  $sn_material_from             = $_POST['sn_material_from'];
  $sn_material_to               = $_POST['sn_material_to'];

  $tgl_pembuatan_from   = $_POST['tgl_pembuatan_from'];
  $tgl_pembuatan_to     = $_POST['tgl_pembuatan_to'];

  $min_date = $mysqli->query("select date(min(created_dt)) as minTanggal from trx_qrcode");
  $date_min = mysqli_fetch_array($min_date);
  $minTanggal = $date_min['minTanggal'];
  $tanggal_sekarang = date('Y-m-d');

  $search_1 = " ";
  if ($tgl_pembuatan_from  != '' AND $tgl_pembuatan_to != '') {
    $search_1 .= " date(created_dt) between '".$tgl_pembuatan_from."' and '".$tgl_pembuatan_to."'";
  } else if ($tgl_pembuatan_from  == '' AND $tgl_pembuatan_to == '') {
    $search_1 .= " date(created_dt) between '".$minTanggal."' and '".$tanggal_sekarang."'";
  } else if ($tgl_pembuatan_from  != '' AND $tgl_pembuatan_to == '') {
    $search_1 .= " date(created_dt) between '".$tgl_pembuatan_from."' and '".$tanggal_sekarang."'";
  } else if ($tgl_pembuatan_from  == '' AND $tgl_pembuatan_to != '') {
    $search_1 .= " date(created_dt) between '".$minTanggal."' and '".$tgl_pembuatan_to."'";
  } 

  $search_2 = " ";
  if ($kode_material_from != '' AND $kode_material_to != '') {
    $search_2 .= " and (kode_material between '".$kode_material_from."' and '".$kode_material_to."' ) ";
  }  

  $search_3 = " ";
  if ($sn_mc_pln_from != '' AND $sn_mc_pln_to != '') {
    $search_3 .= " and (sn_mc_pln between '".$sn_mc_pln_from."' and '".$sn_mc_pln_to."' ) ";
  } 

  $search_4 = " ";
  if ($batch_produksi_from != '' AND $batch_produksi_to != '') {
    $search_4 .= " and (batch_produksi between '".$batch_produksi_from."' and '".$batch_produksi_to."' ) ";
  } 

  $search_5 = " ";
  if ($sn_material_from != '' AND $sn_material_to != '') {
    $search_5 .= " and (sn_material between '".$sn_material_from."' and '".$sn_material_to."' ) ";
  } 

  $search_6 = " ";
  if ($kode_serial_material_from != '' AND $kode_serial_material_to != '') {
    $search_5 .= " and (kode_serial_material between '".$kode_serial_material_from."' and '".$kode_serial_material_to."' ) ";
  } 

  $orderby = " ";
  if ($order_by != '') {
    $orderby .= " order by '".$order_by."' asc";
  } 

  date_default_timezone_set('Asia/Jakarta');
  $print_by       = $_SESSION['nama'];
  $print_dt       = date('Y-m-d H:i:s');
  $status_print   = 1;

  $sql = "UPDATE trx_qrcode SET print_dt='$print_dt', print_by='$print_by', status_print='$status_print' WHERE ".$search_1." ".$search_2." ".$search_3." ".$search_4." ".$search_5." ".$search_6;
  $query = mysqli_query($mysqli, $sql);

  $data = mysqli_query($mysqli,"select barcode_dir, qrcode_dir from trx_qrcode where status_print = '1' and status_qr = '1' and status_barcode = '1' and ".$search_1." ".$search_2." ".$search_3." ".$search_4." ".$search_5." ".$search_6." ".$orderby);
  while($row = mysqli_fetch_array($data)){      
  ?>
    <div class="kotak">
      <img src="<?php echo $row['qrcode_dir'] ?>" class="qrcode">
      <img src="<?php echo $row['barcode_dir'] ?>" class="barcode">
    </div>  
  <?php } ?>
</div>
<script>
  window.addEventListener("load", window.print());
</script>

</html>
