<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Jakarta");
include('config/koneksi.php');

$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];

$sql_1 = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = 1") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1);

if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
  header('location:'.$urlwebs.'/login/');
  exit;
}

$user =mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '".$_SESSION['user']."'") or die (mysqli_error());
$u = mysqli_fetch_array($user);
$users = $u['user'];
$id_user = $u['id'];
$userID = $u['id'];
$token_id = isset($u['token_id']) ? $u['token_id'] : false;
$level = isset($u['level']) ? $u['level'] : false;

$sql_3 = mysqli_query($conn,"SELECT * FROM `tb_balance` WHERE userID = '$userID'") or die(mysqli_error());
$s3 = mysqli_fetch_array($sql_3);

$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);

$sql_41 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s41 = mysqli_fetch_array($sql_41);
?>