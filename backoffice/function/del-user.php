<?php
	require_once('session.php');
	$id = $_GET['id'];
	$tipenya = $_GET['tipe'];
    $query = mysqli_query($conn,"DELETE FROM `tb_user` WHERE id = '$id'") or die(mysqli_error());
    if($tipenya == 1){
    	header('location:../member/');
    }
    else if($tipenya == 2){
        header('location:../user/');
    }
    else if($tipenya == 3){
    	header('location:../reseller/');
    }
    
?>