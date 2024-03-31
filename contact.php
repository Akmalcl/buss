<?php
ob_start();
session_start();
include('config/koneksi.php');
$sid = session_id();
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];
$pengguna = $s0['user'];
$sql_1a = mysqli_query($conn,"SELECT * FROM `tb_social` WHERE user = '$pengguna'") or die(mysqli_error());
$s1a = mysqli_fetch_array($sql_1a);
$sql_1b = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$pengguna'") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');
$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, '$pageName', '$pengguna')") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hubungi Kami - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Hubungi Kami - <?php echo $s0['instansi']; ?>"/>
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="Arie Budi" />
  <meta name="contact" content="ariebudi.com" />
  <meta name="copyright" content="Copyright (c) ariebudi.com. All Rights Reserved." />
  <meta name="robots" content="index, nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/favicon.png">

  <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.css"/>
  <!-- simplebar CSS-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Horizontal menu CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/horizontal-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo $urlweb; ?>/assets/css/app-style.css" rel="stylesheet"/>
  <link href="<?php echo $urlweb; ?>/assets/css/style-main<?php echo $s0['warna']; ?>.css" rel="stylesheet"/>
  <!-- Custom Style--> 
</head>

<body>

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start topbar header-->
    <?php include('top_menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix pt-5"></div>
    <div class="pt-5 pb-5">
      <div class="container">
       <div class="row">
          <div class="col-lg-12">
            <div class="pt-3 pb-4">
              <h5>Hubungi Kami</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <img src="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" style="width: auto; height: 50px; margin-bottom: 15px;" alt="logo icon">
                  <p>Top Up Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, dll. Buka 24 Jam Top Up Kilat Proses 1 Detik Murah, Aman, dan Terpercaya</p>
                  <p>Apabila Anda memiliki Pertanyaan atau Keluhan mengenai Layanan kami, Hubungi kami melalui Contact dibawah ini :</p>
                  <div class="row">
                      <div class="col-sm-4">
                          <p><i class="fab fa-whatsapp pr-3"></i>: <?php echo $s1b['no_hp']; ?></p>
                          <p><i class="fas fa-envelope pr-3"></i>: <?php echo $s1b['email']; ?></p>
                          <p><i class="fas fa-headphones pr-3"></i>: 09:00 - 23:00 WIB</p>
                      </div>
                      <div class="col-sm-4">
                          <p><strong>Follow Us</strong></p>
                          <a href="<?php echo $s1a['facebook']; ?>" target="_blank">
                              <div class="text-center mb-2 mr-2" style="float: left; width: 40px; height: 40px; border-radius: 10px; line-height: 30px; vertical-align: middle; background: radial-gradient(circle farthest-corner at 35% 90%, #fec564, transparent 50%), radial-gradient(circle farthest-corner at 0 140%, #fec564, transparent 50%), radial-gradient(ellipse farthest-corner at 0 -25%, #5258cf, transparent 50%), radial-gradient(ellipse farthest-corner at 20% -50%, #5258cf, transparent 50%), radial-gradient(ellipse farthest-corner at 100% 0, #893dc2, transparent 50%), radial-gradient(ellipse farthest-corner at 60% -20%, #893dc2, transparent 50%), radial-gradient(ellipse farthest-corner at 100% 100%, #d9317a, transparent), linear-gradient(#6559ca, #bc318f 30%, #e33f5f 50%, #f77638 70%, #fec66d 100%);">
                                  <i class="fab fa-instagram mt-1" style="font-size: 32px;!important;"></i>
                              </div>
                          </a>
                          <a href="https://wa.me/<?php echo $s1b['no_hp']; ?>" target="_blank">
                              <div class="text-center mb-2 mr-2" style="float: left; width: 40px; height: 40px; border-radius: 10px; line-height: 42px; background-color: #25D366;">
                                  <i class="fab fa-whatsapp mt-1" style="font-size: 32px;!important"></i>
                              </div>
                          </a>
                          <a href="<?php echo $s1a['facebook']; ?>" target="_blank">
                              <div class="text-center mb-2 mr-2" style="float: left; width: 40px; height: 40px; border-radius: 10px; line-height: 45px; background-color: #5865F2;">
                                  <i class="fab fa-facebook mt-1" style="font-size: 32px;!important"></i>
                              </div>
                          </a>
                          <a href="<?php echo $s1a['linkedin']; ?>" target="_blank">
                              <div class="text-center mb-2 mr-2" style="float: left; width: 40px; height: 40px; border-radius: 10px; line-height: 45px; background-color: #333;">
                                  <i class="fab fa-tiktok mt-1" style="font-size: 32px;!important"></i>
                              </div>
                          </a>
                      </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  	
    
	  <div class="d-block d-sm-none" style="height: 100px;"></div>
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	  <!--Start footer-->
    <?php include('footer.php'); ?>
</body>
</html>
