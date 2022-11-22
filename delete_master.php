<?php 

   include ("koneksi.php");

   if( isset($_GET['id_user']) ){

    // ambil id dari query string
    $id_user = $_GET['id_user'];

    // buat query hapus
    $sql = "DELETE FROM login WHERE id_user ='$id_user'";
    $query = mysqli_query($mysqli, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        $_SESSION['pesan'] = "Data User Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_user");
    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data User";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_user");
    }

} else if( isset($_GET['id_jabatan']) ){

    // ambil id dari query string
    $id_jabatan = $_GET['id_jabatan'];

    // buat query hapus
    $sql = "DELETE FROM ms_jabatan WHERE id_jabatan ='$id_jabatan'";
    $query = mysqli_query($mysqli, $sql);

    if( $query ){
        $_SESSION['pesan'] = "Data Jabatan Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_jabatan_level");
    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data Jabatan";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_jabatan_level");
    }

} else if( isset($_GET['id_level']) ){

    // ambil id dari query string
    $id_level = $_GET['id_level'];

    // buat query hapus
    $sql = "DELETE FROM ms_level WHERE id_level ='$id_level'";
    $query = mysqli_query($mysqli, $sql);

    if( $query ){
        $_SESSION['pesan'] = "Data Level Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_jabatan_level");
    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data Level";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_jabatan_level");
    }

} else if( isset($_GET['id_kategori']) ){

    // ambil id dari query string
    $id_kategori = $_GET['id_kategori'];

    // buat query hapus
    $sql = "DELETE FROM ms_kategori WHERE id_kategori ='$id_kategori'";
    $query = mysqli_query($mysqli, $sql);

    if( $query ){
        $_SESSION['pesan'] = "Data Kategori Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_kategori_kode_pabrik");
    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data Kategori";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_kategori_kode_pabrik");
    }

} else if( isset($_GET['id_kode_pabrik']) ){

    // ambil id dari query string
    $id_kode_pabrik = $_GET['id_kode_pabrik'];

    // buat query hapus
    $sql = "DELETE FROM ms_kode_pabrik WHERE id_kode_pabrik ='$id_kode_pabrik'";
    $query = mysqli_query($mysqli, $sql);

    if( $query ){
        $_SESSION['pesan'] = "Data Kode Pabrik Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_kategori_kode_pabrik");
    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data Kode Pabrik";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_kategori_kode_pabrik");
    }

} else if( isset($_GET['id_katalog']) ){

    // ambil id dari query string
    $id_katalog = $_GET['id_katalog'];

    // buat query hapus
    $sql = "DELETE FROM ms_katalog WHERE id_katalog ='$id_katalog'";
    $query = mysqli_query($mysqli, $sql);

    // apakah query hapus berhasil?
    if( $query ){
        $_SESSION['pesan'] = "Data Katalog Berhasil Di Hapus";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_katalog");
    } else {
        $_SESSION['pesan'] = "Gagal Menghapus Data Katalog";
        $_SESSION['kode_pesan'] = "warning";
        header("location:index.php?page=add_katalog");
    }

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=add_trx");
}

?>