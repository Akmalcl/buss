      
        <header>
          <nav class="navbar navbar-expand-lg fixed-top navbar-light shadow-sm bg-custom d-none .d-sm-block">
            <div class="container">
              <a class="navbar-brand" href="<?php echo $urlweb; ?>">
                <img src="<?php echo $urlweb; ?>/upload/<?php echo $s0['image']; ?>" style="width: auto; height: 50px; color: #fff!important;" alt="logo icon">
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars" style="font-size: 26px; color: #fff!important;"></i>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>" style="color: #fff;"><i class="fa fa-home pr-2" style="width: 20px;"></i> Beranda</a>
                  </li>
                  <?php if(isset($_SESSION['user'])){ ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>/wallet/" style="color: #fff;"><i class="zmdi zmdi-balance-wallet"></i> Saldo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>/transaction/" style="color: #fff;"><i class="fas fa-history"></i> Riwayat</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>/e_user/" style="color: #fff;"><i class="fas fa-user"></i> Profile</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link btn btn-warning btn-sm text-white" href="<?php echo $urlweb; ?>/logout/"><i class="fa fa-power-off"></i></a>
                  </li>
                  <?php } else { ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>/cektrx/" style="color: #fff;"><i class="fa fa-search" style="width: 20px;"></i> Cek Pesanan</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo $urlweb; ?>/harga/" style="color: #fff;"><i class="fa fa-tag" style="width: 20px;"></i> Daftar Harga</a>
                  </li>
                  <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle" aria-expanded="false" style="color: #fff;">
                      <span class="rounded-circle mr-1" style="color: #fff;"> <i class="fas fa-sign-in-alt" style="color: #fff;"></i> </span>
                      Masuk/Daftar
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" style="color: #fff;">
                      <a href="<?php echo $urlweb; ?>/login/" class="dropdown-item has-icon">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                      </a>
                      <a href="<?php echo $urlweb; ?>/register/" class="dropdown-item has-icon">
                        <i class="fas fa-user-plus"></i> Buat Akun
                      </a>
                    </div>
                  </li>
                </ul>
                <?php } ?>
              </div>
            </div>
          </nav>
        </header>
