<?php
	require_once('session.php');

    $users = $u['user'];
    $url_banner = $_POST['url_banner'];
    $ukuran_banner = $_POST['ukuran_banner'];
    $catID = $_POST['postID'];
    $status = $_POST['status'];
    $join_date = date('Y-m-d');
    $kode = date('YmdHis');
    $tipe_gambar = array('image/jpg','image/jpeg','image/bmp', 'image/x-png', 'image/png', 'image/gif');
    $gbr = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tipe = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $explode = explode('.',$gbr);
    $extensi  = $explode[count($explode)-1];
    $newname = 'brand_'.$users.'_'.$kode.'.'.$extensi;
    $upload_dir = "../../upload/";
    if($catID == ''){
        if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"INSERT INTO `tb_banner` (`image`, `url_banner`, `ukuran_banner`, `status`) VALUES ('$newname', '$url_banner', '$ukuran_banner', '$status')") or die(mysqli_error($conn));
                    header('location:../banner/?notif=1');
               }
               else {
                    header('location:../banner/?notif=3');
               } 
            }
            else {
                header('location:../banner/?notif=4');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../banner/?notif=2');
        }
        
    }
    else {
        if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"UPDATE `tb_banner` SET `image` = '$newname', `url_banner` = '$url_banner', `ukuran_banner` = '$ukuran_banner' WHERE id = '$catID'") or die(mysqli_error());
                    header('location:../banner/?catID='.$catID.'&notif=1');
               }
               else {
                    header('location:../banner/?catID='.$catID.'&notif=3');
               } 
            }
            else {
                $query = mysqli_query($conn,"UPDATE `tb_banner` SET `url_banner` = '$url_banner', `ukuran_banner` = '$ukuran_banner' WHERE id = '$catID'") or die(mysqli_error());
                header('location:../banner/?catID='.$catID.'&notif=1');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../banner/?catID='.$catID.'&notif=2');
        }
        
    }
    
?>