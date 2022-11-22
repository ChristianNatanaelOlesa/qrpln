<?php 

   include ("koneksi.php");

   if( isset($_GET['kode_serial_material']) ){

    // ambil id dari query string
    $kode_serial_material = $_GET['kode_serial_material'];

    $qrcode_dir     = '';
    $barcode_dir    = '';
    $status_qr      = '0';
    $status_barcode = '0';
    $update_by      = $_SESSION['nama'];
    $update_dt      = date('Y-m-d H:i:s');

    // buat query hapus
    $sql = "UPDATE trx_qrcode SET status_qr='$status_qr', status_barcode='$status_barcode', qrcode_dir='$qrcode_dir', barcode_dir='$barcode_dir', update_dt='$update_dt', update_by='$update_by' WHERE kode_serial_material = '$kode_serial_material'";
    $query = mysqli_query($mysqli, $sql);

    // apakah query hapus berhasil?
    if( $query ){

        $path_qrcode  = "temp/qrcode/".$kode_serial_material.".png";
        $path_barcode = "temp/barcode/".$kode_serial_material.".png";
        if (file_exists($path_qrcode)) {
            unlink($path_qrcode);
        }

        if (file_exists($path_barcode)) {
            unlink($path_barcode);
        } 

        $_SESSION['pesan'] = "Gambar Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=list_qrcode");

    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Gambar";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=list_qrcode");
    }

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=list_qrcode");
}

?>