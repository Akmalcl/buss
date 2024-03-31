<?php
	require_once('session.php');
	$id = $_GET['id'];
    $query = mysqli_query($conn,"DELETE FROM `tb_page` WHERE id = '$id'") or die(mysqli_error());
    header('location:../page/');
    
?>