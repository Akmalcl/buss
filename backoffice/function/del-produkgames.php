<?php
	require_once('session.php');
	$id = $_GET['id'];
    $query = mysqli_query($conn,"UPDATE `tb_produk` SET status = 0 WHERE id = '$id'") or die(mysqli_error());
    header('location:../product_apigames/');
?>