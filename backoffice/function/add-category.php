<?php
    require_once('session.php');

    $users = $u['user'];
    $category = $_POST['kategori'];
    $slugs = preg_replace("/[^a-zA-Z0-9]/", "", $category);
    $slug = strtolower($slugs);
    $parent = $_POST['parent'];
    $deskripsi = $_POST['deskripsi'];
    $bantuan = $_POST['bantuan'];
    $subtitle = $_POST['subtitle'];
    $catID = $_POST['postID'];
    $status = $_POST['status'];
    $join_date = date('Y-m-d');
    $kode = date('YmdHis');
    $tipe_gambar = array('image/jpg','image/jpeg','image/bmp', 'image/x-png', 'image/png');
    $gbr = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tipe = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $explode = explode('.',$gbr);
    $extensi  = $explode[count($explode)-1];
    $newname = 'category_'.$users.'_'.$kode.'.'.$extensi;
    $upload_dir = "../../upload/";
    if($catID == ''){
        if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"INSERT INTO `tb_kategori` (`slug`, `kategori`, `deskripsi`, `bantuan`, `subtitle`, `image`, `parent`, `created_date`, `user`, `status`) VALUES ('$slug', '$category', '$deskripsi', '$bantuan', '$subtitle', '$newname', '$parent', '$join_date', '$users', '$status')") or die(mysqli_error($conn));
                    header('location:../category/?notif=1');
               }
               else {
                    header('location:../category/?notif=3');
               } 
            }
            else {
                $query = mysqli_query($conn,"INSERT INTO `tb_kategori` (`slug`, `kategori`, `deskripsi`, `bantuan`, `subtitle`, `image`, `parent`, `created_date`, `user`, `status`) VALUES ('$slug', '$category', '$deskripsi', '$bantuan', '$subtitle', 'icon-default.png', '$parent', '$join_date', '$users', '$status')") or die(mysqli_error($conn));
                header('location:../category/?notif=1');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../category/?notif=2');
        }
        
    }
    else {
        if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"UPDATE `tb_kategori` SET `kategori` = '$category', `deskripsi` = '$deskripsi', `bantuan` = '$bantuan', `subtitle` = '$subtitle', `image` = '$newname', `created_date` = '$join_date' WHERE id = '$catID'") or die(mysqli_error());
                    header('location:../category/?catID='.$catID.'&notif=1');
               }
               else {
                    header('location:../category/?catID='.$catID.'&notif=3');
               } 
            }
            else {
                $query = mysqli_query($conn,"UPDATE `tb_kategori` SET `kategori` = '$category', `deskripsi` = '$deskripsi', `bantuan` = '$bantuan', `subtitle` = '$subtitle', `created_date` = '$join_date' WHERE id = '$catID'") or die(mysqli_error());
                header('location:../category/?catID='.$catID.'&notif=1');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../category/?catID='.$catID.'&notif=2');
        }
        
    }
    
?>