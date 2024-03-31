<?php
	require_once('session.php');
    
    $template = $_POST['template'];
    $warna = $_POST['warna'];
    $footere = $_POST['footere'];
    $query = mysqli_query($conn,"UPDATE `tb_seo` SET `template` = '$template', 	`warna` = '$warna', `footer` = '$footere' WHERE id = 1") or die(mysqli_error());
    header('location:../template/?notif=1');
?>