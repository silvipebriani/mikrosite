<?php
$koneksi = mysqli_connect("localhost", "root", "", "mikrosite");
if (!$koneksi) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
