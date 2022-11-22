<?php 
include ("koneksi.php");
include ("phpqrcode/qrlib.php");

session_start();
date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['submit_qrcode'])){

    $kode_material  = $_POST['kode_material'];
	$sn_mc_pln	    = $_POST['sn_mc_pln'];
	$kategori		= $_POST['kategori'];
	$deskripsi		= $_POST['deskripsi'];

    $status_print   = '0';

    $kode_pabrikan  = $_POST['kode_pabrikan'];
	$kode_tahun_produksi = substr($_POST['tahun_produksi'],2,2);
    $tahun_produksi = $_POST['tahun_produksi'];
	$batch_produksi	= $_POST['batch_produksi'];

    $sn_from        = intval($_POST['sn_material_from']);
    $sn_to          = intval($_POST['sn_material_to']);

    if ($sn_from == $sn_to) {
        $n  = 0;
    } else {
        $n  = $sn_to - $sn_from;
    }
    $jumlah_trx = $n + 1;

	$created_by		= $_SESSION['nama'];
	$created_dt		= date('Y-m-d H:i:s');

    //Nama Folder file QR Code & Barcode akan disimpan
    $tempdir    = "temp/qrcode/";
    $status_qr  = '1';

    $tempbarcode        = "temp/barcode/";
    $status_barcode     = '1';

    $sql = "INSERT INTO trx_qrcode (kode_serial_material, kode_material, sn_mc_pln, kategori, deskripsi, kode_pabrikan, tahun_produksi, batch_produksi, sn_material,  qrcode_dir, barcode_dir, status_qr, status_barcode, status_print, created_by, created_dt) VALUES ";

    if ($_POST['batch_produksi'] == 0) {
        echo "<script>alert('Batch Produksi Tidak Boleh 0');window.location.href='index.php?page=add_trx'</script>"; 
    } else if ($_POST['sn_material_from'] == 0) {
        echo "<script>alert('S/N Material (From) Tidak Boleh 0');window.location.href='index.php?page=add_trx'</script>"; 
    } else if ($_POST['sn_material_to'] == 0) {
        echo "<script>alert('S/N Material (To) Tidak Boleh 0');window.location.href='index.php?page=add_trx'</script>"; 
    } else if ($_POST['sn_material_to'] < $_POST['sn_material_from']) {
        echo "<script>alert('S/N Material (To) Harus Lebih Besar Dari S/N Material (From) ');window.location.href='index.php?page=add_trx'</script>"; 
    } else {
        for($i=0;$i<=$n;$i++){
            $sn_tambah = $sn_from + $i;
            $sn_string = strval($sn_tambah);
            $panjang   = strlen($sn_string);

            if ($panjang == 1) {
               $sn_material = "0000".$sn_string;
            } else if ($panjang == 2) {
               $sn_material = "000".$sn_string;
            } else if ($panjang == 3) {
               $sn_material = "00".$sn_string;
            } else if ($panjang == 4) {
               $sn_material = "0".$sn_string;
            } else {
                $sn_material = $sn_string;
            }

            $kode_serial_material   = $sn_mc_pln.$kode_pabrikan.$kode_tahun_produksi.$batch_produksi.$sn_material;

            #parameter inputan
            $isi_teks = $kode_serial_material;
            $namafile = $kode_serial_material.".png";
            $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
            $ukuran = 5; //batasan 1 paling kecil, 10 paling besar
            $padding = 2;

            $qrcode_dir     = $tempdir.$namafile;

            QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

            $barcode_dir        = $tempbarcode . $kode_serial_material . ".png";
            $fileImage="http://localhost".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_serial_material . "&codetype=code128&print=true&size=70";
            /*get content from url*/
            $content=file_get_contents($fileImage);
            /*save file */
            $test = file_put_contents($barcode_dir, $content);

            $sql .= " ('$kode_serial_material', '$kode_material', '$sn_mc_pln', '$kategori', '$deskripsi', '$kode_pabrikan', '$tahun_produksi', '$batch_produksi', '$sn_material', '$qrcode_dir', '$barcode_dir', '$status_qr', '$status_barcode', '$status_print', '$created_by', '$created_dt'),";
        }

        $bulk_insert_query = rtrim($sql, ","); // to remove last comma
        $resultinsert = mysqli_query($mysqli, $bulk_insert_query);
    }

    if( $resultinsert ) {
        $status = '1';

        $result_kategori    = $mysqli->query("SELECT * FROM ms_kategori WHERE kategori = '$kategori' ");
        $r_kategori         = mysqli_fetch_array($result_kategori);

        $result_kode_pabrikan    = $mysqli->query("SELECT * FROM ms_kode_pabrik WHERE kode_pabrikan = '$kode_pabrikan' ");
        $r_kode_pabrikan         = mysqli_fetch_array($result_kode_pabrikan);

        $result_katalog    = $mysqli->query("SELECT * FROM ms_katalog WHERE kode_material = '$kode_material' ");
        $r_katalog         = mysqli_fetch_array($result_katalog);

        if ($r_kategori['status'] == '0') {
            $sql_edit_kategori    = "UPDATE ms_kategori SET status='$status' WHERE kategori = '$kategori' ";
            mysqli_query($mysqli, $sql_edit_kategori);
        } 

        if ($r_kode_pabrikan['status'] == '0') {
            $sql_edit_kode_pabrik    = "UPDATE ms_kode_pabrik SET status='$status' WHERE kode_pabrikan = '$kode_pabrikan' ";
            mysqli_query($mysqli, $sql_edit_kode_pabrik);
        }

        if ($r_katalog['status'] == '0') {
            $sql_edit_katalog    = "UPDATE ms_katalog SET status='$status' WHERE kode_material = '$kode_material' ";
            mysqli_query($mysqli, $sql_edit_katalog);
        }

        $_SESSION['pesan'] = $jumlah_trx." Data Berhasil Di Input";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=list_qrcode");

    } else {
        $_SESSION['pesan'] = "Gagal Input Data";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_trx");

    }   


} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=add_trx");
}

?>
