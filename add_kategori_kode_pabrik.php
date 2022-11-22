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

  include 'koneksi.php';

  $query_level = $mysqli->query("select max(level) as maxLevel FROM ms_level");
  $data_level = mysqli_fetch_array($query_level);
  $levelup = $data_level['maxLevel'] + 1;

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
                <a href="index.php?page=add_kategori_kode_pabrik" class="nav-link active">
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
            <h1>MASTER KATEGORI & SERIAL PLN</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active"><a href="index.php?page=add_kategori_kode_pabrik">Master Kategori & Serial PLN</a></li>
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
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Create New Kategori</h3>
              </div>

              <form class="form-horizontal" name="form_kategori" action="index.php?page=create_kategori" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" class="form-control" style="text-transform:capitalize" maxlength="50" name="kategori" placeholder="Nama Kategori" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" name="submit_kategori" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create New Kode Pabrikan</h3>
              </div>

              <form class="form-horizontal" name="form_kode_pabrik" action="index.php?page=create_kode_pabrik" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Kode Pabrikan</label>
                        <input type="text" class="form-control" minlength="5" maxlength="5" name="kode_pabrikan" placeholder="Kode Pabrikan" onkeypress="return hanyaAngka(event)" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" name="submit_kode_pabrik" class="btn btn-info">Submit</button>
                </div>
              </form>
            </div>
          </div>  
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <table id="table_kategori" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th style="text-align: center;">Kategori</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  include ("koneksi.php");

                  $sql=mysqli_query($mysqli,"select * FROM ms_kategori order by id_kategori asc");

                  if(mysqli_num_rows($sql) == 0){
                    echo '<tr><td colspan="3" style="text-align: center">Tidak Ada Data.</td></tr>';
                  }else{
                    while($row = mysqli_fetch_assoc($sql)){
                ?>

                <tr>
                  <td style="text-align: center;"><?php echo $row['kategori'] ?></td>
                  <td style="text-align: center;"><?php if ($row['status'] == 0) {echo "Non Active";} else {echo "Active";}?></td>
                  <td style="text-align:center;">
                    <?php if ($row['status'] == 0) { ?>
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-md-kategori-<?php echo $row['id_kategori'] ?>">
                        <i class="fas fa-edit"></i>
                      </button>
                      
                      <a href="index.php?page=delete_kategori&id_kategori=<?php echo $row['id_kategori'] ?>" title="Hapus kategori " onclick="return confirm('Anda Yakin Ingin Delete Kategori ( <?php echo $row['kategori'] ?> ) ?')">
                        <button type="button" class="btn btn-default"><i class="fas fa-trash"></i></button>
                      </a>
                    <?php } else {} ?>
                  </td>
                </tr>

                <div class="modal fade" id="modal-md-kategori-<?php echo $row['id_kategori'] ?>">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" name="edit_kategori" action="index.php?page=edit_kategori" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                            <div class="form-group" hidden>
                              <input type="number" class="form-control" name="id_kategori" placeholder="ID KATEGORI" value="<?php echo $row['id_kategori']; ?>" readonly>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label>Kategori</label>
                                  <input type="text" class="form-control" name="kategori" style="text-transform: capitalize" placeholder="Kategori Material" value="<?php echo $row['kategori']; ?>" required>
                                </div>
                              </div>
                            </div>   
                          </div>

                          <div class="card-footer">
                            <button type="submit" name="simpan_kategori" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
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
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <table id="table_kode_pabrikan" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="text-align: center;">Kode Pabrikan</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Action</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                  include ("koneksi.php");

                  $sql=mysqli_query($mysqli,"select * FROM ms_kode_pabrik order by id_kode_pabrik asc");

                  if(mysqli_num_rows($sql) == 0){
                    echo '<tr><td colspan="3" style="text-align: center">Tidak Ada Data.</td></tr>';
                  }else{
                    while($row = mysqli_fetch_assoc($sql)){
                    ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $row['kode_pabrikan'] ?></td>
                      <td style="text-align: center;"><?php if ($row['status'] == 0) {echo "Non Active";} else {echo "Active";}?></td> 
                      <td style="text-align:center;">
                        <?php if ($row['status'] == 0) { ?>
                          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-md-kode_pabrikan-<?php echo $row['id_kode_pabrik'] ?>">
                            <i class="fas fa-edit"></i>
                          </button>
                          
                          <a href="index.php?page=delete_kode_pabrik&id_kode_pabrik=<?php echo $row['id_kode_pabrik'] ?>" title="Hapus Kode Pabrikan" onclick="return confirm('Anda Yakin Ingin Delete Kode Serial ( <?php echo $row['kode_pabrikan'] ?> ) ?')">
                            <button type="button" class="btn btn-default"><i class="fas fa-trash"></i></button>
                          </a>
                        <?php } else {} ?>
                        
                      </td>
                  </tr>

                  <div class="modal fade" id="modal-md-kode_pabrikan-<?php echo $row['id_kode_pabrik'] ?>">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Kode Pabrikan</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" name="edit_kode_pabrikan" action="index.php?page=edit_kode_pabrik" method="post" enctype="multipart/form-data">
                              <div class="card-body">
                                <div class="form-group" hidden>
                                  <input type="number" class="form-control" name="id_kode_pabrik" placeholder="ID SERIAL PLN" value="<?php echo $row['id_kode_pabrik']; ?>" readonly>
                                </div>

                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                      <label>Kode Pabrikan</label>
                                      <input type="text" class="form-control" name="kode_pabrikan" style="text-transform: uppercase;" minlength="5" maxlength="5" placeholder="Kode Pabrikan" value="<?php echo $row['kode_pabrikan']; ?>" required>
                                    </div>
                                  </div>
                                </div>   
                              </div>

                              <div class="card-footer">
                                <button type="submit" name="simpan_kode_pabrikan" class="btn btn-primary">Submit</button>
                              </div>
                          </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <?php   
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
    $('#table_jabatan').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
  $(function () {
    $('#table_level').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
