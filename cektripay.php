<?php
ob_start();
session_start();
include('config/koneksi.php');

$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$tripayApi = $s5['api_key'];

$curls = curl_init();
                               
curl_setopt_array($curls, array(
    CURLOPT_FRESH_CONNECT     => true,
    CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
    CURLOPT_RETURNTRANSFER    => true,
    CURLOPT_HEADER            => false,
    CURLOPT_HTTPHEADER        => array(
        "Authorization: Bearer ".$tripayApi
    ),
    CURLOPT_FAILONERROR       => false
));
                                  
$responses = curl_exec($curls);
$errs = curl_error($curls);
curl_close($curls);
echo !empty($err) ? $err : $responses;
?>