<?php
include('../config/koneksi.php');
$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 4") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$merchantCodes = $s5['merchant_code'];
$apiKey = $s5['api_key'];

$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
$ga = mysqli_fetch_array($getAdmin);
$persen_sell = $ga['persen_sell'];
$persen_res = $ga['persen_res'];
$satuan = $ga['satuan'];

$created_date = date('Y-m-d');

$delete = mysqli_query($conn,"DELETE FROM `tb_prepaid` WHERE jenis = 4") or die(mysqli_error($conn));

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
      'type' => 'services'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
$hasil = json_decode($response, true);
for ($i=0; $i < count($hasil['data']); $i++) {
    $a = strlen($i);
    if($a == 1){
        $aa = '4000'.$i;
    }
    else if($a == 2){
        $aa = '400'.$i;
    }
    else if($a == 3){
        $aa = '40'.$i;
    }
    else if($a == 4){
        $aa = '4'.$i;
    }
    else if($a == 5){
        $aa = $i;
    }
    $code = $hasil['data'][$i]['code'];
    $brand = $hasil['data'][$i]['brand'];
    $gambare = strtolower($hasil['data'][$i]['brand']);
    $gambar = str_replace(' ','_',$gambare).'.png';
    $kategori = $hasil['data'][$i]['type'];
    $title = str_replace(array( "’","'" ),"&apos;",$hasil['data'][$i]['name']);
    $slug = strtolower(str_replace(' ','',$title));
    $hargaModal = $hasil['data'][$i]['price']['special'];
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
    $tipe_data = $hasil['data'][$i]['status'];
    if($tipe_data == 'available'){
        $cekProduk = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE `code` = '$code' AND created_date = '$created_date'") or die(mysqli_error($conn));
        $cp = mysqli_num_rows($cekProduk);
        if($cp == 0){
          if($kategori != 'voucher-game' && $kategori != 'paket-lainnya' && $kategori != 'pulsa-internasional'){
            if($kategori == 'E-Money'){
                $product_type = 4;
            }
            else{
                $product_type = 3;
            }
            $insert = mysqli_query($conn,"INSERT INTO `tb_prepaid` (`id`, `slug`, `code`, `title`, `kategori`, `brand`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$aa', '$slug', '$code', '$title', '$kategori', '$brand', '$hargaModal', '$harga_jual', '$harga_reseller', '$gambar', 1, '$created_date', 4, '$product_type')") or die(mysqli_error($conn));
          }
        }
    }
}
?>