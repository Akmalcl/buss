<?php
ob_start();
session_start();
include('config/koneksi.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
error_reporting(0);
if($_GET['userID'] == ''){
?>
                        <div class="modal-body pt-5 pb-5 text-center">
                          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
                          <p style="font-size: 18px;">Harap Masukan Data Tujuan</p>
                          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
                        </div>
<?php
}
else if($_GET['produkID'] == 'undefined'){
    echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Silahkan Pilih Produk Terlebih Dahulu</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
    ';
}
else if($_GET['metode'] == 'undefined'){
    echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Silahkan Pilih Metode Pembayaran Terlebih Dahulu</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
    ';
}
else if($_GET['noHp'] == ''){
    echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Silahkan Isi Nomor Whatsapp Anda Terlebih Dahulu</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
    ';
}
else if($_GET['noHp'] == '' || $_GET['produkID'] == '' || $_GET['metode'] == ''){
    echo '
        <div class="modal-body pt-5 pb-5 text-center">
          <i class="fa fa-exclamation-triangle fa-5x mb-3" style="font-size: 100px;"></i><br>
          <p style="font-size: 18px;">Silahkan Pesanan Anda Terlebih Dahulu</p>
          <button type="button" class="btn btn-primary btn-lg mt-3" data-dismiss="modal">OK</button>
        </div>
    ';
}
else {
  $voucher = $_GET['voucher'];
  if($voucher != ''){
    $getVoucher = mysqli_query($conn,"SELECT * FROM `tb_reward` WHERE title = '$voucher' AND status = 1") or die(mysqli_error());
    $gvv = mysqli_num_rows($getVoucher);
    if($gvv == 0){
      $apa = 'Voucher Tidak Valid';
      $potongan = 0;
    }
    else {
      $gv = mysqli_fetch_array($getVoucher);
      $apa = $voucher;
      $potongan = $gv['nominal'];
    }
  }
  $produkID = $_GET['produkID'];
  $kabupaten = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE id = '$produkID' ORDER BY id ASC");
  $kabupaten_row = mysqli_fetch_array($kabupaten);
  $kategori = $kabupaten_row['kategori'];
  $sql_12 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE kategori = '$kategori'") or die(mysqli_error());
  $s12 = mysqli_fetch_array($sql_12);
?>
<div class="modal-header">
  <h5 class="modal-title">Data Pesanan</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<form role="form" id="search_form" action="<?php echo $urlweb; ?>/order_premium.php" method="POST">
  <div class="modal-body text-center">
    <table style="width: 100%;">
      <tbody>
                         
        <tr>
          <td class="text-left pt-2 pb-2" style="width: 45%!important; border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">Kategori Layanan:</td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">
            <?php echo $kabupaten_row['kategori']; ?>
            <input type="hidden" class="form-control" name="produkID" value="<?php echo $_GET['produkID']; ?>" readonly>
          </td>
        </tr>
        <tr>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">Nominal Layanan:</td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">
            <?php echo $kabupaten_row['title']; ?>
          </td>
        </tr>
        <tr>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">UserID:</td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">
            <?php echo $_GET['userID']; ?>
            <input type="hidden" class="form-control" name="userID" value="<?php echo $_GET['userID']; ?>">
            <input type="hidden" class="form-control" name="zone_id" value="<?php echo str_replace('_',' ',$_GET['zoneID']); ?>">
          </td>
        </tr>
        <tr>
          <td class="text-left pt-2 pb-2" style="width: 45%!important; border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">Kode Voucher:</td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">
            <?php if($voucher == ''){ echo 'Tidak Ada Voucher Digunakan'; } else { echo $apa; } ?>
            <input type="hidden" class="form-control" name="voucher" value="<?php if($voucher == ''){ echo ''; } else { echo $apa; } ?>" readonly>
          </td>
        </tr>
        <tr>
          <td class="text-left pt-2 pb-2" style="width: 45%!important; border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">Discount:</td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">
            <?php if($voucher == ''){ echo 'Tidak Ada Voucher Digunakan'; } else { echo $potongan; } ?>
            <input type="hidden" class="form-control" name="potongan" value="<?php if($voucher == ''){ echo 0; } else { echo $potongan; } ?>" readonly>
          </td>
        </tr>
        <tr>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">Metode Pembayaran:</td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; white-space: normal; word-break: normal; color: #fff;">
            <?php
              $explode = str_replace('.png','',$_GET['metode']);
              $explodes = explode('_',$explode);
              echo $explodes[1];
            ?>
            <input type="hidden" class="form-control" name="metode" value="<?php echo $_GET['metode']; ?>">
          </td>
        </tr>
        <tr>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #fff;"></td>
          <td class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #fff;">
            <input type="hidden" name="IDuser" class="form-control" value="<?php echo $_GET['IDuser']; ?>">
            <input type="hidden" name="no_hp" class="form-control" value="<?php echo $_GET['noHp']; ?>">
          </td>
        </tr>
        <tr>
          <td colspan="2" class="text-left pt-2 pb-2" style="border: 0!important; vertical-align: middle; color: #fff;">
            Pastikan data Tujuan Anda sudah benar. Kesalahan input data Tujuan bukan tanggung jawab kami.
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
    <button type="submit" name="submit" id="buttonSubmit" class="btn btn-primary">Lanjutkan Pembayaran</button>
  </div>
</form>
<?php } ?>