<?php
include('../config/koneksi.php');
$created_date = date('Y-m-d H:i:s');

$cektrx1 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE providerID = 5 AND status = 1") or die(mysqli_error());
$a=0;
while($cts1 = mysqli_fetch_array($cektrx1)){
    $a++;
    $usersID = $cts1['id_user'];
    $subtotal = $cts1['sub_total'];
    $trxID = $cts1['kd_transaksi'];
    $metode = $cts1['metode'];
    $phone = $cts1['no_hp'];
    $txID = $cts1['trxID'];
    $kategori = $cts1['kategori'];
    $title = $cts1['title'];
    $userIDnya = $cts1['userID'];
    $zoneID = $cts1['zoneID'];
    $nickname = $cts1['nickname'];
    $statusOrder = $cts1['status_order'];
    $statusTrx = $cts1['status'];
    $jenisnya = $cts1['jenis'];
    $produkID = $cts1['produkID'];

    if($jenisnya == 1){
        $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE id = '$produkID'") or die(mysqli_error());
        $s1 = mysqli_fetch_array($sql_1);
        $productCode = $s1['code'];
        $productCategory = $s1['kategori'];
        $productTitle = $s1['title'];
      
      
        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $merchantCodes = $s5['merchant_code'];
        $apiKey = $s5['api_key'];
        $signe = $merchantCodes.$apiKey.$trxID;
        $sign = md5($signe);
        $params = array(
            'username' => $merchantCodes,
            'buyer_sku_code' => $productCode,
            'customer_no' => $userIDnya.$zoneID,
            'ref_id' => $trxID,
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
        echo $response1;
        curl_close($ch1);
        $hasil = json_decode($response1, true);
        $message = $hasil['data']['message'];
        $statusnya = $hasil['data']['status'];
        if($hasil['data']['status'] != 'Gagal'){
            if($metode == 'saldo'){
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$message' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
            }
            else {
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$message' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
            }
        }
        else {
            if($metode == 'saldo'){
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '5','1','$metode','$usersID',1)") or die(mysqli_error());
            }
            else {
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '5','1','$metode','$usersID',1)") or die(mysqli_error());
            }
        }
    }
    else if($jenisnya == 2){
        $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE id = '$produkID'") or die(mysqli_error());
        $s1 = mysqli_fetch_array($sql_1);
        $productCode = $s1['code'];
        $productCategory = $s1['kategori'];
        $productTitle = $s1['title'];
      
      
        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $merchantCodes = $s5['merchant_code'];
        $apiKey = $s5['api_key'];
        $signe = $merchantCodes.$apiKey.$trxID;
        $sign = md5($signe);
        $params = array(
            'username' => $merchantCodes,
            'buyer_sku_code' => $productCode,
            'customer_no' => $userIDnya,
            'ref_id' => $trxID,
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
        echo $response1;
        curl_close($ch1);
        $hasil = json_decode($response1, true);
        $message = $hasil['data']['message'];
        $statusnya = $hasil['data']['status'];
        $numSerial = $hasil['data']['sn'];
        $aa = $message.'. SN :'.$numSerial;
        if($hasil['data']['status'] != 'Gagal'){
            if($metode == 'saldo'){
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$aa' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
            }
            else {
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET status = 2, status_order = '$order_status', `note` = '$aa' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
            }
        }
        else {
            if($metode == 'saldo'){
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '5','2','$metode','$usersID',1)") or die(mysqli_error());
            }
            else {
                $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '5','2','$metode','$usersID',1)") or die(mysqli_error());
            }
        }
    } 
}
?>