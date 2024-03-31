<?php
ob_start();
session_start();
include('config/koneksi.php');
$sid = session_id();
$sql_0 = mysqli_query($conn,"SELECT * FROM `tb_seo` WHERE id = 1") or die(mysqli_error());
$s0 = mysqli_fetch_array($sql_0);
$urlweb = $s0['urlweb'];
$urlwebs = $s0['urlweb'];
$pengguna = $s0['user'];
$sql_1a = mysqli_query($conn,"SELECT * FROM `tb_social` WHERE user = '$pengguna'") or die(mysqli_error());
$s1a = mysqli_fetch_array($sql_1a);
$sql_1b = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$pengguna'") or die(mysqli_error());
$s1b = mysqli_fetch_array($sql_1b);
$ip = $_SERVER['REMOTE_ADDR'];
$date = date('Y-m-d');

$stat = mysqli_query($conn,"INSERT INTO `tb_stat` (`ip`, `date`, `hits`, `page`, `user`) VALUES ('$ip', '$date', 1, 'Order', '$pengguna')") or die (mysqli_error());
$cat = $_GET['cat'];
$sql_3 = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE slug = '$cat'") or die(mysqli_error());
$s3 = mysqli_fetch_array($sql_3);
$jenisnya = $s3['jenis'];
$sql_6 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE slug = '$cat'") or die(mysqli_error());
$s6 = mysqli_fetch_array($sql_6);
$catIDD = $s6['id'];
$sql_banner = mysqli_query($conn,"SELECT * FROM `tb_banners` WHERE catID = '$catIDD'") or die(mysqli_error());
$ssbb = mysqli_num_rows($sql_banner);
if($ssbb == 0){
  $lihat = 'false';
}
else {
  $ssb = mysqli_fetch_array($sql_banner);
  $status = $ssb['status'];
}

$sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
$s5 = mysqli_fetch_array($sql_5);
$tripayApi = $s5['api_key'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Top Up <?php echo $s6['kategori']; ?> - <?php echo $s0['instansi']; ?></title>
  <meta name="description" content="<?php echo $s0['deskripsi']; ?>">
  <meta name="keywords" content="<?php echo $s0['keyword']; ?>">
  <meta property="og:title" content="Top Up <?php echo $s6['kategori']; ?> - <?php echo $s0['instansi']; ?>"/>
  <meta property="og:description" content="<?php echo $s0['deskripsi']; ?>" />
  <meta property="og:url" content="<?php echo $urlweb; ?>" />
  <meta property="og:image" content="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" />
  <meta name="resource-type" content="document" />
  <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
  <meta http-equiv="content-language" content="en-us" />
  <meta name="author" content="Arie Budi" />
  <meta name="contact" content="ariebudi.com" />
  <meta name="copyright" content="Copyright (c) ariebudi.com. All Rights Reserved." />
  <meta name="robots" content="index, nofollow">

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo $urlweb; ?>/upload/favicon.png">
  
  <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.css"/>
  <!--Select Plugins-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="<?php echo $urlweb; ?>/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <!-- animate CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Horizontal menu CSS-->
  <link href="<?php echo $urlweb; ?>/assets/css/horizontal-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="<?php echo $urlweb; ?>/assets/css/app-style.css" rel="stylesheet"/>
  <link href="<?php echo $urlweb; ?>/assets/css/style-main<?php echo $s0['warna']; ?>.css" rel="stylesheet"/>
 
</head>

<body>

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start topbar header-->
    <?php include('top_menu.php'); ?>
    <!--End topbar header-->

    <div class="clearfix pt-5"></div>
    <div class="pt-5 pb-5">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="text-center pt-3 pb-2">
                <img src="<?php echo $urlweb; ?>/upload/<?php echo $s6['image']; ?>" class="mb-3" style="display: block; margin: 0 auto; border-radius: 10px !important;" width="120px" height="120px">
                <h5><?php echo $s6['kategori']; ?></h5>
            </div>
            <div class="text-justify pb-3">
              <?php echo $s6['deskripsi']; ?>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">1</div>
                  <h5 style="margin-left: 45px; margin-top: 5px;">Input Data Tujuan</h5>
                  <?php
                    error_reporting(0);
                    if($s6['kategori'] == 'Be The King'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="number" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" required>
                          </div>
                          <div class="col-6">
                            <select name="zone_id" id="zoneID" class="form-control" required>
                              <option value="">Pilih Server</option>
                              <option value="Asia-S1">Asia-S1</option>
                              <option value="Asia-S2">Asia-S2</option>
                              <option value="Asia-S3">Asia-S3</option>
                              <option value="Asia-S4">Asia-S4</option>
                              <option value="Asia-S5">Asia-S5</option>
                              <option value="Asia-S6">Asia-S6</option>
                              <option value="Asia-S7">Asia-S7</option>
                              <option value="Asia-S8">Asia-S8</option>
                              <option value="Asia-S9">Asia-S9</option>
                              <option value="Asia-S10">Asia-S10</option>
                              <option value="Asia-S11">Asia-S11</option>
                              <option value="Asia-S12">Asia-S12</option>
                              <option value="Asia-S13">Asia-S13</option>
                              <option value="Asia-S14">Asia-S14</option>
                              <option value="Asia-S15">Asia-S15</option>
                              <option value="Asia-S16">Asia-S16</option>
                              <option value="Asia-S17">Asia-S17</option>
                              <option value="Asia-S18">Asia-S18</option>
                              <option value="Asia-S19">Asia-S19</option>
                              <option value="Asia-S20">Asia-S20</option>
                              <option value="Asia-S21">Asia-S21</option>
                              <option value="Asia-S22">Asia-S22</option>
                              <option value="Asia-S23">Asia-S23</option>
                              <option value="Asia-S24">Asia-S24</option>
                              <option value="Asia-S25">Asia-S25</option>
                              <option value="Asia-S26">Asia-S26</option>
                              <option value="Asia-S27">Asia-S27</option>
                              <option value="Asia-S28">Asia-S28</option>
                              <option value="Asia-S29">Asia-S29</option>
                              <option value="Asia-S30">Asia-S30</option>
                              <option value="Asia-S31">Asia-S31</option>
                              <option value="Asia-S32">Asia-S32</option>
                              <option value="Asia-S33">Asia-S33</option>
                              <option value="Asia-S34">Asia-S34</option>
                              <option value="Asia-S35">Asia-S35</option>
                              <option value="Asia-S36">Asia-S36</option>
                              <option value="Asia-S37">Asia-S37</option>
                              <option value="Asia-S38">Asia-S38</option>
                              <option value="Asia-S39">Asia-S39</option>
                              <option value="Asia-S40">Asia-S40</option>
                              <option value="Asia-S41">Asia-S41</option>
                              <option value="Asia-S42">Asia-S42</option>
                              <option value="Asia-S43">Asia-S43</option>
                              <option value="Asia-S44">Asia-S44</option>
                              <option value="Asia-S45">Asia-S45</option>
                              <option value="Asia-S46">Asia-S46</option>
                              <option value="Asia-S47">Asia-S47</option>
                              <option value="Asia-S48">Asia-S48</option>
                              <option value="Asia-S49">Asia-S49</option>
                              <option value="Asia-S50">Asia-S50</option>
                              <option value="Asia-S51">Asia-S51</option>
                              <option value="Asia-S52">Asia-S52</option>
                              <option value="Asia-S53">Asia-S53</option>
                              <option value="Asia-S54">Asia-S54</option>
                              <option value="Asia-S55">Asia-S55</option>
                              <option value="Asia-S56">Asia-S56</option>
                              <option value="Asia-S57">Asia-S57</option>
                              <option value="Asia-S58">Asia-S58</option>
                              <option value="Asia-S59">Asia-S59</option>
                              <option value="Asia-S60">Asia-S60</option>
                              <option value="Asia-S61">Asia-S61</option>
                              <option value="Asia-S62">Asia-S62</option>
                              <option value="Asia-S63">Asia-S63</option>
                              <option value="Asia-S64">Asia-S64</option>
                              <option value="Asia-S65">Asia-S65</option>
                              <option value="Asia-S66">Asia-S66</option>
                              <option value="Asia-S67">Asia-S67</option>
                              <option value="Asia-S68">Asia-S68</option>
                              <option value="Asia-S69">Asia-S69</option>
                              <option value="Asia-S70">Asia-S70</option>
                              <option value="Asia-S71">Asia-S71</option>
                              <option value="Asia-S72">Asia-S72</option>
                              <option value="Asia-S73">Asia-S73</option>
                              <option value="Asia-S74">Asia-S74</option>
                              <option value="Asia-S75">Asia-S75</option>
                              <option value="Asia-S76">Asia-S76</option>
                              <option value="Asia-S77">Asia-S77</option>
                              <option value="Asia-S78">Asia-S78</option>
                              <option value="Asia-S79">Asia-S79</option>
                              <option value="Asia-S80">Asia-S80</option>
                              <option value="Asia-S81">Asia-S81</option>
                              <option value="Asia-S82">Asia-S82</option>
                              <option value="Asia-S83">Asia-S83</option>
                              <option value="Asia-S84">Asia-S84</option>
                              <option value="Asia-S85">Asia-S85</option>
                              <option value="Asia-S86">Asia-S86</option>
                              <option value="Asia-S87">Asia-S87</option>
                              <option value="Asia-S88">Asia-S88</option>
                              <option value="Asia-S89">Asia-S89</option>
                              <option value="Asia-S90">Asia-S90</option>
                              <option value="Asia-S91">Asia-S91</option>
                              <option value="Asia-S92">Asia-S92</option>
                              <option value="Asia-S93">Asia-S93</option>
                              <option value="Asia-S94">Asia-S94</option>
                              <option value="Asia-S95">Asia-S95</option>
                              <option value="Asia-S96">Asia-S96</option>
                              <option value="Asia-S97">Asia-S97</option>
                              <option value="Asia-S98">Asia-S98</option>
                              <option value="Asia-S99">Asia-S99</option>
                              <option value="Asia-S100">Asia-S100</option>
                              <option value="Asia-S101">Asia-S101</option>
                              <option value="Asia-S102">Asia-S102</option>
                              <option value="Asia-S103">Asia-S103</option>
                              <option value="Asia-S104">Asia-S104</option>
                              <option value="Asia-S105">Asia-S105</option>
                              <option value="Asia-S106">Asia-S106</option>
                              <option value="Asia-S107">Asia-S107</option>
                              <option value="Asia-S108">Asia-S108</option>
                              <option value="Asia-S109">Asia-S109</option>
                              <option value="Asia-S110">Asia-S110</option>
                              <option value="Asia-S111">Asia-S111</option>
                              <option value="Asia-S112">Asia-S112</option>
                              <option value="Asia-S113">Asia-S113</option>
                              <option value="Asia-S114">Asia-S114</option>
                              <option value="Asia-S115">Asia-S115</option>
                              <option value="Asia-S116">Asia-S116</option>
                              <option value="Asia-S117">Asia-S117</option>
                              <option value="Asia-S118">Asia-S118</option>
                              <option value="Asia-S119">Asia-S119</option>
                              <option value="Asia-S120">Asia-S120</option>
                              <option value="Asia-S121">Asia-S121</option>
                              <option value="Asia-S122">Asia-S122</option>
                              <option value="Asia-S123">Asia-S123</option>
                              <option value="Asia-S124">Asia-S124</option>
                              <option value="Asia-S125">Asia-S125</option>
                              <option value="Asia-S126">Asia-S126</option>
                              <option value="Asia-S127">Asia-S127</option>
                            </select>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'Mobile Legend' || $s6['kategori'] == 'Mobile Legends A' || $s6['kategori'] == 'Mobile Legends B' || $s6['kategori'] == 'Mobile Legends Membership'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="number" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" required>
                          </div>
                          <div class="col-6">
                            <input type="number" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" required>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'Mobile Legends Vilog' || $s6['kategori'] == 'Mobile Legends Joki Rank'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="number" name="userID" id="userID" class="form-control" placeholder="Masukkan Username + Password" required>
                          </div>
                          <div class="col-6">
                            <select name="zone_id" id="zoneID" class="form-control" required>
                              <option value="">Pilih Salah Satu</option>
                              <option value="Moonton"> Moonton</option>
                              <option value="Facebook"> Facebook</option>
                              <option value="TikTok"> TikTok</option>
                              <option value="VK"> VK</option>
                            </select>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'Chimeraland'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="number" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" required>
                          </div>
                          <div class="col-6"> 
                            <select name="zone_id" id="zoneID" class="form-control" required>  
                              <option value="">Pilih Server</option>
                              <option value="DeathQuay">DeathQuay</option>
                              <option value="CrosRiver">CrosRiver</option>
                              <option value="Buckland">Buckland</option>
                              <option value="BurntPlan">BurntPlan</option>
                              <option value="JadeCoast">JadeCoast</option>
                              <option value="PadHill">PadHill</option>
                              <option value="RoniLand">RoniLand</option>
                              <option value="BeautyLake">BeautyLake</option>
                              <option value="BlizzardBay">BlizzardBay</option>
                              <option value="LushField">LushField</option>
                              <option value="DustyPlan">DustyPlan</option>
                              <option value="IceRiver">IceRiver</option>
                              <option value="GreenGuilty">GreenGuilty</option>
                              <option value="AzureField">AzureField</option>
                              <option value="EosBeach">EosBeach</option>
                              <option value="TwilightBay">TwilightBay</option>
                              <option value="Gray Plain">Gray Plain</option>
                              <option value="SandSnow">SandSnow</option>
                            </select>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'LifeAfter'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="number" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" required>
                          </div>
                          <div class="col-6"> 
                            <select name="zone_id" id="zoneID" class="form-control" required> 
                              <option value="">Pilih Server</option>
                              <option value="MiskaTown">MiskaTown</option>
                              <option value="SandCastle">SandCastle</option>
                              <option value="MouthSwamp">MouthSwamp</option>
                              <option value="RedwoodTown">RedwoodTown</option>
                              <option value="Obelisk">Obelisk</option>
                              <option value="FallForest">FallForest</option>
                              <option value="MountSnow">MountSnow</option>
                              <option value="NancyCity">NancyCity</option>
                              <option value="CharlesTown">CharlesTown</option>
                              <option value="SnowHighlands">SnowHighlands</option>
                              <option value="Santopany">Santopany</option>
                              <option value="LevinCity">LevinCity</option>
                              <option value="NewLand">NewLand</option>
                              <option value="MileStone">MileStone</option>
                              <option value="ChaosOutpost">ChaosOutpost</option>
                              <option value="ChaosCity">ChaosCity</option>
                              <option value="TwinIslands">TwinIslands</option>
                              <option value="HopeWall">HopeWall</option>
                              <option value="IronStride">IronStride</option>
                            </select>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'One Punch Man'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan User ID" required>
                          </div>
                          <div class="col-6">
                            <input type="text" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Server ID" required>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'RagnaroK M Eternal Love'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" required>
                          </div>
                          <div class="col-6"> 
                            <select name="zone_id" id="zoneID" class="form-control" required>  
                              <option value="">Pilih Server</option>
                              <option value="Eternal Love">Eternal Love</option>
                              <option value="Midnight Party">Midnight Party</option>
                            </select>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else if($s6['kategori'] == 'RagnaroK X Next Generation'){
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-6">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukkan UID" required>
                          </div>
                          <div class="col-6"> 
                            <select name="zone_id" id="zoneID" class="form-control" required>  
                              <option value="">Pilih Server</option>
                              <option value="Opera Phantom">Opera Phantom</option>
                              <option value="Wing of Blessing">Wing of Blessing</option>
                              <option value="Royal Instrument">Royal Instrument</option>
                              <option value="Valhalla">Valhalla</option>
                              <option value="Gungnir">Gungnir</option>
                              <option value="Central Plains">Central Plains</option>
                              <option value="Dark Lord">Dark Lord</option>
                              <option value="Temple of Dawn">Temple of Dawn</option>
                              <option value="Golden Lava">Golden Lava</option>
                              <option value="Highland">Highland</option>
                              <option value="Demons Castle">Demons Castle</option>
                              <option value="Sealed Island">Sealed Island</option>
                              <option value="Sipera">Sipera</option>
                              <option value="Silent Ship">Silent Ship</option>
                              <option value="Golden Route">Golden Route</option>
                              <option value="Sapir">Sapir</option>
                              <option value="Rose Red">Rose Red</option>
                              <option value="Kingdom of Freedom">Kingdom of Freedom</option>
                              <option value="Nicola">Nicola</option>
                              <option value="Crystal Waterfall">Crystal Waterfall</option>
                              <option value="Bifrost">Bifrost</option>
                              <option value="Nastia">Nastia</option>
                              <option value="Strouf Treasury">Strouf Treasury</option>
                              <option value="Green Tranquil Pond">Green Tranquil Pond</option>
                              <option value="Ingael">Ingael</option>
                              <option value="Tome of Glory">Tome of Glory</option>
                              <option value="Incense Pavilion">Incense Pavilion</option>
                              <option value="Carew">Carew</option>
                              <option value="Boulders and Horns">Boulders and Horns</option>
                              <option value="Exquisite Pond">Exquisite Pond</option>
                              <option value="Nemesis">Nemesis</option>
                              <option value="Bright Lotus Pond">Bright Lotus Pond</option>
                              <option value="Seocho Market">Seocho Market</option>
                              <option value="Eudora">Eudora</option>
                              <option value="Moonlit Temple">Moonlit Temple</option>
                              <option value="Hidden Wood Ruins">Hidden Wood Ruins</option>
                              <option value="Dungeon Throne">Dungeon Throne</option>
                              <option value="Ayothaya">Ayothaya</option>
                              <option value="Luzhon">Luzhon</option>
                              <option value="Majapahit">Majapahit</option>
                              <option value="Garden City">Garden City</option>
                              <option value="Manila">Manila</option>
                              <option value="Sukhothai">Sukhothai</option>
                              <option value="Tossakan">Tossakan</option>
                              <option value="Badang">Badang</option>
                              <option value="Lapulapu">Lapulapu</option>
                              <option value="Gatotkaca">Gatotkaca</option>
                              <option value="Srikandi">Srikandi</option>
                              <option value="Kumpakan">Kumpakan</option>
                              <option value="Angeling">Angeling</option>
                              <option value="Deviling">Deviling</option>
                              <option value="Ghostring">Ghostring</option>
                              <option value="Mastering">Mastering</option>
                              <option value="Xu Nu">Xu Nu</option>
                              <option value="Song Tu">Song Tu</option>
                              <option value="Half Anniversary">Half Anniversary</option>             
                            </select>
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                    else {
                      echo '
                        <div class="form-row pt-3">
                          <div class="col-12">
                            <input type="text" name="userID" id="userID" class="form-control" placeholder="Masukan User ID / Player ID/ UID / IGG ID / Nomor Tujuan" required>
                            <input type="hidden" name="zone_id" id="zoneID" class="form-control" placeholder="Masukkan Zone ID" value="1">
                          </div>
                          <button class="btn btn-success btn-sm m-1" data-toggle="modal" data-target="#modalhelp"><i class="zmdi zmdi-help"></i> Bantuan</button>
                        </div>
                      ';
                    }
                  ?>       
                </div>
              </div>
            </div>

            <div class="modal fade" id="modalhelp">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-dark animated bounceIn" style="background: #1e2124;">
                  <div class="modal-body text-left" style="color: #fff!important;">
                    <?php
                      echo $s6['bantuan'];
                    ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">2</div>
                  <h5 style="margin-left: 45px; margin-top: 5px;">Pilih Layanan</h5>
                  <div class="row pt-3 pl-2 pr-2 mb-2">
                    <?php
                      $kabupaten = mysqli_query($conn,"SELECT * FROM `tb_produk` WHERE kategori = '".$s3['kategori']."' AND status = 1 ORDER BY harga_jual ASC") or die(mysqli_error());
                      $skk = mysqli_num_rows($kabupaten);
                      if($skk == 0){
                        echo '
                          <div class="col-12">
                            <div class="alert alert-warning alert-dismissible mt-3 mb-0" role="alert">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <div class="alert-icon">
                              <i class="fa fa-exclamation-triangle"></i>
                              </div>
                              <div class="alert-message">
                              <span><strong>Information!</strong> Produk sedang tidak tersedia.</span>
                              </div>
                            </div>
                          </div>
                        ';
                      }
                      else {
                        $no=0;
                        while ($kk = mysqli_fetch_array($kabupaten)) {
                          $no++;
                          if(isset($_SESSION['user'])){
                            $usernya = $_SESSION['user'];
                            $cekUser = mysqli_query($conn,"SELECT * FROM `tb_user` WHERE user = '$usernya'");
                            $cu = mysqli_fetch_array($cekUser);
                            if($cu['level'] == 'reseller'){
                              $harga = $kk['harga_reseller'];
                            }
                            else {
                              $harga = $kk['harga_jual'];
                            }
                          }  
                          else {
                            $harga = $kk['harga_jual'];
                          }
                    ?>
                    <div class="col-sm-4 col-6">
                      <input required="" type="radio" id="layanan_<?php echo $no; ?>" class="radio-nominale" name="produkID" value="<?php echo $kk['id']; ?>">
                      <label for="layanan_<?php echo $no; ?>">
                        <?php echo $kk['title']; ?><br>
                        <small>Rp. <?php echo number_format($harga); ?></small>
                      </label>
                    </div>
                    <?php }} ?>
                  </div>  
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">3</div>
                  <h5 style="margin-left: 45px; margin-top: 5px;">Kode Voucher</h5>
                  <div class="form-group pt-3">
                    <input type="text" name="kode_voucher" id="voucher" placeholder="Masukan Kode Voucher apabila ada" class="form-control" value="">
                  </div>
                  <button type="button" id="submitVoucher" class="btn btn-warning btn-sm text-white">Gunakan Kode Voucher</button>
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">4</div>
                  <h5 style="margin-left: 45px; margin-top: 5px;">Pilih Pembayaran</h5>
                  <div class="accordion mt-3" id="accordionExample">
                    <?php
                      error_reporting(0);
                      $cekmutasi = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 7") or die(mysqli_error());
                      $cm = mysqli_fetch_array($cekmutasi);
                      if($cm['status'] == 1){
                    ?>
                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingOne">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <i class="zmdi zmdi-balance" style="font-size: 18px;"></i>&nbsp; Bank Transfer
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              $sql_bank = mysqli_query($conn,"SELECT * FROM `tb_bank` WHERE userID = 1 ORDER BY id ASC") or die(mysqli_error());
                              $noe = 0;
                              while($sb = mysqli_fetch_array($sql_bank)){
                                $noe ++;
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="Direct_<?php echo $sb['image']; ?>" id="flexRadioDefault<?php echo $noe; ?>a">
                              <label for="flexRadioDefault<?php echo $noe; ?>a" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $urlweb; ?>/upload/<?php echo $sb['image']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1"></div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;"><?php echo $sb['akun']; ?><br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                              <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                              <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                              <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="mr-1" style="float: right; display: block; width: auto; height: 25px; background: #fff;">
                          </div>
                      </div>
                    </div>
                    <?php } ?>
                    <?php
                      $cekVa = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE jenis = 0 AND status = 1") or die(mysqli_error());
                      $cv = mysqli_fetch_array($cekVa);
                      if($cv['id'] == 1){
                        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 1") or die(mysqli_error());
                        $s5 = mysqli_fetch_array($sql_5);
                        $tripayApi = $s5['api_key'];

                        $curls = curl_init();
                               
                        curl_setopt_array($curls, array(
                          CURLOPT_FRESH_CONNECT     => true,
                          CURLOPT_URL               => "https://tripay.co.id/api/merchant/payment-channel",
                          CURLOPT_RETURNTRANSFER    => true,
                          CURLOPT_HEADER            => false,
                          CURLOPT_HTTPHEADER        => array(
                            "Authorization: Bearer ".$tripayApi
                          ),
                          CURLOPT_FAILONERROR       => false
                        ));
                                  
                        $responses = curl_exec($curls);
                        $errs = curl_error($curls);
                        curl_close($curls);
                        //echo !empty($err) ? $err : $responses;
                        $hasils = json_decode($responses, true);
                    ?>
                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingTwo">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              for ($i=0; $i < count($hasils['data']); $i++) {
                                if($hasils['data'][$i]['group'] == 'Virtual Account'){
                                  if($hasils['data'][$i]['active'] == 'true'){
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1"></div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['data'][$i]['name']; ?><br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <?php }}} ?>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <?php
                                  for ($i=0; $i < 4; $i++) {
                                    if($hasils['data'][$i]['group'] == 'Virtual Account'){
                                      if($hasils['data'][$i]['active'] == 'true'){
                              ?>
                              <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                              <?php }}} ?>
                          </div>
                      </div>
                    </div>

                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingThree">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="zmdi zmdi-store" style="font-size: 18px;"></i>&nbsp; Convenience Store
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              for ($i=0; $i < count($hasils['data']); $i++) {
                                if($hasils['data'][$i]['group'] == 'Convenience Store'){
                                  if($hasils['data'][$i]['active'] == 'true'){
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1"></div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['data'][$i]['name']; ?><br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <?php }}} ?>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <?php
                                  for ($i=0; $i < count($hasils['data']); $i++) {
                                    if($hasils['data'][$i]['group'] == 'Convenience Store'){
                                      if($hasils['data'][$i]['active'] == 'true'){
                              ?>
                              <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                              <?php }}} ?>
                          </div>
                      </div>
                    </div>

                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingFour">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; E-Wallet
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              for ($i=0; $i < count($hasils['data']); $i++) {
                                if($hasils['data'][$i]['group'] == 'E-Wallet'){
                                  if($hasils['data'][$i]['active'] == 'true'){
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['data'][$i]['code'].'_'.str_replace(' ','-',$hasils['data'][$i]['name']); ?>" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="col-6 p-1">
                                        <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                            <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" style="display: block; width: 100%; height: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-6 p-1"></div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="col-12 p-1">
                                        <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                        <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['data'][$i]['name']; ?><br>
                                        <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <?php }}} ?>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <?php
                                  for ($i=0; $i < count($hasils['data']); $i++) {
                                    if($hasils['data'][$i]['group'] == 'E-Wallet'){
                                      if($hasils['data'][$i]['active'] == 'true'){
                              ?>
                              <img src="<?php echo $hasils['data'][$i]['icon_url']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                              <?php }}} ?>
                          </div>
                      </div>
                    </div>

                    <?php
                      }
                      else if($cv['id'] == 2){

                    ?>
                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0 pl-1 pr-1" id="headingTwo">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_bca" id="flexRadioDefault201a">
                              <label for="flexRadioDefault201a" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 pl-1">
                                            <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-1"></div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 pl-1 pr-1">
                                            <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                            <p style="font-weight: normal; font-size: 10px;">BCA Virtual Account<br>
                                            <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                        </div>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_bni" id="flexRadioDefault202a">
                              <label for="flexRadioDefault202a" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 pl-1">
                                            <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-1"></div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 pl-1 pr-1">
                                            <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                            <p style="font-weight: normal; font-size: 10px;">BNI Virtual Account<br>
                                            <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                        </div>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_bri" id="flexRadioDefault203a">
                              <label for="flexRadioDefault203a" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 pl-1">
                                            <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-1"></div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 pl-1 pr-1">
                                            <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                            <p style="font-weight: normal; font-size: 10px;">BRI Virtual Account<br>
                                            <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                        </div>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="va_mandiri" id="flexRadioDefault204a">
                              <label for="flexRadioDefault204a" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 pl-1">
                                            <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-1"></div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 pl-1 pr-1">
                                            <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                            <p style="font-weight: normal; font-size: 10px;">MANDIRI Virtual Account<br>
                                            <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                        </div>
                                    </div>
                                </div>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <img src="<?php echo $urlweb; ?>/upload/BCAVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                              <img src="<?php echo $urlweb; ?>/upload/BNIVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                              <img src="<?php echo $urlweb; ?>/upload/BRIVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                              <img src="<?php echo $urlweb; ?>/upload/MANDIRIVA.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                          </div>
                      </div>
                    </div>

                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0" id="headingThree">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="zmdi zmdi-balance-wallet" style="font-size: 18px;"></i>&nbsp; E-Wallet
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="VA_QRIS" id="flexRadioDefault205a">
                              <label for="flexRadioDefault205a" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 pl-1">
                                            <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                <img src="<?php echo $urlweb; ?>/upload/linkaja.png" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-1"></div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 pl-1 pr-1">
                                            <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                            <p style="font-weight: normal; font-size: 10px;">QRIS via LinkAja<br>
                                            <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                        </div>
                                    </div>
                                </div>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <img src="<?php echo $urlweb; ?>/upload/linkaja.png" class="mr-1" style="float: left; display: block; width: auto; height: 20px; background: #fff;">
                          </div>
                      </div>
                    </div>

                    <?php
                      }
                      else if($cv['id'] == 3){
                        $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = 3") or die(mysqli_error());
                        $s5 = mysqli_fetch_array($sql_5);
                        $tripayApi = $s5['api_key'];
                        $merchantCodes = $s5['merchant_code'];

                        $datetime = date('Y-m-d H:i:s');  
                        $paymentAmount = 10000;
                        $signature = hash('sha256',$merchantCodes . $paymentAmount . $datetime . $tripayApi);
                        $itemsParam = array(
                          'merchantcode' => $merchantCodes,
                          'amount' => $paymentAmount,
                          'datetime' => $datetime,
                          'signature' => $signature
                        );
                    
                        class emp{}
                    
                        $params = array_merge((array)$result,$itemsParam);
                    
                        $params_string = json_encode($params);
                    
                        $url = 'https://passport.duitku.com/webapi/api/merchant/paymentmethod/getpaymentmethod'; 
                    
                        $ch = curl_init();
                    
                        curl_setopt($ch, CURLOPT_URL, $url); 
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                            'Content-Type: application/json',                                                                                
                            'Content-Length: ' . strlen($params_string))                                                                       
                        );   
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                                
                        $responses = curl_exec($ch);
                        $errs = curl_error($ch);
                        curl_close($ch);
                        //echo !empty($err) ? $err : $response;
                        $hasils = json_decode($responses, true);
                    ?>
                    <div class="card box_game mb-1">
                      <div class="card-header pt-1 pb-0" id="headingTwo">
                        <div class="row">
                          <div class="col-12">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block pl-1 text-left" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="zmdi zmdi-card" style="font-size: 18px;"></i>&nbsp; Virtual Account & E-Wallet
                              </button>
                            </h2>
                          </div>
                        </div>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                          <div class="row mb-2">
                            <?php
                              for ($i=0; $i < count($hasils['paymentFee']); $i++) {
                            ?>
                            <div class="col-12 p-1">
                              <input class="radio-nominal" type="radio" name="metode" value="<?php echo $hasils['paymentFee'][$i]['paymentMethod']; ?>_<?php echo str_replace(' ','',$hasils['paymentFee'][$i]['paymentName']); ?>" id="flexRadioDefault<?php echo $i; ?>">
                              <label for="flexRadioDefault<?php echo $i; ?>" class="p-0">
                                <div class="row ml-2 mr-2 pb-0">
                                    <div class="row">
                                        <div class="col-6 pl-1">
                                            <div style="background: #fff; width: 100px; height: 40px; overflow: hidden; border-radius: 5px;">
                                                <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="card img-fluid mb-1" style="display: block; width: 100%; height: 100%;">
                                            </div>
                                        </div>
                                        <div class="col-6 pr-1"></div>
                                    </div>
                                </div>
                                <div class="row ml-2 mr-2 pt-0">
                                    <div class="row">
                                        <div class="col-12 pl-1 pr-1">
                                            <hr style="width: 100%; border: 1px solid #eee; margin-top: 5px; margin-bottom: 5px;">
                                            <p style="font-weight: normal; font-size: 10px;"><?php echo $hasils['paymentFee'][$i]['paymentName']; ?><br>
                                            <small style="font-weight: normal; font-size: 8px;">Dicek Otomatis</small></p>
                                        </div>
                                    </div>
                                </div>
                              </label>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer" style="background: none;">
                          <div class="float: right;">
                              <?php
                                  for ($i=0; $i < count($hasils['paymentFee']); $i++) {
                              ?>
                              <img src="<?php echo $hasils['paymentFee'][$i]['paymentImage']; ?>" class="mr-1" style="float: right; display: block; width: auto; height: 20px; background: #fff;">
                              <?php } ?>
                          </div>
                      </div>
                    </div>
                    <?php
                      }
                    ?>
                  </div>   
                </div>
              </div>
            </div>

            <div class="pb-3">
              <div class="section">
                <div class="card-body">
                  <div class="text-white text-center position-absolute circle-primary">5</div>
                  <h5 style="margin-left: 45px; margin-top: 5px;">Konfirmasi Pesanan</h5>
                  <div class="form-group pt-3">
                    <?php
                    if (isset($_SESSION['user'])) {
                      $user = mysqli_query($conn, "SELECT * FROM `tb_user` WHERE user = '" . $_SESSION['user'] . "'") or die(mysqli_error());
                      $u = mysqli_fetch_array($user);
                    ?>
                      <input type="hidden" name="full_name" id="fullname" class="form-control" value="<?php echo $u['full_name']; ?>">
                      <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $u['email']; ?>">
                      <input type="hidden" name="IDuser" id="IDuser" class="form-control" value="<?php echo $u['id']; ?>">
                      <input type="text" name="no_hp" id="noHp" placeholder="Masukan No. Whatsapp | Ex : 08xxxxxx" class="form-control" value="" required>
                    <?php } else { ?>
                      <input type="hidden" name="full_name" id="fullname" class="form-control" value="Guest">
                      <input type="hidden" name="email" id="email" class="form-control" value="<?php echo $s1b['email']; ?>">
                      <input type="hidden" name="IDuser" id="IDuser" class="form-control" value="1">
                      <input type="text" name="no_hp" id="noHp" placeholder="Masukan No. Whatsapp | Ex : 08xxxxxx" class="form-control" value="" required>
                    <?php } ?>
                    <p class="col-12 mt-2" style="font-size: 10px; color: #fff;">Isi nomor whatsapp kalian jika ingin mendapatkan notifikasi pesanan.<br />Dengan membeli otomatis saya menyutujui <a href="<?php echo $urlweb; ?>/page/?p=ketentuan-layanan" target="_blank" class="text-warning">Ketentuan Layanan</a>.</p>
                    <a id="submitId" value="submit" class="btn btn-primary text-white">Beli Sekarang</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="formemodales">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-danger text-white animated bounceIn">
                  <div class="modal-header">
                  <h5 class="modal-title">&nbsp;</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body text-center">
                  <i style="font-size:100px" class=" icon-info mb-3 "></i>
                  <p class="mt-3"><strong>Untuk Sementara Transaksi tidak dapat dilakukan!</strong></p>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="formorder">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white animated bounceIn" id="hasilnya" style="background: #151819;"></div>
              </div>
            </div>
            <div class="modal fade" id="formvoucher">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white animated bounceIn" id="hasile" style="background: #151819;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="d-block d-sm-none" style="height: 100px;"></div>
    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
    <div class="modal fade" id="exampleModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark animated bounceIn" style="background: #151819;">
          <div class="modal-body text-left" style="color: #fff!important;">
            <?php
              $sql_banner = mysqli_query($conn,"SELECT * FROM `tb_banners` WHERE catID = '$catIDD'") or die(mysqli_error());
              $ssb = mysqli_fetch_array($sql_banner);
              if($ssb['image'] != ''){
                echo '
                  <img src="'.$urlwebs.'/upload/'.$ssb['image'].'" class="img-fluid mb-3" style="display: block; margin: 0 auto;">
                ';
              }
              echo '<div style="margin: 15px!important;">'.$ssb['content'].'</div>';
            ?>
          </div>
          <div class="modal-footer">
            <div class="row" style="width: 100%;">
              <div class="col-8 text-left">
                
              </div>
              <div class="col-4 text-right">
                  <button type="button" class="btn btn-warning" data-dismiss="modal" aria-label="Close">
                      Tutup
                  </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--Start footer-->
    <?php include('footer.php'); ?>
  <script>
      $(window).on('load', function() {
        $('#exampleModal').modal({show: <?php echo $lihat; ?>, backdrop: 'static', keyboard: false});
      });
      $(document).ready(function() {
        $("input:radio[name=produkID]").change(function (){
            url = "<?php echo $urlweb; ?>/select_game.php?id="+$('input:radio[name=produkID]:checked').val();
            $('#accordionExample').load(url);
            //console.log(url);
            return false;
        });
        $("#submitVoucher").click(function (){
            urle = "<?php echo $urlweb; ?>/select_voucher.php?id="+$('#voucher').val();
            $('#formvoucher').modal('show');
            $('#hasile').load(urle);
            //console.log(url);
            return false;
        });
        $("#submitId").click(function () {
            uri = "<?php echo $urlweb; ?>/get_detail.php?userID="+$("#userID").val()+"&zoneID="+$("#zoneID").val()+"&produkID="+$('input:radio[name=produkID]:checked').val()+"&metode="+$('input:radio[name=metode]:checked').val()+"&IDuser="+$("#IDuser").val()+"&noHp="+$("#noHp").val()+"&voucher="+$("#voucher").val();
            $('#formorder').modal('show');
          $('#hasilnya').load(uri);
          console.log(uri);
          return false;
        });
          $("#buttonSubmit").click(function () {
          $("#search_form").submit();
        })
      });
  </script>
</body>
</html>
