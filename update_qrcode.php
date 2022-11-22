<?php 
include ("koneksi.php");
include ("phpqrcode/qrlib.php");

session_start();

date_default_timezone_set('Asia/Jakarta');

if(isset($_POST['simpan_qrcode'])){

    $sn_mc_pln      = $_POST['sn_mc_pln'];
    $kode_pabrikan  = $_POST['kode_pabrikan'];
    $kode_material  = $_POST['kode_material'];
    $kategori       = $_POST['kategori'];
    $deskripsi      = $_POST['deskripsi'];

    $kode_tahun_produksi = substr($_POST['tahun_produksi'],2,2);
    $tahun_produksi = $_POST['tahun_produksi'];
    $batch_produksi = $_POST['batch_produksi'];
    $sn_material    = $_POST['sn_material'];

    $update_by     = $_SESSION['nama'];
    $update_dt     = date('Y-m-d H:i:s');

    $tempqr         = "temp/qrcode/";
    $tempbarcode    = "temp/barcode/";
    
    $quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
    $ukuran = 7; //batasan 1 paling kecil, 10 paling besar
    $padding = 2;

    $old_qrcode  = $tempqr.$_POST['kode_serial_material'].".png";
    $old_barcode = $tempbarcode.$_POST['kode_serial_material'].".png";

    //DATA TRX QRCODE
    $query_trx      = $mysqli->query("SELECT * from trx_qrcode where kode_serial_material = '$_POST[kode_serial_material]'");
    $data_trx       = mysqli_fetch_array($query_trx);
    $jmlh_data_trx  = mysqli_num_rows($query_trx);

    if ($_POST['kode_material'] == $data_trx['kode_material'] && $_POST['batch_produksi'] == $data_trx['batch_produksi'] && $_POST['sn_material'] == $data_trx['sn_material']) {

        $_SESSION['pesan'] = "Tidak Ada Data Yang Di Rubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=detail_qrcode&kode_serial_material=$_POST[kode_serial_material]");
    } else {

        $old_trx           = $mysqli->query("SELECT * FROM trx_qrcode WHERE sn_mc_pln = '$_POST[sn_mc_pln]' and sn_material = '$_POST[sn_material]' and batch_produksi = '$_POST[batch_produksi]'  ");
        $data_old_trx      = mysqli_fetch_array($old_trx);
        $jmlh_data_old_trx = mysqli_num_rows($old_trx);

        if ($_POST['kode_material'] == $data_trx['kode_material']) {
            if ($_POST['sn_material'] != $data_trx['sn_material'] || $_POST['batch_produksi'] != $data_trx['batch_produksi']) {
                if ($jmlh_data_old_trx > 0) {
                    $_SESSION['pesan'] = "S/N Material ($sn_material) dengan SN MC PLN ($sn_mc_pln) dan Batch Produksi ($batch_produksi) sudah pernah di buat sebelumnya";
                    $_SESSION['kode_pesan'] = "warning";
                    header("location:index.php?page=detail_qrcode&kode_serial_material=$_POST[kode_serial_material]");
                } else {
                    $kode_serial_material   = $sn_mc_pln.$kode_pabrikan.$kode_tahun_produksi.$batch_produksi.$sn_material;
                    $namafile               = $kode_serial_material.".png";
                    $qrcode_dir             = $tempqr.$namafile;
                    $barcode_dir            = $tempbarcode.$namafile;

                    $sql = "UPDATE trx_qrcode SET kode_serial_material='$kode_serial_material', sn_material='$_POST[sn_material]', batch_produksi='$_POST[batch_produksi]', qrcode_dir='$qrcode_dir', barcode_dir='$barcode_dir', update_dt='$update_dt', update_by='$update_by' WHERE kode_serial_material = '$_POST[kode_serial_material]'";
                    $query = mysqli_query($mysqli, $sql);
                }
            }

        } else {

            if ($jmlh_data_old_trx > 0) {
                $_SESSION['pesan'] = "S/N Material ($sn_material) dengan SN MC PLN ($sn_mc_pln) dan Batch Produksi ($batch_produksi) sudah pernah di buat sebelumnya";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=detail_qrcode&kode_serial_material=$_POST[kode_serial_material]");
            } else {
                $kode_serial_material   = $sn_mc_pln.$kode_pabrikan.$kode_tahun_produksi.$batch_produksi.$sn_material;
                $namafile               = $kode_serial_material.".png";
                $qrcode_dir             = $tempqr.$namafile;
                $barcode_dir            = $tempbarcode.$namafile;

                $sql = "UPDATE trx_qrcode SET kode_serial_material='$kode_serial_material', kode_material='$kode_material', sn_mc_pln='$sn_mc_pln', kode_pabrikan='$kode_pabrikan', kategori='$kategori', deskripsi='$deskripsi', tahun_produksi='$tahun_produksi', batch_produksi='$batch_produksi', sn_material='$sn_material', qrcode_dir='$qrcode_dir', barcode_dir='$barcode_dir', update_dt='$update_dt', update_by='$update_by' WHERE kode_serial_material = '$_POST[kode_serial_material]'";
                $query = mysqli_query($mysqli, $sql);
            }

        }   
    }

    // apakah query simpan berhasil?
    if( $query ) {
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

        if (file_exists($old_qrcode)) {
            unlink($old_qrcode);
        }

        QRCode::png($kode_serial_material,$tempqr.$namafile,$quality,$ukuran,$padding);


        if (file_exists($old_barcode)) {
            unlink($old_barcode);
        } 

        $fileImage="http://localhost".dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_serial_material . "&codetype=code128&print=true&size=55";

        
        $content=file_get_contents($fileImage);

        /*save file */
        $test = file_put_contents($barcode_dir, $content);

        $_SESSION['pesan'] = "Data QR PLN Berhasil Di Rubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=detail_qrcode&kode_serial_material=$kode_serial_material");
    } else {
        $_SESSION['pesan'] = "Gagal Merubah Data QR PLN";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=detail_qrcode&kode_serial_material=$kode_serial_material");
    }


} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=detail_qrcode&kode_serial_material=$kode_serial_material");
}

?>
