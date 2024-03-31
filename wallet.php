<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Saldo Saya - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Saldo Saya - <?php echo $s0['instansi']; ?>"/>
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
  <!--Select Plugins-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
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
              <h5>Saldo Saya</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pb-3">
                <?php
                    error_reporting(0);
                    if (!empty($_GET['notif'])) {
                      if ($_GET['notif'] == 1) {
                        echo '
                          <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Pin Transaksi Salah!</span>
                            </div>
                          </div>
                        ';
                      }
                      if ($_GET['notif'] == 2) {
                        echo '
                          <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <div class="alert-icon">
                              <i class="fa fa-exclamation"></i>
                            </div>
                            <div class="alert-message">
                              <span><strong>Warning!</strong> Anda Belum Membuat PIN Transaksi, Silahkan buat PIN Transaksi pada menu Profil!</span>
                            </div>
                          </div>
                        ';
                      }
                    }
                ?>
              <div class="section">
                <div class="card-body">
                  <div class="card-title" style="font-size: 16px;">Rp. <?php echo number_format($s3['active']); ?>
                    <span class="float-right">
                      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formdepo" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus mr-1"></i> Top Up Saldo IDR (Rp)</button>
                    </span>
                  </div>
                  <!-- Modal -->
                  <div class="modal fade" id="formdepo">
                    <div class="modal-dialog" style="background: #191f50!important; color: #fff!important;">
                      <div class="modal-content animated bounceIn" style="background: #191f50!important; color: #fff!important;">
                        <div class="modal-header">
                          <h5 class="modal-title" style="color: #fff;">Form Top Up Saldo</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form role="form" action="<?php echo $urlweb; ?>/functions/topup.php" method="post">
                            <div class="form-group mb-2">
                              <label style="color: #fff;">Nominal Top Up</label>
                              <input type="number" name="nominal" min="10000" max="4500000" step="1000" value="10000" class="form-control" required>
                              <input type="hidden" name="userID" class="form-control" value="<?php echo $userID; ?>">
                            </div>
                            <div class="form-group mb-2">
                              <label style="color: #fff;">Pilih Metode Pembayaran</label>
                              <div class="accordion mt-3" id="accordionExample">
                                <?php
                                  error_reporting(0);
                                  $cekmutasi = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 7") or die(mysqli_error());
                                  $cm = mysqli_fetch_array($cekmutasi);
                                  if($cm['status'] == 1){
                                ?>
                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingOne">
                                    <div class="row">
                                      <div class="col-12">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="zmdi zmdi-balance" style="font-size: 18px;"></i>&nbsp; Bank Transfer
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <?php
                                          $sql_bank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE userID = 1 ORDER BY id ASC") or die(mysqli_error());
                                          $noe = 0;
                                          while($sb = mysqli_fetch_array($sql_bank)){
                                            $noe ++;
                                        ?>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="Direct_<?php echo str_replace('.png','',$sb['image']); ?>_7" id="flexRadioDefault<?php echo $noe; ?>a">
                                          <label for="flexRadioDefault<?php echo $noe; ?>a" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="col-6 p-1">
                                                    <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                        <img src="<?php echo $urlweb; ?>/upload/<?php echo $sb['image']; ?>" style="display: block; width: 100%; height: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-6 p-1"></div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="col-12 p-1">
                                                    <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                    <p style="font-weight: normal; font-size: 10px;"><?php echo $sb['akun']; ?><br>
                                                    <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <?php } ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                                          <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                                          <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                                          <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                                      </div>
                                  </div>
                                </div>
                                <?php } ?>
                                <?php
                                  $cekVa = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE jenis = 0 AND status = 1") or die(mysqli_error());
                                  $cv = mysqli_fetch_array($cekVa);
                                  if($cv['id'] == 1){
                                    $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
                                    $s5 = mysqli_fetch_array($sql_5);
                                    $tripayApi = $s5['api_key'];

                                    $curls = curl_init();
                                           
                                    curl_setopt_array($curls, array(
                                      CURLOPT_FRESH_CONNECT     => true,
                                      CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
                                      CURLOPT_RETURNTRANSFER    => true,
                                      CURLOPT_HEADER            => false,
                                      CURLOPT_HTTPHEADER        => array(
                                        "Authorization: Bearer ".$tripayApi
                                      ),
                                      CURLOPT_FAILONERROR       => false
                                    ));
                                              
                                    $responses = curl_exec($curls);
                                    $errs = curl_error($curls);
                                    curl_close($curls);
                                    //echo !empty($err) ? $err : $responses;
                                    $hasils = json_decode($responses, true);
                                ?>
                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingTwo">
                                    <div class="row">
                                      <div class="col-12 p-1">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <?php
                                          for ($i=0; $i < count($hasils['data']); $i++) {
                                            if($hasils['data'][$i]['group'] == 'Virtual Account'){
                                              if($hasils['data'][$i]['active'] == 'true'){
                                        ?>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
                                          <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="col-6 p-1">
                                                    <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                        <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-6 p-1"></div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="col-12 p-1">
                                                    <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                    <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['data'][$i]['name']; ?><br>
                                                    <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <?php }}} ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <?php
                                              for ($i=0; $i < 4; $i++) {
                                                if($hasils['data'][$i]['group'] == 'Virtual Account'){
                                                  if($hasils['data'][$i]['active'] == 'true'){
                                          ?>
                                          <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                                          <?php }}} ?>
                                      </div>
                                  </div>
                                </div>

                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingThree">
                                    <div class="row">
                                      <div class="col-12">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            <i class="zmdi zmdi-store" style="font-size: 18px;"></i>&nbsp; Convenience Store
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <?php
                                          for ($i=0; $i < count($hasils['data']); $i++) {
                                            if($hasils['data'][$i]['group'] == 'Convenience Store'){
                                              if($hasils['data'][$i]['active'] == 'true'){
                                        ?>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
                                          <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="col-6 p-1">
                                                    <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                        <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-6 p-1"></div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="col-12 p-1">
                                                    <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                    <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['data'][$i]['name']; ?><br>
                                                    <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <?php }}} ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <?php
                                              for ($i=0; $i < count($hasils['data']); $i++) {
                                                if($hasils['data'][$i]['group'] == 'Convenience Store'){
                                                  if($hasils['data'][$i]['active'] == 'true'){
                                          ?>
                                          <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                                          <?php }}} ?>
                                      </div>
                                  </div>
                                </div>

                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingFour">
                                    <div class="row">
                                      <div class="col-12">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                            <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; E-Wallet
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <?php
                                          for ($i=0; $i < count($hasils['data']); $i++) {
                                            if($hasils['data'][$i]['group'] == 'E-Wallet'){
                                              if($hasils['data'][$i]['active'] == 'true'){
                                        ?>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
                                          <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="col-6 p-1">
                                                    <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                        <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                                    </div>
                                                </div>
                                                <div class="col-6 p-1"></div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="col-12 p-1">
                                                    <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                    <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['data'][$i]['name']; ?><br>
                                                    <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <?php }}} ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <?php
                                              for ($i=0; $i < count($hasils['data']); $i++) {
                                                if($hasils['data'][$i]['group'] == 'E-Wallet'){
                                                  if($hasils['data'][$i]['active'] == 'true'){
                                          ?>
                                          <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                                          <?php }}} ?>
                                      </div>
                                  </div>
                                </div>

                                <?php
                                  }
                                  else if($cv['id'] == 2){

                                ?>
                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingTwo">
                                    <div class="row">
                                      <div class="col-12">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="va_bca_2" id="flexRadioDefault201a">
                                          <label for="flexRadioDefault201a" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="row">
                                                    <div class="col-6 pl-1">
                                                        <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                            <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pr-1"></div>
                                                </div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="row">
                                                    <div class="col-12 pl-1 pr-1">
                                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                        <p style="font-weight: normal; font-size: 10px;">BCA Virtual Account<br>
                                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="va_bni_2" id="flexRadioDefault202a">
                                          <label for="flexRadioDefault202a" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="row">
                                                    <div class="col-6 pl-1">
                                                        <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                            <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pr-1"></div>
                                                </div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="row">
                                                    <div class="col-12 pl-1 pr-1">
                                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                        <p style="font-weight: normal; font-size: 10px;">BNI Virtual Account<br>
                                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="va_bri_2" id="flexRadioDefault203a">
                                          <label for="flexRadioDefault203a" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="row">
                                                    <div class="col-6 pl-1">
                                                        <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                            <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pr-1"></div>
                                                </div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="row">
                                                    <div class="col-12 pl-1 pr-1">
                                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                        <p style="font-weight: normal; font-size: 10px;">BRI Virtual Account<br>
                                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="va_mandiri_2" id="flexRadioDefault204a">
                                          <label for="flexRadioDefault204a" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="row">
                                                    <div class="col-6 pl-1">
                                                        <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                            <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pr-1"></div>
                                                </div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="row">
                                                    <div class="col-12 pl-1 pr-1">
                                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                        <p style="font-weight: normal; font-size: 10px;">MANDIRI Virtual Account<br>
                                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                                          <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                                          <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                                          <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                                      </div>
                                  </div>
                                </div>

                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0" id="headingThree">
                                    <div class="row">
                                      <div class="col-12">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                            <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; E-Wallet
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="VA_QRIS_2" id="flexRadioDefault205a">
                                          <label for="flexRadioDefault205a" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="row">
                                                    <div class="col-6 pl-1">
                                                        <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                            <img src="<?php echo $urlweb; ?>/upload/linkaja.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pr-1"></div>
                                                </div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="row">
                                                    <div class="col-12 pl-1 pr-1">
                                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                        <p style="font-weight: normal; font-size: 10px;">QRIS via LinkAja<br>
                                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <img src="<?php echo $urlweb; ?>/upload/linkaja.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                                      </div>
                                  </div>
                                </div>

                                <?php
                                  }
                                  else if($cv['id'] == 3){
                                    $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 3") or die(mysqli_error());
                                    $s5 = mysqli_fetch_array($sql_5);
                                    $tripayApi = $s5['api_key'];
                                    $merchantCodes = $s5['merchant_code'];

                                    $datetime = date('Y-m-d H:i:s');  
                                    $paymentAmount = 10000;
                                    $signature = hash('sha256',$merchantCodes . $paymentAmount . $datetime . $tripayApi);
                                    $itemsParam = array(
                                      'merchantcode' => $merchantCodes,
                                      'amount' => $paymentAmount,
                                      'datetime' => $datetime,
                                      'signature' => $signature
                                    );
                                
                                    class emp{}
                                
                                    $params = array_merge((array)$result,$itemsParam);
                                
                                    $params_string = json_encode($params);
                                
                                    $url = 'https://passport.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod'; 
                                
                                    $ch = curl_init();
                                
                                    curl_setopt($ch, CURLOPT_URL, $url); 
                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                                        'Content-Type: application/json',                                                                                
                                        'Content-Length: ' . strlen($params_string))                                                                       
                                    );   
                                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                                            
                                    $responses = curl_exec($ch);
                                    $errs = curl_error($ch);
                                    curl_close($ch);
                                    //echo !empty($err) ? $err : $response;
                                    $hasils = json_decode($responses, true);
                                ?>
                                <div class="card box_game mb-1">
                                  <div class="card-header pt-1 pb-0" id="headingTwo">
                                    <div class="row">
                                      <div class="col-12">
                                        <h2 class="mb-0">
                                          <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account & E-Wallet
                                          </button>
                                        </h2>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                      <div class="row mb-2">
                                        <?php
                                          for ($i=0; $i < count($hasils['paymentFee']); $i++) {
                                        ?>
                                        <div class="col-6 p-1">
                                          <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['paymentFee'][$i]['paymentMethod']; ?>_<?php echo str_replace(' ','',$hasils['paymentFee'][$i]['paymentName']); ?>_3" id="flexRadioDefault<?php echo $i; ?>">
                                          <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                            <div class="row ml-2 mr-2 pb-0">
                                                <div class="row">
                                                    <div class="col-6 pl-1">
                                                        <div style="background: #fff; width: 40px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                            <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 pr-1"></div>
                                                </div>
                                            </div>
                                            <div class="row ml-2 mr-2 pt-0">
                                                <div class="row">
                                                    <div class="col-12 pl-1 pr-1">
                                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                                        <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['paymentFee'][$i]['paymentName']; ?><br>
                                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                          </label>
                                        </div>
                                        <?php } ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-footer" style="background: none;">
                                      <div class="float: right;">
                                          <?php
                                              for ($i=0; $i < count($hasils['paymentFee']); $i++) {
                                          ?>
                                          <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                                          <?php } ?>
                                      </div>
                                  </div>
                                </div>
                                <?php
                                  }
                                ?>
                              </div> 
                            </div>
                            <div class="form-group mt-3">
                              <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                              <button type="submit" name="submit" class="btn btn-primary">Top Up</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr style="background-color: #b8b8b8; opacity: .5;">
                  <div class="table-responsive">
                    <table id="default-datatable" class="table table-bordered align-items-center table-flush">
                      <thead>
                        <tr class="bg-primary text-white">
                          <th class="text-center" style="vertical-align: middle;">No</th>
                          <th class="text-center" style="vertical-align: middle;">Tgl Transaksi</th>
                          <th class="text-center" style="vertical-align: middle;">No. Transaksi</th>
                          <th class="text-center" style="vertical-align: middle;">Jumlah</th>
                          <th class="text-center" style="vertical-align: middle;">Note</th>
                          <th class="text-center" style="vertical-align: middle;">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_transaksi` WHERE userID = '$userID' ORDER BY id DESC") or die(mysqli_error());
                          $no = 0;
                          while($s1 = mysqli_fetch_array($sql_1)){
                            $no++;
                            $userID = $s1['userID'];
                            $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = '$userID'") or die(mysqli_error());
                            $s3 = mysqli_fetch_array($sql_3);
                        ?>
                        <tr>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><?php echo $no; ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><?php echo $s1['date']; ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><a href="<?php echo $urlweb; ?>/payment/?trxID=<?php echo $s1['kd_transaksi']; ?>"><?php echo $s1['kd_transaksi']; ?></a></td>
                          <td class="text-right text-white" style="vertical-align: middle; white-space: normal;"><?php echo number_format($s1['total']); ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;"><?php echo $s1['note']; ?></td>
                          <td class="text-center text-white" style="vertical-align: middle; white-space: normal;">
                            <?php
                              if($s1['status'] == 0){
                                echo '<button class="btn btn-warning btn-sm">Pending</button>';
                              }
                              else if($s1['status'] == 1){
                                echo '<button class="btn btn-success btn-sm">Success</button>';
                              }
                              else if($s1['status'] == 2){
                                echo '<button class="btn btn-danger btn-sm">Refund</button>';
                              }
                            ?>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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
    <script>
      $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();
      });
    </script>
</body>
</html>
