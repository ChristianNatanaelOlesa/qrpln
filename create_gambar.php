<?php
if(isset($_GET['kode_serial_material']) && $_GET['kode_serial_material'] !=''){
    //tampung data kiriman
    $kode_serial_material = $_GET['kode_serial_material'];

    // include file qrlib.php
    include "phpqrcode/qrlib.php";

    //Nama Folder file QR Code kita nantinya akan disimpan
    $tempdir        = "temp/qrcode/";
    $tempbarcode    = "temp/barcode/";
    $status_qr      = '1';
    $status_barcode = '1';

    //Nama Folder file QR Code kita nantinya akan disimpan

    $update_by     = $_SESSION['nama'];
    $update_dt     = date('Y-m-d H:i:s');

    //jika folder belum ada, buat folder 
    if (!file_exists($tempdir)){
        mkdir($tempdir);
    }

    //jika folder belum ada, buat folder 
    if (!file_exists($tempbarcode)){
        mkdir($tempbarcode);
    }

    #parameter inputan
    $namafile = $kode_serial_material.".png";
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 10; //batasan 1 paling kecil, 10 paling besar
    $padding = 1;

    $qrcode_dir     = $tempdir.$namafile;
    $barcode_dir    = $tempbarcode . $kode_serial_material . ".png";

    $sql = "UPDATE trx_qrcode SET status_qr='$status_qr', qrcode_dir='$qrcode_dir', status_barcode='$status_barcode', barcode_dir='$barcode_dir', update_dt='$update_dt', update_by='$update_by' WHERE kode_serial_material = '$_GET[kode_serial_material]'";
    $query = mysqli_query($mysqli, $sql);
    
    if( $query ) {

        QRCode::png($kode_serial_material,$tempdir.$namafile,$quality,$ukuran,$padding);

        $fileImage="http://localhost".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_serial_material . "&codetype=code128&print=true&size=55";

        /*get content from url*/
        $content=file_get_contents($fileImage);

        /*save file */
        $test = file_put_contents($barcode_dir, $content);

        $_SESSION['pesan'] = "QR & Barcode Berhasil Di Buat";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=detail_qrcode&kode_serial_material=$kode_serial_material");

    } else {
        $_SESSION['pesan'] = "Gagal Membuat QR & Barcode";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=detail_qrcode&kode_serial_material=$kode_serial_material");
    }

}else{

    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "success";
    header("location:index.php?page=detail_qrcode&kode_serial_material=$kode_serial_material");
}

?>