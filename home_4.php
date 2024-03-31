<style type="text/css">
  .sticky {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 99999;
}

/* Tambahkan beberapa padding atas ke konten halaman untuk mencegah gerakan cepat mendadak (karena header mendapat posisi baru di bagian atas halaman (posisi: tetap dan atas: 0) */
.sticky + .content {
  padding-top: 102px;
}
</style>
<div class="pt-3" style="background:#1e2124!important;">
        <div class="container">
            <div class="carousel"
              data-flickity='{ "wrapAround": true, "imagesLoaded": true, "percentPosition": false, "freeScroll": true, "autoPlay": true, "adaptiveHeight": true }'>
                <?php
                    $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
                    $no=0;
                    while($s2 = mysqli_fetch_array($sql_2)){
                        $no++;
                ?>
                <img src="<?php echo $urlweb; ?>/upload/<?php echo $s2['image']; ?>" style="border-radius: 10px !important;" alt="First slide">
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container pb-4" id="myHeader">
      <div class="row">
        <div class="col-12">
          <ul class="nav nav-tabs" id="myTab" role="tablist" style="width: 100%!important; border-bottom-left-radius: 10px !important; border-bottom-right-radius: 10px !important;">
            <?php
              $sql_jenis = mysqli_query($conn,"SELECT * FROM `tb_jenis` WHERE status = 1 ORDER BY id ASC LIMIT 5") or die(mysqli_error());
              $h = mysqli_num_rows($sql_jenis);
              $lebar = 100 / $h;
              $no = 0;
              while($sj = mysqli_fetch_array($sql_jenis)){
                $no++;
            ?>
            <li class="nav-item" role="presentation" style="width: <?php echo $lebar; ?>%; border-bottom-left-radius: 10px !important;">
              <a class="nav-link<?php if($no == 1) { echo ' active'; } ?>" id="<?php echo strtolower($sj['jenis']); ?>-tab" data-toggle="tab" href="#<?php echo strtolower($sj['jenis']); ?>" role="tab" aria-controls="<?php echo strtolower($sj['jenis']); ?>" aria-selected="true" style="font-size: 10px;">
                <p><i class="<?php echo $sj['image']; ?> fa-2x"></i></p>
                <?php echo $sj['jenis']; ?>
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="pb-4">
      <div class="container">
        <div class="tab-content" id="myTabContent">
          <?php
            $sql_jenis = mysqli_query($conn,"SELECT * FROM `tb_jenis` WHERE status = 1 ORDER BY id ASC LIMIT 5") or die(mysqli_error());
            $no = 0;
            while($sj = mysqli_fetch_array($sql_jenis)){
              $no++;
              $jenisnya = $sj['jenis'];
              if($jenisnya == 'Game'){
                $parent = 1;
                $table = 'tb_produk';
              }
              else if($jenisnya == 'Pulsa'){
                $parent = 3;
                $table = 'tb_prepaid';
              }
              else if($jenisnya == 'Emoney'){
                $parent = 4;
                $table = 'tb_prepaid';
              }
              else if($jenisnya == 'Premium'){
                $parent = 2;
                $table = 'tb_produk';
              }
              else if($jenisnya == 'Social'){
                $parent = 5;
                $table = 'tb_produk_social';
              }
          ?>
          <div class="tab-pane fade<?php if($no == 1) { echo ' show active'; } ?> p-3" id="<?php echo strtolower($sj['jenis']); ?>" role="tabpanel" aria-labelledby="<?php echo strtolower($sj['jenis']); ?>-tab">
            <h5><?php echo $sj['jenis']; ?></h5>
            <span class="strip-primary"></span>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <div class="row game">
              <?php
                $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE parent = '$parent' AND status = 1 ORDER BY kategori ASC") or die(mysqli_error());
                while($s3 = mysqli_fetch_array($sql_3)){
                  $kategori = $s3['kategori'];
                  if($jenisnya == 'Game'){
                    $hitung = mysqli_query($conn,"SELECT * FROM $table WHERE kategori = '$kategori'") or die(mysqli_error());
                  }
                  else if($jenisnya == 'Pulsa'){
                    $hitung = mysqli_query($conn,"SELECT * FROM $table WHERE brand = '$kategori'") or die(mysqli_error());
                  }
                  else if($jenisnya == 'Emoney'){
                    $hitung = mysqli_query($conn,"SELECT * FROM $table WHERE brand = '$kategori'") or die(mysqli_error());
                  }
                  else if($jenisnya == 'Premium'){
                    $hitung = mysqli_query($conn,"SELECT * FROM $table WHERE kategori = '$kategori'") or die(mysqli_error());
                  }
                  else if($jenisnya == 'Social'){
                    $hitung = mysqli_query($conn,"SELECT * FROM $table WHERE kategori = '$kategori'") or die(mysqli_error());
                  }
                  $h = mysqli_num_rows($hitung);
                  if($h > 0){
              ?>
              <div class="col-sm-3 col-lg-2 col-4 mb-5 text-center p-1" style="">
                <div class="card p-1 mb-0 zoom" style="background: #151819; height: 175px;">
                  <div class="card-body p-1">
                    <a href="<?php echo $urlweb; ?>/<?php echo strtolower($sj['jenis']); ?>/<?php echo $s3['slug']; ?>/" class="product_list">
                      <img src="<?php echo $urlweb; ?>/upload/<?php echo $s3['image']; ?>" style="display: block; margin: 0 auto; width: auto; height: 80px; border-radius: 10px; margin-top: -45px; margin-bottom: 15px;">
                      <div style="min-height: 40px;"><?php echo $s3['kategori']; ?></div>
                      <div style="min-height: 30px; font-size: 10px;"><?php echo $s3['subtitle']; ?></div>
                    </a>
                    <a href="<?php echo $urlweb; ?>/<?php echo strtolower($sj['jenis']); ?>/<?php echo $s3['slug']; ?>/" class="btn btn-warning btn-sm btn-block mt-2" style="border-radius: 25px;">Beli</a>
                  </div>
                </div>
              </div>
              <?php }} ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>