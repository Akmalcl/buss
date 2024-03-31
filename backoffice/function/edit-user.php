<?php
    require_once('session.php');
    $pass = md5($_POST['pass']);
    $re_pass = $_POST['pass'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    if($re_pass == ''){
    	$query = mysqli_query($conn,"UPDATE `tb_user` SET `full_name` = '$full_name', `no_hp` = '$no_hp', `email` ='$email' WHERE id = 1") or die(mysqli_error());
    }
    else {
    	$query = mysqli_query($conn,"UPDATE `tb_user` SET `pass` = '$pass', `re_pass` = '$re_pass', `full_name` = '$full_name', `no_hp` = '$no_hp', `email` ='$email' WHERE id = 1") or die(mysqli_error());
    }
    
    header('location:../e_user/?postID='.$postID.'&notif=1');
?>