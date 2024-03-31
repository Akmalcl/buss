<?php
	require_once('session.php');
    
    $persen_sell = $_POST['persen_sell'];
    $persen_res = $_POST['persen_res'];
    $reseller_price = $_POST['reseller_price'];
    $poin = $_POST['poin'];
    
    $getProduk = mysqli_query($conn,"SELECT * FROM `tb_produk` ORDER BY id ASC") or die(mysqli_error());
    while($gp = mysqli_fetch_array($getProduk)){
        $produkID = $gp['id'];
        $hargaModal = $gp['harga_modal'];
        $hargaJual = round(($gp['harga_modal']*$persen_sell) / 100);
        $harga_jual = $hargaModal + $hargaJual;
        $hargaRes =  round(($gp['harga_modal']*$persen_res) / 100);
        $harga_reseller = $hargaModal + $hargaRes;
        $update = mysqli_query($conn,"UPDATE `tb_produk` SET harga_jual = '$harga_jual', harga_reseller = '$harga_reseller' WHERE id = '$produkID'") or die(mysqli_error());
    }
    $query = mysqli_query($conn,"UPDATE `tb_admin` SET `persen_sell` = '$persen_sell', `persen_res` = '$persen_res', `reseller_price` = '$reseller_price', `poin` = '$poin' WHERE id = 1") or die(mysqli_error());
    header('location:../setting_admin/?notif=1');
?>