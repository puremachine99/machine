<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION['status'])) {
    header("location:index.php");
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include "koneksi.php";
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = '$id'");
}
function tema($kode)
{
    $sql = "SELECT * FROM akun WHERE usernames = '$kode'";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        return $row['theme'];
    }
}
function resep($kode)
{
    $sql = "SELECT * FROM komposisi WHERE id_bahan = '$kode'";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        return $row['Nama'] . "|" . $row['Satuan'];
    }
}
function kat($kode)
{
    $sql = "SELECT * FROM kategori WHERE id_kategori = '$kode'";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        return $row['nama'];
    }
}
function menu()
{
    $sql = "SELECT * FROM kategori";
    require "koneksi.php";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
            <td><?= $row['id_kategori'] ?></td>
            <td><?= $row['nama'] ?></td>
            <td width="2" align="right">
                <a href="form_kategori.php?id=<?= $row['id_kategori'] ?>&nama=<?= $row['nama'] ?>" class="btn btn-info btn-xs btn-block"><span class="fa fa-pencil"></span> Edit</a>
                <a href="list_kategori.php?id=<?= $row['id_kategori'] ?>" class="btn btn-danger btn-xs btn-block"><span class="fa fa-trash"></span> Hapus</a>
            </td>
        </tr>
<?php
    }
}

require "panel_navigasi.php";
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            List Menu
            <small>Daftar Menu yang sudah anda miliki beserta detail harga</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu</a></li>
            <li class="active">List Menu</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">

                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php menu() ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                </tr>
                            </tfoot>
                        </table>
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