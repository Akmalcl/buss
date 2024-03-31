<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Jakarta");
include('config/koneksi.php');
$sids = session_id();
$ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE id_session = '$sids'") or die(mysqli_error());
$cs = mysqli_num_rows($ceksession);
if($cs == 0){
    $sid = session_id();
}
else{
    session_regenerate_id();
    $sid = session_id();
}

$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];

$sql_1b = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = 1") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$sellerPhone = substr($s1b['no_hp'],1);
$sellerWa = $s1b['no_hp'];

$unik = date('Hs');
$kode_unik = substr(str_shuffle(1234567890),0,3);
$kd_transaksi = 'INV'.$unik.$kode_unik.'PAY';
    
$userID = $_POST['userID'];
if(isset($_POST['zone_id'])){
    $zone_id = $_POST['zone_id'];
}
else {
    $zone_id = '';
}
if(isset($_POST['nickname'])){
    $nickname = str_replace(array( "’","'" ),"&apos;",$_POST['nickname']);
}
else {
    $nickname = '';
}

$last_id = $_POST['IDuser'];
$produkID = $_POST['produkID'];
$sql_1 = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE id = '$produkID'") or die(mysqli_error());
$s1 = mysqli_fetch_array($sql_1);
$productCode = $s1['code'];
$productCategory = $s1['kategori'];
$productTitle = $s1['title'];
$jenisnya = $s1['jenis'];

$voucher = $_POST['voucher'];
$potongan = $_POST['potongan'];
$abc = $_POST['metode'];
$explode_payment = explode('_',$abc);
$metode = $explode_payment[0];
$metodeBayar = $explode_payment[1];
$paymentID = $explode_payment[2];
$sql_11 = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = '$last_id'") or die(mysqli_error());
$s11 = mysqli_fetch_array($sql_11);
$email = $s11['email'];
$full_name = $s11['full_name'];
$explode = explode(' ',$full_name);
$noHp = $_POST['no_hp'];
$level = $s11['level'];
if($level == 'reseller'){
    $harga = $s1['harga_reseller'];
}
else {
    $harga = $s1['harga_jual'];
}

$subtotal = $harga - $potongan;
$subtotale = ($harga - $potongan) + $kode_unik;
$created_date = date('Y-m-d H:i:s');
$created_dates = date('Y-m-d');

    if($paymentID == 1){

        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $privateKey = $s5['private_key'];
        $tripayApi = $s5['api_key'];
        $tripayCode = $s5['merchant_code'];

        $cektrx = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE merchant_ref = '$kd_transaksi'") or die(mysqli_error($conn));
        $ct = mysqli_num_rows($cektrx);
        if($ct == 0){
            $signature = hash_hmac('sha256', $tripayCode.$kd_transaksi.$subtotal, $privateKey);
            $data = [
                'method'            => $metode,
                'merchant_ref'      => $kd_transaksi,
                'amount'            => $subtotal,
                'customer_name'     => $full_name,
                'customer_email'    => $email,
                'customer_phone'    => $noHp,
                'order_items'       => [
                    [
                        'sku'         => $kd_transaksi,
                        'name'        => 'Pembayaran Nomor Transaksi '.$kd_transaksi,
                        'price'       => $subtotal,
                        'quantity'    => 1
                    ]
                ],
                'callback_url'      => $urlweb.'/tripay_response.php',
                'return_url'        => $urlweb,
                'expired_time'      => (time()+(24*60*60)), // 24 jam
                'signature'         => $signature
            ];
                                                            
            $curl = curl_init();
                                           
            curl_setopt_array($curl, array(
                CURLOPT_FRESH_CONNECT     => true,
                CURLOPT_URL               => "https://tripay.co.id/api/transaction/create",
                CURLOPT_RETURNTRANSFER    => true,
                CURLOPT_HEADER            => false,
                CURLOPT_HTTPHEADER        => array(
                    "Authorization: Bearer ".$tripayApi
                ),
                CURLOPT_FAILONERROR       => false,
                CURLOPT_POST              => true,
                CURLOPT_POSTFIELDS        => http_build_query($data)
            ));
                                                                                                        
            $response = curl_exec($curl);
            $err = curl_error($curl);
                                                                                                        
            curl_close($curl);                                                           
            $hasil = json_decode($response, true);

            echo $response;                                                            
            echo $hasil; 
            echo $err; 

            $reference = $hasil['data']['reference'];
            $merchant_ref = $hasil['data']['merchant_ref'];
            $payment_method = $hasil['data']['payment_method'];
            $payment_name = $hasil['data']['payment_name'];
            $customer_email = $hasil['data']['customer_email'];
            $customer_phone = $hasil['data']['customer_phone'];
            $amount = $subtotal;
            $fee = $hasil['data']['total_fee'];
            $amount_total = $subtotal+ $fee;
            $pay_code = $hasil['data']['pay_code'];
            $checkout_url = $hasil['data']['checkout_url'];
            $status = $hasil['data']['status'];
            $expired_time = date('Y-m-d H:i:s', strtotime('+1 days'));

            $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));
            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES('$last_id', '$reference', '$merchant_ref', '$payment_method', '$payment_name', '$customer_email', '$customer_phone', '$amount', '$fee', '$amount_total', '$pay_code', '$checkout_url', '$status', '0000-00-00 00:00:00', '$expired_time', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));

            $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
            $cf = mysqli_fetch_array($cekFonnte);
            if($cf['status'] == 1){
                $content = '*Terima Kasih telah memesan *' . $productTitle . '* *' . $userID . '*
Silahkan melakukan pembayaran sesuai dengan nominal, nomor rekening, dan bank dibawah ini:
                                
*Nominal :* Rp. ' . $amount_total . '
*Bank :* ' . $payment_method . '
*Rekening :* ' . $pay_code . '
*Berlaku Sampai :* ' . $expired_time . '
                                                
Jika kamu sudah melakukan pembayaran, silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $kd_transaksi . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$sellerWa;
            
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.fonnte.com/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => array(
                       'target' => $noHp,
                       'message' => $content,
                       'countryCode' => '62'),
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: ".$cf['api_key']
                    ),
                ));
            
                $response = curl_exec($curl);
                
                
                curl_close($curl);
                //echo $response;
                sleep(1); #do not delete!
            }
            header('Location:../payment/?trxID='.$kd_transaksi);
            exit();
        }
        else {
            header('Location:../payment/?trxID='.$kd_transaksi);
            exit();
        }
    }
    else if($paymentID == 2){

        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 2") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $privateKey = $s5['private_key'];
        $tripayApi = $s5['api_key'];
        $tripayCode = $s5['merchant_code'];

        $cektrx = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE merchant_ref = '$kd_transaksi'") or die(mysqli_error($conn));
        $ct = mysqli_num_rows($cektrx);
        if($ct == 0){
            $url = 'https://my.ipaymu.com/api/v2/payment/direct'; // for production mode
            $method = 'POST'; //method
            $body['name']    = $full_name;
            $body['phone']    = $noHp;
            $body['email']    = $email;
            $body['amount']      = $subtotal;
            $body['product']      = array($productTitle);
            $body['qty']      = array('1');
            $body['notifyUrl']  = $urlweb.'/ipaymu_response.php';
            $body['expired']    = '1';
            $body['expiredType']    = 'hours';
            $body['referenceId']    = $kd_transaksi;
            $body['paymentMethod']    = $metode;
            $body['paymentChannel']    = $metodeBayar;

            //Generate Signature
            // *Don't change this
            $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
            $requestBody  = strtolower(hash('sha256', $jsonBody));
            $stringToSign = strtoupper($method) . ':' . $tripayApi . ':' . $requestBody . ':' . $privateKey;
            $signature    = hash_hmac('sha256', $stringToSign, $privateKey);
            $timestamp    = Date('YmdHis');
            //End Generate Signature

            $ch = curl_init($url);

            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json',
                'va: ' . $tripayApi,
                'signature: ' . $signature,
                'timestamp: ' . $timestamp
            );

            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            curl_setopt($ch, CURLOPT_POST, count($body));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $err = curl_error($ch);
            $ret = curl_exec($ch);
            curl_close($ch);
            
            echo $ret;
            $hasil = json_decode($ret, true);
            $transactionID = $hasil['Data']['TransactionId'];
            $pay_code = $hasil['Data']['PaymentNo'];
            $PaymentName = $hasil['Data']['PaymentName'];
            $adminFee = $hasil['Data']['Fee'];
            $Expired = $hasil['Data']['Expired'];
            $Via = $hasil['Data']['Via'];
            $Channel = $hasil['Data']['Channel'];
            $amount_total = $subtotal + $adminFee;

            if($hasil['Success'] == 'true'){
                $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));
                $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES('$last_id', '$transactionID', '$kd_transaksi', '$Via_$Channel', '$PaymentName', '$email', '$noHp', '$subtotal', '$adminFee', '$amount_total', '$pay_code', '', 'UNPAID', '0000-00-00 00:00:00', '$Expired', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));

                $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
                $cf = mysqli_fetch_array($cekFonnte);
                if($cf['status'] == 1){
                    $content = '*Terima Kasih telah memesan *' . $productTitle . '* *' . $userID . '*
Silahkan melakukan pembayaran sesuai dengan nominal, nomor rekening, dan bank dibawah ini:
                                    
*Nominal :* Rp. ' . $amount_total . '
*Bank :* ' . $metodeBayar . '
*Rekening :* ' . $pay_code . '
*Berlaku Sampai :* ' . $Expired . '
                                                    
Jika kamu sudah melakukan pembayaran, silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $kd_transaksi . '*
                                   
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$sellerWa;
                
                    $curl = curl_init();
            
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.fonnte.com/send",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                           'target' => $noHp,
                           'message' => $content,
                           'countryCode' => '62'),
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: ".$cf['api_key']
                        ),
                    ));
                
                    $response = curl_exec($curl);
                    
                    
                    curl_close($curl);
                    //echo $response;
                    sleep(1); #do not delete!
                }
            }

            header('Location:../payment/?trxID='.$kd_transaksi);
            exit();
        }
        else {
            header('Location:../payment/?trxID='.$kd_transaksi);
            exit();
        }

    }
    else if($paymentID == 3){

        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 3") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $privateKey = $s5['private_key'];
        $tripayApi = $s5['api_key'];
        $tripayCode = $s5['merchant_code'];
        $callbackUrl = $urlwebs.'/duitku_response/'; // url untuk callback
        $returnUrl = $urlwebs; // url untuk redirect
        $expiryPeriod = 60;

        $cektrx = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE merchant_ref = '$kd_transaksi'") or die(mysqli_error($conn));
        $ct = mysqli_num_rows($cektrx);
        if($ct == 0){
            $signature = md5($tripayCode . $kd_transaksi . $subtotal . $tripayApi);
            $catatan = 'Pembelian dengan No. Pesanan '.$kd_transaksi;

            $customerDetail = array(
                'firstName' => $explode[0],
                'lastName' => $explode[1],
                'email' => $email,
                'phoneNumber' => $noHp,
                'billingAddress' => '',
                'shippingAddress' => ''
            );
    
            $params = array(
                'merchantCode' => $tripayCode,
                'paymentAmount' => $subtotal,
                'paymentMethod' => $metode,
                'merchantOrderId' => $kd_transaksi,
                'productDetails' => $catatan,
                'additionalParam' => '',
                'merchantUserInfo' => '',
                'customerVaName' => $full_name,
                'email' => $email,
                'phoneNumber' => $noHp,
                'itemDetails' => '',
                'customerDetail' => $customerDetail,
                'callbackUrl' => $callbackUrl,
                'returnUrl' => $returnUrl,
                'signature' => $signature,
                'expiryPeriod' => $expiryPeriod
            );
    
            $params_string = json_encode($params);
            echo $params_string;
            $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry';
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
    
            //execute post
            $request = curl_exec($ch);
            $err = curl_error($curl);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($httpCode == 200){
                $result = json_decode($request, true);
                //header('location: '. $result['paymentUrl']);
                $paymentUrl = $result['paymentUrl'];
                $reference = $result['reference'];
                $vaNumber = $result['vaNumber'];
                $statusMessage = $result['statusCode'];
                if($statusMessage == 00){
                    $statusCode = 'SUCCESS';
                }
                else if($statusMessage == 01){
                   $statusCode = 'PENDING'; 
                }
                else if($statusMessage == 02){
                    $statusCode = 'EXPIRED';
                }
                
                $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));

                $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$last_id', '$reference', '$kd_transaksi', '$metode', '$metodeBayar', '$email', '$noHp', '$harga', '0', '$subtotal', '$vaNumber', '$paymentUrl', '$statusCode', '0000-00-00 00:00:00', '$expired_time', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));
            }

            $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
            $cf = mysqli_fetch_array($cekFonnte);
            if($cf['status'] == 1){
                $content = '*Terima Kasih telah memesan *' . $productTitle . '* *' . $userID . '*
Silahkan melakukan pembayaran sesuai dengan nominal, nomor rekening, dan bank dibawah ini:
                                
*Nominal :* Rp. ' . $subtotal . '
*Bank :* ' . $metodeBayar . '
*Rekening :* ' . $vaNumber . '
*Berlaku Sampai :* ' . $expired_time . '
                                                
Jika kamu sudah melakukan pembayaran, silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $kd_transaksi . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$sellerWa;
            
                $curl = curl_init();
        
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.fonnte.com/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => array(
                       'target' => $noHp,
                       'message' => $content,
                       'countryCode' => '62'),
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: ".$cf['api_key']
                    ),
                ));
            
                $response = curl_exec($curl);
                
                
                curl_close($curl);
                //echo $response;
                sleep(1); #do not delete!
            }
            header('Location:../payment/?trxID='.$kd_transaksi);
            exit();
        }
        else {
            header('Location:../payment/?trxID='.$kd_transaksi);
            exit();
        }
    }
    else if($paymentID == 7){
        if($metodeBayar == 'BCAVA'){
            $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$last_id', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Central Asia (BCA)', '$email', '$noHp', '$harga', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));
        }
        else if($metodeBayar == 'BNIVA'){
            $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$last_id', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Negara Indonesia (BNI)', '$email', '$noHp', '$harga', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));
        }
        else if($metodeBayar == 'BRIVA'){
            $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$last_id', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Rakyat Indonesia (BRI)', '$email', '$noHp', '$harga', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));
        }
        else if($metodeBayar == 'MANDIRIVA'){
            $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$harga', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 0)") or die(mysqli_error($conn));

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$last_id', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Mandiri (MANDIRI)', '$email', '$noHp', '$harga', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$jenisnya', 2, '$created_date')") or die(mysqli_error($conn));
        }
        header('Location:../payment/?trxID='.$kd_transaksi);
        exit();
    }
    else {
        if($metode == 'saldo'){
            $cekSaldo = mysqli_query($conn,"SELECT * FROM `tb_balance` WHERE userID = '$last_id'") or die(mysqli_error());
            $cs = mysqli_fetch_array($cekSaldo);
            $saldo_aktif = $cs['active'];
            if($saldo_aktif > $subtotal){
                $insert = mysqli_query($conn,"INSERT INTO `tb_order` (`id_session`, `kd_transaksi`, `produkID`, `qty`, `harga`, `kode_unik`, `potongan`, `sub_total`, `voucher`, `kategori`, `title`, `userID`, `zoneID`, `nickname`, `trxID`, `services`, `status_order`, `note`, `full_name`, `email`, `no_hp`, `metode`, `created_date`, `providerID`, `jenis`, `id_user`, `status`) VALUES ('$sid', '$kd_transaksi', '$produkID', 1, '$subtotal', '$kode_unik', '$potongan', '$subtotal', '$voucher', '$productCategory', '$productTitle', '$userID', '$zone_id', '$nickname', '', '$productCode', '', '', '$full_name', '$email', '$noHp', '$metode', '$created_date', '$jenisnya', 2, '$last_id', 1)") or die(mysqli_error($conn));
                $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active - $subtotal, `pending` = pending + $subtotal WHERE userID = '$last_id'") or die(mysqli_error($conn));
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Pembelian Produk $productTitle','$subtotal',0,'Pembelian Produk $productTitle', '$jenisnya','2','saldo','$last_id',1)") or die(mysqli_error());
                
                if($jenisnya == 4){
                    $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 4") or die(mysqli_error());
                    $s4 = mysqli_fetch_array($sql_4);
                    $apiKeys = $s4['api_key'];
                    $merchantCodes = $s4['merchant_code'];
                    $signe = $merchantCodes.$apiKeys;
                    $sign = md5($signe);
                    $curl1 = curl_init();
                                            
                    curl_setopt_array($curl1, array(
                        CURLOPT_URL => 'https://vip-reseller.co.id/api/prepaid',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array('key' => $apiKeys, 'sign' => $sign, 'type' => 'order', 'service' => $productCode, 'data_no' => $userID),
                    ));
                                        
                    $response1 = curl_exec($curl1);
                                        
                    curl_close($curl1);
                    $hasil = json_decode($response1, true);
                    $orderid = $hasil['data']['trxid'];
                    $order_status = $hasil['data']['status'];
                    if($hasil['result'] == 'true'){
                        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, `trxID` = '$orderid', status_order = '$order_status' WHERE kd_transaksi = '$kd_transaksi'") or die(mysqli_error($conn));
                    }
                    else {
                        $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$harga', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$order_status' WHERE kd_transaksi = '$kd_transaksi'") or die(mysqli_error($conn));
                        $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Pengembalian Dana','$subtotal',0,'Pengembalian Dana','$jenisnya','1','saldo','$userID',2)") or die(mysqli_error());
                    }
                }
                else if($jenisnya == 5){
                    $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
                    $s4 = mysqli_fetch_array($sql_4);
                    $apiKeys = $s4['api_key'];
                    $merchantCodes = $s4['merchant_code'];
                    $signe = $merchantCodes.$apiKeys.$kd_transaksi;
                    $sign = md5($signe);
                    $params = array(
                        'username' => $merchantCodes,
                        'buyer_sku_code' => $productCode,
                        'customer_no' => $userID,
                        'ref_id' => $kd_transaksi,
                        'sign' => $sign
                    );
                    $params_string = json_encode($params);
                    $url1 = 'https://api.digiflazz.com/v1/transaction';
                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url1); 
                    curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, $params_string);                                                                  
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);                                                                      
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, array(                                                                          
                        'Content-Type: application/json'                                                                       
                    ));   
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, FALSE);
                        
                    //execute post
                    $response1 = curl_exec($ch1);
                        
                    curl_close($ch1);
                    echo $response1;
                    $hasil = json_decode($response1, true);
                    $message = $hasil['data']['message'];
                    $order_status = $hasil['data']['status'];
                    if($order_status != 'Gagal'){
                        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$message' WHERE kd_transaksi = '$kd_transaksi'") or die(mysqli_error($conn));
                    }
                    else {
                        $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$subtotal', `pending` = pending - $subtotal WHERE userID = '$last_id'") or die(mysqli_error($conn));
                        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$message' WHERE kd_transaksi = '$kd_transaksi'") or die(mysqli_error($conn));
                        $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Pengembalian Dana $productTitle','$subtotal',0,'Pengembalian Dana $productTitle','$jenisnya','1','saldo','$last_id',2)") or die(mysqli_error());
                    }
                }

                $content_payment = '*Terima Kasih* Pembayaran dengan No.Invoice *' . $kd_transaksi . '* Telah kami terima, Pesanan Anda sedang diproses.
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $kd_transaksi . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$$sellerWa;

                $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
                $cf = mysqli_fetch_array($cekFonnte);
                if($cf['status'] == 1){
                    $curls = curl_init();
                    
                    curl_setopt_array($curls, array(
                        CURLOPT_URL => "https://api.fonnte.com/send",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => array(
                           'target' => $noHp,
                           'message' => $content_payment,
                           'countryCode' => '62'),
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: ".$cf['api_key']
                        ),
                    ));
                        
                    $response = curl_exec($curls);
                            
                            
                    curl_close($curls);
                    //echo $response;
                    sleep(1); #do not delete!
                }
                
                header('Location:../thank-you/?trxID='.$kd_transaksi);
                exit();
            }
            else {
                header('Location:../wallet/');
                exit();
            }
        }
    }
    

?>