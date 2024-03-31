<?php
	require_once('session.php');
    $users = $u['user'];
    $image = $_POST['image'];
    if($image == 'BCAVA.png'){
    	$akun = 'Bank Central Asia (BCA)';
    }
    else if($image == 'BNIVA.png'){
    	$akun = 'Bank Negara Indonesia (BNI)';    	
    }
    else if($image == 'BRIVA.png'){
    	$akun = 'Bank Rakyat Indonesia (BRI)';    	
    }
    else if($image == 'MANDIRIVA.png'){
    	$akun = 'Bank Mandiri';    	
    }
    $no_rek = $_POST['no_rek'];
    $pemilik = $_POST['pemilik'];
    $created_date = date('Y-m-d H:i:s');
    $query = mysqli_query($conn,"INSERT INTO `tb_bank` (`image`, `akun`, `no_rek`, `pemilik`,`userID`) VALUES ('$image', '$akun','$no_rek','$pemilik',1)") or die(mysqli_error());
    header('location:../cekmutasi/');
?>