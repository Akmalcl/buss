<?php
	require_once('session.php');
	$id = $_GET['postID'];
	$status = $_GET['status'];
	if($status == 0){
		$statusnya = 1;
	}
	else if($status == 1) {
		$statusnya = 0;
	}
    $query = mysqli_query($conn,"UPDATE `tb_jenis` SET status = '$statusnya' WHERE id = '$id'") or die(mysqli_error());
    header('location:../jenis/');
?>