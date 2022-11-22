<?php
  	session_start();
	error_reporting( error_reporting() & ~E_NOTICE );
	include "koneksi.php";

	if ($_GET['page'] == "dashboard") {
		include "dashboard.php";
	}

	//MODE TESTING !!!

	//RESET
	else if ($_GET['page'] == "mode_testing") {
		include "mode_testing.php";
	}

	//DELETE FILE QR & BARCODE MASSAL
	else if ($_GET['page']=="filter_delete_image") { //VIEW
		include "filter_delete_gambar.php";
	}

	else if ($_GET['page']=="delete_gambar_massal") { //FUNCTIOn
		include "delete_gambar_massal.php";
	}

	//GENERATE FILE QR & BARCODE MASSAL !!!
	else if ($_GET['page']=="filter_create_image") { //VIEW
		include "filter_create_gambar.php";
	}

	else if ($_GET['page']=="create_gambar_massal") { //FUNCTIOn
		include "create_gambar_massal.php";
	}

	//DELETE DATA & IMAGE (QR & BARCODE) MASSAL!!!
	else if ($_GET['page'] == "filter_delete_data") { //VIEW
		include "filter_delete_data.php";
	}

	else if ($_GET['page'] == "delete_data_massal") { //FUNCTIOn
		include "delete_data_massal.php";
	}

	//HALAMAN MASTER DATA - USER
    
	else if ($_GET['page']=="add_user") {
		include "add_user.php";
	}

	else if ($_GET['page']=="create_user") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_user") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_user") {
		include "delete_master.php";
	}

	//HALAMAN MASTER DATA - JABATAN & LEVEL

	else if ($_GET['page']=="add_jabatan_level") {
		include "add_jabatan_level.php";
	}

	else if ($_GET['page']=="create_jabatan") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_jabatan") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_jabatan") {
		include "delete_master.php";
	}

	else if ($_GET['page']=="create_level") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_level") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_level") {
		include "delete_master.php";
	}

	//HALAMAN MASTER DATA - KATALOG MATERIAL
	else if ($_GET['page']=="add_katalog") {
		include "add_katalog.php";
	}

	else if ($_GET['page']=="create_katalog") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_katalog") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_katalog") {
		include "delete_master.php";
	}
	
	//HALAMAN MASTER DATA - KATEGORI & KODE PABRIK

	else if ($_GET['page']=="add_kategori_kode_pabrik") {
		include "add_kategori_kode_pabrik.php";
	}

	else if ($_GET['page']=="create_kategori") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_kategori") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_kategori") {
		include "delete_master.php";
	}

	else if ($_GET['page']=="create_kode_pabrik") {
		include "create_master.php";
	}

	else if ($_GET['page']=="edit_kode_pabrik") {
		include "update_master.php";
	}

	else if ($_GET['page']=="delete_kode_pabrik") {
		include "delete_master.php";
	}

	//HALAMAN PRINT FILTER

	else if ($_GET['page']=="print_filter") {
		include "print_filter.php";
		// include "under_construction.php";
	}

	else if ($_GET['page']=="print_all") {
		include "print_massal.php";
	}

	//HALAMAN CREATE QR & BARCODE

	else if ($_GET['page']=="add_trx") {
		include "add_trx.php";
	}

	else if ($_GET['page']=="create_trx") {
		include "create_trx.php";
	}


	// HALAMAN DETAIL QRCODE
	else if ($_GET['page']=="detail_qrcode") {
		include "detail_qrcode.php";
	}

	else if ($_GET['page']=="edit_qrcode") {
		include "update_qrcode.php";
	}

	else if ($_GET['page']=="create_gambar") {
		include "create_gambar.php";
	}

	//HALAMAN LIST QR CODE

	else if ($_GET['page']=="list_qrcode") {
		include "list_qrcode.php";
	}

	else if ($_GET['page']=="print_material") {
		include "print_material.php";
	}

	else if ($_GET['page']=="delete_gambar") {
		include "delete_gambar.php";
	}

	else if ($_GET['page']=="delete_trx") {
		include "delete_trx.php";
	}

	else{
		include "login.php";
	}
?>