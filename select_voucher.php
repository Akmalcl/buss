<?php
ob_start();
session_start();
include('config/koneksi.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);

//error_reporting(0);
if($_GET['id']){
  $voucher = $_GET['id'];
  if($voucher == ''){
      echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Masukan Kode Voucher Terlebih Dahulu!</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
      ';
  }
  else {
    $getVoucher = mysqli_query($conn,"SELECT * FROM `tb_reward` WHERE title = '$voucher' AND status = 1") or die(mysqli_error());
    $gvv = mysqli_num_rows($getVoucher);
    if($gvv == 0){
      echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Voucher yang Anda Masukan Tidak Tersedia atau Sudah Kadaluarsa!</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
      ';
    }
    else {
      echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-check fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Voucher Berhasil Digunakan!</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
      ';
    }
  }
}
else {
    echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Masukan Kode Voucher Terlebih Dahulu!</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
    ';
}
?>