<?php
ob_start();
session_start();
include('../config/koneksi.php');

$sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 7") or die(mysqli_error());
$s4 = mysqli_fetch_array($sql_5);
$merchantCodes = $s4['merchant_code'];
$apiKeys = $s4['api_key'];


$cekmutasi = [
    'api_signature' => $apiKeys,
];

$incomingApiSignature = isset($_SERVER['HTTP_API_SIGNATURE']) ? $_SERVER['HTTP_API_SIGNATURE'] : '';
// validasi API Signature
if (! hash_equals($cekmutasi['api_signature'], $incomingApiSignature)) {
    exit('Invalid Signature');
}

$post = file_get_contents('php://input');
$json = json_decode($post);

if (json_last_error() !== JSON_ERROR_NONE) {
    exit('Invalid JSON');
}

if ($json->action === 'payment_report') {
    foreach ($json->content->data as $data) {
        // Jumlah (2 desimal) : 50000.00
        $amount = $data->amount;

        // Berita transfer
        $description = $data->description;
        $merchantRef = $description;
        $paidTime = date('Y-m-d H:i:s');
        
        $paymentID = date('YmdHi');

        if ($type === 'credit') { // dana masuk
            $cektrx = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE amount_total = '$amount'") or die(mysqli_error());
            $ct = mysqli_fetch_array($cektrx);
              
            $merchantRef = $ct['merchant_ref'];
            $payment_method = $ct['payment_name'];
            $amount = $ct['amount'];
            $userID = $ct['userID'];
            $providerID = $ct['providerID'];
            $jenis_transaksi = $ct['jenis_transaksi'];

            $getUSer = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = '$userID'") or die(mysqli_error($conn));
            $gu = mysqli_fetch_array($getUSer);
            $no_hp = $gu['no_hp'];

            $content_payment = '*Terima Kasih* Pembayaran dengan No.Invoice *' . $merchantRef . '* Telah kami terima, Pesanan Anda sedang diproses.
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];

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
                       'target' => $no_hp,
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
            
            if($providerID == 0){
                $ceksession = mysqli_query($conn,"SELECT * FROM `tb_transaksi` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                $cs = mysqli_fetch_array($ceksession);
                $userID = $cs['userID'];
                $getUSer = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE id = '$userID'") or die(mysqli_error($conn));
                $gu = mysqli_fetch_array($getUSer);
                $full_names = $gu['full_name'];
                $email = $gu['email'];
                $no_hp = $gu['no_hp'];

                $update = mysqli_query($conn,"UPDATE `tb_transaksi` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                $update_balace = mysqli_query($conn,"UPDATE `tb_balance` SET active = active + $amount WHERE userID = '$userID'") or die(mysqli_error());
            }
            else if($providerID == 4){
                $ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                $cs = mysqli_fetch_array($ceksession);
                $full_names = $cs['full_name'];
                $email = $cs['email'];
                $no_hp = $cs['no_hp'];
                $servicess = $cs['services'];
                $dataNo = $cs['userID'];
                $dataZone = $cs['zoneID'];

                if($jenis_transaksi == 1){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());

                        $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 4") or die(mysqli_error());
                        $s4 = mysqli_fetch_array($sql_4);
                        $apiKeys = $s4['api_key'];
                        $merchantCodes = $s4['merchant_code'];
                        $signe = $merchantCodes.$apiKeys;
                        $sign = md5($signe);
                        $curl1 = curl_init();
                                            
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => 'https://vip-reseller.co.id/api/game-feature',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array('key' => $apiKeys, 'sign' => $sign, 'type' => 'order', 'service' => $servicess, 'data_no' => $dataNo, 'data_zone' => $dataZone),
                        ));
                                        
                        $response1 = curl_exec($curl1);
                                        
                        curl_close($curl1);
                        $hasil = json_decode($response1, true);
                        $orderid = $hasil['data']['trxid'];
                        $order_status = $hasil['data']['status'];
                        if($hasil['result'] == 'true'){
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, `trxID` = '$orderid', status_order = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        else {
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$harga', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana','$subtotal',0,'Pengembalian Dana', '$providerID','1','saldo','$userID',2)") or die(mysqli_error());
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                    }
                }
                else if($jenis_transaksi == 2){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                        
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
                            CURLOPT_POSTFIELDS => array('key' => $apiKeys, 'sign' => $sign, 'type' => 'order', 'service' => $servicess, 'data_no' => $dataNo),
                        ));
                                        
                        $response1 = curl_exec($curl1);
                                        
                        curl_close($curl1);
                        $hasil = json_decode($response1, true);
                        $orderid = $hasil['data']['trxid'];
                        $order_status = $hasil['data']['status'];
                        if($hasil['result'] == 'true'){
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, `trxID` = '$orderid', status_order = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        else {
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$harga', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana','$subtotal',0,'Pengembalian Dana', '$providerID','1','saldo','$userID',2)") or die(mysqli_error());
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                    }
                }
                else if($jenis_transaksi == 3){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                        
                        $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 2") or die(mysqli_error());
                        $s4 = mysqli_fetch_array($sql_4);
                        $apiKeys = $s4['api_key'];
                        $merchantCodes = $s4['merchant_code'];
                        $signe = $merchantCode.$apiKeys;
                        $sign = md5($signe);
                        $curl1 = curl_init();
                                
                        curl_setopt_array($curl1, array(
                          CURLOPT_URL => 'https://vip-reseller.co.id/api/social-media',
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'POST',
                          CURLOPT_POSTFIELDS => array('key' => $apiKeys, 'sign' => $sign, 'type' => 'order', 'service' => $servicess, 'quantity' => $qty, 'data' => $userID),
                        ));
                                
                        $response1 = curl_exec($curl1);
                                
                        curl_close($curl1);
                        $hasil = json_decode($response1, true);
                        $orderid = $hasil['data']['trxid'];
                        $order_status = $hasil['data']['status'];
                        if($hasil['result'] == 'true'){
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, `trxID` = '$orderid', status_order = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        else {
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana','$amount',0,'Pengembalian Dana', '$providerID','1','$payment_method','$userID',1)") or die(mysqli_error($conn));
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$amount', `pending` = pending - '$amount' WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                    }
                }

            }
            else if($providerID == 5){
                $ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                $cs = mysqli_fetch_array($ceksession);
                $full_names = $cs['full_name'];
                $email = $cs['email'];
                $no_hp = $cs['no_hp'];
                $servicess = $cs['services'];
                $dataNo = $cs['userID'];
                $dataZone = $cs['zoneID'];

                if($jenis_transaksi == 1){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                        
                        $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
                        $s4 = mysqli_fetch_array($sql_4);
                        $apiKeys = $s4['api_key'];
                        $merchantCodes = $s4['merchant_code'];
                        $signe = $merchantCodes.$apiKeys.$merchantRef;
                        $sign = md5($signe);
                        $params = array(
                            'username' => $merchantCodes,
                            'buyer_sku_code' => $servicess,
                            'customer_no' => $dataNo.$dataZone,
                            'ref_id' => $merchantRef,
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
                        $hasil = json_decode($response1, true);
                        $message = $hasil['data']['message'];
                        if($order_status != 'Gagal'){
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$message' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        else {
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$subtotal', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$message' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana $productTitle','$subtotal',0,'Pengembalian Dana $productTitle', '$providerID','1','saldo','$userID',2)") or die(mysqli_error());
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                    }
                }
                else if($jenis_transaksi == 2){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                        
                        $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
                        $s4 = mysqli_fetch_array($sql_4);
                        $apiKeys = $s4['api_key'];
                        $merchantCodes = $s4['merchant_code'];
                        $signe = $merchantCodes.$apiKeys.$merchantRef;
                        $sign = md5($signe);
                        $params = array(
                            'username' => $merchantCodes,
                            'buyer_sku_code' => $servicess,
                            'customer_no' => $dataNo,
                            'ref_id' => $merchantRef,
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
                        $hasil = json_decode($response1, true);
                        $message = $hasil['data']['message'];
                        if($order_status != 'Gagal'){
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$message' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        else {
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$subtotal', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$message' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana $productTitle','$subtotal',0,'Pengembalian Dana $productTitle', '$providerID','1','saldo','$userID',2)") or die(mysqli_error());
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                    }
                }

            }
            else if($providerID == 6){
                $ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                $cs = mysqli_fetch_array($ceksession);
                $full_names = $cs['full_name'];
                $email = $cs['email'];
                $no_hp = $cs['no_hp'];
                $servicess = $cs['services'];
                $dataNo = $cs['userID'];
                $dataZone = $cs['zoneID'];

                if($jenis_transaksi == 3){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                        
                        $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 6") or die(mysqli_error());
                        $s4 = mysqli_fetch_array($sql_4);
                        $apiKeys = $s4['api_key'];
                        $merchantCodes = $s4['merchant_code'];
                        
                        $curl1 = curl_init();
                                    
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => 'https://api.medanpedia.co.id/order',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => array(
                                'api_id' => $merchantCodes,
                                'api_key' => $apiKeys,
                                'service' => $servicess,
                                'target' => $userID, 
                                'quantity' => $qty, 
                            ),
                        ));
                                        
                        $response1 = curl_exec($curl1);
                                        
                        curl_close($curl1);
                        $hasil = json_decode($response1, true);
                        if($hasil['status'] == 'true'){
                            $orderid = $hasil['data']['id'];
                            $order_status = $hasil['data']['status'];
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, `trxID` = '$orderid', status_order = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        else if($hasil['status'] == 'false') {
                            $order_note = $hasil['data'];
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$harga', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana','$subtotal',0,'Pengembalian Dana','$jenisnya','1','saldo','$userID',2)") or die(mysqli_error());
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                    }
                }
            }
            else if($providerID == 9){
                $ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                $cs = mysqli_fetch_array($ceksession);
                $full_names = $cs['full_name'];
                $email = $cs['email'];
                $no_hp = $cs['no_hp'];
                $servicess = $cs['services'];
                $dataNo = $cs['userID'];
                $dataZone = $cs['zoneID'];

                if($jenis_transaksi == 1){
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                        
                        $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 9") or die(mysqli_error());
                        $s4 = mysqli_fetch_array($sql_4);
                        $apiKeys = $s4['api_key'];
                        $merchantCodes = $s4['merchant_code'];
                        $signe = $merchantCodes.$apiKeys;
                        $sign = md5($signe);

                        $nicknames = preg_replace('/[^\p{L}\p{N}\s]/u', '', $nickname);

                        $post_url = 'https://v1.apigames.id/transaksi/http-get-v1?merchant='.$merchantCodes.'&secret='.$apiKeys.'&produk='.$servicess.'&tujuan='.$dataNo.$dataZone.'&ref=' . $merchantRef;
                        $curl1 = curl_init();
                        curl_setopt_array($curl1, array(
                            CURLOPT_URL => $post_url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'GET',
                            CURLOPT_POSTFIELDS => '',
                            CURLOPT_HTTPHEADER => array(
                                'Content-Type: application/x-www-form-urlencoded'
                            ),
                        ));
                                        
                        $response1 = curl_exec($curl1);
                        
                        $hasil = json_decode($response1, true);

                        if ($hasil['status'] == 0) {
                            $order_status = $hasil['error_msg'];
                            $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$harga', `pending` = pending - $subtotal WHERE userID = '$userID'") or die(mysqli_error($conn));
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = '$order_status' WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$merchantRef','$created_date','Pengembalian Dana','$subtotal',0,'Pengembalian Dana','$jenisnya','1','saldo','$userID',2)") or die(mysqli_error());
                            $content = '*Terima Kasih* Pesanan Anda Gagal Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        } else {
                            $orderid = $hasil['data']['trxid'];
                            $order_status = $hasil['data']['status'];
                            $note = $hasil['data']['sn'];
                            $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `trxID` = '$orderid', status_order = '$order_status', note = '$note', status = 2 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                            $content = '*Terima Kasih* Pesanan Anda Berhasil Diproses
                                                
silahkan cek status transaksi kamu di '.$urlweb.'/cektrx/ dan masukkan No.Invoice kamu *' . $merchantRef . '*
                                
Jika ada kendala, silahkan hubungi Layanan CS :
WA/TELEGRAM : '.$su['no_hp'];
                        }
                        
                    }
                }
            }
            else if($providerID == 10){
                $ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                $cs = mysqli_fetch_array($ceksession);
                $full_names = $cs['full_name'];
                $email = $cs['email'];
                $no_hp = $cs['no_hp'];
                $servicess = $cs['services'];
                $dataNo = $cs['userID'];
                $dataZone = $cs['zoneID'];

                if($jenis_transaksi == 1){
                    $ceksession = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error($conn));
                    $cs = mysqli_fetch_array($ceksession);
                    $userID = $cs['userID'];
                    if($cs['status'] == 0){
                        $update = mysqli_query($conn,"UPDATE `tb_order` SET status = 1 WHERE kd_transaksi = '$merchantRef'") or die(mysqli_error());
                        $update_tripay = mysqli_query($conn,"UPDATE `tb_tripay` SET `status` = 'PAID', `paid_time` = '$paidTime' WHERE `merchant_ref` = '$merchantRef'") or die(mysqli_error());
                    }
                }
            }

            $cekFonnte = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 8") or die(mysqli_error());
            $cf = mysqli_fetch_array($cekFonnte);
            if($cf['status'] == 1){
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
                       'target' => $no_hp,
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
}
?>