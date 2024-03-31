<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Jakarta");
include('../../config/koneksi.php');

$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'].'/backoffice';
$urlwebs = $s0['urlweb'];

if (empty($_SESSION['user']) AND empty($_SESSION['pass'])){
  header('location:'.$urlweb.'/login/');
  exit;
}

$usernya = $_SESSION['user'];
$user =mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$usernya'") or die (mysqli_error());
$u = mysqli_fetch_array($user);
$token_id = isset($u['token_id']) ? $u['token_id'] : false;
$level = isset($u['level']) ? $u['level'] : false;

if(!validateToken($token_id)){
	$_SESSION['token'] = "";
	$_SESSION['user'] = "";
	$_SESSION['pass'] = "";
	header('location:'.$urlweb.'/login/?error=5');
	exit;
}

function validateToken($token_id){
    $conn = $GLOBALS['conn'];
	$q = mysqli_query($conn,"SELECT * FROM `tb_token` WHERE id='$token_id';") or die(mysqli_error($conn));
	if (mysqli_num_rows($q) > 0) {
		$token_data = mysqli_fetch_array($q);
		$token = $token_data['token'];
		$session_token = isset($_SESSION['token']) ? $_SESSION['token'] : "";
		
		if($token == $session_token){
			return true;
		}
	}
	
	return false;
}
?>