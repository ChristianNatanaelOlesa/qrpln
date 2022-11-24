<?php 
  session_start();
 
  // cek apakah yang mengakses halaman ini sudah login
  if($_SESSION['username']==""){
    echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
  }

  $session_username   = $_SESSION['username'];
  $session_nama       = $_SESSION['nama'];
  $session_level      = $_SESSION['level'];
  $session_jabatan    = $_SESSION['jabatan'];

  include 'koneksi.php';

  $query_user     = $mysqli->query("SELECT * FROM login WHERE username = '$_POST[username]'");
  $data_user      = mysqli_fetch_array($query_user);
  $jmlh_data_user = mysqli_num_rows($query_user);
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
    <a href="dashboard.php" class="brand-link">
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
          <a href="#" class="d-block"><?php echo $_SESSION['nama']; ?></a>
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
                <a href="index.php?page=add_user" class="nav-link active">
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
  </div>
  <div class="sidebar-custom">
    <a href="logout.php"><button type="button" class="btn btn-block bg-gradient-danger">LOGOUT</button></a>
  </div>
</aside>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>MASTER USER</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
            <li class="breadcrumb-item active"><a href="index.php?page=add_user">Master User</a></li>
            <li class="breadcrumb-item active">Create, Update, Delete</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Create New User</h3>
          </div>

          <form class="form-horizontal" name="add_user" action="index.php?page=create_user" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Password</label>
                    <div class="input-group-append">
                      <input type="password" class="form-control" name="password" id="password1" placeholder="Password">
                    </div>
                    <input type="checkbox" id="checkbox_value"> Show Password
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control" name="jabatan" id="jabatan" required>
                      <option selected="selected" value="">- Pilih Jabatan -</option>
                      <?php
                      include "koneksi.php";
                      $sql=mysqli_query($mysqli,"select * from ms_jabatan where kode_jabatan != 'adm' order by id_jabatan asc");
                      while ($data = mysqli_fetch_array($sql)){
                        echo '<option name="jabatan" value="'.$data['kode_jabatan'].'">'.$data['nama_jabatan'].'</option>';
                      }?>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Level</label>
                    <select class="form-control" name="level" id="level" required>
                      <option selected="selected" value="">- Pilih Level -</option>
                      <?php
                      include "koneksi.php";
                      $sql=mysqli_query($mysqli,"select * from ms_level where level != 0 order by id_level asc");
                      while ($data = mysqli_fetch_array($sql)){
                        echo '<option name="level" value="'.$data['level'].'">'.$data['nama_level'].'</option>';
                      }?>
                    </select>
                  </div>
                </div>

              </div>

            <div class="card-footer">
              <button type="submit" name="submit_user" class="btn btn-primary">Submit</button>
            </div>
        </form>

      <br>

      <div class="row">
        <div class="col-md-12">
              <table id="tableuser" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th style="text-align: center;">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  include ("koneksi.php");

                  $sql=mysqli_query($mysqli,"select a.*, b.*, c.* FROM login a inner join ms_level b on a.level = b.level inner join ms_jabatan c on a.jabatan = c.kode_jabatan order by a.nama asc");

                  if(mysqli_num_rows($sql) == 0){
                    echo '<tr><td colspan="6" style="text-align: center">Tidak Ada Data.</td></tr>';
                  }else{
                    $no = 1;
                    while($row = mysqli_fetch_assoc($sql)){
                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td><?php echo $row['nama'] ?></td>
                  <td><?php echo strtolower($row['username']) ?></td>
                  <td><?php echo $row['nama_jabatan'] ?></td>
                  <td><?php echo $row['nama_level'] ?></td>
                  <td><?php if ($row['status'] == 0) {echo "Non Active";} else {echo "Active";}?></td>
                  <td style="text-align:center;">
                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg-<?php echo $row['id_user'] ?>">
                    <i class="fas fa-edit"></i></button>
                    
                    <a href="index.php?page=delete_user&id_user=<?php echo $row['id_user'] ?>" title="Hapus User" onclick="return confirm('Anda Yakin Ingin Delete User Ini ?')"><button type="button" class="btn btn-default"><i class="fas fa-trash">
                    </i></button></a>
                  </td>
                </tr>

                <div class="modal fade" id="modal-lg-<?php echo $row['id_user'] ?>">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form class="form-horizontal" name="form_edit_user" action="index.php?page=edit_user" onsubmit="return validateForm()" method="post" enctype="multipart/form-data">
                          <div class="card-body">
                            <div class="form-group" hidden>
                              <input type="number" class="form-control" name="id_user" placeholder="ID USER" value="<?php echo $row['id_user']; ?>" readonly>
                            </div>

                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Nama Lengkap</label>
                                  <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?php echo $row['nama']; ?>">
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $row['username']; ?>">
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Password</label>
                                  <div class="input-group-append">
                                  <input type="password" class="form-control" name="password1" id="password1" placeholder="Password">
                                  </div>
                                </div>
                              </div>

                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label>Confirm Password</label>
                                  <div class="input-group-append">
                                  <input type="password" class="form-control" name="password2" id="password2" placeholder="Password">
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Jabatan</label>
                                  <select class="form-control" name="jabatan" id="jabatan" style="width: 100%;">
                                    <option selected="selected" value="<?php echo $row['kode_jabatan']; ?>"><?php echo $row['nama_jabatan']; ?></option>
                                    <?php
                                    include "koneksi.php";
                                    $sql_edit_jabatan = mysqli_query($mysqli,"select * from ms_jabatan where kode_jabatan != '$row[kode_jabatan]' and kode_jabatan != 'adm' order by id_jabatan asc");
                                    while ($data_edit_jabatan = mysqli_fetch_array($sql_edit_jabatan)){
                                      echo '<option name="jabatan" value="'.$data_edit_jabatan['kode_jabatan'].'">'.$data_edit_jabatan['nama_jabatan'].'</option>';
                                    }?>
                                  </select>
                                </div>
                              </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Level</label>
                                  <select class="form-control" name="level" style="width: 100%;">
                                    <option selected="selected" value="<?php echo $row['level']; ?>"><?php echo $row['nama_level']; ?></option>
                                    <?php
                                    include "koneksi.php";
                                    $sql_edit_level = mysqli_query($mysqli,"select * from ms_level where level != $row[level] and level != 0 order by id_level asc");
                                    while ($data_edit_level = mysqli_fetch_array($sql_edit_level)){
                                      echo '<option name="level" value="'.$data_edit_level['level'].'">'.$data_edit_level['nama_level'].'</option>';
                                    }?>
                                  </select>
                                </div>
                              </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label>Status</label>
                                  <select class="form-control" name="status" style="width: 100%;">
                                    <option selected="selected" value="<?php echo $row['status']; ?>"><?php if ($row['status'] == 0) {echo "Non Active";} else if ($row['status'] == 1){echo "Active";}?></option>
                                      <?php if ($row['status'] == 0) { ?>
                                      <option value="1">Active</option>
                                      <?php } else { ?>
                                      <option value="0">Non Active</option>
                                      <?php } ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            
                          </div>

                          <div class="card-footer">
                            <button type="submit" name="simpan_user" class="btn btn-primary">Submit</button>
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
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>

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
    $('#tableuser').DataTable({
      "paging": true,
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
$(document).ready(function(){
    $('#checkbox_value').on('change', function(){
      var x = document.getElementById("password1");
      if(this.checked) {
        x.type = "text";
      }else{
        x.type = "password";
      }
    });
});
</script>



</body>
</html>
