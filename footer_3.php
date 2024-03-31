    <footer id="aboutus" class="bg-footer">
      <div data-v-10b0ebbe="" class="product-tile__clip-path"></div>
      <div class="pt-5 pb-5" bis_skin_checked="1">
        <div class="container" bis_skin_checked="1">
          <div class="row" bis_skin_checked="1">
            <div class="col-lg-8 col-sm-8" bis_skin_checked="1">
              <img src="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" style="width: auto; height: 50px; margin-bottom: 15px;" alt="logo icon">
              <p>Top Up Mobile Legends, Free Fire, Genshin Impact, PUBG Mobile, dll. Buka 24 Jam Top Up Kilat Proses 1 Detik Murah, Aman, dan Terpercaya</p>
              <p><i class="fas fa-envelope pr-3"></i>: <?php echo $s1b['email']; ?></p>
              <p><i class="fas fa-headphones pr-3"></i>: 09:00 - 23:00 WIB</p>
              <hr>
              <ul class="nav mb-3">
                    
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/cektrx/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Cek Status Pesanan</a>
                </li>
                <?php if(isset($_SESSION['user'])){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/transaction/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Riwayat</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/e_user/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/logout/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Logout</a>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/login/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Login</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/register/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Register</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo $urlweb; ?>/contact/"><i class="fa fa-circle-dot pr-2" style="width: 20px;"></i> Hubungi Kami</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-4 col-sm-4 col-12" bis_skin_checked="1">
              <h5 class="pb-2">Produk Favorit</h5>
              <div class="row">
                <?php
                  $sql_39 = mysqli_query($conn,"SELECT * FROM `tb_kategori` WHERE parent = 1 AND status = 1 ORDER BY rand() LIMIT 6") or die(mysqli_error());
                  while($s39 = mysqli_fetch_array($sql_39)){
                ?>
                <div class="col-4 mb-2">
                  <a href="<?php echo $urlweb; ?>/game/<?php echo $s39['slug']; ?>/">
                    <img src="<?php echo $urlweb; ?>/upload/<?php echo $s39['image']; ?>" class="img-fluid" style="border-radius: 10px; display: block;">
                  </a>
                </div>
                <?php } ?>
              </div>
              <h5 class="mt-2 pb-2">Pembayaran</h5>
              <marquee>
                <img src="<?php echo $urlweb; ?>/upload/bca_footer.png" width="80px" class="ml-3 bg-white p-1">
                <img src="<?php echo $urlweb; ?>/upload/linkaja_footer.png" width="80px" class="ml-3 bg-white p-1">
                <img src="<?php echo $urlweb; ?>/upload/shopay_footer.png" width="80px" class="ml-3 bg-white p-1">
                <img src="<?php echo $urlweb; ?>/upload/ovo_footer.png" width="80px" class="ml-3 bg-white p-1">
                <img src="<?php echo $urlweb; ?>/upload/dana_footer.png" width="80px" class="ml-3 bg-white p-1">
                <img src="<?php echo $urlweb; ?>/upload/qris_footer.png" width="80px" class="ml-3 bg-white p-1">
              </marquee>
            </div>
          </div>

          <div class="pt-5 pb-2" bis_skin_checked="1">
            <div class="row">
              <div class="col-sm-4 pt-2">
                © Copyright <?php echo date('Y'); ?>. All Rights Reserved
              </div>
              <div class="col-sm-8">
                <ul class="nav float-right">
                  <?php
                    $sql_page = mysqli_query($conn,"SELECT * FROM `tb_page` ORDER BY id ASC LIMIT 5") or die(mysqli_error());
                    while($sp = mysqli_fetch_array($sql_page)){
                  ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>/page/?p=<?php echo $sp['slug']; ?>"><?php echo $sp['nama_page']; ?></a>
                  </li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!--End footer-->
  
  </div><!--End wrapper-->
  <div style="background: none; position: fixed; bottom: 5%; right: 1%; z-index: 9999; width: 50px; font-size: 42px; line-height: 60px; text-align: center;">
      <div id="showcallcenter" style="display: none;">
      <?php if($s1a['instagram'] != '#'){ ?>
      <a href="<?php echo $s1a['instagram']; ?>" target="_blank">
          <div class="mb-2" style="width: 50px; height: 50px; border-radius: 10px; line-height: 45px; background: radial-gradient(circle farthest-corner at 35% 90%, #fec564, transparent 50%), radial-gradient(circle farthest-corner at 0 140%, #fec564, transparent 50%), radial-gradient(ellipse farthest-corner at 0 -25%, #5258cf, transparent 50%), radial-gradient(ellipse farthest-corner at 20% -50%, #5258cf, transparent 50%), radial-gradient(ellipse farthest-corner at 100% 0, #893dc2, transparent 50%), radial-gradient(ellipse farthest-corner at 60% -20%, #893dc2, transparent 50%), radial-gradient(ellipse farthest-corner at 100% 100%, #d9317a, transparent), linear-gradient(#6559ca, #bc318f 30%, #e33f5f 50%, #f77638 70%, #fec66d 100%);">
              <i class="fab fa-instagram" style="font-size: 32px;!important"></i>
          </div>
      </a>
      <?php } ?>
      <a href="https://wa.me/<?php echo $s1b['no_hp']; ?>" target="_blank">
          <div class="mb-2" style="width: 50px; height: 50px; border-radius: 10px; line-height: 42px; background-color: #25D366;">
              <i class="fab fa-whatsapp" style="font-size: 32px;!important"></i>
          </div>
      </a>
      <?php if($s1a['facebook'] != '#'){ ?>
      <a href="<?php echo $s1a['facebook']; ?>" target="_blank">
          <div class="mb-2" style="width: 50px; height: 50px; border-radius: 10px; line-height: 45px; background-color: #5865F2;">
              <i class="fab fa-facebook" style="font-size: 32px;!important"></i>
          </div>
      </a>
      <?php } ?>
      <?php if($s1a['linkedin'] != '#'){ ?>
      <a href="<?php echo $s1a['linkedin']; ?>" target="_blank">
          <div class="mb-2" style="width: 50px; height: 50px; border-radius: 10px; line-height: 45px; background-color: #333;">
              <i class="fab fa-tiktok" style="font-size: 32px;!important"></i>
          </div>
      </a>
      <?php } ?>
      </div>
      <a id="callcenter" onclick="myFunctiona()">
          <div class="mb-2" style="width: 50px; height: 50px; border-radius: 10px; line-height: 45px; background-color: #fff;">
              <img src="<?php echo $urlweb; ?>/upload/callcenter.png" style="width: 100%; height: auto; display: block; margin: 0 auto;">
          </div>
      </a>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo $urlweb; ?>/assets/js/jquery.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/js/popper.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/js/bootstrap.min.js"></script>
  
  <!-- simplebar js -->
  <script src="<?php echo $urlweb; ?>/assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- horizontal-menu js -->
  <script src="<?php echo $urlweb; ?>/assets/js/horizontal-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="<?php echo $urlweb; ?>/assets/plugins/summernote/dist/summernote-bs4.min.js"></script>
  <!--Select Plugins Js-->
  <script src="<?php echo $urlweb; ?>/assets/plugins/select2/js/select2.min.js"></script>
  <!--Data Tables js-->
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="<?php echo $urlweb; ?>/assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
  <script>
    $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable();
      $('#default-datatable1').DataTable();
      $('#default-datatable2').DataTable();
    });
    function openNav() {
      document.getElementById("mySidenav").style.width = "300px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
    }
    function myFunctiona() {
      var x = document.getElementById("showcallcenter");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
  </script>