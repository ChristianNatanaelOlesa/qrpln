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
?>

<!DOCTYPE html>
<html lang="id">
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
  <!-- SweetaAlert -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style type="text/css">
    .dropdown-menu {
      position: absolute; 
      transform: translate3d(-200px, 38px, 0px); 
      top: -100px; left: 0px; 
      will-change: transform;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<?php if(isset($_SESSION['pesan']) && $_SESSION['pesan'] != '') { ?>
  <script>
    swal({
      title: "<?php echo $_SESSION['pesan']; ?>",
      icon: "<?php echo $_SESSION['kode_pesan']; ?>",
    });
  </script>
<?php 
  unset($_SESSION['pesan']);
} ?>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

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

          <li class="nav-item">
            <a href="index.php?page=print_filter" class="nav-link">
              <i class="nav-icon fa-solid fa-print"></i>
              <p>Print Filter</p>
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>List QR Code & Barcode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">List QR Code & Barcode</li>
            </ol>
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row mb-2">

                  <div class="col-sm-7">
                    <div class="form-group row">
                        
                      <div class="col-sm-10">
                        <form action="index.php?page=list_qrcode" method="post" class="form-horizontal">
                          <div class="form-group row">

                            <label class="col-sm-7 col-form-label">Urutkan Berdasarkan Status Print</label>
                            <div class="col-sm-5">
                              <select class="form-control select2bs4" style="width:100%; height: 100%;" onchange="this.form.submit()" name="order_by" id="order_by" required>
                                <option selected="selected" value="">- Pilih Status -</option>
                                <option value="0">Belum Print</option>
                                <option value="1">Sudah Print</option>
                              </select>
                            </div>

                            
                          </div>
                        </form>
                      </div>                    
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-12">
                    <table id="tbl_qrcode_barcode" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center; vertical-align: middle;">Kode Serial Material PLN</th>
                          <th style="text-align: center; vertical-align: middle;">Kode Material</th>
                          <th class="no-sort" style="text-align: center; vertical-align: middle;">Status</th>
                          <th style="text-align: center; vertical-align: middle;">Created Date</th>
                          <th style="text-align: center; vertical-align: middle;">Update Date</th>
                          <th style="text-align: center; vertical-align: middle;">Print Date</th>
                          <th class="no-sort" style="text-align: center; vertical-align: middle;">Action</th>
                        </tr>
                      </thead>

                      <tbody>
                      <?php
                        include ("koneksi.php");

                        if (isset($_POST['order_by'])) {
                          $orderby   = $_POST['order_by'];

                          $query_list = mysqli_query($mysqli,"select a.*, b.no_material, b.material_group, b.id_material from trx_qrcode a inner join ms_katalog b on a.kode_material = b.kode_material where a.status_print = '$_POST[order_by]' order by a.created_dt desc");
                        } else {
                          $query_list=mysqli_query($mysqli,"select a.*, b.no_material, b.material_group, b.id_material from trx_qrcode a inner join ms_katalog b on a.kode_material = b.kode_material order by a.created_dt desc");
                        }

                        if(mysqli_num_rows($query_list) == 0){
                          echo '<tr><td colspan="8" style="text-align: center">Tidak Ada Data.</td></tr>';
                        }else{
                          while($data_list = mysqli_fetch_assoc($query_list)){
                            $tgl_created  = date("d-m-Y H:i:s", strtotime($data_list['created_dt']));
                            $tgl_update   = date("d-m-Y H:i:s", strtotime($data_list['update_dt']));
                            $tgl_print    = date("d-m-Y H:i:s", strtotime($data_list['print_dt']));
                      ?>
                      <tr>
                        <td style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_serial_material']) ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php echo strtoupper($data_list['kode_material']) ?></td>
                        <td style="text-align: center; vertical-align: middle;">
                          <?php if ($data_list['status_qr'] == 0) {
                          echo '<span class="badge bg-danger" style="text-align: center; vertical-align: middle;" title="Image QR Code Tidak Tersedia"><font size="4">Q</font></span>';} else {echo '<span class="badge bg-success" style="text-align: center; vertical-align: middle;" title="Image QR Code Tersedia"><font size="4">Q</font></span>';}?>
                          &nbsp;
                          <?php if ($data_list['status_barcode'] == 0) {
                          echo '<span class="badge bg-danger" style="text-align: center; vertical-align: middle;" title="Image Barcode Tidak Tersedia"><font size="4">B</font></span>';} else {echo '<span class="badge bg-success" style="text-align: center; vertical-align: middle;" title="Image Barcode Tersedia"><font size="4">B</font></span>';}?>
                          &nbsp;
                          <?php if ($data_list['status_print'] == 0) {
                          echo '<span class="badge bg-warning" style="text-align: center; vertical-align: middle;" title="Belum Di Print"><font size="4">P</font></span>';} else {echo '<span class="badge bg-primary" style="text-align: center; vertical-align: middle;" title="Sudah Di Print"><font size="4">P</font></span>';}?>
                          </td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['created_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $tgl_created; } ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['update_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $tgl_update; } ?></td>
                        <td style="text-align: center; vertical-align: middle;"><?php if ($data_list['print_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $tgl_print; } ?></td>
                        <td style="text-align: center; vertical-align: middle;">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            </button>
                            <div class="dropdown-menu">

                              <button type="button" class="btn dropdown-item" title="Detail Material" data-toggle="modal" data-target="#modal-lg-detail-<?php echo $data_list['kode_serial_material'] ?>">Detail
                              </button>

                              <?php if ($data_list['status_qr'] != '0' and $data_list['status_barcode'] != '0' and $data_list['status_print'] != '0') { ?>
                                <a href='index.php?page=print_material&kode_serial_material=<?php echo $data_list["kode_serial_material"]; ?>'>
                                  <button type="button" class="btn dropdown-item" title="Print Barcode & QR Code" >Print</button>
                                </a>

                              <?php } else if ($data_list['status_qr'] == '0' and $data_list['status_barcode'] == '0') { ?>
                                
                              <?php } else { ?>
                                <a href='index.php?page=print_material&kode_serial_material=<?php echo $data_list["kode_serial_material"]; ?>' onclick="return confirm('SETELAH PRINT DATA TIDAK DAPAT DI EDIT LAGI. YAKIN INGIN PRINT ?')">
                                  <button type="button" class="btn dropdown-item" title="Print Barcode & QR Code" >Print</button>
                                </a>
                              <?php } ?>

                              <?php if ($session_level == '0') { ?>
                                <?php if ($data_list['status_qr'] == 1 && $data_list['status_barcode'] == 1) { ?>
                                  <a href='index.php?page=delete_gambar&kode_serial_material=<?php echo $data_list['kode_serial_material'] ?>'><button type="button" class="btn dropdown-item" title="Hapus Image QR & Barcode" onclick="return confirm('Anda Yakin Ingin Hapus Image QR & Barcode Ini ?')">Hapus Gambar
                                </button></a>
                                <?php } else {} ?>
                                
                                <?php if ($data_list['status_print'] == 0) { ?>
                                <a href='index.php?page=delete_trx&kode_serial_material=<?php echo $data_list['kode_serial_material'] ?>'><button type="button" class="btn dropdown-item" title="Hapus Data" onclick="return confirm('Anda Yakin Ingin Hapus Data Ini ?')">Hapus Data
                                </button></a>
                                <?php } else {} ?>
                              <?php } ?>
                              
                            </div>
                          </div>
                        </td>
                      </tr>

                      <div class="modal fade" id="modal-lg-detail-<?php echo $data_list['kode_serial_material'] ?>">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title">DETAIL MATERIAL</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="card-body">

                                <div class="row">
                                  <div class="col-md-3">
                                   <font size="4"><b>KODE MATERIAL</b></font> 
                                  </div>
                                  <div class="col-md-9">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<font size="3"><b><?php echo $data_list['kode_material']; ?></b></font> 
                                  </div>
                                </div>

                                <ul>
                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="3"><b>Image QR Code</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<?php if ($data_list['status_qr'] == 0) {
                                          echo '<font size="3">Tidak Tersedia</font>';} else {echo '<font size="3">Tersedia</font>';}?>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Image Barcode</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<?php if ($data_list['status_barcode'] == 0) {
                                          echo '<font size="3">Tidak Tersedia</font>';} else {echo '<font size="3">Tersedia</font>';}?>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Status Print</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<?php if ($data_list['status_print'] == 0) {
                                          echo '<font size="3">Belum Di Print</font>';} else {echo '<font size="3">Sudah Di Print</font>';}?>
                                      </div>
                                    </div>
                                  </li>
                                </ul>

                                <div class="row">
                                  <div class="col-md-12">
                                   <font size="4"><b>DATA DARI PLN</b></font> 
                                  </div>
                                </div>

                                <ul>
                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="3"><b>No Material</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php echo $data_list['no_material']; ?></font> 
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Material Group</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['material_group']; ?></font>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>ID Material</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['id_material']; ?></font>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>SN MC PLN</b></font> 
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['sn_mc_pln']; ?></font> 
                                      </div>
                                    </div> 
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Kategori</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['kategori']; ?></font>
                                      </div>
                                    </div> 
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Deskripsi</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['deskripsi']; ?></font>
                                      </div>
                                    </div> 
                                  </li>
                                </ul>

                                <div class="row">
                                  <div class="col-md-12">
                                   <font size="4"><b>DATA DARI PABRIKAN</b></font> 
                                  </div>
                                </div>

                                <ul>
                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="3"><b>Kode Pabrikan</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php echo $data_list['kode_pabrikan']; ?></font> 
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Tahun Produksi</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['tahun_produksi']; ?></font>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Batch Produksi</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['batch_produksi']; ?></font>
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>S/N Material</b></font> 
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="4"><?php echo $data_list['sn_material']; ?></font> 
                                      </div>
                                    </div> 
                                  </li>
                                </ul>

                                <div class="row">
                                  <div class="col-md-12">
                                   <font size="4"><b>LOG HISTORY</b></font> 
                                  </div>
                                </div>

                                <ul>
                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="3"><b>Created Date</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php if ($data_list['created_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $tgl_created." - ( ".$data_list['created_by']." ) "; } ?></font> 
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Update Date</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php if ($data_list['update_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $tgl_update." - ( ".$data_list['update_by']." ) "; } ?></font> 
                                      </div>
                                    </div>
                                  </li>

                                  <li>
                                    <div class="row">
                                      <div class="col-md-3">
                                        <font size="4"><b>Print Date</b></font>
                                      </div>
                                      <div class="col-md-9">
                                        :&nbsp;&nbsp;<font size="3"><?php if ($data_list['print_dt'] == '0000-00-00 00:00:00') {echo "-";} else {echo $tgl_print." - ( ".$data_list['print_by']." ) "; } ?></font> 
                                      </div>
                                    </div>
                                  </li>
                                </ul>

                                <div class="row">
                                  <div class="col-md-12">
                                    <center>
                                      <a href='index.php?page=detail_qrcode&kode_serial_material=<?php echo $data_list['kode_serial_material'] ?>'>
                                        <button type="button" class="btn btn-primary" title="Detail & Gambar" >Selengkapnya</button>
                                      </a>
                                    </center>
                                  </div>
                                </div>
                            
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php    
                        }
                      }
                      ?>
                      </tbody>
                    </table>
                  </div><!-- COL 12 TABLE -->
                </div><!-- ROW TABLE -->

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>KETERANGAN WARNA</label><br>
                      <font color="black" size="3"><span class="badge bg-success">Q</span><font size="3" color="black">&nbsp;&nbsp;:&nbsp;&nbsp;Image QR Code Tersedia</font></font><br>
                      <font color="black" size="3"><span class="badge bg-danger">Q</span><font size="3" color="black">&nbsp;&nbsp;:&nbsp;&nbsp;Image QR Code Tidak Tersedia</font></font><br>
                      <font color="black" size="3"><span class="badge bg-success">B</span><font size="3" color="black">&nbsp;&nbsp;:&nbsp;&nbsp;Image Barcode Tersedia</font></font><br>
                      <font color="black" size="3"><span class="badge bg-danger">B</span><font size="3" color="black">&nbsp;&nbsp;:&nbsp;&nbsp;Image Barcode Tidak Tersedia</font></font><br>
                      <font color="black" size="3"><span class="badge bg-primary">P</span><font size="3" color="black">&nbsp;&nbsp;:&nbsp;&nbsp;Sudah Di Print</font></font><br>
                      <font color="black" size="3"><span class="badge bg-warning">P</span><font size="3" color="black">&nbsp;&nbsp;:&nbsp;&nbsp;Belum Di Print</font></font><br>

                    </div>
                  </div>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label>KETERANGAN LAINNYA</label><br>
                      <font color="red" size="2"><b>* Edit hanya bisa dilakukan jika QR/Barcode belum di print</b></font><br>
                      <font color="red" size="2"><b>* Setelah pencet tombol print maka data tidak bisa di edit kembali</b></font><br>
                      <font color="red" size="2"><b>* Input S/N Material (From) harus LEBIH BESAR dari S/N Material (To)</b></font><br>
                      <font color="red" size="2"><b>* Input S/N Material (To) harus LEBIH KECIL dari S/N Material (From)</b></font><br>
                      <font color="red" size="2"><b>* Untuk generate gambar QR & Barcode per baris klik Action > Detail > Selengkapnya</b></font>
                    </div>
                  </div>
                </div>

              </div><!-- CARD BODY -->
            </div><!-- CARD -->
          </div><!-- COL CARD BODY -->
        </div><!-- ROW CARD BODY -->
      </div><!-- CONTAIN FLUID -->
    </section>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> PT. Trafoindo Prima Perkasa.</strong> All rights reserved.
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

<script type="text/javascript">
function autofill(){
  var kode_material = $("#kode_material").val();
  $.ajax({
    url : 'autofill_edit.php', // file proses penginputan
    data : "kode_material="+kode_material,
  }).success(function (data){
    alert(kode_material);
      var json = data,
      obj = JSON.parse(json);

    $('#sn_mc_pln').val(obj.sn_mc_pln);
    $('#kategori').val(obj.kategori);
    $('#deskripsi').val(obj.deskripsi);
  })
}
</script>


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
    $('#tbl_qrcode_barcode').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      columnDefs: [{
          searchable: false,
          targets: [2,6]
        }],
      "order": [[ 3, "asc" ]],
        columnDefs: [{
          orderable: false,
          targets: "no-sort"
        }],
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
