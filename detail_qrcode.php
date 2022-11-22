<?php 
  session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['username']==""){
    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
  }

  $session_username   = $_SESSION['username'];
  $session_nama       = $_SESSION['nama'];
  $session_jabatan    = $_SESSION['jabatan'];
  $session_level      = $_SESSION['level'];

  $years = range(2022, strftime("%Y", time()));
?>

<?php 
  include 'koneksi.php';

  //CEK EMAIL DI TABLE MASTER CUSTOMER
  $query_trx      = $mysqli->query("SELECT * from trx_qrcode where kode_serial_material = '$_GET[kode_serial_material]'");
  $data_trx       = mysqli_fetch_array($query_trx);
  $jmlh_data_trx  = mysqli_num_rows($query_trx);

  $tgl_created  = date("d-m-Y H:i:s", strtotime($data_trx['created_dt']));
  $tgl_update   = date("d-m-Y H:i:s", strtotime($data_trx['update_dt']));
  $tgl_print    = date("d-m-Y H:i:s", strtotime($data_trx['print_dt']));

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PT. Trafoindo | QR PLN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="assets/link/fonts.googleapis.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="assets/link/css/ionicframework.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Other Link References -->
  <script src="assets/link/kit.fontawesome.js"></script>
  <script src="assets/link/ajax.googleapis.js"></script>
  <script src="assets/link/bootstrap3-typeahead-4.0.2.min.js"></script>
  <script src="assets/link/bootstrap.min-3.3.5.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php?page=dashboard" class="brand-link">
      <img src="assets/img/logo-tpp.jpg" alt="Logo Trafoindo" class="brand-image img-circle">
      <span class="brand-text font-weight-light"><font size="5"><b>QR PLN</b></font></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/img/user-image.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php?page=dashboard" class="d-block"><?php echo $_SESSION['nama']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item">
            <a href="index.php?page=dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-database"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if ($session_level == 0) { ?>
              <li class="nav-item">
                <a href="index.php?page=add_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=add_jabatan_level" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jabatan & Level</p>
                </a>
              </li>
              <?php } else {} ?>

              <li class="nav-item">
                <a href="index.php?page=add_kategori_kode_pabrik" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori & Kode Pabrik</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=add_katalog" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Katalog Material</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="index.php?page=add_trx" class="nav-link">
              <i class="nav-icon fa-solid fa-square-plus"></i>
              <p>Create QR & Barcode</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="index.php?page=list_qrcode" class="nav-link active">
              <i class="nav-icon fa-solid fa-list"></i>
              <p>List QR Code</p>
            </a>
          </li>
          
          <?php if ($session_level == 0) { ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa-solid fa-triangle-exclamation"></i>
              <p>Mode Testing
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?page=filter_delete_image" class="nav-link">
                  <i class="nav-icon fa-solid fa-trash"></i>
                  <p>DELETE GAMBAR FILTER</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=filter_delete_data" class="nav-link">
                  <i class="nav-icon fa-solid fa-file-circle-xmark"></i>
                  <p>DELETE DATA FILTER</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=filter_create_image" class="nav-link">
                  <i class="nav-icon fa-solid fa-image"></i>
                  <p>GENERATE IMAGE FILTER</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=mode_testing" onclick="return confirm('Dabatase akan di kosongkan dan gambar akan di hapus. Yakin ingin reset ?')" class="nav-link">
                  <i class="nav-icon fa-solid fa-ban"></i>
                  <p>RESET !!!</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else {} ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div class="sidebar-custom">
      <a href="logout.php"><button type="button" class="btn btn-block bg-gradient-danger">LOGOUT</button></a>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Material</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=list_qrcode">List QR Code</a></li>
              <li class="breadcrumb-item"><a href="index.php?page=detail_qrcode&kode_serial_material=kode_serial_material=<?php echo $data_trx['kode_serial_material']; ?>">Detail Material</a></li>
              <li class="breadcrumb-item active"><?php echo $data_trx['kode_serial_material']; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center">QR CODE</h3>
                <?php if ($data_trx['qrcode_dir'] == '') { ?>
                  <div class="text-center">
                    <img class="img-fluid mb-2" alt="View QR Code" style="width: 100%;" src="assets/img/unvailable_picture.jpg">
                  </div> 
                <?php } else { ?>
                  <div class="text-center">
                    <a href="#" data-toggle="modal" title="View QR Code" data-target="#modal-qrcode-<?php echo $data_trx['kode_serial_material'] ?>"><img class="img-fluid mb-2" alt="View QR Code" style="width: 100%;" src="<?php echo $data_trx['qrcode_dir']; ?>"></a>
                  </div> 
                <?php } ?>  
              </div>
            </div>

            <div class="modal fade" id="modal-qrcode-<?php echo $data_trx['kode_serial_material'] ?>">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">QR CODE</h4>
                  </div>
                  <div class="modal-body">
                    <div class="card-body">

                      <div class="row">
                        <div class="col-md-12">
                          <center><img class="img-fluid mb-2" alt="QR Code" style="width: 100%;" src="<?php echo $data_trx['qrcode_dir']; ?>"></center>
                        </div>
                      </div>

                    </div>  
                  </div>
                </div>
              </div>
            </div>

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <h3 class="profile-username text-center">BARCODE</h3>
                <?php if ($data_trx['barcode_dir'] == '') { ?>
                  <div class="text-center">
                    <img class="img-fluid mb-2" alt="Barcode Belum Di Buat" style="width: 100%;" src="assets/img/unvailable_picture.jpg">
                  </div> 
                <?php } else { ?>
                  <div class="text-center">
                    <a href="#" data-toggle="modal" title="View QR Code" data-target="#modal-barcode-<?php echo $data_trx['kode_serial_material'] ?>"><img class="img-fluid mb-2" alt="View Barcode" style="width: 100%;" src="<?php echo $data_trx['barcode_dir']; ?>"></a>
                  </div> 
                <?php } ?>  
                       
              </div>
            </div>

            <?php if ($data_trx['status_qr'] == '0' and $data_trx['status_barcode'] == '0') { ?>
              <div class="card">
                <div class="card-body box-profile">
                  <a href="index.php?page=create_gambar&kode_serial_material=<?php echo $data_trx['kode_serial_material'] ?>" class="btn btn-warning btn-block"><b>Generate Barcode & QR Code</b></a> 
                </div>
              </div>
            <?php } ?>

            <div class="modal fade" id="modal-barcode-<?php echo $data_trx['kode_serial_material'] ?>">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">BARCODE</h4>
                  </div>
                  <div class="modal-body">
                    <div class="card-body">

                      <div class="row">
                        <div class="col-md-12">
                          <center><img class="img-fluid mb-2" alt="QR Code" style="width: 100%; height: 100%" src="<?php echo $data_trx['barcode_dir']; ?>"></center>
                        </div>
                      </div>
                      
                    </div>  
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#detail_material" data-toggle="tab">Material Information</a></li>
                  <?php if ($data_trx['status_print'] == 0) { ?>
                    <li class="nav-item"><a class="nav-link" href="#edit_material" data-toggle="tab">Edit Material </a></li>
                  <?php } else {} ?>
                
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="detail_material">
                    <!-- Post -->
                    <div class="post">
                      <div class="row">
                        <div class="col-12 col-sm-12">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Kode Serial Material</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><?php echo $data_trx['kode_serial_material'] ?></font></center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Status QR Code</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php
                                      if($data_trx['status_qr'] == 1){echo '<span class="badge bg-success" style="text-align: center;"><font size ="3">AVAILABLE</font></span>';
                                      }else if ($data_trx['status_qr'] == 0) {
                                        echo '<span class="badge bg-danger" style="text-align: center;"><font size ="3">NOT AVAILABLE</font></span>';
                                      }
                                    ?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Status Barcode</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php
                                      if($data_trx['status_barcode'] == 1){echo '<span class="badge bg-success" style="text-align: center;"><font size ="3">AVAILABLE</font></span>';
                                      }else if ($data_trx['status_barcode'] == 0) {
                                        echo '<span class="badge bg-danger" style="text-align: center;"><font size ="3">NOT AVAILABLE</font></span>';
                                      }
                                    ?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Status Print</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php
                                      if($data_trx['status_print'] == 1){echo '<span class="badge bg-primary" style="text-align: center;"><font size ="3">SUDAH DI PRINT</font></span>';
                                      }else if ($data_trx['status_print'] == 0) {
                                        echo '<span class="badge bg-warning" style="text-align: center;"><font size ="3">BELUM DI PRINT</font></span>';
                                      }
                                    ?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>SN MC PLN</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><?php if ($data_trx['sn_mc_pln'] == '') { echo "-";} else{ echo $data_trx['sn_mc_pln'];}?></font></center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Tahun Produksi</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><?php if ($data_trx['tahun_produksi'] == '') { echo "-";} else{ echo $data_trx['tahun_produksi'];}?></font></center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Batch Produksi</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><?php if ($data_trx['batch_produksi'] == '') { echo "-";} else{ echo $data_trx['batch_produksi'];}?></font></center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>S/N Material</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['sn_material'] == '') { echo "-";} else{ echo $data_trx['sn_material'];}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-6">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Kode Pabrikan</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['kode_pabrikan'] == '') { echo "-";} else{ echo $data_trx['kode_pabrikan'];}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-4">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Kategori Material</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['kategori'] == '') { echo "-";} else{ echo $data_trx['kategori'];}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-8">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Deskripsi</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['deskripsi'] == '') { echo "-";} else{ echo $data_trx['deskripsi'];}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Dibuat Oleh</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['created_by'] == '') { echo "-";} else{ echo $data_trx['created_by'];}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-6">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Tanggal Pembuatan</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['created_dt'] == '0000-00-00 00:00:00') { echo "-";} else{ echo $tgl_created;}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>

                      <?php if ($data_trx['update_by'] != '') { ?>
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <div class="card card-outline card-primary">
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-sm-12">
                                    <center><font size="4"><b>Diupdate Oleh</b></font></center>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <center>
                                      <?php if ($data_trx['update_by'] == '') { echo "-";} else{ echo $data_trx['update_by'];}?>
                                    </center>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>

                          <div class="col-12 col-sm-6">
                            <div class="card card-outline card-primary">
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-sm-12">
                                    <center><font size="4"><b>Tanggal Update</b></font></center>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <center>
                                      <?php if ($data_trx['update_dt'] == '0000-00-00 00:00:00') { echo "-";} else{ echo $tgl_update;}?>
                                    </center>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      <?php } else {} ?>

                      <?php if ($data_trx['print_by'] != '') { ?>
                      <div class="row">
                        <div class="col-12 col-sm-6">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Terakhir Di Print Oleh</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['print_by'] == '') { echo "-";} else{ echo $data_trx['print_by'];}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        <div class="col-12 col-sm-6">
                          <div class="card card-outline card-primary">
                            <div class="card-body">

                              <div class="row">
                                <div class="col-sm-12">
                                  <center><font size="4"><b>Tanggal Terakhir Print</b></font></center>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-sm-12">
                                  <center>
                                    <?php if ($data_trx['print_dt'] == '0000-00-00 00:00:00') { echo "-";} else{ echo $tgl_print;}?>
                                  </center>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <?php } else {} ?>

                      <?php if ($data_trx['status_qr'] == 1 and $data_trx['status_barcode'] == 1) { ?>
                        <center>
                          <button class="btn btn-secondary" onclick="newWindow = window.open('index.php?page=print_material&kode_serial_material=<?php echo $data_trx["kode_serial_material"]; ?>'); ">
                            Print Barcode & QR Code
                          </button>
                        </center>
                      <?php } else {} ?>
                  </div>
                </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="edit_material">
                    <div class="post">
                      <form class="form-horizontal" name="form_edit_qrcode" action="index.php?page=edit_qrcode" method="post" enctype="multipart/form-data">
                        <div class="row" hidden>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Kode Serial Material</label>
                              <input class="form-control" type="text" name="kode_serial_material" id="kode_serial_material" value="<?php echo $data_trx['kode_serial_material'] ?>" placeholder="Kode Serial Material" readonly>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Kode Material</label>
                              <select class="form-control select2bs4" style="width:100%; height: 100%;" onchange="autofill()" name="kode_material" id="kode_material" required>
                                <option selected="selected" value="<?php echo $data_trx['kode_material'] ?>">- <?php echo $data_trx['kode_material'] ?> -</option>
                                <?php
                                include "koneksi.php";
                                $sql=mysqli_query($mysqli,"select * from ms_katalog where status != 0 and kode_material != '$data_trx[kode_material]' order by kode_material asc");
                                while ($data = mysqli_fetch_array($sql)){
                                  echo '<option name="kode_material" value="'.$data['kode_material'].'">'.$data['kode_material'].'</option>';
                                }?>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>SN MC PLN</label>
                              <input class="form-control" type="text" name="sn_mc_pln" id="sn_mc_pln" value="<?php echo $data_trx['sn_mc_pln'] ?>" placeholder="SN MC PLN" readonly>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label>Kategori Material</label>
                              <input class="form-control" type="text" name="kategori" id="kategori" value="<?php echo $data_trx['kategori'] ?>" placeholder="Kategori Material" readonly>
                            </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group">
                              <label>Deskripsi Material</label>
                              <input class="form-control" type="text" name="deskripsi" id="deskripsi" value="<?php echo $data_trx['deskripsi'] ?>" placeholder="Deskripsi Material" readonly>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label>Kode Pabrikan</label>
                              <select class="form-control" style="width:100%; height: 100%;"  name="kode_pabrikan" id="kode_pabrikan">
                                <?php
                                include "koneksi.php";
                                $sql_kode=mysqli_query($mysqli,"select * from ms_kode_pabrik");
                                while ($data_kode = mysqli_fetch_array($sql_kode)){
                                  echo '<option name="kode_pabrikan" value="'.$data_kode['kode_pabrikan'].'">'.$data_kode['kode_pabrikan'].'</option>';
                                }?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label title="Di input oleh pabrikan!!">Tahun Produksi</label>
                              <select class="form-control" name="tahun_produksi" id="tahun_produksi" required>
                                <?php foreach($years as $year) : ?>
                                  <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label title="Di input oleh pabrikan!!">Batch Produksi</label><font color="red" size="3">*</font>
                              <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" minlength="2" maxlength="2" name="batch_produksi" id="batch_produksi" value="<?php echo $data_trx['batch_produksi'] ?>" placeholder="00" required>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label title="Di input oleh pabrikan!!">S/N Material</label><font color="red" size="3" title="Di input oleh pabrikan!!">*</font>
                              <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" minlength="5" maxlength="5" name="sn_material" id="sn_material" value="<?php echo $data_trx['sn_material'] ?>" placeholder="00000" required>
                            </div>
                          </div>

                        </div>

                        <br>

                        <center>
                            <div class="col-sm-12">
                            <button type="submit" name="simpan_qrcode" class="btn btn-primary" >Submit</button>
                            
                          </div></center>
                      </form>
                    </div>
                  </div>
 
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/link/jquery.min-1.12.4.js"></script>
<script src="assets/link/cloudflare.js"></script>
<script src="assets/dist/js/jquery.maskedinput.js" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets/plugins/jszip/jszip.min.js"></script>
<script src="assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>


<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>

<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode > 30 && (charCode < 48 || charCode > 57))

      return false;
    return true;
  }
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});

</script>

<script>
  $(function () {
    $('#tbl_qrcode_barcode').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>



<script type="text/javascript">
function autofill(){
  var kode_material = $("#kode_material").val();
  $.ajax({
    url : 'autofill.php', // file proses penginputan
    data : "kode_material="+kode_material,
  }).success(function (data){
      var json = data,
      obj = JSON.parse(json);
    $('#sn_mc_pln').val(obj.sn_mc_pln);
    $('#kategori').val(obj.kategori);
    $('#deskripsi').val(obj.deskripsi);
  })
}
</script>

</body>
</html>
