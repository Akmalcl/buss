<?php
	require_once('session.php');
	$postID = $_GET['postID'];
	$jenisnya = $_GET['jenis'];
	if($jenisnya == 1){
		if($postID == 4){
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

			$delete = mysqli_query($conn,"DELETE FROM `tb_produk` WHERE jenis = 4") or die(mysqli_error($conn));

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
			           $insert = mysqli_query($conn,"INSERT INTO `tb_produk` (`id`, `slug`, `code`, `title`, `kategori`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `currency`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$aa', '$slug', '$code', '$title', '$game', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', '', 1, '$created_date', 4, 1)") or die(mysqli_error($conn));
			        }
			    }
			}
		}
		else if($postID == 5){
			$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
			$s5 = mysqli_fetch_array($sql_5);
			$merchantCodes = $s5['merchant_code'];
			$apiKey = $s5['api_key'];

			$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
			$ga = mysqli_fetch_array($getAdmin);
			$persen_sell = $ga['persen_sell'];
			$persen_res = $ga['persen_res'];
			$satuan = $ga['satuan'];

			$created_date = date('Y-m-d');

			$delete = mysqli_query($conn,"DELETE FROM `tb_produk` WHERE jenis = 5") or die(mysqli_error($conn));

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
			}
		}
	}
	else if($jenisnya == 2){
		if($postID == 4){
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

			$join_date = date('Y-m-d H:i:s');
			$created_date = date('Y-m-d');

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
			            $insert = mysqli_query($conn,"INSERT INTO `tb_prepaid` (`slug`, `code`, `title`, `kategori`, `brand`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$slug', '$code', '$title', '$kategori', '$brand', '$hargaModal', '$harga_jual', '$harga_reseller', '$gambar', 1, '$created_date', 4, '$product_type')") or die(mysqli_error($conn));
			          }
			        }
			    }
			}
		}
		else if($postID == 5){
			$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 5") or die(mysqli_error());
			$s5 = mysqli_fetch_array($sql_5);
			$merchantCodes = $s5['merchant_code'];
			$apiKey = $s5['api_key'];

			$getAdmin = mysqli_query($conn,"SELECT * FROM `tb_admin` WHERE id = 1") or die(mysqli_error());
			$ga = mysqli_fetch_array($getAdmin);
			$persen_sell = $ga['persen_sell'];
			$persen_res = $ga['persen_res'];
			$satuan = $ga['satuan'];

			$created_date = date('Y-m-d');

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
		}
	}
	else if($jenisnya == 3){
		if($postID == 4){
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

			$delete = mysqli_query($conn,"DELETE FROM `tb_produk_social` WHERE jenis = 4") or die(mysqli_error($conn));

			$join_date = date('Y-m-d H:i:s');
			$created_date = date('Y-m-d');

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
			    $code = $hasil['data'][$i]['id'];
			    $explode = explode(' ',$hasil['data'][$i]['category']);
			    $category = $explode[0];
			    $title = $hasil['data'][$i]['name'];
			    $minBuy = $hasil['data'][$i]['min'];
			    $maxBuy = $hasil['data'][$i]['max'];
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
			    $image = strtolower($category).'.png';
			    $tipe_data = $hasil['data'][$i]['status'];
			    if($tipe_data == 'available'){
			        $cekProduk = mysqli_query($conn,"SELECT * FROM `tb_produk_social` WHERE `code` = '$code' AND created_date = '$created_date'") or die(mysqli_error($conn));
			        $cp = mysqli_num_rows($cekProduk);
			        if($cp == 0){
			          $insert = mysqli_query($conn,"INSERT INTO `tb_produk_social` (`slug`, `code`, `title`, `kategori`, `min_buy`, `max_buy`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$code', '$code', '$title', '$category', '$minBuy', '$maxBuy', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', 1, '$created_date',4,5)") or die(mysqli_error($conn));
			        }
			    }
			}
		}
		else if($postID == 6){
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
			          
			  $insert = mysqli_query($conn,"INSERT INTO `tb_produk_social` (`slug`, `code`, `title`, `kategori`, `min_buy`, `max_buy`, `harga_modal`, `harga_jual`, `harga_reseller`, `image`, `status`, `created_date`, `jenis`, `product_type`) VALUES ('$code', '$code', '$title', '$category', '$minBuy', '$maxBuy', '$hargaModal', '$harga_jual', '$harga_reseller', '$image', 1, '$created_date', 6, 5)") or die(mysqli_error($conn)); 
			}
		}
	}
    
    header('location:../service/?notif=2');
?>