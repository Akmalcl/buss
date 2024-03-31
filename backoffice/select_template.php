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
    $temptID = $_GET['id'];
?>
<div class="card">
    <div class="card-body">
        <p>Preview Tampilan</p>
    	<img src="<?php echo $urlwebs; ?>/upload/home_<?php echo $temptID; ?>.png" class="img-fluid" style="display: block; margin: 0 auto;">
    </div>
</div>
<?php 
}
?>