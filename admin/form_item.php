<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
function tema($kode)
{
    $sql = "SELECT * FROM akun WHERE usernames = '$kode'";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
        return $row['theme'];
    }
}
function colors($tema)
{
    if ($tema == "midnight") {
        return "putih";
    } else {
        return "hitam";
    }
}
function bahan()
{
    ?>
    <option value="">--Pilih Bahan--</option>
    <?php
        $sql = "SELECT * FROM komposisi";
        $res = mysql_query($sql);
        while ($row = mysql_fetch_assoc($res)) {
            ?>
        <option value="<?= $row['id_bahan'] ?>"><?= $row['Nama'] ?></option>
    <?php
        }
    }

    function kategori()
    {
        ?>
    <option value="">--Pilih Kategori--</option>
    <?php
        $sql = "SELECT * FROM kategori";
        $res = mysql_query($sql);
        while ($row = mysql_fetch_assoc($res)) {
            ?>
        <option value="<?= $row['id_kategori'] ?>"><?= $row['nama'] ?></option>
<?php
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
    .putih {
        color: white;
    }

    .hitam {
        color: black;
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
                    Item 
                    <small>Tulis Detail item untuk menghitung harga margin </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
                    <li class="active">Tulis Item</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">

                            </div>
                            <div class="box-body">
                                <form method="post" action="tulis_item.php">
                                    Nama Item : <input type="text" class="form-control <?= colors(call("theme")) ?>" name="menu">
                                    <hr>
                                    <div class="col-xs-2">
                                        <label>Harga Kulak</label>
                                        <input type="text" name="kulak" maxlength="" class="form-control <?= colors(call("theme")) ?>" placeholder="Harga Kulak">
                                    </div>
                                    <div class="col-xs-2">
                                        <label>Harga Jual</label>
                                        <input type="text" name="jual" maxlength="" class="form-control <?= colors(call("theme")) ?>" placeholder="Harga Jual">
                                    </div>

                                    <div class="col-xs-3">
                                        <label>Kategori:</label>
                                        <select name="kategori" class="form-control <?= colors(call("theme")) ?>"><?= kategori() ?></select>
                                    </div>
                                    <div class="col-xs-12">
                                        <br>
                                        <button type="submit" class="btn btn-success pull-right" name="tambah"><span class="fa fa-plus"></span> Item Baru</button>
                                    </div>
                                </form>
                            </div>

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
    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugin
s/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
</body>

</html>