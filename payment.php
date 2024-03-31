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

$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Order', '$pengguna')") or die (mysqli_error());
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pembayaran - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Pembayaran - <?php echo $s0['instansi']; ?>"/>
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
              <h5>Pembayaran</h5>
              <span class="strip-primary"></span>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <h4>Terima Kasih</h4>
                  Pesanan anda berhasil dibuat. Masa berlaku untuk No. Transaksi ini 24 jam, segera lakukan pembayaran agar pesanan segera diproses.
                  <br><br>
                  Simpan No. Transaksi anda untuk Cek Status Pesanan!
                </div>
              </div>
            </div>

            <div class="pb-3">
              <?php
                error_reporting(0);
                $trxID = $_GET['trxID'];
                $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE merchant_ref = '$trxID'") or die(mysqli_error());
                $s2 = mysqli_fetch_array($sql_2);
                $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$trxID'") or die(mysqli_error());
                $s3 = mysqli_fetch_array($sql_3);
                $produkID = $s3['produkID'];
                $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE id = '$produkID'") or die(mysqli_error());
                $s4 = mysqli_fetch_array($sql_4);
              ?>
              <div class="section">
                <div class="card-body">
                  <div class="row">
                      <div class="col-sm-6">
                          <div class="pb-4">
                            Waktu Transaksi
                            <h5><?php echo $s2['created_date']; ?></h5>
                          </div>
                          <div class="pb-4">
                            No. Transaksi
                            <h5><?php echo $s2['merchant_ref']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_trxaku()" data-clipboard-text="<?php echo $s2['merchant_ref']; ?>"></i></h5>
                          </div>
                          <div class="pb-4">
                            Metode Pembayaran
                            <h5><?php echo $s2['payment_name']; ?></h5>
                          </div>                                
                          <div class="pb-4">
                            <?php
                              if($s2['payment_method'] == 'Direct_BCAVA'){
                                $metodenya = $s2['payment_method'].'.png';
                                $getBank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE image = '$metodenya' AND userID = 1") or die(mysqli_error());
                                $gb = mysqli_fetch_array($getBank);
                            ?>
                            No. Rekening Pembayaran<br>
                            <h5><?php echo $gb['no_rek']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_virtualku()" data-clipboard-text="<?php echo $gb['no_rek']; ?>"></i></h5>
                            <p>a/n <?php echo $gb['pemilik']; ?></p>
                            <small><strong>NOTE :</strong> Lakukan Pembayaran Sesuai dengan Nominal Transaksi, Kegagalan Transaksi akibat salah transfer bukan tanggung jawab kami.</small>
                            <?php
                              } else if($s2['payment_method'] == 'Direct_BNIVA'){
                                $metodenya = $s2['payment_method'].'.png';
                                $getBank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE image = '$metodenya' AND userID = 1") or die(mysqli_error());
                                $gb = mysqli_fetch_array($getBank);
                            ?>
                            No. Rekening Pembayaran<br>
                            <h5><?php echo $gb['no_rek']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_virtualku()" data-clipboard-text="<?php echo $gb['no_rek']; ?>"></i></h5>
                            <p>a/n <?php echo $gb['pemilik']; ?></p>
                            <small><strong>NOTE :</strong> Lakukan Pembayaran Sesuai dengan Nominal Transaksi, Kegagalan Transaksi akibat salah transfer bukan tanggung jawab kami.</small>
                            <?php
                              } else if($s2['payment_method'] == 'Direct_BRIVA'){
                                $metodenya = $s2['payment_method'].'.png';
                                $getBank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE image = '$metodenya' AND userID = 1") or die(mysqli_error());
                                $gb = mysqli_fetch_array($getBank);
                            ?>
                            No. Rekening Pembayaran<br>
                            <h5><?php echo $gb['no_rek']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_virtualku()" data-clipboard-text="<?php echo $gb['no_rek']; ?>"></i></h5>
                            <p>a/n <?php echo $gb['pemilik']; ?></p>
                            <small><strong>NOTE :</strong> Lakukan Pembayaran Sesuai dengan Nominal Transaksi, Kegagalan Transaksi akibat salah transfer bukan tanggung jawab kami.</small>
                            <?php
                              } else if($s2['payment_method'] == 'Direct_MANDIRIVA'){
                                $metodenya = $s2['payment_method'].'.png';
                                $getBank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE image = '$metodenya' AND userID = 1") or die(mysqli_error());
                                $gb = mysqli_fetch_array($getBank);
                            ?>
                            No. Rekening Pembayaran<br>
                            <h5><?php echo $gb['no_rek']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_virtualku()" data-clipboard-text="<?php echo $gb['no_rek']; ?>"></i></h5>
                            <p>a/n <?php echo $gb['pemilik']; ?></p>
                            <small><strong>NOTE :</strong> Lakukan Pembayaran Sesuai dengan Nominal Transaksi, Kegagalan Transaksi akibat salah transfer bukan tanggung jawab kami.</small>
                            <?php
                              } else{
                            ?>
                            Kode Pembayaran / No. Virtual Account<br>
                            <?php if($s2['payment_method'] == 'QRISC' || $s2['payment_method'] == 'QRIS' || $s2['payment_method'] == 'QRIS2' || $s2['payment_method'] == 'QRISCOP' || $s2['payment_method'] == 'QRISD' || $s2['payment_method'] == 'QRISNOBU'){ ?>
                            <img src="https://tripay.co.id/qr/<?php echo $s2['reference']; ?>" style="display: block; margin: 0 auto; margin-top: 10px; width:100%; max-width:180px !important; cursor:zoom-in;" id="qr_code">
                            <?php } else if($s2['payment_method'] == 'OVO'){ ?>
                            Untuk Pembayaran Menggunakan OVO,<br>Silahkan Lakukan Pembayaran melalui tombol dibawah :<br>
                            <a href="<?php echo $s2['checkout_url']; ?>" target="_blank" class="btn btn-success btn-sm">Bayar Sekarang</a>
                            <?php } else { ?>
                            <h5><?php echo $s2['pay_code']; ?><i class="fa fa-clone pl-2 clip" onclick="copy_virtualku()" data-clipboard-text="<?php echo $s2['pay_code']; ?>"></i></h5>
                            <?php }} ?>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="pb-4">
                            Total Belanja
                            <h5>Rp. <?php echo number_format($s2['amount']); ?> Discount Rp. <?php echo number_format($s3['potongan']); ?></h5>
                          </div>
                          <div class="pb-4">
                            Biaya Layanan / Admin
                            <h5>Rp. <?php echo number_format($s2['fee']); ?></h5>
                          </div>
                          <div class="pb-4">
                            Jumlah Pembayaran
                            <h5>Rp. <?php echo number_format($s2['amount_total']); ?></h5>
                          </div>
                          <div class="pb-4">
                            Rincian Pesanan
                            <?php if($s2['providerID'] == 0){
                                echo '<h5>Top Up saldo</h5>';
                            }
                            else { ?>
                            <h5><?php echo ucwords(str_replace('-',' ',$s3['kategori'])); ?> - <?php echo $s3['title']; ?></h5>
                            <p><?php echo $s3['userID']; ?> <?php if($s3['zoneID'] == 'undefined' || $s3['zoneID'] == '') { echo ''; } else { echo '('.$s3['zoneID'].')'; } ?> - <?php echo $s3['nickname']; ?></p> 
                            <?php } ?>
                          </div>
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
    <script src="<?php echo $urlweb; ?>/assets/js/clipboard.min.js"></script>
    <script>

      var clipboard = new ClipboardJS('.clip');

      function copy_trxaku() {
        alert("No. Transaksi berhasil di Copy");
      }

      function copy_virtualku() {
        alert("Kode Pembayaran / No. Virtual Account berhasil di Copy");
      }

    </script>
</body>
</html>
