<?php
	require_once('session.php');

    $users = $u['user'];
    $apikey = $_POST['apikey'];
    $private_key = $_POST['private_key'];
    $status = $_POST['status'];
    $join_date = date('Y-m-d');
    $query = mysqli_query($conn,"UPDATE `tb_tripayapi` SET `api_key` = '$apikey', `private_key` = '$private_key', `status` = '$status' WHERE id = 7") or die(mysqli_error());
    header('location:../cekmutasi/?notif=1');
?>