<?php
	require_once('session.php');
	$id = $_GET['id'];
	$abc = $_GET['abc'];
	if($abc == 1 || $abc == 2){
		$query = mysqli_query($conn,"DELETE FROM `tb_produk` WHERE id = '$id'") or die(mysqli_error());
	}
	else {
		$query = mysqli_query($conn,"DELETE FROM `tb_prepaid` WHERE id = '$id'") or die(mysqli_error());
	}
    
    header('location:../product_manual/');
?>