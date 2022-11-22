<?php

include ("koneksi.php");

// cek apakah tombol simpan sudah diklik atau blum?
if(isset($_POST['simpan_user'])) {

    $id_user    = $_POST['id_user'];
    $password1  = md5($_POST['password1']);
    $password2  = md5($_POST['password2']);
    $username   = $_POST['username'];
    $nama       = $_POST['nama'];
    $jabatan    = $_POST['jabatan'];
    $level      = $_POST['level'];
    $status     = $_POST['status'];

    $old_user           = $mysqli->query("SELECT * FROM login WHERE id_user = '$_POST[id_user]' ");
    $data_old_user      = mysqli_fetch_array($old_user);
    $jmlh_data_old_user = mysqli_num_rows($old_user);

    $result_username    = $mysqli->query("SELECT * FROM login WHERE username = '$_POST[username]' ");
    $r_username         = mysqli_fetch_array($result_username);
    $jmlh_data_username = mysqli_num_rows($result_username);

    $result_nama    = $mysqli->query("SELECT * FROM login WHERE nama = '$_POST[nama]' ");
    $r_nama         = mysqli_fetch_array($result_nama);
    $jmlh_data_nama = mysqli_num_rows($result_nama);

    if ($_POST['username'] == $data_old_user['username'] && $_POST['nama'] == $data_old_user['nama'] && $_POST['jabatan'] == $data_old_user['jabatan'] && $_POST['level'] == $data_old_user['level'] && $_POST['status'] == $data_old_user['status'] ) {
        echo "<script>alert('Tidak ada data yang berubah');window.location.href='index.php?page=add_user'</script>";
    }  else {

        if($_POST['password1'] == ''){

            if ($_POST['nama'] != $data_old_user['nama']) {
                if ($jmlh_data_nama > 0) {
                    echo "<script>alert('Nama Sudah Ada');</script>";
                } else {
                    $sql_nama   = "UPDATE login SET nama='$nama' WHERE id_user = '$_POST[id_user]' ";
                    $query_nama = mysqli_query($mysqli, $sql_nama);
                }
            }

            if ($_POST['username'] != $data_old_user['username']) {
                if ($jmlh_data_username > 0) {
                    echo "<script>alert('Username Sudah Ada');</script>";
                } else {
                    $sql_username   = "UPDATE login SET username='$username' WHERE id_user = '$_POST[id_user]' ";
                    $query_username = mysqli_query($mysqli, $sql_username);
                }
            }

            if ($_POST['jabatan'] != $data_old_user['jabatan']) {
                $sql_jabatan    = "UPDATE login SET jabatan='$jabatan' WHERE id_user = '$_POST[id_user]' ";
                $query_jabatan  = mysqli_query($mysqli, $sql_jabatan);
            }

            if ($_POST['level'] != $data_old_user['level']) {
                $sql_level      = "UPDATE login SET level='$level' WHERE id_user = '$_POST[id_user]' ";
                $query_level    = mysqli_query($mysqli, $sql_level);
            }

            if ($_POST['status'] != $data_old_user['status']) {
                $sql_status     = "UPDATE login SET status='$status' WHERE id_user = '$_POST[id_user]' ";
                $query_status   = mysqli_query($mysqli, $sql_status);
            }

        } else {

            if ($_POST['nama'] != $data_old_user['nama']) {
                if ($jmlh_data_nama > 0) {
                    echo "<script>alert('Nama Sudah Ada');</script>";
                } else {
                    $sql_nama   = "UPDATE login SET nama='$nama' WHERE id_user = '$_POST[id_user]' ";
                    $query_nama = mysqli_query($mysqli, $sql_nama);
                }
            }

            if ($_POST['username'] != $data_old_user['username']) {
                if ($jmlh_data_username > 0) {
                    echo "<script>alert('Username Sudah Ada');</script>";
                } else {
                    $sql_username   = "UPDATE login SET username='$username' WHERE id_user = '$_POST[id_user]' ";
                    $query_username = mysqli_query($mysqli, $sql_username);
                }
            }

            if ($_POST['password1'] != $_POST['password2']) {
                echo "<script>alert('Password tidak sama');</script>";
            } else {
                $sql_password   = "UPDATE login SET password='$password1' WHERE id_user = '$_POST[id_user]' ";
                $query_password = mysqli_query($mysqli, $sql_password);
                echo "<script>alert('Password berhasil di rubah');</script>";
            }

            if ($_POST['jabatan'] != $data_old_user['jabatan']) {
                $sql_jabatan    = "UPDATE login SET jabatan='$jabatan' WHERE id_user = '$_POST[id_user]' ";
                $query_jabatan  = mysqli_query($mysqli, $sql_jabatan);
            }

            if ($_POST['level'] != $data_old_user['level']) {
                $sql_level      = "UPDATE login SET level='$level' WHERE id_user = '$_POST[id_user]' ";
                $query_level    = mysqli_query($mysqli, $sql_level);
            }

            if ($_POST['status'] != $data_old_user['status']) {
                $sql_status     = "UPDATE login SET status='$status' WHERE id_user = '$_POST[id_user]' ";
                $query_status   = mysqli_query($mysqli, $sql_status);
            }
        }

        if ($query_nama || $query_username || $query_jabatan || $query_level || $query_status) {
            $_SESSION['pesan'] = "Data User Berhasil Di Rubah";
            $_SESSION['kode_pesan'] = "success";
            header("location:index.php?page=add_user");
        } else {
            $_SESSION['pesan'] = "Gagal Merubah Data User";
            $_SESSION['kode_pesan'] = "warning";
            header("location:index.php?page=add_user");
        } 
    } 

} else if(isset($_POST['simpan_jabatan'])){

    $kode_jabatan   = str_replace(' ', '_', strtolower($_POST['kode_jabatan']));
    $nama_jabatan   = ucfirst($_POST['nama_jabatan']);

    $old_jabatan              = $mysqli->query("SELECT * FROM ms_jabatan WHERE id_jabatan = '$_POST[id_jabatan]' ");
    $data_old_jabatan         = mysqli_fetch_array($old_jabatan);
    $jmlh_data_old_jabatan    = mysqli_num_rows($old_jabatan);

    $result_jabatan    = $mysqli->query("SELECT * FROM ms_jabatan WHERE kode_jabatan = '$kode_jabatan' ");
    $r_jabatan         = mysqli_fetch_array($result_jabatan);
    $jmlh_data_jabatan = mysqli_num_rows($result_jabatan);

    $result_nama = $mysqli->query("SELECT * FROM ms_jabatan WHERE nama_jabatan = '$nama_jabatan' ");
    $r_nama = mysqli_fetch_array($result_nama);
    $jmlh_data_nama = mysqli_num_rows($result_nama);

    if ($kode_jabatan == $data_old_jabatan['kode_jabatan'] && $nama_jabatan == $data_old_jabatan['nama_jabatan']) {
        echo '<script>alert("Tidak ada perubahan");window.location.href="index.php?page=add_jabatan_level"</script>';
    } else {

        if ($kode_jabatan != $data_old_jabatan['kode_jabatan']) { 
            if ($jmlh_data_jabatan > 0) {
                $_SESSION['pesan'] = "Kode Jabatan Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_jabatan_level");
            } else {
                $sql = "UPDATE ms_jabatan SET kode_jabatan='$_POST[kode_jabatan]' WHERE id_jabatan = '$_POST[id_jabatan]' ";
                $query_kode_jabatan = mysqli_query($mysqli, $sql);
            }
        }

        if ($nama_jabatan != $data_old_jabatan['nama_jabatan']) { 
            if ($jmlh_data_nama > 0) {
                $_SESSION['pesan'] = "Nama Jabatan Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_jabatan_level");
            } else {
                $sql = "UPDATE ms_jabatan SET nama_jabatan='$_POST[nama_jabatan]' WHERE id_jabatan = '$_POST[id_jabatan]' ";
                $query_nama_jabatan = mysqli_query($mysqli, $sql);
            }
        }

        if ( $query_kode_jabatan || $query_nama_jabatan ) {
            $_SESSION['pesan'] = "Data Jabatan Berhasil Di Rubah";
            $_SESSION['kode_pesan'] = "success";
            header("location:index.php?page=add_jabatan_level");
        } 
    }

} else if(isset($_POST['simpan_level'])){

    $level      = $_POST['level'];
    $nama_level = $_POST['nama_level'];

    $old_level              = $mysqli->query("SELECT * FROM ms_level WHERE id_level = '$_POST[id_level]'");
    $data_old_level         = mysqli_fetch_array($old_level);
    $jmlh_data_old_level    = mysqli_num_rows($old_level);
    
    $result_level    = $mysqli->query("SELECT * FROM ms_level WHERE level = '$level' ");
    $r_level         = mysqli_fetch_array($result_level);
    $jmlh_data_level = mysqli_num_rows($result_level);

    $result_nama_level    = $mysqli->query("SELECT * FROM ms_level WHERE nama_level = '$nama_level' ");
    $r_nama_level         = mysqli_fetch_array($result_nama_level);
    $jmlh_data_nama_level = mysqli_num_rows($result_nama_level);

    if ($level == $data_old_level['level'] && $nama_level == $data_old_level['nama_level']) {
        $_SESSION['pesan'] = "Tidak Ada Data Yang Berubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_jabatan_level");
    } else {

        if ($level != $data_old_level['level']) { 
            if ($jmlh_data_level > 0) {
                $_SESSION['pesan'] = "Level Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_jabatan_level");
            } else {
                $sql_level = "UPDATE ms_level SET level='$_POST[level]' WHERE id_level = '$_POST[id_level]' ";
                $query_level = mysqli_query($mysqli, $sql_level);
            }
            
        }

        if ($nama_level != $data_old_level['nama_level']) { 
            if ($jmlh_data_nama_level > 0) {
                $_SESSION['pesan'] = "Nama Level Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_jabatan_level");
            } else {
                $sql = "UPDATE ms_level SET nama_level='$_POST[nama_level]' WHERE id_level = '$_POST[id_level]' ";
                $query_nama_level = mysqli_query($mysqli, $sql);
            }
            
        }

        if ( $query_level || $query_nama_level ) {
            $_SESSION['pesan'] = "Data Level Berhasil Di Rubah";
            $_SESSION['kode_pesan'] = "success";
            header("location:index.php?page=add_jabatan_level");
        } 

    }

    

} else if(isset($_POST['simpan_kategori'])){

    $kategori       = $_POST['kategori'];

    $old_kategori           = $mysqli->query("SELECT * FROM ms_kategori WHERE id_kategori = '$_POST[id_kategori]' ");
    $data_old_kategori      = mysqli_fetch_array($old_kategori);
    $jmlh_data_old_kategori = mysqli_num_rows($old_kategori);
    
    $result_kategori    = $mysqli->query("SELECT * FROM ms_kategori WHERE kategori = '$_POST[kategori]' ");
    $r_kategori         = mysqli_fetch_array($result_kategori);
    $jmlh_data_kategori = mysqli_num_rows($result_kategori);

    if ($_POST['kategori'] == $data_old_kategori['kategori']) {
        $_SESSION['pesan'] = "Tidak Ada Yang Berubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_kategori_kode_pabrik");
    } else {
        if ($jmlh_data_kategori > 0) {
            $_SESSION['pesan'] = "Kategori Sudah Ada";
            $_SESSION['kode_pesan'] = "warning";
            header("location:index.php?page=add_kategori_kode_pabrik");
        } else {
            $sql = "UPDATE ms_kategori SET kategori='$_POST[kategori]' WHERE id_kategori = '$_POST[id_kategori]' ";
            $query = mysqli_query($mysqli, $sql);

            // apakah query simpan berhasil?
            if( $query ) {
                $_SESSION['pesan'] = "Data Kategori Berhasil Di Rubah";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_kategori_kode_pabrik");
            }
        }
    }

} else if(isset($_POST['simpan_kode_pabrikan'])){

    $kode_pabrikan  = $_POST['kode_pabrikan'];

    $old_kode_pabrik           = $mysqli->query("SELECT * FROM ms_kode_pabrik WHERE id_kode_pabrik = '$_POST[id_kode_pabrik]' ");
    $data_old_kode_pabrik      = mysqli_fetch_array($old_kode_pabrik);
    $jmlh_data_old_kode_pabrik = mysqli_num_rows($old_kode_pabrik);

    $result_kode_pabrik    = $mysqli->query("SELECT * FROM ms_kode_pabrik WHERE kode_pabrikan = '$kode_pabrikan' ");
    $r_kode_pabrik         = mysqli_fetch_array($result_kode_pabrik);
    $jmlh_data_kode_pabrik = mysqli_num_rows($result_kode_pabrik);

    if ($_POST['kode_pabrikan'] == $data_old_kode_pabrik['kode_pabrikan']) {
        $_SESSION['pesan'] = "Tidak Ada Data Yang Di Rubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_kategori_kode_pabrik");
    } else {
        if ($jmlh_data_kode_pabrik > 0){
            $_SESSION['pesan'] = "Kode Pabrikan Sudah Ada";
            $_SESSION['kode_pesan'] = "warning";
            header("location:index.php?page=add_kategori_kode_pabrik");
        } else {
            $sql = "UPDATE ms_kode_pabrik SET kode_pabrikan='$kode_pabrikan' WHERE id_kode_pabrik = '$_POST[id_kode_pabrik]' ";
            $query = mysqli_query($mysqli, $sql);

            // apakah query simpan berhasil?
            if( $query ) {
                $_SESSION['pesan'] = "Kode Pabrikan Berhasil Di Rubah";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_kategori_kode_pabrik");
            } 
        }
          
    }

} else if(isset($_POST['simpan_katalog'])){

    $kode_material      = strtoupper($_POST['kode_material']);
    $no_material        = $_POST['no_material'];
    $material_group     = '0'.substr($_POST['no_material'],0,3);
    $id_material        = substr($_POST['no_material'],3,4);
    $kategori           = $_POST['kategori'];
    $deskripsi          = $_POST['deskripsi'];

    $sn_mc_pln          = 'PLN'.$material_group.'000'.$id_material;

    $old_katalog            = $mysqli->query("SELECT * FROM ms_katalog WHERE id_katalog = '$_POST[id_katalog]' ");
    $data_old_katalog       = mysqli_fetch_array($old_katalog);
    $jmlh_data_old_katalog  = mysqli_num_rows($old_katalog);

    $cek_kode_material        = $mysqli->query("SELECT * FROM ms_katalog WHERE kode_material = '$kode_material' ");
    $data_kode_material       = mysqli_fetch_array($cek_kode_material);
    $jmlh_data_kode_material  = mysqli_num_rows($cek_kode_material);

    $cek_no_material        = $mysqli->query("SELECT * FROM ms_katalog WHERE no_material = '$_POST[no_material]' ");
    $data_no_material       = mysqli_fetch_array($cek_no_material);
    $jmlh_data_no_material  = mysqli_num_rows($cek_no_material);

    $cek_kategori        = $mysqli->query("SELECT * FROM ms_katalog WHERE kategori = '$_POST[kategori]' ");
    $data_kategori       = mysqli_fetch_array($cek_kategori);
    $jmlh_data_kategori  = mysqli_num_rows($cek_kategori);

    $cek_deskripsi        = $mysqli->query("SELECT * FROM ms_katalog WHERE deskripsi = '$_POST[deskripsi]' ");
    $data_deskripsi       = mysqli_fetch_array($cek_deskripsi);
    $jmlh_data_deskripsi  = mysqli_num_rows($cek_deskripsi);

    if ($kode_material == $data_old_katalog['kode_material'] && $_POST['no_material'] == $data_old_katalog['no_material'] && $_POST['kategori'] == $data_old_katalog['kategori'] && $_POST['deskripsi'] == $data_old_katalog['deskripsi']) { //0000

        $_SESSION['pesan'] = "Tidak Ada Data Yang Di Rubah";
        $_SESSION['kode_pesan'] = "success";
        header("location:index.php?page=add_katalog");

    } else {

        if ($kode_material != $data_old_katalog['kode_material']) { 
            if ($jmlh_data_kode_material > 0) {
                $_SESSION['pesan'] = "Kode Material Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_katalog");
            } else {
                $sql_kode_material = "UPDATE ms_katalog SET kode_material='$kode_material' WHERE id_katalog = '$_POST[id_katalog]' ";
                $query_kode_material = mysqli_query($mysqli, $sql_kode_material); 
            }
            
        }

        if ($no_material != $data_old_katalog['no_material']) { 
            if ($jmlh_data_no_material > 0) {
                $_SESSION['pesan'] = "No Material Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_katalog");
            } else {
                $sql_no_material = "UPDATE ms_katalog SET no_material='$no_material', sn_mc_pln='$sn_mc_pln', material_group='$material_group', id_material='$id_material' WHERE id_katalog = '$_POST[id_katalog]' ";
                $query_no_material = mysqli_query($mysqli, $sql_no_material); 
            }
        } 

        if ($kategori != $data_old_katalog['kategori']) { 
            $sql_kategori = "UPDATE ms_katalog SET kategori='$kategori' WHERE id_katalog = '$_POST[id_katalog]' ";
            $query_kategori = mysqli_query($mysqli, $sql_kategori); 
        }

        if ($deskripsi != $data_old_katalog['deskripsi']) { 
            if ($jmlh_data_deskripsi > 0) {
                $_SESSION['pesan'] = "Deskripsi Material Sudah Ada";
                $_SESSION['kode_pesan'] = "warning";
                header("location:index.php?page=add_katalog");
            } else {
                $sql_deskripsi = "UPDATE ms_katalog SET deskripsi='$deskripsi' WHERE id_katalog = '$_POST[id_katalog]' ";
                $query_deskripsi = mysqli_query($mysqli, $sql_deskripsi); 
            }
        }

        if( $query_kode_material ||  $query_no_material || $query_kategori || $query_deskripsi ) {
            $_SESSION['pesan'] = "Data Katalog Berhasil Di Rubah";
            $_SESSION['kode_pesan'] = "success";
            header("location:index.php?page=add_kategori_kode_pabrik");
        } 
    }

} else {
    $_SESSION['pesan'] = "Akses Dilarang";
    $_SESSION['kode_pesan'] = "warning";
    header("location:index.php?page=add_trx");
}

?>