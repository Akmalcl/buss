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

$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Cek Pesanan', '$pengguna')") or die (mysqli_error());

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Harga - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Daftar Harga - <?php echo $s0['instansi']; ?>"/>
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
              <h5>Daftar Harga</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pb-3">
              <div class="section">
                <div class="card-body p-0">
                  <ul class="nav nav-tabs" id="myTab" role="tablist" style="width: 100%!important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
                    <?php
                      $sql_jenis = mysqli_query($conn,"SELECT * FROM `tb_jenis` WHERE status = 1 ORDER BY id ASC LIMIT 5") or die(mysqli_error());
                      $h = mysqli_num_rows($sql_jenis);
                      $lebar = 100 / $h;
                      $no = 0;
                      while($sj = mysqli_fetch_array($sql_jenis)){
                        $no++;
                    ?>
                    <li class="nav-item" role="presentation" style="width: <?php echo $lebar; ?>%; border-bottom-left-radius: 10px !important;">
                      <a class="nav-link<?php if($no == 1) { echo ' active'; } ?>" id="<?php echo strtolower($sj['jenis']); ?>-tab" data-toggle="tab" href="#<?php echo strtolower($sj['jenis']); ?>" role="tab" aria-controls="<?php echo strtolower($sj['jenis']); ?>" aria-selected="true" style="font-size: 10px;">
                        <p><i class="<?php echo $sj['image']; ?> fa-2x"></i></p>
                        <?php echo $sj['jenis']; ?>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <?php
                        $sql_list = mysqli_query($conn,"SELECT * FROM `tb_jenis` WHERE status = 1 ORDER BY id ASC LIMIT 5") or die(mysqli_error());
                        $no = 0;
                        while($sl = mysqli_fetch_array($sql_list)){
                          $no++;
                          $jenisnya = $sl['jenis'];
                          if($jenisnya == 'Game'){
                            $parent = 1;
                            $table = 'tb_produk';
                            $join = 'a.kategori = b.kategori';
                          }
                          else if($jenisnya == 'Pulsa'){
                            $parent = 3;
                            $table = 'tb_prepaid';
                            $join = 'a.brand = b.kategori';
                          }
                          else if($jenisnya == 'Emoney'){
                            $parent = 4;
                            $table = 'tb_prepaid';
                            $join = 'a.brand = b.kategori';
                          }
                          else if($jenisnya == 'Premium'){
                            $parent = 2;
                            $table = 'tb_produk';
                            $join = 'a.kategori = b.kategori';
                          }
                          else if($jenisnya == 'Social'){
                            $parent = 5;
                            $table = 'tb_produk_social';
                            $join = 'a.kategori = b.kategori';
                          }
                    ?>
                    <div class="tab-pane fade<?php if($no == 1) { echo ' show active'; } ?> p-3" id="<?php echo strtolower($sl['jenis']); ?>" role="tabpanel" aria-labelledby="<?php echo strtolower($sl['jenis']); ?>-tab">
                      <?php
                        $sql_1 = mysqli_query($conn,"SELECT a.*,b.* FROM $table as a INNER JOIN tb_kategori as b ON $join WHERE a.status = 1 AND b.parent = '$parent' ORDER BY a.id ASC") or die(mysqli_error());
                        $sll = mysqli_num_rows($sql_1);
                        if($sll > 0){
                      ?>
                      <div class="table-responsive">
                        <table id="" class="table table-bordered default-datatable">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th class="text-center">Kategori</th>
                              <th class="text-center">Produk</th>
                              <th class="text-center">Member</th>
                              <th class="text-center">Reseller</th>
                              <th class="text-center">Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $no=0;
                              while($s1 = mysqli_fetch_array($sql_1)){
                                $no++;
                            ?>
                            <tr>
                              <td class="text-left text-white" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo $s1['kategori']; ?></td>
                              <td class="text-left text-white" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo $s1['title']; ?></td>
                              <td class="text-right text-white" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo number_format($s1['harga_jual']); ?></td>
                              <td class="text-right text-white" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo number_format($s1['harga_reseller']); ?></td>
                              <td class="text-center text-white" style="vertical-align: middle; white-space: normal; font-size: 12px;">
                                <?php
                                  if($s1['status'] == 1){
                                    echo 'Tersedia';
                                  }
                                  else {
                                    echo 'Tidak Tersedia';
                                  }
                                ?>
                              </td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                      <?php } ?>
                    </div>
                    <?php } ?>
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
