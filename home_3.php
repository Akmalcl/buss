    <div id="carousel-1" class="carousel slide d-none d-sm-block" data-ride="carousel">
      <div class="container">
        <ol class="carousel-indicators">
          <?php
            $sql_21 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
            $nos=0;
            while($s21 = mysqli_fetch_array($sql_21)){
                $nos++;
                $a = $nos - 1;
          ?>
          <li data-target="#carousel-1" data-slide-to="<?php echo $a; ?>"<?php if($nos == 1){ echo ' class="active"'; } ?>></li>
          <?php } ?>
        </ol>
        <div class="carousel-inner">
          <?php
            $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
            $no = 0;
            while($s2 = mysqli_fetch_array($sql_2)){
              $no++;
          ?>
          <div class="carousel-item<?php if($no == 1) { echo ' active'; } ?>" style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important;">
            <img class="d-block w-100" src="<?php echo $urlweb; ?>/upload/<?php echo $s2['image']; ?>" style="border-top-left-radius: 10px !important; border-top-right-radius: 10px !important;" alt="First slide">
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div id="carousel-1" class="carousel slide d-block d-sm-none" data-ride="carousel">
      <div class="container p-0">
        <ol class="carousel-indicators">
          <?php
            $sql_21 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
            $nos=0;
            while($s21 = mysqli_fetch_array($sql_21)){
                $nos++;
                $a = $nos - 1;
          ?>
          <li data-target="#carousel-1" data-slide-to="<?php echo $a; ?>"<?php if($nos == 1){ echo ' class="active"'; } ?>></li>
          <?php } ?>
        </ol>
        <div class="carousel-inner">
          <?php
            $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_slide` ORDER BY id DESC LIMIT 5") or die(mysqli_error());
            $no = 0;
            while($s2 = mysqli_fetch_array($sql_2)){
              $no++;
          ?>
          <div class="carousel-item<?php if($no == 1) { echo ' active'; } ?>">
            <img class="d-block w-100" src="<?php echo $urlweb; ?>/upload/<?php echo $s2['image']; ?>" alt="First slide">
          </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="container pb-4">
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
              <div class="col-sm-3 col-lg-2 col-4 text-center p-2">
                <div class="card zoom mb-3" style="background: #fdd017!important; border-radius: 10px;">
                  <a href="<?php echo $urlweb; ?>/<?php echo strtolower($sj['jenis']); ?>/<?php echo $s3['slug']; ?>/" class="product_list">
                    <img src="<?php echo $urlweb; ?>/upload/<?php echo $s3['image']; ?>" class="img-fluid" style="border-radius: 10px; display: block;">
                    <div data-v-10b0ebbe="" class="product-tile__clip-path bg-dark"></div>
                    <div class="card-title text-center mt-3" bis_skin_checked="1" style="color: #000;">
                      <div style="min-height: 40px;"><?php echo $s3['kategori']; ?></div>
                      <div style="min-height: 30px; font-size: 10px;"><?php echo $s3['subtitle']; ?></div>
                    </div>
                  </a>
                </div>
              </div>
              <?php }} ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>