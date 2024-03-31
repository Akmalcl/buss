<?php
ob_start();
session_start();
include('config/koneksi.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$status = 1;
    $ipaddress = $_POST['ipaddress'];
    $update = mysqli_query($conn,"UPDATE `tb_popup` SET status = 1 WHERE ip = '$ipaddress'") or die(mysqli_error());
?>