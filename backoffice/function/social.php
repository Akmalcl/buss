<?php
	require_once('session.php');
    
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    $youtube = $_POST['youtube'];
    $query = mysqli_query($conn,"UPDATE `tb_social` SET `facebook` = '$facebook',
                                                        `twitter` = '$twitter',
                                                        `instagram` = '$instagram',
                                                        `linkedin` = '$linkedin',
                                                        `youtube` = '$youtube'
                                                        WHERE id = 1") or die(mysqli_error());
    header('location:../social/?notif=1');
?>