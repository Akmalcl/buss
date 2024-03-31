<?php
include('../config/koneksi.php');
$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$merchantCodes = $s5['merchant_code'];
$apiKey = $s5['api_key'];

$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
$ga = mysqli_fetch_array($getAdmin);
$persen_sell = $ga['persen_sell'];
$persen_res = $ga['persen_res'];
$satuan = $ga['satuan'];


$delete = mysqli_query($conn,"DELETE FROM `tb_produk` WHERE jenis = 5") or die(mysqli_error($conn));
$delete = mysqli_query($conn,"DELETE FROM `tb_prepaid` WHERE jenis = 5") or die(mysqli_error($conn));

$join_date = date('Y-m-d H:i:s');
$created_date = date('Y-m-d');

$signe = $merchantCodes.$apiKey.'"pricelist"';
$sign = md5($signe);
$params = array(
    'cmd' => 'prepaid',
    'username' => $merchantCodes,
    'sign' => $sign
);
$params_string = json_encode($params);
$url1 = 'https://api.digiflazz.com/v1/price-list';
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
//echo $response1;
$hasil = json_decode($response1, true);
for ($i=0; $i < count($hasil['data']); $i++) {
    $a = strlen($i);
    if($a == 1){
        $aa = '5000'.$i;
    }
    else if($a == 2){
        $aa = '500'.$i;
    }
    else if($a == 3){
        $aa = '50'.$i;
    }
    else if($a == 4){
        $aa = '5'.$i;
    }
    else if($a == 5){
        $aa = $i;
    }
    $brand = ucwords(strtolower($hasil['data'][$i]['brand']));
    $category = $hasil['data'][$i]['category'];
    $code = $hasil['data'][$i]['buyer_sku_code'];
    $game = $hasil['data'][$i]['product_name'];
    $slug = strtolower(preg_replace("/[^a-zA-Z0-9]/", "",$brand));
    $image = strtolower(str_replace(' ','_',$brand)).'.png';
    $title = str_replace(array( "’","'" ),"&apos;",$hasil['data'][$i]['product_name']);
    $hargaModal = $hasil['data'][$i]['price'];
    if($satuan == 0){
        $hargaJual = round(($hargaModal*$persen_sell) / 100);
        $harga_jual = $hargaModal + $hargaJual;

        $hargaRes =  round(($hargaModal*$persen_res) / 100);
        $harga_reseller = $hargaModal + $hargaRes;
    }
    else {
        $harga_jual = $hargaModal + $persen_sell;
        $harga_reseller = $hargaModal + $persen_res;
    }
    
    if($hasil['data'][$i]['category'] == 'Games' || $hasil['data'][$i]['category'] == 'Voucher'){
        $cekProduk = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE `code` = '$code' AND created_date = '$created_date'") or die(mysqli_error($conn));
        $cp = mysqli_num_rows($cekProduk);
        if($cp == 0){
           $insert = mysqli_query($conn,"INSERT INTO `tb_produk` (`id`, `slug`, `code`, `title`, `kategori`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `currency`, `status`, `created_date`, `jenis`, `product_type`) VALUES 
        ('$aa', '$slug', '$code', '$title', '$brand', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', '', 1, '$created_date', 5, 1)") or die(mysqli_error($conn));
        }
    }
    else {
        $cekProduk = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE `code` = '$code' AND created_date = '$created_date'") or die(mysqli_error($conn));
        $cp = mysqli_num_rows($cekProduk);
        if($cp == 0){
            if($category == 'E-Money'){
                $product_type = 4;
            }
            else{
                $product_type = 3;
            }
            $insert = mysqli_query($conn,"INSERT INTO `tb_prepaid` (`id`, `slug`, `code`, `title`, `kategori`, `brand`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$aa', '$slug', '$code', '$title', '$category', '$brand', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', 1, '$created_date', 5, '$product_type')") or die(mysqli_error($conn));
        }
    }
}
?>