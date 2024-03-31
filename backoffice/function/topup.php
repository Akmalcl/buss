<?php
error_reporting(E_ALL);
require_once('session.php');

$usersID = $_POST['userID'];
$amounts = $_POST['nominal'];

$today = date('Y-m-d');
$sql_3 = mysqli_query($conn,"SELECT * FROM `tb_transaksi` ORDER BY id DESC LIMIT 1") or die(mysqli_error($conn));
$s33 = mysqli_num_rows($sql_3);
if($s33 == 0){
    $unikID = 0;
}
else {
    $s3 = mysqli_fetch_array($sql_3);
    $unikID = $s3['id'];
}
$no_invoice = 'INV/'.date('y').'/'.date('m').'/'.date('s').$unikID;
$unik = date('Hs');
$kode_unik = substr(str_shuffle(1234567890),0,3);
$orderid = $kode_unik.date('dis');
$created_date = date('Y-m-d H:i:s');

$insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `jenis`, `metode`, `userID`, `status`) VALUES ('$no_invoice','$created_date','Top Up Saldo','$amounts',0,'Top Up Saldo','1','Manual','$usersID',1)") or die(mysqli_error());
$update_balace = mysqli_query($conn,"UPDATE `tb_balance` SET active = active + $amounts WHERE userID = '$usersID'") or die(mysqli_error());
header('location:../balance/?notif=1');

?>