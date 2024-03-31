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
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="<?php echo $urlweb; ?>/assets/vendor/libs/summernote/dist/summernote-bs4.css"/>

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
              <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">System /</span> <span class="text-muted fw-light">Manage API /</span> Payment Gateway

              </h4>
              <div class="row">
                <div class="col-sm-4">
                  <div class="card">
                    <div class="card-body">
                      <?php
                        error_reporting(0);
                        if (!empty($_GET['notif'])) {
                          if ($_GET['notif'] == 1) {
                            echo '
                              <div class="alert alert-success d-flex align-items-center" role="alert">
                                <span class="alert-icon text-success me-2">
                                  <i class="ti ti-check ti-xs"></i>
                                </span>
                                <span><strong>Well Done!</strong> Payment Gateway API Saved!</span>
                              </div>
                            ';
                          }
                        }
                        if(isset($_GET['postID'])){
                          $postID = $_GET['postID'];
                          $sql_2 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE id = '$postID'") or die(mysqli_error());
                          $s2 = mysqli_fetch_array($sql_2);
                        }
                      ?>
                      <form role="form" action="<?php echo $urlweb; ?>/function/add-vip.php" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                          <label class="form-label">Provider :</label>
                          <select class="form-control" type="text" name="provider" required>
                            <option value=""> Pilih Provider </option>
                            <option value="4"<?php if(isset($_GET['postID'])){ if($s2['id'] == 4){ echo ' selected=selected'; }} ?>> Vip Reseller </option>
                            <option value="5"<?php if(isset($_GET['postID'])){ if($s2['id'] == 5){ echo ' selected=selected'; }} ?>> Digiflazz </option>
                            <option value="6"<?php if(isset($_GET['postID'])){ if($s2['id'] == 6){ echo ' selected=selected'; }} ?>> Medan Pedia </option>
                            <option value="9"<?php if(isset($_GET['postID'])){ if($s2['id'] == 9){ echo ' selected=selected'; }} ?>> Apigames </option>
                          </select>
                        </div>
                        <div class="form-group mb-2">
                          <label class="form-label">Api Key / Secret Key :</label>
                          <input class="form-control" type="text" name="apikey" value="<?php if(isset($_GET['postID'])){ echo $s2['api_key']; } ?>" required>
                          <input class="form-control" type="hidden" name="postID" value="<?php if(isset($_GET['postID'])){ echo $s2['id']; } ?>">
                        </div>
                        <div class="form-group mb-2">
                          <label class="form-label">UserID / API ID / Merchant ID :</label>
                          <input class="form-control" type="text" name="merchant_code" value="<?php if(isset($_GET['postID'])){ echo $s2['merchant_code']; } ?>">
                        </div>
                        <div class="form-group mb-2">
                          <label class="form-label">Status :</label>
                          <select name="status" class="form-control">
                            <option value="1"<?php if(isset($_GET['postID'])){ if($s2['status'] == 1) { echo 'selected = selected'; }} ?>> Active</option>
                            <option value="0"<?php if(isset($_GET['postID'])){ if($s2['status'] == 0) { echo 'selected = selected'; }} ?>> Not Active</option>
                          </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                        <a href="<?php echo $urlweb; ?>/payment_gateway/" class="btn btn-light">Cancel</a>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-sm-8">
                  <!-- Invoice List Table -->
                  <div class="card">
                    <div class="card-datatable table-responsive">
                      <table id="default-datatable" class="invoice-list-table table border-top">
                        <thead>
                          <tr class="bg-info">
                            <th class="text-center" style="vertical-align: middle;">#</th>
                            <th class="text-center" style="vertical-align: middle;">Provider</th>
                            <th class="text-center" style="vertical-align: middle;">Api</th>
                            <th class="text-center" style="vertical-align: middle;">Status</th>
                            <th class="text-center" style="vertical-align: middle;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql_1 = mysqli_query($conn,"SELECT * FROM `tb_tripayapi` WHERE jenis = 1 ORDER BY id ASC") or die(mysqli_error());
                            $no=0;
                            while($s1 = mysqli_fetch_array($sql_1)){
                              $no++;
                          ?>
                          <tr>
                            <td class="text-center" style="vertical-align: middle; font-size: 14px;"><?php echo $no; ?></td>
                            <td class="text-left" style="vertical-align: middle; white-space: normal; font-size: 14px;"><?php echo $s1['provider']; ?></td>
                            <td class="text-left" style="vertical-align: middle; white-space: normal; font-size: 14px;">
                              Api Key / Secret Key :<br><?php echo $s1['api_key']; ?><br>
                              UserID / API ID / Merchant ID :<br><?php echo $s1['merchant_code']; ?><br>
                              
                            </td>
                            <td class="text-center" style="vertical-align: middle; white-space: normal; font-size: 14px;"><?php if($s1['status'] == 0){ echo 'Not Active'; } else { echo 'Active'; } ?></td>
                            <td class="text-center" style="vertical-align: middle; font-size: 14px;">
                              <a href="<?php echo $urlweb; ?>/provider/?postID=<?php echo $s1['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
                              <a href="<?php echo $urlweb; ?>/function/del-provider.php?postID=<?php echo $s1['id']; ?>&status=<?php echo $s1['status']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want remove this data?');"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                          <?php } ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
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
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/select2/select2.js"></script>
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
    <script src="<?php echo $urlweb; ?>/assets/js/forms-selects.js"></script>
    <script src="<?php echo $urlweb; ?>/assets/vendor/libs/summernote/dist/summernote-bs4.min.js"></script>
    <script>
    $(document).ready(function() {
      //Default data table
      $('#default-datatable').DataTable(); 
      $('.summernoteEditor').summernote({
        height: 300,
        tabsize: 2
      });
    });
  </script>
  </body>
</html>
