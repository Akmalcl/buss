<?php
	require_once('session.php');
	$id = $_POST['postID'];
	$note = $_POST['catatan'];
	$update = mysqli_query($conn,"UPDATE `tb_order` SET `note` = '$note', `status` = 2 WHERE `id` = '$id'") or die(mysqli_error($conn));
    header('location:../order/');
?>