<?php
ob_start();
session_start();
include('config/koneksi.php');
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);

error_reporting(0);
if($_GET['id']){
    $produkID = $_GET['id'];
    $kabupaten = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE id = '$produkID' ORDER BY id ASC");
    $kabupaten_row = mysqli_fetch_array($kabupaten);
    if(isset($_SESSION['user'])){
      $usernya = $_SESSION['user'];
      $cekUser = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$usernya'");
      $cu = mysqli_fetch_array($cekUser);
      if($cu['level'] == 'reseller'){
        $harga = $kabupaten_row['harga_reseller'];
      }
      else {
        $harga = $kabupaten_row['harga_jual'];
      }
    }  
    else {
      $harga = $kabupaten_row['harga_jual'];
    }
    
    $cekmutasi = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 7") or die(mysqli_error());
    $cm = mysqli_fetch_array($cekmutasi);
    if($cm['status'] == 1){
      echo '
        <div class="col-12">
          <h5>Bank Transfer</h5>
        </div>
      ';
      $sql_bank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE userID = 1 ORDER BY id ASC") or die(mysqli_error());
      $noe = 0;
      while($sb = mysqli_fetch_array($sql_bank)){
        $noe ++;
    ?>
    <div class="col-sm-6 col-12">
      <input class="radio-nominal" type="radio" name="metode" value="Direct_<?php echo $sb['image']; ?>_7" id="flexRadioDefault<?php echo $noe; ?>a">
      <label for="flexRadioDefault<?php echo $noe; ?>a">
        <div class="row ml-2 mr-2 pb-0">
          <img src="<?php echo $urlweb; ?>/upload/<?php echo $sb['image']; ?>" class="card img-fluid mb-1" style="display: block; width: auto; width: 100px; height: 40px;">
        </div>
        <div class="row ml-2 mr-2 pt-0">
          <p style="font-weight: normal;"><?php echo $sb['akun']; ?></p>
        </div>
        <div class="row ml-2 mr-2 pb-0 pt-0">
          <p class="mb-0" style="font-weight: bold; font-size: 13px;">Rp. <?php echo number_format($harga); ?></p>
        </div>
      </label>
    </div>
    <?php }} ?> 
    <div class="col-12">
      <h5>Virtual Account atau E-Wallet</h5>
    </div>
            
    <?php
      $cekVa = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE jenis = 0 AND status = 1") or die(mysqli_error());
      $cv = mysqli_fetch_array($cekVa);
      if($cv['id'] == 1){
        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $tripayApi = $s5['api_key'];
        $apiKey = $s5['api_key'];
        $curls = curl_init();
                                 
        curl_setopt_array($curls, array(
          CURLOPT_FRESH_CONNECT     => true,
          CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
          CURLOPT_RETURNTRANSFER    => true,
          CURLOPT_HEADER            => false,
          CURLOPT_HTTPHEADER        => array(
            "Authorization: Bearer ".$apiKey
          ),
          CURLOPT_FAILONERROR       => false
        ));
                                 
        $responses = curl_exec($curls);
        $errs = curl_error($curls);
        curl_close($curls);
        //echo !empty($err) ? $err : $responses;
        $hasils = json_decode($responses, true);
        for ($i=0; $i < count($hasils['data']); $i++) {
          if($hasils['data'][$i]['active'] == 'true'){
            $fee_flat = $hasils['data'][$i]['total_fee']['flat'];
            $percent = $hasils['data'][$i]['total_fee']['percent']/100;
            $percent2 = round($harga * $percent);
            $total_harga = $harga + $fee_flat + $percent2;
    ?>
    <div class="col-sm-6 col-12">             
      <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
      <label for="flexRadioDefault<?php echo $i; ?>">
      <div class="row ml-2 mr-2 pb-0">
        <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="card img-fluid mb-1" style="display: block; width: auto; width: 100px; height: 40px;">
      </div>
      <div class="row ml-2 mr-2 pt-0 pb-1">
        <p class="mb-0" style="font-weight: normal;"><?php echo $hasils['data'][$i]['name']; ?></p>
      </div>
      <div class="row ml-2 mr-2 pb-0 pt-0">
        <p class="mb-0" style="font-weight: bold; font-size: 13px;">Rp. <?php echo number_format($total_harga); ?></p>
      </div>
    </label>
                    
  </div>
  <?php
        }
      }
    }
    else if($cv['id'] == 2){
  ?>
  <div class="col-sm-6 col-12">
    <input type="hidden" name="paymentID" id="paymentID" value="2">
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
      for ($i=0; $i < count($hasils['paymentFee']); $i++) {
  ?>
  <div class="col-sm-6 col-12">
    <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['paymentFee'][$i]['paymentMethod']; ?>_<?php echo $hasils['paymentFee'][$i]['paymentName']; ?>_3" id="flexRadioDefault<?php echo $i; ?>">
    <label for="flexRadioDefault<?php echo $i; ?>">
      <div class="row ml-2 mr-2 pb-0">
        <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="card img-fluid mb-1" style="display: block; width: auto; width: 100px; height: 40px;">
      </div>
      <div class="row ml-2 mr-2 pt-0">
        <p style="font-weight: normal;"><?php echo $hasils['paymentFee'][$i]['paymentName']; ?></p>
      </div>
      <div class="row ml-2 mr-2 pb-0 pt-0">
        <p class="mb-0" style="font-weight: bold; font-size: 13px;">Rp. <?php echo number_format($harga); ?></p>
      </div>
    </label>
                 
  </div>
  <?php
      }
    }
  ?>
  <div class="alert alert-success alert-dismissible m-2" role="alert">
    <div class="alert-message text-center">
      <a class="text-dark"><strong>Perhatian!!</strong> Apabila Nominal yang Anda pilih kurang dari 10.000 silahkan menggunakan metode pembayaran QRIS.</a>
    </div>
  </div>
<?php
}
?>