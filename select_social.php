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
    $postID = $_GET['id'];
    $qty = $_GET['qty'];
    $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_produk_social` WHERE id = '$postID'") or die(mysqli_error());
    $s3 = mysqli_fetch_array($sql_3);
    if(isset($_SESSION['user'])){
      $usernya = $_SESSION['user'];
      $cekUser = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$usernya'");
      $cu = mysqli_fetch_array($cekUser);
      if($cu['level'] == 'reseller'){
        $aa = $s3['harga_reseller']/1000;
      }
      else {
        $aa = $s3['harga_jual']/1000;
      }
    }  
    else {
      $aa = $s3['harga_jual']/1000;
    }
    $harga = round($aa*$qty);
    
    $cekmutasi = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 7") or die(mysqli_error());
    $cm = mysqli_fetch_array($cekmutasi);
    if($cm['status'] == 1){
?>
                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0 pr-2" id="headingOne">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="zmdi zmdi-balance" style="font-size: 18px;"></i>&nbsp; Bank Transfer
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
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
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="Direct_<?php echo str_replace('.png','',$sb['image']); ?>_7" id="flexRadioDefault<?php echo $noe; ?>a">
                              <label for="flexRadioDefault<?php echo $noe; ?>a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/<?php echo $sb['image']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
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
                      <div class="card-header pt-1 pb-0 pr-2" id="headingTwo">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
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
                                    $fee_flat = $hasils['data'][$i]['total_fee']['flat'];
                                    $percent = $hasils['data'][$i]['total_fee']['percent']/100;
                                    $percent2 = round($harga * $percent);
                                    $total_harga = $harga + $fee_flat + $percent2;
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
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
                      <div class="card-header pt-1 pb-0 pr-2" id="headingThree">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="zmdi zmdi-store" style="font-size: 18px;"></i>&nbsp; Convenience Store
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <?php
                              $total_harga = $harga + 6000;
                            ?>
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
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
                                    $fee_flat = $hasils['data'][$i]['total_fee']['flat'];
                                    $percent = $hasils['data'][$i]['total_fee']['percent']/100;
                                    $percent2 = round($harga * $percent);
                                    $total_harga = $harga + $fee_flat + $percent2;
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
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
                      <div class="card-header pt-1 pb-0 pr-2" id="headingFour">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; E-Wallet
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <?php
                              $a = round($harga * 0.7)/100;
                              $total_harga = $harga + 750 + $a;
                            ?>
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
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
                                    $fee_flat = $hasils['data'][$i]['total_fee']['flat'];
                                    $percent = $hasils['data'][$i]['total_fee']['percent']/100;
                                    $percent2 = round($harga * $percent);
                                    $total_harga = $harga + $fee_flat + $percent2;
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>_1" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
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
                      <div class="card-header pt-1 pb-0 pr-2" id="headingTwo">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
                          </div>
                        </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_bca_2" id="flexRadioDefault201a">
                              <label for="flexRadioDefault201a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 13px;"><?php echo number_format($harga); ?></p>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;">BCA Virtual Account<br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_bni_2" id="flexRadioDefault202a">
                              <label for="flexRadioDefault202a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;">BNI Virtual Account<br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_bri_2" id="flexRadioDefault203a">
                              <label for="flexRadioDefault203a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;">BRI Virtual Account<br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_mandiri_2" id="flexRadioDefault204a">
                              <label for="flexRadioDefault204a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;">MANDIRI Virtual Account<br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
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
                      <div class="card-header pt-1 pb-0 pr-2" id="headingThree">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; E-Wallet
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
                          </div>
                        </div>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="VA_QRIS_2" id="flexRadioDefault205a">
                              <label for="flexRadioDefault205a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/linkaja.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                        <div class="col-6 p-1 text-right">
                                          <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 p-1">
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
                      <div class="card-header pt-1 pb-0 pr-2" id="headingTwo">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account & E-Wallet
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
                          </div>
                        </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              for ($i=0; $i < count($hasils['paymentFee']); $i++) {
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['paymentFee'][$i]['paymentMethod']; ?>_<?php echo str_replace(' ','',$hasils['paymentFee'][$i]['paymentName']); ?>_3" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>">
                                <div class="row ml-2 mr-2 pb-0">
                                  <div class="col-6 p-1">
                                    <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                        <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                    </div>
                                  </div>
                                  <div class="col-6 p-1 text-right">
                                    <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                  </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                  <div class="col-12 p-1">
                                      <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                      <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['paymentFee'][$i]['paymentName']; ?><br>
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
                              <?php
                                  for ($i=0; $i < 4; $i++) {
                              ?>
                              <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                              <?php } ?>
                          </div>
                      </div>
                    </div>
                    <?php
                      }
                    ?>
                    <?php
                        if(isset($_SESSION['user'])){
                    ?>
                    <div class="card box_game mb-1" style="border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;">
                      <div class="card-header pt-1 pb-0 pr-2" id="headingFive">
                        <div class="row">
                          <div class="col-8 pr-0">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; Saldo
                              </button>
                            </h2>
                          </div>
                          <div class="col-4 text-right">
                            <p class="mb-0 mt-2" style="font-weight: bold; font-size: 13px; color: #fff;"></p>
                          </div>
                        </div>
                      </div>
                      <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              $sql_user = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '".$_SESSION['user']."'") or die(mysqli_error());
                              $su = mysqli_fetch_array($sql_user);
                              $usersID = $su['id'];
                              $sql_balance = mysqli_query($conn,"SELECT * FROM `tb_balance` WHERE userID = '$usersID'") or die(mysqli_error());
                              $sb = mysqli_fetch_array($sql_balance);
                              if($sb['active'] > $harga){
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="saldo_Saldo" id="flexRadioDefault500a">
                              <label for="flexRadioDefault500a">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1"><img src="<?php echo $urlweb; ?>/upload/balance.png" class="card img-fluid mb-1" style="display: block; background: none; height: 50px;"></div>
                                    <div class="col-6 p-1 text-right">
                                      <p class="mb-0" style="font-weight: bold; font-size: 10px;"><?php echo number_format($harga); ?></p>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 pl-1 pr-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                      <p style="font-weight: normal; font-size: 10px;">Saldo<br>
                                      <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                      <div class="alert alert-success alert-dismissible m-2" role="alert">
                                        <div class="alert-message text-center">
                                          <a class="text-dark" style="text-transform: none;">Saldo Tersedia<strong> Rp. <?php echo number_format($sb['active']); ?></strong></a>
                                        </div>
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
                          
                      </div>
                    </div>
                    <?php } ?>

  <div class="alert alert-success alert-dismissible m-2" role="alert">
    <div class="alert-message text-center">
      <a class="text-dark"><strong>Perhatian!!</strong> Apabila Nominal yang Anda pilih kurang dari 10.000 silahkan menggunakan metode pembayaran QRIS.</a>
    </div>
  </div>
<?php
}
?>
