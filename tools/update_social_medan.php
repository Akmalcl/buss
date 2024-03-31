<?php
include('../config/koneksi.php');
$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 6") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$merchantCodes = $s5['merchant_code'];
$apiKey = $s5['api_key'];

$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
$ga = mysqli_fetch_array($getAdmin);
$persen_sell = $ga['persen_sell'];
$persen_res = $ga['persen_res'];
$satuan = $ga['satuan'];

$created_date = date('Y-m-d');

$delete = mysqli_query($conn,"DELETE FROM `tb_produk_social` WHERE jenis = 6") or die(mysqli_error($conn));

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.medanpedia.co.id/services',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
    'api_id' => $merchantCodes,
    'api_key' => $apiKey,
    'service_fav' => '',
  ),
));

$response = curl_exec($curl);

curl_close($curl);
//echo $response;
$hasil = json_decode($response, true);
for ($i=0; $i < count($hasil['data']); $i++) {
    $a = strlen($i);
    if($a == 1){
        $aa = '6000'.$i;
    }
    else if($a == 2){
        $aa = '600'.$i;
    }
    else if($a == 3){
        $aa = '60'.$i;
    }
    else if($a == 4){
        $aa = '6'.$i;
    }
    else if($a == 5){
        $aa = $i;
    }
  $code = $hasil['data'][$i]['id'];
  $explode = explode(' ',$hasil['data'][$i]['category']);
  $category = $explode[0];
  $title = str_replace(array( "’","'" ),"&apos;",$hasil['data'][$i]['name']);
  $minBuy = $hasil['data'][$i]['min'];
  $maxBuy = $hasil['data'][$i]['max'];
  $hargaModal = $hasil['data'][$i]['price'];
  if($satuan == 0){
    $hargaJual = round(($hargaModal1*$persen_sell) / 100);
    $harga_jual = $hargaModal1 + $hargaJual1;

    $hargaRes =  round(($hargaModal1*$persen_res) / 100);
    $harga_reseller = $hargaModal1 + $hargaRes1;
  }
  else {
    $harga_jual = $hargaModal1 + $persen_sell;
    $harga_reseller = $hargaModal1 + $persen_res;
  }
  $image = strtolower($category).'.png';
          
  $insert = mysqli_query($conn,"INSERT INTO `tb_produk_social` (`id`, `slug`, `code`, `title`, `kategori`, `min_buy`, `max_buy`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$aa', '$code', '$code', '$title', '$category', '$minBuy', '$maxBuy', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', 1, '$created_date', 6, 5)") or die(mysqli_error($conn)); 
}
?>