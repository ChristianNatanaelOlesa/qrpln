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

  <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
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
            <a href="index.php?page=add_trx" class="nav-link active">
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
            <h1>Form Create New QR & Barcode</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?page=dashboard">Home</a></li>
              <li class="breadcrumb-item active">Form Create New QR & Barcode</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="card">
        <div class="card-body">
          <form class="form-horizontal" name="form_add_trx" action="index.php?page=create_trx" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label>Kode Material</label><font color="red" size="4" title="Required">*</font>
                  <select class="form-control select2bs4" style="width:100%; height: 100%;" onchange="autofill()" name="kode_material" id="kode_material" required>
                    <option selected="selected" value="">- Pilih Kode -</option>
                    <?php
                    include "koneksi.php";
                    $sql=mysqli_query($mysqli,"select * from ms_katalog order by kode_material asc");
                    while ($data = mysqli_fetch_array($sql)){
                      echo '<option name="kode_material" value="'.$data['kode_material'].'">'.$data['kode_material'].'</option>';
                    }?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label>SN MC PLN</label>
                  <input class="form-control" type="text" name="sn_mc_pln" id="sn_mc_pln" placeholder="SN MC PLN">
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Kategori Material</label>
                  <input class="form-control" type="text" name="kategori" id="kategori" placeholder="Kategori Material">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Deskripsi Material</label>
                  <input class="form-control" type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi Material">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label title="Di input oleh pabrikan!!">Kode Pabrikan</label>
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
                  <select class="form-control" name="tahun_produksi" id="tahun_produksi">
                    <?php foreach($years as $year) : ?>
                      <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label title="Di input oleh pabrikan!!">Batch Produksi</label><font color="red" size="4" title="Required">*</font>
                  <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" minlength="2" maxlength="2" name="batch_produksi" id="batch_produksi" placeholder="00" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label title="Di input oleh pabrikan!!">S/N Material (From)</label><font color="red" size="4" title="Required">*</font>
                  <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" minlength="5" maxlength="5" name="sn_material_from" id="sn_material_from" placeholder="00000" required>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label title="Di input oleh pabrikan!!">S/N Material (To)</label><font color="red" size="3" title="Di input oleh pabrikan!!">*</font>
                  <input class="form-control" type="text" onkeypress="return hanyaAngka(event)" minlength="5" maxlength="5" name="sn_material_to" id="sn_material_to" placeholder="00000" required>
                </div>
              </div>
              
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>KETERANGAN</label><br>
                  <font color="red" size="4"><b>* Batch Produksi tidak boleh 1 digit (Cth : jika input 1 maka harus diisi 01)</b></font><br>
                  <font color="red" size="4"><b>* S/N Material (From/To) tidak boleh kurang dari 5 digit</b></font><br>
                  <font color="red" size="4"><b>* Input S/N Material (From) harus LEBIH BESAR dari S/N Material (To)<br>
                  <font color="red" size="4"><b>* Input S/N Material (To) harus LEBIH KECIL dari S/N Material (From)</b></font>
                </div>
              </div>
            </div>
            <br>

            <center>
                <div class="col-sm-12">
                <button type="submit" name="submit_qrcode" class="btn btn-primary" >Submit</button>
                
              </div></center>
          </form>          
        </div>
      </div>
    </section>

  </div>

<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2022 PT.Trafoindo Prima Perkasa.</strong> All rights reserved.
</footer>
</div>

<!-- jQuery -->
<script src="assets/link/jquery.min-1.12.4.js"></script>
<script src="assets/link/cloudflare.js"></script>


<script src="assets/dist/js/jquery.maskedinput.js" type="text/javascript"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="assets/plugins/select2/js/select2.full.min.js"></script>
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

<script>
$(document).ready(function(){

  $("#kode_pabrikan").attr("disabled","disabled");
  $("#tahun_produksi").attr("disabled","disabled");
  $("#batch_produksi").attr("disabled","disabled");
  $("#sn_material_from").attr("disabled","disabled");
  $("#sn_material_to").attr("disabled","disabled");

  $("#sn_mc_pln").attr("readonly","readonly");
  $("#kategori").attr("readonly","readonly");
  $("#deskripsi").attr("readonly","readonly");
    
  $('#kode_material').on('change', function(){
    
    var kode_material = $(this).val(); 
    if (kode_material != ''){
      $("#kode_pabrikan").removeAttr("disabled");
      $("#tahun_produksi").removeAttr("disabled");
      $("#batch_produksi").removeAttr("disabled");
      $("#sn_material_from").removeAttr("disabled");
      $("#sn_material_to").removeAttr("disabled");


    } else {

      document.getElementById('kode_pabrikan').value = "";
      document.getElementById('tahun_produksi').value = "";
      document.getElementById('batch_produksi').value = "";
      document.getElementById('sn_material_from').value = "";
      document.getElementById('sn_material_to').value = "";

      $("#kode_pabrikan").attr("disabled","disabled");
      $("#tahun_produksi").attr("disabled","disabled");
      $("#batch_produksi").attr("disabled","disabled");
      $("#sn_material_from").attr("disabled","disabled");
      $("#sn_material_to").attr("disabled","disabled");
    }

  })
});
</script>

</body>
</html>
