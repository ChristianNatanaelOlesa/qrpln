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
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
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

  <script src="assets/link/kit.fontawesome.js"></script>
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
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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
                <a href="index.php?page=add_katalog" class="nav-link active">
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
            <a href="index.php?page=list_qrcode" class="nav-link">
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>MASTER KATALOG MATERIAL</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active"><a href="index.php?page=add_katalog">Master Katalog</a></li>
              <li class="breadcrumb-item active">Create, Update, Delete</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    	<div class="container-fluid">

        <div class="row">
        	<div class="col-md-12">
            <div class="card card-primary">
            	<div class="card-header">
              	<h3 class="card-title">Create New Katalog</h3>
            	</div>

            	<form class="form-horizontal" name="form_katalog" action="index.php?page=create_katalog" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Kode Material</label>
                        <input type="text" class="form-control" minlength="5" maxlength="5" name="kode_material" placeholder="Kode Material" required>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label>No Material</label>
                        <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" minlength="7" maxlength="7" name="no_material" placeholder="No Material" required>
                      </div>
                    </div>

                    <div class="col-md-3">
                    	<div class="form-group">
  	                    <label>Kategori</label>
  	                    <select class="form-control select2" name="kategori" id="kategori" required>
                          <?php
                          include "koneksi.php";
                          $sql = mysqli_query($mysqli,"select * from ms_kategori order by id_kategori asc");
                          while ($data = mysqli_fetch_array($sql)){
                            echo '<option name="kategori" value="'.$data['kategori'].'">'.$data['kategori'].'</option>';
                          }?>
                        </select>
                    	</div>
                    </div>
                    
                    <div class="col-md-5">
                      <div class="form-group">
                        <label>Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" placeholder="Deskripsi" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" name="submit_katalog" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
        	</div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="table_katalog" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th style="text-align: center;">No. </th>
                    <th style="text-align: center;">Kode Material</th>
                    <th style="text-align: center;">SN MC PLN</th>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Deskripsi</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  include ("koneksi.php");

                  $sql=mysqli_query($mysqli,"select * FROM ms_katalog order by kode_material asc");

                  if(mysqli_num_rows($sql) == 0){
                    echo '<tr><td colspan="6" style="text-align: center">Tidak Ada Data.</td></tr>';
                  }else{
                    $no = 1;
                    while($row = mysqli_fetch_assoc($sql)){
                ?>

                <tr>
                  <td style="text-align: center;"><?php echo $no; ?></td>
                  <td style="text-align: center;"><?php echo $row['kode_material'] ?></td>
                  <td style="text-align: center;"><?php echo $row['sn_mc_pln'] ?></td>
                  <td style="text-align: center;"><?php echo $row['kategori'] ?></td>
                  <td style="text-align: center;"><?php echo $row['deskripsi'] ?></td>
                  <td style="text-align: center;"><?php if ($row['status'] == 0) {echo "Non Active";} else {echo "Active";}?></td>
                  <td style="text-align:center;">

                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        </button>
                        <div class="dropdown-menu">

                          <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modal-lg-detail-<?php echo $row['id_katalog'] ?>">
                            Detail Katalog
                          </button>

                          <?php if ($row['status'] == 0) { ?>

                            <button type="button" class="btn dropdown-item" data-toggle="modal" data-target="#modal-lg-edit-<?php echo $row['kode_material'] ?>">
                            Edit Katalog
                            </button>

                            <?php if ($session_level == 0) { ?>
                              <a href="index.php?page=delete_katalog&id_katalog=<?php echo $row['id_katalog'] ?>" title="Hapus Katalog" onclick="return confirm('Anda Yakin Ingin Delete Katalog Ini ?')">
                              <button type="button" class="btn dropdown-item">Delete Katalog</button>
                              </a>
                            <?php } else {} ?>

                          <?php } else {} ?>

                          
                          
                        </div>
                      </div>

                  </td>
                </tr>

                <div class="modal fade" id="modal-lg-detail-<?php echo $row['id_katalog'] ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Detail Katalog</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-3">
                             <font size="4"><b>Kode Material</b></font> 
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['kode_material']; ?></font> 
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-3">
                              <font size="4"><b>No Material</b></font>
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['no_material']; ?></font> 
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-3">
                              <font size="4"><b>Material Group</b></font>
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['material_group']; ?></font>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-3">
                              <font size="4"><b>ID Material</b></font>
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['id_material']; ?></font>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-3">
                              <font size="4"><b>SN MC PLN</b></font> 
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['sn_mc_pln']; ?></font> 
                            </div>
                          </div>                          

                          <div class="row">
                            <div class="col-md-3">
                              <font size="4"><b>Kategori</b></font>
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['kategori']; ?></font>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-3">
                              <font size="4"><b>Deskripsi</b></font>
                            </div>
                            <div class="col-md-9">
                              :&nbsp;&nbsp;<font size="4"><?php echo $row['deskripsi']; ?></font>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="modal-lg-edit-<?php echo $row['kode_material'] ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Katalog</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" name="form_edit_katalog" action="index.php?page=edit_katalog" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                            <div class="row" hidden>
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>ID KATALOG</label>
                                  <input type="text" class="form-control" name="id_katalog" placeholder="ID KATALOG" value="<?php echo $row['id_katalog'] ?>" readonly>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Kode Material</label>
                                  <input type="text" class="form-control" minlength="5" maxlength="5" name="kode_material" placeholder="Kode Material" value="<?php echo $row['kode_material'] ?>" required>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>No Material</label>
                                  <input type="text" class="form-control" minlength="7" maxlength="7" name="no_material" value="<?php echo $row['no_material'] ?>" placeholder="No Material" required>
                                </div>
                              </div>

                              <div class="col-md-4">
                                <div class="form-group">
                                  <label>Kategori</label>
                                  <select class="form-control select2" name="kategori" id="kategori" required>
                                    <option selected="selected" value="<?php echo $row['kategori'] ?>"><?php echo $row['kategori'] ?></option>
                                    <?php
                                    include "koneksi.php";
                                    $sql_edit_katalog = mysqli_query($mysqli,"select * from ms_kategori kategori != '$row[kategori]' order by id_kategori asc");
                                    while ($data_edit_katalog = mysqli_fetch_array($sql_edit_katalog )){
                                      echo '<option name="kategori" value="'.$data_edit_katalog['kategori'].'">'.$data_edit_katalog['kategori'].'</option>';
                                    }?>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <label>Deskripsi</label>
                                  <input type="text" class="form-control" name="deskripsi" value="<?php echo $row['deskripsi'] ?>" placeholder="Deskripsi" required>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="card-footer">
                            <button type="submit" name="simpan_katalog" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                
                <?php
                  $no++;
                    }
                  }
                ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>

	    </div>
    </section>
    <!-- /.content -->
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
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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


<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>

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
    $('#table_katalog').DataTable({
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

</body>
</html>
