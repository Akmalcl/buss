<?php
    require_once('session.php');
    $users = $u['user'];
    $satuan = $_POST['satuan'];
    $persen_sell = $_POST['persen_sell'];
    $persen_res = $_POST['persen_res'];
    $created_date = date('Y-m-d H:i:s');

    $getProduk = mysqli_query($conn,"SELECT * FROM `tb_produk` ORDER BY id ASC") or die(mysqli_error());
    while($gp = mysqli_fetch_array($getProduk)){
        $produkID = $gp['id'];
        $hargaModal = $gp['harga_modal'];
        if($satuan == 0){
            $hargaJual = round(($gp['harga_modal']*$persen_sell) / 100);
            $harga_jual = $hargaModal + $hargaJual;

            $hargaRes =  round(($gp['harga_modal']*$persen_res) / 100);
            $harga_reseller = $hargaModal + $hargaRes;
        }
        else if($satuan == 1) {
            $harga_jual = $hargaModal + $persen_sell;
            $harga_reseller = $hargaModal + $persen_res;
        }
            
        $update = mysqli_query($conn,"UPDATE `tb_produk` SET harga_jual = '$harga_jual', harga_reseller = '$harga_reseller' WHERE id = '$produkID'") or die(mysqli_error($conn));
    }

    $getPrepaid = mysqli_query($conn,"SELECT * FROM `tb_prepaid` ORDER BY id ASC") or die(mysqli_error());
    while($gp1 = mysqli_fetch_array($getPrepaid)){
        $produkID1 = $gp1['id'];
        $hargaModal1 = $gp1['harga_modal'];
        if($satuan == 0){
            $hargaJual1 = round(($gp1['harga_modal']*$persen_sell) / 100);
            $harga_jual1 = $hargaModal1 + $hargaJual1;

            $hargaRes1 =  round(($gp1['harga_modal']*$persen_res) / 100);
            $harga_reseller1 = $hargaModal1 + $hargaRes1;
        }
        else if($satuan == 1) {
            $harga_jual1 = $hargaModal1 + $persen_sell;
            $harga_reseller1 = $hargaModal1 + $persen_res;
        }
            
        $update = mysqli_query($conn,"UPDATE `tb_prepaid` SET harga_jual = '$harga_jual1', harga_reseller = '$harga_reseller1' WHERE id = '$produkID1'") or die(mysqli_error($conn));
    }

    $getSocial = mysqli_query($conn,"SELECT * FROM `tb_produk_social` ORDER BY id ASC") or die(mysqli_error());
    while($gs = mysqli_fetch_array($getSocial)){
        $produkID2 = $gs['id'];
        $hargaModal2 = $gs['harga_modal'];
        if($satuan == 0){
            $hargaJual2 = round(($gs['harga_modal']*$persen_sell) / 100);
            $harga_jual2 = $hargaModal2 + $hargaJual1;
            $hargaRes2 =  round(($gs['harga_modal']*$persen_res) / 100);
            $harga_reseller2 = $hargaModal2 + $hargaRes1;
        }
        else if($satuan == 1) {
            $harga_jual2 = $hargaModal2 + $persen_sell;
            $harga_reseller2 = $hargaModal2 + $persen_res;
        }
            
        $update = mysqli_query($conn,"UPDATE `tb_prepaid` SET harga_jual = '$harga_jual2', harga_reseller = '$harga_reseller2' WHERE id = '$produkID2'") or die(mysqli_error($conn));
    }
    $query = mysqli_query($conn,"UPDATE `tb_admin` SET `satuan` = '$satuan', `persen_sell` = '$persen_sell', `persen_res` = '$persen_res' WHERE id = 1") or die(mysqli_error($conn));
    header('location:../admin/?notif=1');
?>