<?php
    require_once('session.php');
    $users = $u['user'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $pass = md5($_POST['pass']);
    $re_pass = $_POST['pass'];
    $kode = date('YdmHis');
    if($re_pass == ''){
        $query = mysqli_query($conn,"UPDATE `tb_user` SET `full_name` = '$full_name',
                                                                    `email` = '$email',
                                                                    `no_hp` = '$no_hp'
                                                                WHERE user = '$users'") or die(mysqli_error());
    }
    else {
        $query = mysqli_query($conn,"UPDATE `tb_user` SET `full_name` = '$full_name',
                                                                    `email` = '$email',
                                                                    `no_hp` = '$no_hp',
                                                                    `pass` = '$pass'
                                                                WHERE user = '$users'") or die(mysqli_error());
    }
    
            header('location:../profile/?notif=1');
?>