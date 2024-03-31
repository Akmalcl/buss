<?php
require_once('session.php');

$author = $u['full_name'];
$data = array('?php','select * from','join','inner join','left join','where = ','where=','disctint','<script>','</script>');

$harga_modal = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['harga_modal']);
$harga_jual = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['harga_jual']);
$harga_reseller = preg_replace("/[^a-zA-Z0-9]/", "", $_POST['harga_reseller']);
$postID = $_POST['postID'];

$query = mysqli_query($conn,"UPDATE `tb_produk_social` SET `harga_jual`='$harga_jual', `harga_reseller` = '$harga_reseller'  WHERE id = '$postID'") or die(mysqli_error());
header('location:../social_media/?do=add&catID='.$postID.'&notif=1');
exit();
?>