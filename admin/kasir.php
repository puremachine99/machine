<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysql_query("DELETE FROM menu WHERE Id_menu = '$id'");
}
function tema($kode)
{
    $sql = "SELECT * FROM akun WHERE usernames = '$kode'";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        return $row['theme'];
    }
}
function call($field)
{
    $kode = $_SESSION['status'];
    $sql = "SELECT $field FROM akun WHERE usernames = '$kode'";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        return $row[$field];
    }
}
function list_menu()
{
    $sql = "SELECT * FROM menu ORDER BY id_kategori";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        ?>
        <div class="col-xs-2">
            <div class="box box-info">
                <div class="box-body">
                <h4><?= ucfirst($row['Nama']) ?></h4>
                    <!--<img src="#">-->
                    <input type="hidden" name="id_menu[]" value="<?= ($row['Id_menu']) ?>">
                    <input type="hidden" name="harga[]" value="<?= ($row['Harga']) ?>">
                    <input type="hidden" name="pokok[]" value="<?= ($row['Pokok']) ?>">
                    <input type="hidden" name="nama[]" value="<?= ($row['Nama']) ?>">
                    <h5 class="text-green"><?= number_format($row['Harga'], 2, ',', '.') ?></h5>
                    <div class="col-xs-10">
                        <input type="number" name="qty[]" min="0" max="99" maxlength="2" class="form-control <?=colors(call("theme"))?>" >
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
function colors($tema){
    if($tema == "midnight"){
      return "putih";
    }else{
      return "hitam";
    }
  }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SudiMampir | Admin</title>

    <link rel="shortcut icon" href="../assets/ico.png">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../dist/css/skins/skin-midnight.css">

    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>
    .putih{
        color: white;
    }
    .hitam{
        color: black ;
    }
</style>
<body class="hold-transition skin-<?= tema($_SESSION['status']) ?> sidebar-mini">
    <div class="wrapper">
        
        <!-- Left side column. contains the logo and sidebar -->
        <?php
        require "panel_navigasi.php";
        ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Cashier
                    <small>v 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#" height="100px"><i class="fa fa-dashboard"></i> Kasir</a></li>
                    <li class="active">Buka</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <form action="bayar.php" method="post">
                                <div class="box-header">
                                    <button type="submit" name="subtotal" class="btn btn-info"><span class="fa fa-money"> </span> Bayar</button>
                                </div>
                                <div class="box-body">
                                    <?= list_menu() ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

        </div>
        <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>

    <div class="tampil-data"></div>
    <!-- jQuery 2.2.3 -->
    <!-- jQuery 2.2.3 -->

    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
</body>

</html>