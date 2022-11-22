<?php 
include ("koneksi.php");

if(isset($_POST['submit_user'])){
	
	$username			= $_POST['username'];
	$password 			= md5($_POST['password']);
	$nama				= $_POST['nama'];
	$jabatan			= $_POST['jabatan'];
	$level				= $_POST['level'];
	$status				= '1';

	$result_username 	= $mysqli->query("SELECT * FROM login WHERE username = '$username'");
	$r_username 		= mysqli_fetch_array($result_username);
	$jmlh_data_username	= mysqli_num_rows($result_username);

	if ($jmlh_data_username > 0){
		$_SESSION['pesan'] = "Username sudah ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_user");
	}else{

		if ($_POST['password'] == '') {
			$sql = "INSERT INTO login (username, nama, jabatan, level, status) VALUES ('$username', '$nama', '$jabatan','$level', '$status')";
		} else {
			$sql = "INSERT INTO login (username, password, nama, jabatan, level, status) VALUES ('$username', '$password', '$nama', '$jabatan','$level', '$status')";
		}
		
		$query = mysqli_query($mysqli, $sql);

		// apakah query simpan berhasil?
	    if( $query ) {
	        $_SESSION['pesan'] = "User Berhasil Di Tambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_user");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan User";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_user");
	    } 
	}

} else if(isset($_POST['submit_jabatan'])){

    $kode_jabatan   = str_replace(' ', '_', strtolower($_POST['kode_jabatan']));
	$nama_jabatan	= ucfirst($_POST['nama_jabatan']);

	$result_kode 	= $mysqli->query("SELECT * FROM ms_jabatan WHERE kode_jabatan = '$kode_jabatan'");
	$r_kode 		= mysqli_fetch_array($result_kode);
	$jmlh_data_kode	= mysqli_num_rows($result_kode);

	$result_nama = $mysqli->query("SELECT * FROM ms_jabatan WHERE nama_jabatan = '$nama_jabatan'");
	$r_nama = mysqli_fetch_array($result_nama);
	$jmlh_data_nama	= mysqli_num_rows($result_nama);

	if ($jmlh_data_kode > 0){
    	$_SESSION['pesan'] = "Kode Jabatan Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_jabatan_level");
	} else if ($jmlh_data_nama > 0){
    	$_SESSION['pesan'] = "Nama Jabatan Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_jabatan_level");
	} else{
		$sql = "INSERT INTO ms_jabatan (kode_jabatan, nama_jabatan) VALUES ('$kode_jabatan', '$nama_jabatan')";
		$query = mysqli_query($mysqli, $sql);

		// apakah query simpan berhasil?
	    if( $query ) {
	        $_SESSION['pesan'] = "Data Jabatan Berhasil Ditambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_jabatan_level");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan Data Jabatan";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_jabatan_level");
	    } 	
	}

} else if(isset($_POST['submit_level'])){

	$level		= $_POST['level'];
    $nama_level	= ucfirst($_POST['nama_level']);

    $result_level			= $mysqli->query("SELECT * FROM ms_level WHERE level = '$level' ");
    $r_level				= mysqli_fetch_array($result_level);
    $jmlh_data_level 		= mysqli_num_rows($result_level);

	$r_nama_level 			= $mysqli->query("SELECT * FROM ms_level WHERE nama_level = '$nama_level' ");
	$data_nama_level		= mysqli_fetch_array($r_nama_level);
	$jmlh_data_nama_level	= mysqli_num_rows($r_nama_level);

	if ($jmlh_data_level > 0){
        $_SESSION['pesan'] = "Level Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_jabatan_level");
    } else if ($jmlh_data_nama_level > 0){
		$_SESSION['pesan'] = "Nama Level Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_jabatan_level");
    } else {
		$sql = "INSERT INTO ms_level (level, nama_level) VALUES ('$level', '$nama_level')";
		$query = mysqli_query($mysqli, $sql);

		if( $query ) {
	        $_SESSION['pesan'] = "Data Level Berhasil Ditambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_jabatan_level");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan Data Level";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_jabatan_level");
	    }  	
	}

} else if(isset($_POST['submit_kategori'])){

    $kategori       = ucfirst($_POST['kategori']);
    $status         = '0';
    
    $result_kategori    = $mysqli->query("SELECT * FROM ms_kategori WHERE kategori = '$_POST[kategori]'");
    $r_kategori         = mysqli_fetch_array($result_kategori);
    $jmlh_data_kategori = mysqli_num_rows($result_kategori);

    if ($jmlh_data_kategori > 0){
    	$_SESSION['pesan'] = "Kategori Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_kategori_kode_pabrik");
    } else {
        $sql = "INSERT INTO ms_kategori (kategori, status) VALUES ('$kategori', '$status')";
        $query = mysqli_query($mysqli, $sql);

        if( $query ) {
	        $_SESSION['pesan'] = "Data Kategori Berhasil Di Tambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_kategori_kode_pabrik");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan Data Kategori";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_kategori_kode_pabrik");
	    }  
    }

} else if(isset($_POST['submit_kode_pabrik'])){

    $kode_pabrikan  = $_POST['kode_pabrikan'];
    $status         = '0';

    $result_kode_pabrik = $mysqli->query("SELECT * FROM ms_kode_pabrik WHERE kode_pabrikan = '$kode_pabrikan'");
    $r_kode_pabrik = mysqli_fetch_array($result_kode_pabrik);
    $jmlh_data_kode_pabrik  = mysqli_num_rows($result_kode_pabrik);

    if ($jmlh_data_kode_pabrik > 0){
        $_SESSION['pesan'] = "Kode Pabrikan Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_kategori_kode_pabrik");
    } else{
        $sql = "INSERT INTO ms_kode_pabrik (kode_pabrikan, status) VALUES ('$kode_pabrikan', '$status')";
        $query = mysqli_query($mysqli, $sql);

        if( $query ) {
	        $_SESSION['pesan'] = "Data Kode Pabrikan Berhasil Di Tambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_kategori_kode_pabrik");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan Data Kode Pabrikan";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_kategori_kode_pabrik");
	    }   
    }

} else if(isset($_POST['submit_katalog'])){

    $kode_material      = strtoupper($_POST['kode_material']);
    $no_material        = $_POST['no_material'];
    $material_group     = '0'.substr($_POST['no_material'],0,3);
    $id_material        = substr($_POST['no_material'],3,4);
    $kategori           = $_POST['kategori'];
    $deskripsi          = $_POST['deskripsi'];
    $status             = '0';

    $sn_mc_pln          = 'PLN'.$material_group.'000'.$id_material;

    $resilt_no_material     = $mysqli->query("SELECT * FROM ms_katalog WHERE no_material = '$_POST[no_material]'");
    $data_no_material       = mysqli_fetch_array($resilt_no_material);
    $jmlh_data_no_material  = mysqli_num_rows($resilt_no_material);

    $result_kode_material       = $mysqli->query("SELECT * FROM ms_katalog WHERE kode_material = '$_POST[kode_material]'");
    $data_kode_material         = mysqli_fetch_array($result_kode_material);
    $jmlh_data_kode_material    = mysqli_num_rows($result_kode_material);

    if ($jmlh_data_no_material > 0){
        $_SESSION['pesan'] = "Nomor Material Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_katalog");
    } else if ($jmlh_data_kode_material > 0){
        $_SESSION['pesan'] = "Kode Material Sudah Ada";
		$_SESSION['kode_pesan'] = "warning";
		header("location:index.php?page=add_katalog");
    } else {
        $sql = "INSERT INTO ms_katalog (kode_material, sn_mc_pln, no_material, material_group, id_material, kategori, deskripsi, status) VALUES ('$kode_material', '$sn_mc_pln', '$no_material', '$material_group', '$id_material', '$kategori', '$deskripsi', '$status') ";
        $query = mysqli_query($mysqli, $sql);

        if( $query ) {
	        $_SESSION['pesan'] = "Data Katalog Berhasil Di Tambahkan";
			$_SESSION['kode_pesan'] = "success";
			header("location:index.php?page=add_katalog");
	    } else {
	        $_SESSION['pesan'] = "Gagal Menambahkan Data Katalog";
			$_SESSION['kode_pesan'] = "warning";
			header("location:index.php?page=add_katalog");
	    }  
    }

} else {
	$_SESSION['pesan'] = "Akses Dilarang";
	$_SESSION['kode_pesan'] = "warning";
	header("location:index.php?page=list_qrcode");
}
    

?>