<?php include('session.php'); ?>
<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="<?php echo $urlweb; ?>/assets/"
  data-template="vertical-menu-template"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?php echo $s0['instansi']; ?></title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="resource-type" content="document" />
    <meta http-equiv="content-type" content="text/html; charset=US-ASCII" />
    <meta http-equiv="content-language" content="en-us" />
    <meta name="author" content="Arie Budi" />
    <meta name="contact" content="ariebudi.com" />
    <meta name="copyright" content="Copyright (c) ariebudi.com. All Rights Reserved." />
    <meta name="robots" content="index, nofollow">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $urlwebs; ?>/upload/favicon.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?php echo $urlweb; ?>/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="<?php echo $urlweb; ?>/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?php echo $urlweb; ?>/assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <?php include('sidebar.php'); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <?php include('top-menu.php'); ?>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..."
              />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <?php
                  error_reporting(0);
                  $today = date('Y-m');
                  $sql_3 = mysqli_query($conn,"SELECT * FROM `tb_produk`") or die(mysqli_error());
                  $s3 = mysqli_num_rows($sql_3);
                  $sql_32 = mysqli_query($conn,"SELECT * FROM `tb_prepaid`") or die(mysqli_error());
                  $s32 = mysqli_num_rows($sql_32);
                  $sql_33 = mysqli_query($conn,"SELECT * FROM `tb_produk_social`") or die(mysqli_error());
                  $s33 = mysqli_num_rows($sql_33);
                  $totalProduk = $s3 + $s32 + $s33;
                  $sql_4 = mysqli_query($conn,"SELECT SUM(qty) as orders FROM `tb_order` WHERE status = 1 AND created_date LIKE '$today%'") or die(mysqli_error());
                  $s4 = mysqli_fetch_array($sql_4);
                  $sql_5 = mysqli_query($conn,"SELECT SUM(sub_total) as purchase FROM `tb_order` WHERE status IN(1,2) AND created_date LIKE '$today%'") or die(mysqli_error());
                  $s5 = mysqli_fetch_array($sql_5);
                  $sql_6 = mysqli_query($conn,"SELECT SUM(hits) as visitor FROM `tb_stat`") or die(mysqli_error());
                  $s6 = mysqli_fetch_array($sql_6);
                  $sql_7 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE status IN(1,2) AND created_date LIKE '$today%' GROUP BY no_hp") or die(mysqli_error());
                  $s7 = mysqli_num_rows($sql_7);
                  $sql_8 = mysqli_query($conn,"SELECT a.harga_modal, a.harga_jual, a.id, b.* FROM tb_produk as a INNER JOIN tb_order as b ON a.id = b.produkID WHERE b.status IN(1,2) AND b.created_date LIKE '$today%'") or die(mysqli_error());
                  $s8 = mysqli_fetch_array($sql_8);
                  $selisihA = $s8['harga_jual'] - $s8['harga_modal'];
                  $sql_9 = mysqli_query($conn,"SELECT a.harga_modal, a.harga_jual, a.id, b.* FROM tb_prepaid as a INNER JOIN tb_order as b ON a.id = b.produkID WHERE b.status IN(1,2) AND b.created_date LIKE '$today%'") or die(mysqli_error());
                  $s9 = mysqli_fetch_array($sql_9);
                  $selisihB = $s9['harga_jual'] - $s9['harga_modal'];
                  $sql_10 = mysqli_query($conn,"SELECT a.harga_modal, a.harga_jual, a.id, b.* FROM tb_prepaid as a INNER JOIN tb_order as b ON a.id = b.produkID WHERE b.status IN(1,2) AND b.created_date LIKE '$today%'") or die(mysqli_error());
                  $s10 = mysqli_fetch_array($sql_10);
                  $selisihC = $s10['harga_jual'] - $s10['harga_modal'];
                  $income = $selisihA + $selisihB + $selisihC;
                  $totalBelanja = $s8['harga_modal'] + $s9['harga_modal'] + $s10['harga_modal'];
                ?>
                <!-- Statistics -->
                <div class="col-xl-12 mb-4 col-lg-12 col-12">
                  <div class="card h-100">
                    <div class="card-header">
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                        <small class="text-muted">Updated Today</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row gy-3">
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                              <i class="ti ti-users ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo number_format($s7); ?></h5>
                              <small>Pelanggan</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                              <i class="ti ti-shopping-cart ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo number_format($totalProduk); ?></h5>
                              <small>Produk</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                              <i class="ti ti-chart-pie-2 ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0">Rp. <?php echo number_format($s5['purchase']); ?></h5>
                              <small>Penjualan</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                              <i class="ti ti-currency-dollar ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0">Rp. <?php echo number_format($income); ?></h5>
                              <small>Pendapatan</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Statistics -->

                <!-- Revenue Report -->
                <div class="col-12 col-xl-6 mb-4 col-lg-6">
                  <div class="card h-100">
                    <div class="card-header pb-0 d-flex justify-content-between mb-lg-n4">
                      <div class="card-title mb-0">
                        <h5 class="mb-0">Laporan Penjualan</h5>
                        <small class="text-muted">Penghasilan Dalam 1 Bulan</small>
                      </div>
                      <!-- </div> -->
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12 col-md-4 d-flex flex-column align-self-end">
                          <div class="d-flex gap-2 align-items-center mb-2 pb-1 flex-wrap">
                            <h1 class="mb-0">Rp. <?php echo number_format($s5['purchase']); ?></h1>
                            <div class="badge rounded bg-label-success"></div>
                          </div>
                          <small class="text-muted"></small>
                        </div>
                        <div class="col-12 col-md-8">
                          <div id="weeklyEarningReports"></div>
                        </div>
                      </div>
                      <div class="border rounded p-3 mt-2">
                        <div class="row gap-4 gap-sm-0">
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-primary p-1">
                                <i class="ti ti-currency-dollar ti-sm"></i>
                              </div>
                              <h6 class="mb-0">Total Penjualan</h6>
                            </div>
                            <h4 class="my-2 pt-1">Rp. <?php echo number_format($s5['purchase']); ?></h4>
                            <div class="progress w-75" style="height: 4px">
                              <div
                                class="progress-bar"
                                role="progressbar"
                                style="width: 65%"
                                aria-valuenow="65"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-info p-1"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                              <h6 class="mb-0">Total Profit</h6>
                            </div>
                            <h4 class="my-2 pt-1">Rp. <?php echo number_format($income); ?></h4>
                            <div class="progress w-75" style="height: 4px">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width: 50%"
                                aria-valuenow="50"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                          <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                              <div class="badge rounded bg-label-danger p-1">
                                <i class="ti ti-brand-paypal ti-sm"></i>
                              </div>
                              <h6 class="mb-0">Total Belanja</h6>
                            </div>
                            <h4 class="my-2 pt-1">Rp. <?php echo number_format($totalBelanja); ?></h4>
                            <div class="progress w-75" style="height: 4px">
                              <div
                                class="progress-bar bg-danger"
                                role="progressbar"
                                style="width: 65%"
                                aria-valuenow="65"
                                aria-valuemin="0"
                                aria-valuemax="100"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Revenue Report -->

                <!-- Popular Product -->
                <div class="col-md-6 col-xl-6 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Pembayaran Terakhir</h5>
                        <small class="text-muted">Total Penjualan</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr class="bg-info text-white">
                              <th class="text-center">Tanggal</th>
                              <th class="text-center">No. Transaksi</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql_11 = mysqli_query($conn,"SELECT * FROM `tb_tripay` WHERE status = 'PAID' AND created_date LIKE '$today%' ORDER BY id DESC LIMIT 10") or die(mysqli_error());
                              while($s11 = mysqli_fetch_array($sql_11)){
                            ?>
                            <tr>
                              <td style="vertical-align: middle; white-space: normal;"><?php echo $s11['created_date']; ?></td>
                              <td style="vertical-align: middle; white-space: normal;"><?php echo $s11['merchant_ref']; ?></td>
                              <td class="text-right" style="vertical-align: middle; white-space: normal;">Rp. <?php echo number_format($s11['amount_total']); ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Popular Product -->

                <!-- Popular Product -->
                <div class="col-md-6 col-xl-4 mb-4 mb-lg-0">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Produk Top Up Terlaris</h5>
                        <small class="text-muted">Total Penjualan</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr class="bg-info text-white">
                              <th class="text-center">Produk</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql_12 = mysqli_query($conn,"SELECT a.*, b.*, b.title as nama, COUNT(b.produkID) as totalProduk FROM tb_produk as a INNER JOIN tb_order as b ON a.id = b.produkID WHERE b.status = 1 AND b.created_date LIKE '$today%' GROUP BY b.produkID ORDER BY totalProduk DESC LIMIT 10") or die(mysqli_error());
                              while($s12 = mysqli_fetch_array($sql_12)){
                            ?>
                            <tr>
                              <td style="vertical-align: middle; white-space: normal;"><?php echo $s12['nama']; ?></td>
                              <td class="text-right" style="vertical-align: middle; white-space: normal;"><?php echo $s12['totalProduk']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Popular Product -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Produk Prepaid Terlaris</h5>
                        <small class="text-muted">Total Penjualan</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr class="bg-info text-white">
                              <th class="text-center">Produk</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql_13 = mysqli_query($conn,"SELECT a.*, b.*, b.title as nama, COUNT(b.produkID) as totalProduk FROM tb_prepaid as a INNER JOIN tb_order as b ON a.id = b.produkID WHERE b.status = 1 AND b.created_date LIKE '$today%' GROUP BY b.produkID ORDER BY totalProduk DESC LIMIT 10") or die(mysqli_error());
                              while($s13 = mysqli_fetch_array($sql_13)){
                            ?>
                            <tr>
                              <td style="vertical-align: middle; white-space: normal;"><?php echo $s13['nama']; ?></td>
                              <td class="text-right" style="vertical-align: middle; white-space: normal;"><?php echo $s13['totalProduk']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->

                <!-- Transactions -->
                <div class="col-md-6 col-lg-4 mb-4 mb-lg-0">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                      <div class="card-title m-0 me-2">
                        <h5 class="m-0 me-2">Produk Social Media Terlaris</h5>
                        <small class="text-muted">Total Penjualan</small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr class="bg-info text-white">
                              <th class="text-center">Produk</th>
                              <th class="text-center">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              $sql_14 = mysqli_query($conn,"SELECT a.*, b.*, b.title as nama, b.*, COUNT(b.produkID) as totalProduk FROM tb_produk_social as a INNER JOIN tb_order as b ON a.id = b.produkID WHERE b.status = 1 AND b.created_date LIKE '$today%' GROUP BY b.produkID ORDER BY totalProduk DESC LIMIT 10") or die(mysqli_error());
                              while($s14 = mysqli_fetch_array($sql_14)){
                            ?>
                            <tr>
                              <td style="vertical-align: middle; white-space: normal;"><?php echo $s14['nama']; ?></td>
                              <td class="text-right" style="vertical-align: middle; white-space: normal;"><?php echo $s14['totalProduk']; ?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Transactions -->

              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
                >
                  <div>
                    ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                    , <?php echo $s0['instansi']; ?> All Rights Reserved.
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/popper/popper.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/js/bootstrap.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="<?php echo $urlweb; ?>/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-buttons/buttons.html5.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-buttons/buttons.print.js"></script>

    <!-- Main JS -->
    <script src="<?php echo $urlweb; ?>/assets/js/main.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/js/dashboards-analytics.js"></script>

  </body>
</html>
