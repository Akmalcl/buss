<?php
	require_once('session.php');

    $users = $u['user'];
    $apikey = $_POST['apikey'];
    $status = $_POST['status'];
    $join_date = date('Y-m-d');
    $query = mysqli_query($conn,"UPDATE `tb_tripayapi` SET `api_key` = '$apikey', `status` = '$status' WHERE id = 8") or die(mysqli_error());
    header('location:../whatsapp/?notif=1');
?>