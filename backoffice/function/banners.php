<?php
	require_once('session.php');

    $users = $u['user'];
    $content = str_replace(array( "’","'" ),"&apos;",$_POST['deskripsi']);
    $status = $_POST['status'];
    $catID = $_POST['catID'];
    $postID = $_POST['postID'];
    $join_date = date('Y-m-d');
    $kode = date('YmdHis');
    $tipe_gambar = array('image/jpg','image/jpeg','image/bmp', 'image/x-png', 'image/png', 'image/gif');
    $gbr = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tipe = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $explode = explode('.',$gbr);
    $extensi  = $explode[count($explode)-1];
    $newname = 'popup_'.$users.'_'.$kode.'.'.$extensi;
    $upload_dir = "../../upload/";
    if($postID == ''){
        if($catID == 0){
            if($_FILES['image']['size'] <= 2048000){
                if($gbr !=="" && $error == 0){
                   if(in_array(strtolower($tipe), $tipe_gambar)){
                        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                        $sql_kategori = mysqli_query($conn,"SELECT * FROM `tb_kategori` ORDER BY id ASC") or die(mysqli_error());
                        while($sk = mysqli_fetch_array($sql_kategori)){
                            $kategoriID = $sk['id'];
                            $cekPopup = mysqli_query($conn,"SELECT * FROM `tb_banners` WHERE catID = '$kategoriID'") or die(mysqli_error());
                            $cp = mysqli_num_rows($cekPopup);
                            if($cp == 0){
                                $query = mysqli_query($conn,"INSERT INTO `tb_banners`(`catID`, `image`, `content`, `status`) VALUES ('$kategoriID','$newname','$content','$status')") or die(mysqli_error());
                            }
                        }
                        header('location:../popup_product/?notif=1');
                   }
                   else {
                        header('location:../popup_product/?notif=3');
                   } 
                }
                else {
                    $sql_kategori = mysqli_query($conn,"SELECT * FROM `tb_kategori` ORDER BY id ASC") or die(mysqli_error());
                    while($sk = mysqli_fetch_array($sql_kategori)){
                        $kategoriID = $sk['id'];
                        $cekPopup = mysqli_query($conn,"SELECT * FROM `tb_banners` WHERE catID = '$kategoriID'") or die(mysqli_error());
                        $cp = mysqli_num_rows($cekPopup);
                        if($cp == 0){
                            $query = mysqli_query($conn,"INSERT INTO `tb_banners`(`catID`, `image`, `content`, `status`) VALUES ('$kategoriID','','$content','$status')") or die(mysqli_error());
                        }
                    }
                    header('location:../popup_product/?notif=1');
                }
            }
            else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
                header('location:../popup_product/?notif=2');
            }
        }
        else {
            if($_FILES['image']['size'] <= 2048000){
                if($gbr !=="" && $error == 0){
                   if(in_array(strtolower($tipe), $tipe_gambar)){
                        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                        $query = mysqli_query($conn,"INSERT INTO `tb_banners`(`catID`, `image`, `content`, `status`) VALUES ('$catID','$newname','$content','$status')") or die(mysqli_error());
                        header('location:../popup_product/?notif=1');
                   }
                   else {
                        header('location:../popup_product/?notif=3');
                   } 
                }
                else {
                    $query = mysqli_query($conn,"INSERT INTO `tb_banners`(`catID`, `image`, `content`, `status`) VALUES ('$catID','','$content','$status')") or die(mysqli_error());
                    header('location:../popup_product/?notif=1');
                }
            }
            else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
                header('location:../popup_product/?notif=2');
            }
        }
    }
    else {
        if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"UPDATE `tb_banners` SET `image` = '$newname', `content` = '$content' WHERE id = '$postID'") or die(mysqli_error());
                    header('location:../popup_product/?notif=1');
               }
               else {
                    header('location:../popup_product/?notif=3');
               } 
            }
            else {
                $query = mysqli_query($conn,"UPDATE `tb_banners` SET `content` = '$content' WHERE id = '$postID'") or die(mysqli_error());
                header('location:../popup_product/?notif=1');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../popup_product/?notif=2');
        }
    }
    
?>