<?php
	require_once('session.php');

    $users = $u['user'];
    $provider = $_POST['provider'];
    $apikey = $_POST['apikey'];
    $merchant_code = $_POST['merchant_code'];
    $status = $_POST['status'];
    $join_date = date('Y-m-d');
    $cekApi = mysqli_query($conn,"SELECT api_key FROM `tb_tripayapi` WHERE id = '$provider'") or die(mysqli_error());
    $ca = mysqli_fetch_array($cekApi);
    if($ca['api_key'] == ''){
    	$query = mysqli_query($conn,"UPDATE `tb_tripayapi` SET `api_key` = '$apikey', `merchant_code` = '$merchant_code', `status` = '$status' WHERE id = '$provider'") or die(mysqli_error());
    	if($status == 1){
	    	if($provider == 4){
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
				      'type' => 'services',
				      'filter_type' => 'game'
				  ),
				));

				$response = curl_exec($curl);

				curl_close($curl);
				echo $response;
				$hasil = json_decode($response, true);
				for ($i=0; $i < count($hasil['data']); $i++) {
				    $code = $hasil['data'][$i]['code'];
				    $game = $hasil['data'][$i]['game'];
				    $slug = strtolower(preg_replace("/[^a-zA-Z0-9]/", "",$game));
				    $image = strtolower(str_replace(' ','_',$game)).'.png';
				    $title = str_replace(array( "’","'" ),"&apos;",$hasil['data'][$i]['name']);
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
				        $cekProduk = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE `code` = '$code' AND created_date = '$created_date'") or die(mysqli_error($conn));
				        $cp = mysqli_num_rows($cekProduk);
				        if($cp == 0){
				           $insert = mysqli_query($conn,"INSERT INTO `tb_produk` (`slug`, `code`, `title`, `kategori`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `currency`, `status`, `created_date`, `jenis`) VALUES ('$slug', '$code', '$title', '$game', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', '', 1, '$created_date', 4)") or die(mysqli_error($conn));
				        }
				    }
				}

				///////////////////////////////////////////////////////////////////////////////////////////////

				$curl1 = curl_init();

				curl_setopt_array($curl1, array(
				  CURLOPT_URL => 'https://vip-reseller.com/api/prepaid',
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

				$response1 = curl_exec($curl1);

				curl_close($curl1);
				echo $response1;
				$hasil1 = json_decode($response1, true);
				for ($ii=0; $ii < count($hasil1['data']); $ii++) {
				    $code1 = $hasil1['data'][$ii]['code'];
				    $brand1 = $hasil1['data'][$ii]['brand'];
				    $gambare1 = strtolower($hasil1['data'][$ii]['brand']);
				    $gambar1 = str_replace(' ','_',$gambare1).'.png';
				    $kategori1 = $hasil1['data'][$ii]['type'];
				    $title1 = str_replace(array( "’","'" ),"&apos;",$hasil1['data'][$ii]['name']);
				    $slug1 = strtolower(str_replace(' ','',$title1));
				    $hargaModal1 = $hasil1['data'][$ii]['price']['special'];
				    if($satuan == 0){
				        $hargaJual1 = round(($hargaModal1*$persen_sell) / 100);
				        $harga_jual1 = $hargaModal1 + $hargaJual1;

				        $hargaRes1 =  round(($hargaModal1*$persen_res) / 100);
				        $harga_reseller1 = $hargaModal1 + $hargaRes1;
				    }
				    else {
				        $harga_jual1 = $hargaModal1 + $persen_sell;
				        $harga_reseller1 = $hargaModal1 + $persen_res;
				    }
				    $tipe_data1 = $hasil1['data'][$ii]['status'];
				    if($tipe_data1 == 'available'){
				        $cekProduk1 = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE `code` = '$code1' AND created_date = '$created_date'") or die(mysqli_error($conn));
				        $cp1 = mysqli_num_rows($cekProduk1);
				        if($cp1 == 0){
				          if($kategori1 != 'voucher-game' && $kategori1 != 'paket-lainnya' && $kategori1 != 'pulsa-internasional'){
				            $insert1 = mysqli_query($conn,"INSERT INTO `tb_prepaid` (`slug`, `code`, `title`, `kategori`, `brand`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`) VALUES ('$slug1', '$code1', '$title1', '$kategori1', '$brand1', '$hargaModal1', '$harga_jual1', '$harga_reseller1', '$gambar1', 1, '$created_date', 4)") or die(mysqli_error($conn));
				          }
				        }
				    }
				}

				////////////////////////////////////////////////////////////////////////////////////////////////

				$curl2 = curl_init();

				curl_setopt_array($curl2, array(
				  CURLOPT_URL => 'https://vip-reseller.com/api/social-media',
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

				$response2 = curl_exec($curl2);

				curl_close($curl2);
				echo $response2;
				$hasil2 = json_decode($response2, true);
				for ($iii=0; $iii < count($hasil2['data']); $iii++) {
				    $code2 = $hasil2['data'][$iii]['id'];
				    $explode2 = explode(' ',$hasil2['data'][$iii]['category']);
				    $category2 = $explode2[0];
				    $title2 = $hasil2['data'][$iii]['name'];
				    $minBuy2 = $hasil2['data'][$iii]['min'];
				    $maxBuy2 = $hasil2['data'][$iii]['max'];
				    $hargaModal2 = $hasil2['data'][$iii]['price']['special'];
				    if($satuan == 0){
				        $hargaJual2 = round(($hargaModal2*$persen_sell) / 100);
				        $harga_jual2 = $hargaModal2 + $hargaJual2;

				        $hargaRes2 =  round(($hargaModal2*$persen_res) / 100);
				        $harga_reseller2 = $hargaModal2 + $hargaRes2;
				    }
				    else {
				        $harga_jual2 = $hargaModal2 + $persen_sell;
				        $harga_reseller2 = $hargaModal2 + $persen_res;
				    }
				    $image2 = strtolower($category2).'.png';
				    $tipe_data2 = $hasil2['data'][$iii]['status'];
				    if($tipe_data2 == 'available'){
				        $cekProduk2 = mysqli_query($conn,"SELECT * FROM `tb_produk_social` WHERE `code` = '$code2' AND created_date = '$created_date'") or die(mysqli_error($conn));
				        $cp2 = mysqli_num_rows($cekProduk2);
				        if($cp2 == 0){
				          $insert2 = mysqli_query($conn,"INSERT INTO `tb_produk_social` (`slug`, `code`, `title`, `kategori`, `min_buy`, `max_buy`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`) VALUES ('$code2', '$code2', '$title2', '$category2', '$minBuy2', '$maxBuy2', '$hargaModal2', '$harga_jual2', '$harga_reseller2', '$image2', 1, '$created_date',4)") or die(mysqli_error($conn));
				        }
				    }
				}
	    	}
	    	else if($provider == 5){
	    		$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
				$s5 = mysqli_fetch_array($sql_5);
				$merchantCodes = $s5['merchant_code'];
				$apiKey = $s5['api_key'];

				$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
				$ga = mysqli_fetch_array($getAdmin);
				$persen_sell = $ga['persen_sell'];
				$persen_res = $ga['persen_res'];
				$satuan = $ga['satuan'];

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
				           $insert = mysqli_query($conn,"INSERT INTO `tb_produk` (`slug`, `code`, `title`, `kategori`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `currency`, `status`, `created_date`, `jenis`) VALUES 
				        ('$slug', '$code', '$title', '$brand', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', '', 1, '$created_date', 5)") or die(mysqli_error($conn));
				        }
				    }
				    else {
				        $cekProduk = mysqli_query($conn,"SELECT * FROM `tb_prepaid` WHERE `code` = '$code' AND created_date = '$created_date'") or die(mysqli_error($conn));
				        $cp = mysqli_num_rows($cekProduk);
				        if($cp == 0){
				            $insert = mysqli_query($conn,"INSERT INTO `tb_prepaid` (`slug`, `code`, `title`, `kategori`, `brand`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`) VALUES ('$slug', '$code', '$title', '$category', '$brand', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', 1, '$created_date', 5)") or die(mysqli_error($conn));
				        }
				    }
				}
	    	}
	    	else if($provider == 6){
	    		$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 6") or die(mysqli_error());
				$s5 = mysqli_fetch_array($sql_5);
				$merchantCodes = $s5['merchant_code'];
				$apiKey = $s5['api_key'];

				$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
				$ga = mysqli_fetch_array($getAdmin);
				$persen_sell = $ga['persen_sell'];
				$persen_res = $ga['persen_res'];
				$satuan = $ga['satuan'];

				$join_date = date('Y-m-d H:i:s');
				$created_date = date('Y-m-d');

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
				    
				    $insert = mysqli_query($conn,"INSERT INTO `tb_produk_social` (`slug`, `code`, `title`, `kategori`, `min_buy`, `max_buy`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`) VALUES ('$code', '$code', '$title', '$category', '$minBuy', '$maxBuy', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', 1, '$created_date', 6)") or die(mysqli_error($conn)); 
				}
	    	}
	    }
    }
    else {
    	$query = mysqli_query($conn,"UPDATE `tb_tripayapi` SET `api_key` = '$apikey', `merchant_code` = '$merchant_code', `status` = '$status' WHERE id = '$provider'") or die(mysqli_error());
    }
    

    header('location:../provider/?notif=1');
    
?>