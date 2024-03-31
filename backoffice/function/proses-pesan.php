<?php
	require_once('session.php');
	$id = $_GET['postID'];
    $query = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE id = '$id'") or die(mysqli_error());
    header('location:../order/');
?>