<?php
	require_once('session.php');
	$id = $_GET['id'];
    $query = mysqli_query($conn,"DELETE FROM `tb_order` WHERE kd_transaksi = '$id'") or die(mysqli_error());
    $query = mysqli_query($conn,"DELETE FROM `tb_tripay` WHERE merchant_ref = '$id'") or die(mysqli_error());
    header('location:../order/');
?>