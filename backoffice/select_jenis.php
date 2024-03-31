<?php
ob_start();
session_start();
include('../config/koneksi.php');

error_reporting(0);
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'].'/office';
$urlwebs = $s0['urlweb'];

if($_GET['id']){
	$parent = $_GET['id'];
    $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE parent = '$parent' ORDER BY kategori ASC") or die(mysqli_error());
    while($s3 = mysqli_fetch_array($sql_3)){
?>
    <option value="<?php echo $s3['id']; ?>"> <?php echo $s3['kategori']; ?> </option>
<?php 
	}
}
?>