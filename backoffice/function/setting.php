<?php
    require_once('session.php');
    $users = $u['user'];
    $title = $_POST['instansi'];
    $keyword = $_POST['keyword'];
    $deskripsi = $_POST['deskripsi'];
    $callcenter = $_POST['callcenter'];

    $date = date('Y-m-d H:i:s');
    $kode = date('YdmHis');
    $tipe_gambar = array('image/jpeg','image/bmp', 'image/x-png', 'image/png');
    
    $gbr = $_FILES['image']['name'];
    $ukuran = $_FILES['image']['size'];
    $tipe = $_FILES['image']['type'];
    $error = $_FILES['image']['error'];
    $explode = explode('.',$gbr);
    $extensi  = $explode[count($explode)-1];
    $newname = 'logo_'.$users.'_'.$kode.'.'.$extensi;
    
    $favicon = $_FILES['favicon']['name'];
    $explodes = explode('.',$favicon);
    $extensis  = $explode[count($explodes)-1];
    $newnames = 'favicon.png';
    $upload_dir = "../../upload/";
    if($_FILES['image']['size'] <= 512000){
        if($gbr !="" && $error == 0){
           if(in_array(strtolower($tipe), $tipe_gambar)){
                move_uploaded_file($_FILES['favicon']['tmp_name'], $upload_dir . $newnames);
                move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $newname);
                $query = mysqli_query($conn,"UPDATE `tb_seo` SET `image` = '$newname', `instansi` = '$title', `keyword` = '$keyword', `deskripsi` ='$deskripsi' WHERE id = 1") or die(mysqli_error());
                header('location:../setting/?notif=1');
           }
           else {
                header('location:../setting/?notif=3');
           } 
        }
        else {
            move_uploaded_file($_FILES['favicon']['tmp_name'], $upload_dir . $newnames);
            $query = mysqli_query($conn,"UPDATE `tb_seo` SET `instansi` = '$title', `keyword` = '$keyword', `deskripsi` ='$deskripsi' WHERE id = 1") or die(mysqli_error());
                header('location:../setting/?notif=1');
        }
    }
    else if($_FILES['image']['size'] >= 512000 || $_FILES['image']['size'] == 0){
        header('location:../setting/?notif=2');
    }