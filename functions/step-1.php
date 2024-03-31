<?php
ob_start();
session_start();
include('../config/koneksi.php');
include('../classes/class.phpmailer.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$token = session_id();
$full_name = $_POST['full_name'];
$no_hp = $_POST['no_hp'];
$usere = strtolower($_POST['user']);
$user = str_replace(' ','',$usere);
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$pass = md5($_POST['pass']);
$re_pass = $_POST['pass'];
$level = 'user';
$join_date = date('Y-m-d H:i:s');

$cekemail = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$user' OR email = '$email'") or die (mysqli_error());
$q = mysqli_num_rows($cekemail);
if($q > 0){
    header('location:../register/?error=2');
}
else {
    $query = mysqli_query($conn,"INSERT INTO `tb_user` (`user`, `pass`, `re_pass`, `token_id`, `image`, `full_name`, `email`, `no_hp`, `level`, `join_date`, `last_login`, `status`) VALUES (
            '$user', '$pass', '$re_pass', '0', 'avatar5.png', '$full_name', '$email', '$no_hp', 'user', '$join_date', '$join_date', 1)") or die(mysqli_error());
    $last_id = mysqli_insert_id($conn);
    $query2 = mysqli_query($conn,"INSERT INTO `tb_balance` (`userID`, `active`, `pending`, `payout`, `created_date`) VALUES ('$last_id', 0, 0, 0, '$join_date')") or die(mysqli_error());
    header('location:../login/?notif=5');
	
}
?>