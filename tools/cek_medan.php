<?php
include('../config/koneksi.php');
$created_date = date('Y-m-d H:i:s');

$cektrx1 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE providerID = 6 AND status = 1") or die(mysqli_error());
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

    $curl2 = curl_init();
                                                       
    curl_setopt_array($curl2, array(
        CURLOPT_URL => 'https://api.medanpedia.co.id/status',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
          'api_id' => $apiIDs,
          'api_key' => $apiKeys,
          'id' => $txID2, 
        ),
    ));

    $response2 = curl_exec($curl2);
        
    curl_close($curl2);
    echo $response2;
    $hasil2 = json_decode($response2, true);
    if($hasil2['status'][$ba] == 'true'){
        $order_status2 = $hasil2['data'][$ba]['status'];
        $order_note2 = 'Transaksi Berhasil';
        if($statusOrder2 == 'Pending'){
          if($order_status2 == 'Success'){
            if($metode1 == 'saldo'){
              $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status2', `note` = '$order_note2' WHERE kd_transaksi = '$trxID2'") or die(mysqli_error($conn));
              $update = mysqli_query($conn,"UPDATE `tb_balance` SET `payout` = payout + '$total2', `pending` = pending - '$total2' WHERE userID = '$usersID2'") or die(mysqli_error($conn));
            }
            else {
              $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = '$order_status2', `note` = '$order_note2' WHERE kd_transaksi = '$trxID2'") or die(mysqli_error($conn));
            }
          }
          else if($order_status == 'Error'){
            if($metode == 'saldo'){
              $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = 'failed', `note` = '$order_note2' WHERE kd_transaksi = '$trxID2'") or die(mysqli_error($conn));
              $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total2', `pending` = pending - '$total2' WHERE userID = '$usersID2'") or die(mysqli_error($conn));
              $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID2','$created_date','Refund Pembelian $trxID2','$total2',0,'Refund Pembelian $trxID2','6','3','$metode2','$usersID2',1)") or die(mysqli_error());
            }
            else {
              $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = 'failed', `note` = '$order_note2' WHERE kd_transaksi = '$trxID2'") or die(mysqli_error($conn));
              $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total2' WHERE userID = '$usersID2'") or die(mysqli_error($conn));
              $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID2','$created_date','Refund Pembelian $trxID2','$total2',0,'Refund Pembelian $trxID2','6','3','$metode12','$usersID2',1)") or die(mysqli_error());
            }
          }
        }
    }
    else if($hasil2['status'][$ba] == 'false'){
        $order_note2 = $hasil2['data'][$ba];
        if($metode1 == 'saldo'){
          $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = 'failed', `note` = '$order_note2' WHERE kd_transaksi = '$trxID1'") or die(mysqli_error($conn));
          $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total2', `pending` = pending - '$total2' WHERE userID = '$usersID2'") or die(mysqli_error($conn));
          $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID2','$created_date','Refund Pembelian $trxID2','$total2',0,'Refund Pembelian $trxID2','6','3','$metode2','$usersID2',1)") or die(mysqli_error());
        }
        else {
          $update3 = mysqli_query($conn,"UPDATE `tb_order` SET `status` = 2, `status_order` = 'failed', `note` = '$order_note2' WHERE kd_transaksi = '$trxID2'") or die(mysqli_error($conn));
          $update = mysqli_query($conn,"UPDATE `tb_balance` SET `active` = active + '$total2' WHERE userID = '$usersID2'") or die(mysqli_error($conn));
          $insert_transaksi = mysqli_query($conn,"INSERT INTO `tb_transaksi` (`kd_transaksi`, `date`, `transaksi`, `total`, `saldo`, `note`, `providerID`, `jenis`, `metode`, `userID`, `status`) VALUES ('$trxID2','$created_date','Refund Pembelian $trxID2','$total2',0,'Refund Pembelian $trxID2','6','3','$metode1','$usersID2',1)") or die(mysqli_error());
        }
    } 
}
?>