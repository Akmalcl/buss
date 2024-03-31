<?php
include('../config/koneksi.php');
$created_date = date('Y-m-d H:i:s');

$cektrx1 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE providerID = 9 AND status = 1") or die(mysqli_error());
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

    $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 9") or die(mysqli_error());
    $s5 = mysqli_fetch_array($sql_5);
    $merchantCodes = $s5['merchant_code'];
    $apiKey = $s5['api_key'];
    $signes = $merchantCodes.$apiKey;
    $signe = md5($signes);
              
    $post_url = 'https://v1.apigames.id/merchant/'.$merchantCodes.'/cektrx/'.$trxID;
                    
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
    echo $response1;
    $hasil = json_decode($response1, true);
                        
    if ($hasil['status'] == 0) {
        $note = $hasil['error_msg'];
        $update1 = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$subtotal', `pending` = pending - $subtotal WHERE userID = '$last_id'") or die(mysqli_error($conn));
        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 3, `note` = 'Transaksi Gagal' WHERE kd_transaksi = '$kd_transaksi'") or die(mysqli_error($conn));
        $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `jenis`, `metode`, `userID`, `status`) VALUES ('$kd_transaksi','$created_date','Pengembalian Dana','$subtotal',0,'Pengembalian Dana','1','saldo','$last_id',2)") or die(mysqli_error());
    } else {
        $orderid = $hasil['data']['trxid'];
        $order_status = $hasil['data']['status'];
        $note = $hasil['data']['sn'];
        $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `trxID` = '$orderid', status_order = '$order_status', note = '$note', status = 2 WHERE kd_transaksi = '$kd_transaksi'") or die(mysqli_error($conn));
    } 
}
?>