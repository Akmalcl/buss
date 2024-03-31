<?php
	require_once('session.php');
	$id = $_GET['postID'];
    $query = mysqli_query($conn,"UPDATE `tb_user` SET level = 'reseller' WHERE id = '$id'") or die(mysqli_error());
    header('location:../reseller/');
?>