<?php
	require_once('session.php');
	$id = $_GET['postID'];
	$status = $_GET['status'];
	$tipenya = $_GET['tipe'];
	if($status == 0){
		$statusnya = 1;
	}
	else if($status == 1){
		$statusnya = 0;
	}
    $query = mysqli_query($conn,"UPDATE `tb_user` SET status = '$statusnya' WHERE id = '$id'") or die(mysqli_error());
    if($tipenya == 1){
    	header('location:../member/');
    }
    else if($tipenya == 2){
    	header('location:../user/');
    }
    else {
    	header('location:../reseller/');
    }
?>