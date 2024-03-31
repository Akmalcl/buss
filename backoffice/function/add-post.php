<?php
	require_once('session.php');

    $users = $u['user'];
    $author = $u['full_name'];
    $title = str_replace(array( "’","'" ),"&apos;",$_POST['title']);
    $slugs = preg_replace("/[^a-zA-Z0-9]/", "-", $title);
    $slug = strtolower($slugs);
    $keywords = str_replace('-',',',$slug);
    $content = str_replace(array( "’","'" ),"&apos;",$_POST['content']);
    $meta_desc = str_replace(array( "’","'" ),"&apos;",$_POST['meta_desc']);
    $postID = $_POST['postID'];
    $status = $_POST['status'];
    $date = date('Y-m-d');
    $kode = date('YdmHis');
    $tipe_gambar = array('image/jpg','image/jpeg','image/bmp', 'image/x-png', 'image/png');
    $gbr = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tipe = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $explode = explode('.',$gbr);
    $extensi  = $explode[count($explode)-1];
    $newname = 'blog_'.$users.'_'.$kode.'.'.$extensi;
    $upload_dir = "../../upload/";
    if($postID == ''){
        if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"INSERT INTO `tb_post` (`slug`, `title`, `meta_desc`, `keyword`, `image`, `video`, `content`, `author`, `kategori`, `created_date`, `last_update`, `user`, `status`) VALUES ('$slug','$title','$meta_desc','$keywords','$newname','','$content','$author','artikel','$date','$date','$users', '$status')") or die(mysqli_error());
                    header('location:../post/?do=add&notif=1');
               }
               else {
                    header('location:../post/?do=add&notif=3');
               } 
            }
            else {
                $query = mysqli_query($conn,"INSERT INTO `tb_post` (`slug`, `title`, `meta_desc`, `keyword`, `image`, `video`, `content`, `author`, `kategori`, `created_date`, `last_update`, `user`, `status`) VALUES ('$slug','$title','$meta_desc','$keywords','no-photo.jpg','','$content','$author','artikel','$date','$date','$users', '$status')") or die(mysqli_error());
                header('location:../post/?do=add&notif=1');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../post/?do=add&notif=2');
        }
    }
    else {
       if($_FILES['image']['size'] <= 2048000){
            if($gbr !=="" && $error == 0){
               if(in_array(strtolower($tipe), $tipe_gambar)){
                    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                    $query = mysqli_query($conn,"UPDATE `tb_post` SET `slug` = '$slug', `title` = '$title', `meta_desc` = '$meta_desc', `keyword` = '$keywords', `image` = '$newname', `content` = '$content', `author` = '$author', `last_update` = '$date', `user` = '$users', `status` = '$status' WHERE id = '$postID'") or die(mysqli_error());
                    header('location:../post/?do=add&postID='.$postID.'&notif=1');
               }
               else {
                    header('location:../post/?do=add&postID='.$postID.'&notif=3');
               } 
            }
            else {
                $query = mysqli_query($conn,"UPDATE `tb_post` SET `slug` = '$slug', `title` = '$title', `meta_desc` = '$meta_desc', `keyword` = '$keywords', `content` = '$content', `author` = '$author', `last_update` = '$date', `user` = '$users', `status` = '$status' WHERE id = '$postID'") or die(mysqli_error());
                header('location:../post/?do=add&postID='.$postID.'&notif=1');
            }
        }
        else if($_FILES['image']['size'] >= 2048000 || $_FILES['image']['size'] == 0){
            header('location:../post/?do=add&postID='.$postID.'&notif=2');
        } 
    }
?>