<?php 

   include ("koneksi.php");

   if( isset($_GET['kode_serial_material']) ){

    // ambil id dari query string
    $kode_serial_material = $_GET['kode_serial_material'];

    // buat query hapus
    $sql = "DELETE FROM trx_qrcode WHERE kode_serial_material ='$kode_serial_material'";
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
        
        $_SESSION['pesan'] = "Data Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=list_qrcode");

    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=list_qrcode");
    }

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=list_qrcode");
}

?>