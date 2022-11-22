<?php

include ("koneksi.php");

$mysqli->query("TRUNCATE trx_qrcode");
$mysqli->query("UPDATE ms_katalog SET status = '0'");
$mysqli->query("UPDATE ms_kategori SET status = '0'");
$mysqli->query("UPDATE ms_kode_pabrik SET status = '0'");

$barcode_dir = 'temp/barcode/';
$qrcode_dir = 'temp/qrcode/';
array_map('unlink', glob("{$barcode_dir}*.png"));
array_map('unlink', glob("{$qrcode_dir}*.png"));

$_SESSION['pesan'] = "Database Di Kosongkan dan Semua Gambar Telah Di Hapus";
$_SESSION['kode_pesan'] = "success";
header("location:index.php?page=add_trx");
  
?>