<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "db_buku_tamu_php";

$koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));
