<?php
	require_once('session.php');

    $users = $u['user'];
    $title = $_POST['title'];
    $nominal = $_POST['nominal'];
    $status = $_POST['status'];
    $postID = $_POST['postID'];

    if($postID == ''){
        $query = mysqli_query($conn,"INSERT INTO `tb_reward` (`title`, `nominal`, `status`) VALUES ('$title', '$nominal', '$status')") or die(mysqli_error($conn));
        header('location:../voucher/?notif=1');
    }
    else {
        $query = mysqli_query($conn,"UPDATE `tb_reward` SET `title` = '$title', `nominal` = '$nominal', `status` = '$status' WHERE id = '$postID'") or die(mysqli_error($conn));
        header('location:../voucher/?catID='.$postID.'&notif=1');
    }
?>