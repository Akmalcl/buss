<?php
include('../config/koneksi.php');
$created_date = date('Y-m-d H:i:s');

$cektrx1 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE providerID = 4 AND status = 1") or die(mysqli_error());
$a=0;
while($cts1 = mysqli_fetch_array($cektrx1)){
  $a++;
  $b = $a-1;
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

        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 4") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $merchantCodes = $s5['merchant_code'];
        $apiKey = $s5['api_key'];

        $signe = $merchantCodes.$apiKey;
        $sign = md5($signe);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://vip-reseller.co.id/api/game-feature',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'key' => $apiKey,
                'sign' => $sign,
                'type' => 'status',
                'trxid' => $txID
            ),
        ));
        $response = curl_exec($curl);
                  
        curl_close($curl);
        echo $response;
        $hasil = json_decode($response, true);
        $order_status = $hasil['data'][0]['status'];
        $order_note = $hasil['data'][0]['note'];
        echo $order_status;
        if($statusOrder == 'waiting'){
            if($order_status == 'success'){
                if($metode == 'saldo'){
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                }
                else {
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                }
            }
            else if($order_status == 'error'){
                if($metode == 'saldo'){
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                    $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '4','1','$metode','$usersID',1)") or die(mysqli_error());
                }
                else {
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                    $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '4','1','$metode','$usersID',1)") or die(mysqli_error());
                }
            }
        }
    }
    else if($jenisnya == 2){
        $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE id = '$produkID'") or die(mysqli_error());
        $s1 = mysqli_fetch_array($sql_1);
        $productCode = $s1['code'];
        $productCategory = $s1['kategori'];
        $productTitle = $s1['title'];

        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 4") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $merchantCodes = $s5['merchant_code'];
        $apiKey = $s5['api_key'];

        $signe = $merchantCodes.$apiKey;
        $sign = md5($signe);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://vip-reseller.co.id/api/prepaid',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'key' => $apiKey,
                'sign' => $sign,
                'type' => 'status',
                'trxid' => $txID
            ),
        ));
        $response = curl_exec($curl);
                  
        curl_close($curl);
        echo $response;
        $hasil = json_decode($response, true);
        $order_status = $hasil['data'][0]['status'];
        $order_note = $hasil['data'][0]['note'];
        echo $order_status;
        if($statusOrder == 'waiting'){
            if($order_status == 'success'){
                if($metode == 'saldo'){
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                }
                else {
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                }
            }
            else if($order_status == 'error'){
                if($metode == 'saldo'){
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                    $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '4','2','$metode','$usersID',1)") or die(mysqli_error());
                }
                else {
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                    $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '4','2','$metode','$usersID',1)") or die(mysqli_error());
                }
            }
        }
    }
    else if($jenisnya == 3){
        $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_produk_social` WHERE id = '$produkID'") or die(mysqli_error());
        $s1 = mysqli_fetch_array($sql_1);
        $productCode = $s1['code'];
        $productCategory = $s1['kategori'];
        $productTitle = $s1['title'];

        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 4") or die(mysqli_error());
        $s5 = mysqli_fetch_array($sql_5);
        $merchantCodes = $s5['merchant_code'];
        $apiKey = $s5['api_key'];

        $signe = $merchantCodes.$apiKey;
        $sign = md5($signe);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://vip-reseller.co.id/api/social-media',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array(
                'key' => $apiKey,
                'sign' => $sign,
                'type' => 'status',
                'trxid' => $txID
            ),
        ));
        $response = curl_exec($curl);
                  
        curl_close($curl);
        echo $response;
        $hasil = json_decode($response, true);
        $order_status = $hasil['data'][0]['status'];
        $order_note = $hasil['data'][0]['note'];
        echo $order_status;
        if($statusOrder == 'waiting'){
            if($order_status == 'success'){
                if($metode == 'saldo'){
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                }
                else {
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                }
            }
            else if($order_status == 'error'){
                if($metode == 'saldo'){
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total', `pending` = pending - '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                    $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '4','3','$metode','$usersID',1)") or die(mysqli_error());
                }
                else {
                    $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `status_order` = 'failed', `note` = '$order_note' WHERE kd_transaksi = '$trxID'") or die(mysqli_error($conn));
                    $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total' WHERE userID = '$usersID'") or die(mysqli_error($conn));
                    $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID','$created_date','Refund Pembelian $trxID','$total',0,'Refund Pembelian $trxID', '4','3','$metode','$usersID',1)") or die(mysqli_error());
                }
            }
        }
    }
}
?>