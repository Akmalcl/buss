    <div class="pt-5 pb-5" style="background:#1e2124!important;">
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

    <div class="container pb-4">
      <div class="row">
        <div class="col-sm-6">
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
                <?php echo $sj['jenis']; ?>
              </a>
            </li>
            <?php } ?>
          </ul>
        </div>
        <div class="col-sm-6">
          <form action="<?php echo $urlweb; ?>/search/" method="GET">
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="keyword"  name="keyword" autocomplete="off" placeholder="Ketik Nama Game..." aria-label="Ketik Nama Game..." aria-describedby="button-addon2">
              <div class="input-group-append">
                <button class="btn btn-warning" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
              </div>
            </div>
            <style>
                  #res {
                    position: absolute;
                    width: 90%;
                    max-width:90%;
                    cursor: pointer;
                    overflow-y: auto;
                    max-height: 400px;
                    box-sizing: border-box;
                    z-index: 2;
                    border-color: white;
                    margin-top:-2px;
                    color: #000;
                  }
                  .link-class{
                      border-color:white;
                  }
                  .list-group{
                      border-radius:0;
                  }
                  .link-class:hover{
                    background-color:#fff;
                    color: #000;
                    cursor: pointer;
                  }
                  </style>
                  <div class="container">
                      <ul class="list-group" style="margin-left: 0!important;" id="res"></ul>
                  </div>
          </form>
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
              <div class="col-sm-3 col-lg-2 col-4 text-center p-1">
                <div class="card p-1 mb-0 zoom" style="background: none;">
                  <div class="card-body p-1">
                    <a href="<?php echo $urlweb; ?>/<?php echo strtolower($sj['jenis']); ?>/<?php echo $s3['slug']; ?>/" class="product_list">
                      <img src="<?php echo $urlweb; ?>/upload/<?php echo $s3['image']; ?>" class="img-fluid" style="border-radius: 10px; display: block;">
                      <div style="min-height: 40px;"><?php echo $s3['kategori']; ?></div>
                      <div style="min-height: 30px; font-size: 10px;"><?php echo $s3['subtitle']; ?></div>
                    </a>
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