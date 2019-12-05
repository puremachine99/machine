<style>
  .rusak {
    cursor: not-allowed;
  }
</style>
<header class="main-header">
  <!-- Logo -->
  <?php
  function hehe($kode)
  {
    $x = $_SESSION['status'];
    include "koneksi.php";
    $sql = "SELECT $kode FROM akun where usernames='$x'";
    $res = mysql_query($sql);
    while ($row = mysql_fetch_assoc($res)) {
      return $row[$kode];
    }
  }
  function tipe($kode)
  {
    if (hehe("Jenis") == 0) {
      ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cutlery text-aqua"></i>
          <span>Menu</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="form_menu.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Resep Baru"><i class="fa fa-plus"></i> Buat Menu</a></li>
          <li><a href="list_menu.php" data-placement="right" data-toggle="tooltip" data-original-title="Resep Kamu"><i class="fa fa-table"></i> List Menu</a></li>
          <li><a href="form_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Kategori Baru"><i class="fa fa-bookmark"></i> Tambah Kategori</a></li>
          <li><a href="list_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Kategori"><i class="fa fa-table"></i> List Kategori</a></li>
        <?php
          } else {
            ?>
          <li class="treeview">
            <a href="#">
              <i class="glyphicon glyphicon-cd text-aqua"></i>
              <span>Item</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="form_item.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Resep Baru"><i class="fa fa-plus"></i> Item Baru</a></li>
              <li><a href="list_item.php" data-placement="right" data-toggle="tooltip" data-original-title="Resep Kamu"><i class="fa fa-table"></i> List Item</a></li>
              <li><a href="form_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Buat Kategori Baru"><i class="fa fa-bookmark"></i> Tambah Kategori</a></li>
              <li><a href="list_kategori.php" data-placement="right" data-toggle="tooltip" data-original-title="Kategori"><i class="fa fa-table"></i> List Kategori</a></li>
          <?php
            }
          }
          ?>
          <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">K<b>SM</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?= hehe("Nama_kafe") ?></span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
              <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li>
                  <a href="logout.php"><i class="fa fa-power-off"></i></a>
                </li>
              </ul>
            </div>
          </nav>
</header>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <ul class="sidebar-menu">
      <li class="header">&nbsp;</li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dollar text-green"></i>
          <span>Cashier</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="kasir.php" data-placement="right" data-toggle="tooltip" data-original-title="Mulai Jualan"><i class="fa fa-tags"></i> Buka</a></li>
          <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-sticky-note-o"></i> Nota</a></li>
          <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-power-off"></i> Tutup</a></li>

        </ul>
      </li>

      <?= tipe(hehe("Jenis")) ?>
    </ul>
    </li>
    <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-shopping-cart text-yellow"></i> <span>Pengeluaran</span></a></li>
    <li><a href="#" class="rusak" data-placement="right" data-toggle="tooltip" data-original-title="Dalam Proses"><i class="fa fa-suitcase text-red"></i> <span>Keuangan</span></a></li>
    <li><a href="pengaturan.php"><i class="fa fa-gear"></i> <span>Pengaturan</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>