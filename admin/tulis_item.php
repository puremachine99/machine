<?php
include "koneksi.php";
$e = 0;


function bulat($angka)
{
    $x = ceil($angka / 1000);
    return $x;
}
function total(){
    $pokok = $_POST['pokok'];
    $menu = $_POST['menu'];
    $jual = $_POST['jual'];
    $kategori = $_POST['kategori'];
    $produksi = 0;
    $resep = "";
    $SQL = "INSERT INTO menu VALUES('','$menu','$kategori','$jual','$pokok','')";
    mysql_query($SQL);
}
total();
header("location:form_item.php");
?>