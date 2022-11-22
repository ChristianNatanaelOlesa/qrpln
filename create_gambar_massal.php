<?php 

   include ("koneksi.php");
   include "phpqrcode/qrlib.php";
   date_default_timezone_set('Asia/Jakarta');

   if( isset($_POST['submit_gambar']) ){

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

    $tgl_pembuatan_from           = $_POST['tgl_pembuatan_from'];
    $tgl_pembuatan_to             = $_POST['tgl_pembuatan_to'];

    $min_date = $mysqli->query("select date(min(created_dt)) as minTanggal from trx_qrcode");
    $date_min = mysqli_fetch_array($min_date);
    $minTanggal = $date_min['minTanggal'];
    $tanggal_sekarang = date('Y-m-d');

    $status_qr      = '1';
    $status_barcode = '1';
    $update_by     = $_SESSION['nama'];
    $update_dt     = date('Y-m-d H:i:s');

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

     //PREFRENSI QR CODE
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
    $padding = 1;


    $data = mysqli_query($mysqli,"select kode_serial_material from trx_qrcode where status_qr = '0' and status_barcode = '0' and ".$search_1." ".$search_2." ".$search_3." ".$search_4." ".$search_5." ".$search_6." ".$orderby);
      while($row = mysqli_fetch_array($data)){ 

        $kode_serial_material   = $row['kode_serial_material'];
        $qrcode_dir  = "temp/qrcode/".$kode_serial_material.".png";
        $barcode_dir = "temp/barcode/".$kode_serial_material.".png";

        $fileImage="http://localhost".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_serial_material . "&codetype=code39&print=true&size=40";

        /*get content from url*/
        $content=file_get_contents($fileImage);

        if (file_exists($qrcode_dir)) {
            unlink($qrcode_dir);
            QRCode::png($kode_serial_material,$qrcode_dir,$quality,$ukuran,$padding);
        } else {
          QRCode::png($kode_serial_material,$qrcode_dir,$quality,$ukuran,$padding);
        }

        if (file_exists($barcode_dir)) {
            unlink($barcode_dir);
            $test = file_put_contents($barcode_dir, $content);
        } else {
          $test = file_put_contents($barcode_dir, $content);
        }

        // buat query hapus
        $sql = "UPDATE trx_qrcode SET qrcode_dir='$qrcode_dir', barcode_dir='$barcode_dir', status_qr='$status_qr', status_barcode='$status_barcode', update_dt='$update_dt', update_by='$update_by' WHERE ".$search_1." ".$search_2." ".$search_3." ".$search_4." ".$search_5;
        $query = mysqli_query($mysqli, $sql);
      } 

      $_SESSION['pesan'] = "QR & Barcode Berhasil Di Buat";
      $_SESSION['kode_pesan'] = "success";
      header("location:index.php?page=list_qrcode");

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=list_qrcode");
}

?>