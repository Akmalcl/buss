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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Transaction /</span> Order List</h4>
              <div class="row">
                <?php
                  error_reporting(0);
                  $today = date('Y-m');
                  $sql_4 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE status = 0 AND created_date LIKE '$today%'") or die(mysqli_error());
                  $s4 = mysqli_num_rows($sql_4);
                  $sql_5 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE status = 1 AND created_date LIKE '$today%'") or die(mysqli_error());
                  $s5 = mysqli_num_rows($sql_5);
                  $sql_6 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE status = 2 AND created_date LIKE '$today%'") or die(mysqli_error());
                  $s6 = mysqli_num_rows($sql_6);
                  $sql_7 = mysqli_query($conn,"SELECT * FROM `tb_order` WHERE status = 3 AND created_date LIKE '$today%'") or die(mysqli_error());
                  $s7 = mysqli_num_rows($sql_7);
                ?>
                <div class="col-xl-12 mb-4 col-lg-12 col-12">
                  <div class="card h-100">
                    <div class="card-header">
                      <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                        <small class="text-muted"></small>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="row gy-3">
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                              <i class="ti ti-calendar ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo $s4; ?></h5>
                              <small>Menunggu</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-danger me-3 p-2">
                              <i class="ti ti-calendar ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo $s5; ?></h5>
                              <small>Diproses</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                              <i class="ti ti-calendar ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo $s6; ?></h5>
                              <small>Berhasil</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-6">
                          <div class="d-flex align-items-center">
                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                              <i class="ti ti-calendar ti-sm"></i>
                            </div>
                            <div class="card-info">
                              <h5 class="mb-0"><?php echo $s7; ?></h5>
                              <small>Gagal</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Statistics -->
              </div>
              <!-- Invoice List Table -->
              <div class="card">
                <div class="card-datatable table-responsive">
                  <table id="default-datatable" class="invoice-list-table table border-top">
                    <thead>
                      <tr class="bg-info">
                        <th class="text-center" style="vertical-align: middle;">#</th>
                        <th class="text-center" style="vertical-align: middle;">Date</th>
                        <th class="text-center" style="vertical-align: middle;">TrxID</th>
                        <th class="text-center" style="vertical-align: middle;">Customer</th>
                        <th class="text-center" style="vertical-align: middle;">Voucher</th>
                        <th class="text-center" style="vertical-align: middle;">Discount</th>
                        <th class="text-center" style="vertical-align: middle;">Total Pay</th>
                        <th class="text-center" style="vertical-align: middle;">Product</th>
                        <th class="text-center" style="vertical-align: middle;">Status</th>
                        <th class="text-center" style="vertical-align: middle;">Note</th>
                        <th class="text-center" style="vertical-align: middle;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_order` ORDER BY created_date DESC") or die(mysqli_error());
                        $no=0;
                        while($s1 = mysqli_fetch_array($sql_1)){
                          $no++;
                          $kd_transaksi = $s1['kd_transaksi'];
                          $status = $s1['status'];
                      ?>
                      <tr>
                        <td class="text-center" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo $no; ?></td>
                        <td class="text-center" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo $s1['created_date']; ?></td>
                        <td style="vertical-align: middle; white-space: normal; font-size: 12px;"><a href="<?php echo $urlwebs; ?>/cektrx/?trxNum=<?php echo $s1['kd_transaksi']; ?>" target="_blank"><?php echo $s1['kd_transaksi']; ?></a></td>
                        <td style="vertical-align: middle; white-space: normal; font-size: 12px;">
                          <?php echo $s1['full_name']; ?><br>
                          <?php echo $s1['no_hp']; ?><br> 
                          <?php echo $s1['email']; ?>       
                        </td>
                        <td class="text-center" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo $s1['voucher']; ?></td>
                        <td class="text-right" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo number_format($s1['potongan']); ?></td>
                        <td class="text-right" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo number_format($s1['sub_total']); ?></td>
                        <td class="text-left" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php echo $s1['kategori']; ?> - <?php echo $s1['title']; ?></td>
                        <td class="text-left" style="vertical-align: middle; white-space: normal; font-size: 12px;">
                          <?php
                            if($status == 0){
                              echo '
                                <span class="badge-dot">
                                  <i class="bg-info"></i> MENUNGGU
                                </span>
                              ';
                            }
                            else if($status == 1){
                              echo '
                                <span class="badge-dot">
                                  <i class="bg-primary"></i> DIPROSES
                                </span>
                              ';
                            }
                            else if($status == 2){
                              echo '
                                <span class="badge-dot">
                                  <i class="bg-success"></i> SELESAI
                                </span>
                              ';
                            }
                            else if($status == 3){
                              echo '
                                <span class="badge-dot">
                                  <i class="bg-danger"></i> GAGAL
                                </span>
                              ';
                            }
                          ?>
                        </td>
                        <td class="text-left" style="vertical-align: middle; white-space: normal; font-size: 12px;"><?php if($s1['note'] == '') { echo '-'; } else { echo $s1['note']; } ?></td>
                        <td class="text-center" style="vertical-align: middle; white-space: nowrap; font-size: 12px;">
                          <?php
                            if($s1['providerID'] == 4){
                              if($status == 1){
                          ?>
                          <a href="#myModal<?php echo $s1['id']; ?>a" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $s1['id']; ?>a" data-bs-backdrop="static" data-bs-keyboard="false">Proses</a>
                            <div class="modal fade" id="myModal<?php echo $s1['id']; ?>a" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">#<?php echo $s1['kd_transaksi']; ?></h4>
                                  </div>
                                  <form action="<?php echo $urlweb; ?>/function/proses_pesanan.php" method="POST">
                                    <div class="modal-body" style="white-space: normal;">
                                      <p style="white-space: normal;">Apabila Anda telah mengirimkan pesanan melalui Email <?php echo $s1['email']; ?>, Silahkan Tuliskan keterangan apa saja yang Anda kirim melalui form dibawah ini :</p>
                                      <input class="form-control mb-3" type="hidden" name="postID" value="<?php echo $s1['id']; ?>">
                                      <textarea class="form-control mb-3" name="catatan" cols="30" rows="10" placeholder="Write something..."></textarea>
                                    </div>
                                    <div class="modal-footer text-right">
                                      <button type="submit" class="btn btn-success w-100">Proses Pesanan</button>
                                      <button type="button" class="btn btn-danger w-100" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          <?php }} ?>
                          <a href="<?php echo $urlweb; ?>/function/del-order.php?id=<?php echo $s1['kd_transaksi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want remove this data?');"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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
    <script>
    $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable(); 
      $('#summernoteEditor').summernote({
        height: 500,
        tabsize: 2
      });
    });
  </script>
  </body>
</html>
