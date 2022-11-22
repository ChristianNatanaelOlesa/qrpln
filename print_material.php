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
  .page {
    margin: 0;
    width: 10cm;
    height: 5cm;
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
<body>
  <div class="page">


<?php   
    include ("koneksi.php");

    date_default_timezone_set('Asia/Jakarta');
    $print_by       = $_SESSION['nama'];
    $print_dt       = date('Y-m-d H:i:s');
    $status_print   = 1;

    $result_kode    = $mysqli->query("SELECT * from trx_qrcode where kode_serial_material = '$_GET[kode_serial_material]'");
    $r_kode         = mysqli_fetch_array($result_kode);

    $sql = "UPDATE trx_qrcode SET print_dt='$print_dt', print_by='$print_by', status_print='$status_print' where kode_serial_material = '$_GET[kode_serial_material]' ";
    $query = mysqli_query($mysqli, $sql);
?>    

<div class="kotak">
  <img src="<?php echo $r_kode['qrcode_dir'] ?>" class="qrcode">
  <img src="<?php echo $r_kode['barcode_dir'] ?>" class="barcode">
</div>  

</div>

<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>