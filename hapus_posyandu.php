<?php
session_start();
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM posyandu WHERE id=$id");
$_SESSION['check'] = "Data berhasil dihapus!";
header('location:posyandu.php');

