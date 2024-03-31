<?php
	require_once('session.php');
	$postID = $_GET['postID'];
	$jenisnya = $_GET['jenis'];
	if($jenisnya == 1){
		$delete = mysqli_query($conn,"DELETE FROM `tb_produk` WHERE jenis  = '$postID'") or die(mysqli_error($conn));
	}
	else if($jenisnya == 2){
		$delete = mysqli_query($conn,"DELETE FROM `tb_prepaid` WHERE jenis  = '$postID'") or die(mysqli_error($conn));
	}
	else if($jenisnya == 3){
		$delete = mysqli_query($conn,"DELETE FROM `tb_produk_social` WHERE jenis  = '$postID'") or die(mysqli_error($conn));
	}
    
    header('location:../service/?notif=2');
?>