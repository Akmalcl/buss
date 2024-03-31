<?php
error_reporting(E_ALL);
require_once('session.php');

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

$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_4);
$privateKey = $s4['private_key'];
$tripayApi = $s4['api_key'];
$tripayCode = $s4['merchant_code'];

$sql_1b = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = 1") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$sellerPhone = substr($s1b['no_hp'],1);
$sellerWa = $s1b['no_hp'];
    
$usersID = $u['id'];
$amounts = $_POST['nominal'];
$abc = $_POST['metode'];
$explode_payment = explode('_',$abc);
$metode = $explode_payment[0];
$metodeBayar = $explode_payment[1];
$paymentID = $explode_payment[2];
    
$getUSer = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = '$usersID'") or die(mysqli_error($conn));
$gu = mysqli_fetch_array($getUSer);
$full_name = $gu['full_name'];
$email = $gu['email'];
$noHp = $gu['no_hp'];
    
$subtotal = $amounts;

$today = date('Y-m-d');
$sql_3 = mysqli_query($conn,"SELECT * FROM `tb_transaksi` ORDER BY id DESC LIMIT 1") or die(mysqli_error($conn));
$s33 = mysqli_num_rows($sql_3);
if($s33 == 0){
    $unikID = 0;
}
else {
    $s3 = mysqli_fetch_array($sql_3);
    $unikID = $s3['id'];
}
$kd_transaksi = 'INV/'.date('y').'/'.date('m').'/'.date('s').$unikID;
$unik = date('Hs');
$kode_unik = substr(str_shuffle(1234567890),0,3);
$orderid = $kode_unik.date('dis');
$created_date = date('Y-m-d H:i:s');

$subtotale = $subtotal + $kode_unik;

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

            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());
            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES('$usersID', '$reference', '$merchant_ref', '$payment_method', '$payment_name', '$customer_email', '$customer_phone', '$amount', '$fee', '$amount_total', '$pay_code', '$checkout_url', '$status', '0000-00-00 00:00:00', '$expired_time', '0', 0, '$created_date')") or die(mysqli_error($conn));
            $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
            $cf = mysqli_fetch_array($cekFonnte);
            if($cf['status'] == 1){
                $content = '*Terima Kasih telah menggunakan layanan kami *
Silahkan melakukan pembayaran sesuai dengan nominal, nomor rekening, dan bank dibawah ini:
                                
*Nominal :* Rp. ' . $amount_total . '
*Bank :* ' . $payment_method . '
*Rekening :* ' . $pay_code . '
*Berlaku Sampai :* ' . $expired_time . '
                                                
Jika kamu sudah melakukan pembayaran, Saldo akun Anda otomatis akan ditambahkan
                                
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
            $body['product']      = array('Top Up');
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
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());
                $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES('$usersID', '$transactionID', '$kd_transaksi', '$Via_$Channel', '$PaymentName', '$email', '$noHp', '$subtotal', '$adminFee', '$amount_total', '$pay_code', '', 'UNPAID', '0000-00-00 00:00:00', '$Expired', '0', 1, '$created_date')") or die(mysqli_error($conn));
                $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
                $cf = mysqli_fetch_array($cekFonnte);
                if($cf['status'] == 1){
                    $content = '*Terima Kasih telah menggunakan layanan kami *
Silahkan melakukan pembayaran sesuai dengan nominal, nomor rekening, dan bank dibawah ini:
                                
*Nominal :* Rp. ' . $amount_total . '
*Bank :* ' . $metodeBayar . '
*Rekening :* ' . $pay_code . '
*Berlaku Sampai :* ' . $Expired . '
                                                
Jika kamu sudah melakukan pembayaran, Saldo akun Anda otomatis akan ditambahkan
                                
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
                
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());

                $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$usersID', '$reference', '$kd_transaksi', '$metode', '$full_name', '$email', '$noHp', '$subtotal', '0', '$subtotal', '$vaNumber', '$paymentUrl', '$statusCode', '0000-00-00 00:00:00', '$expired_time', '0', 1, '$created_date')") or die(mysqli_error($conn));
                $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
                $cf = mysqli_fetch_array($cekFonnte);
                if($cf['status'] == 1){
                    $content = '*Terima Kasih telah menggunakan layanan kami *
Silahkan melakukan pembayaran sesuai dengan nominal, nomor rekening, dan bank dibawah ini:
                                
*Nominal :* Rp. ' . $amount_total . '
*Bank :* ' . $metodeBayar . '
*Rekening :* ' . $vaNumber . '
*Berlaku Sampai :* ' . $expired_time . '
                                                
Jika kamu sudah melakukan pembayaran, Saldo akun Anda otomatis akan ditambahkan
                                
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
else if($paymentID == 7){
        if($metodeBayar == 'BCAVA'){
            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$usersID', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Central Asia (BCA)', '$email', '$noHp', '$subtotal', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 1, '$created_date')") or die(mysqli_error($conn));
        }
        else if($metodeBayar == 'BNIVA'){
            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$usersID', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Negara Indonesia (BNI)', '$email', '$noHp', '$subtotal', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 1, '$created_date')") or die(mysqli_error($conn));
        }
        else if($metodeBayar == 'BRIVA'){
            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$usersID', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Rakyat Indonesia (BRI)', '$email', '$noHp', '$subtotal', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 1, '$created_date')") or die(mysqli_error($conn));
        }
        else if($metodeBayar == 'MANDIRIVA'){
            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Top Up Saldo','$amount',0,'Top Up Saldo', '0','1','$metode','$usersID',0)") or die(mysqli_error());

            $insert_tripay = mysqli_query($conn,"INSERT INTO `tb_tripay` 
                (`userID`, `reference`, `merchant_ref`, `payment_method`, `payment_name`, `customer_email`, `customer_phone`, `amount`, `fee`, `amount_total`, `pay_code`, `checkout_url`, `status`, `paid_time`, `expired_time`, `providerID`, `jenis_transaksi`, `created_date`) VALUES 
                ('$usersID', '', '$kd_transaksi', 'Direct_$metodeBayar', 'Bank Mandiri (MANDIRI)', '$email', '$noHp', '$subtotal', '$kode_unik', '$subtotale', '', '', 'UNPAID', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0', 1, '$created_date')") or die(mysqli_error($conn));
        }
        header('Location:../payment/?trxID='.$kd_transaksi);
        exit();
}  
    
?>