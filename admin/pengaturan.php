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
function temaaktif($kode){
    if($kode == call("theme")){
        return "selected";
    }
}
function jenisaktif($kode){
    if($kode == call("Jenis")){
        return "selected";
    }
}
if (isset($_POST['stem'])) {
    $a = $_POST['tema'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET theme='$a' WHERE usernames = '$b'");
} else if (isset($_POST['spass'])) {
    $a = $_POST['passwords'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET passwords='$a' WHERE usernames = '$b'");
} else if (isset($_POST['snama'])) {
    $a = $_POST['Nama'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET Nama_kafe='$a' WHERE usernames = '$b'");
} else if (isset($_POST['salam'])) {
    $a = $_POST['alamat'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET alamat='$a' WHERE usernames = '$b'");
} else if (isset($_POST['skont'])) {
    $a = $_POST['kontak'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET kontak='$a' WHERE usernames = '$b'");
} else if (isset($_POST['semail'])) {
    $a = $_POST['email'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET email='$a' WHERE usernames = '$b'");
} else if (isset($_POST['sinst'])) {
    $a = $_POST['instagram'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET instagram='$a' WHERE usernames = '$b'");
}else if (isset($_POST['sjen'])) {
    $a = $_POST['jenis'];
    $b = $_SESSION['status'];
    mysql_query("UPDATE akun SET Jenis='$a' WHERE usernames = '$b'");
}

function colors($tema)
{
    if ($tema == "midnight") {
        return "putih";
    } else {
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
                    Pengaturan
                    <small>Kustomisasi</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                    <li class="active">Pengaturan</li>
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
                                <div class="col-xs-8">

                                    <table class="table">
                                        <tr>
                                            <td>
                                                <h5>Username</h5>
                                            </td>
                                            <td colspan="2">
                                                <h5> <?= call("usernames") ?></h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Password</h5>
                                            </td>
                                            <td width="50%">
                                                <form action="pengaturan.php" method="post">
                                                    <div class="input-group input-group-sm">
                                                        <input type="password" name="passwords" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("passwords") ?>">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="spass" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <h5>Tema</h5>
                                            </td>
                                            
                                            <td>
                                                <form action="pengaturan.php" method="post">
                                                    <div class="input-group input-group-sm">
                                                        <select name="tema" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("theme") ?>">
                                                            <option value="blue" <?=temaaktif("blue")?>>Blue</option>
                                                            <option value="red" <?=temaaktif("red")?>>Red</option>
                                                            <option value="yellow" <?=temaaktif("yellow")?>>Yellow</option>
                                                            <option value="green" <?=temaaktif("green")?>>Green</option>
                                                            <option value="purple" <?=temaaktif("purple")?>>Purple</option>
                                                            <option value="midnight" <?=temaaktif("midnight")?>>Midnight</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="stem" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Nama Cafe </h5>
                                            </td>
                                            
                                            <td width="50%">
                                                <form action="pengaturan.php" method="post">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="Nama" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("Nama_kafe") ?>">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="snama" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Alamat </h5>
                                            </td>
                                            <td width="50%">
                                                <form action="pengaturan.php" method="post">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="alamat" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("alamat") ?>">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="salam" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Kontak </h5>
                                            </td>
                                            <td width="50%">
                                                <form action="pengaturan.php" method="post">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="kontak" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("kontak") ?>">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="skont" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Email </h5>
                                            </td>

                                            <td width="50%">
                                                <form action="pengaturan.php" method="post">

                                                    <div class="input-group input-group-sm">
                                                        <input type="email" name="email" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("email") ?>">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="semail" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Instagram </h5>
                                            </td>

                                            <td width="50%">
                                                <form action="pengaturan.php" method="post">

                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="instagram" class="form-control <?= colors(call("theme")) ?>" placeholder="<?= call("instagram") ?>">
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="sinst" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5>Jenis Aplikasi</h5>
                                            </td>
                                            
                                            <td>
                                                <form action="pengaturan.php" method="post">
                                                    <div class="input-group input-group-sm">
                                                        <select name="jenis" class="form-control <?= colors(call("theme")) ?>">
                                                            <option value="0" <?=jenisaktif("0")?>>Kafe, Kedai, Resto, Warung</option>
                                                            <option value="1" <?=jenisaktif("1")?>>Toko</option>
                                                        </select>
                                                        <span class="input-group-btn">
                                                            <button type="submit" name="sjen" class="btn btn-info"><span class="fa fa-check"></span> Simpan</button>
                                                        </span>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
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