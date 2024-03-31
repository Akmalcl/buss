<?php
	require_once('session.php');

    $users = $u['user'];
    $provider = $_POST['provider'];
    $apikey = $_POST['apikey'];
    $privateKey = $_POST['private_key'];
    $merchant_code = $_POST['merchant_code'];
    $status = $_POST['status'];
    $join_date = date('Y-m-d');
    $query = mysqli_query($conn,"UPDATE `tb_tripayapi` SET `api_key` = '$apikey', `private_key` = '$privateKey', `merchant_code` = '$merchant_code', `status` = '$status' WHERE id = '$provider'") or die(mysqli_error());
    $update = mysqli_query($conn,"UPDATE `tb_tripayapi` SET status = 0 WHERE jenis = 0  AND id != '$provider'") or die(mysqli_error());

    header('location:../payment_gateway/?notif=1');
    
?>