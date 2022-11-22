<?php
include 'koneksi.php';

$kode_material = $_GET['kode_material'];

$query = "SELECT * from ms_katalog where kode_material = '$kode_material' ";

$sql = mysqli_query($mysqli, $query);
$katalog = mysqli_fetch_array($sql);

$data = array(
        'kode_material' => $katalog['kode_material'],
        'sn_mc_pln' => $katalog['sn_mc_pln'],
        'kategori' => $katalog['kategori'],
        'deskripsi' => $katalog['deskripsi']
    );
echo json_encode($data);
?>