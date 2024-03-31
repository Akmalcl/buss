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
                <span class="text-muted fw-light">System /</span> <span class="text-muted fw-light">Settings /</span> Template

              </h4>
              <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-6">
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
                                <span><strong>Well Done!</strong> Template Saved!</span>
                              </div>
                            ';
                          }
                          if ($_GET['notif'] == 2) {
                            echo '
                              <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                  <i class="ti ti-bell ti-xs"></i>
                                </span>
                                <span><strong>Warning!</strong> Max Image Size 2MB!</span>
                              </div>
                            ';
                          }
                          if ($_GET['notif'] == 3) {
                            echo '
                              <div class="alert alert-warning d-flex align-items-center" role="alert">
                                <span class="alert-icon text-warning me-2">
                                  <i class="ti ti-bell ti-xs"></i>
                                </span>
                                <span><strong>Warning!</strong> Only JPG atau PNG!</span>
                              </div>
                            ';
                          }
                        }
                      ?>
                      <form role="form" action="<?php echo $urlweb; ?>/function/template.php" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2">
                          <label class="form-label">Tampilan Produk</label>
                          <select name="template" id="template" class="form-control">
                            <option> Pilih Tampilan </option>
                            <option value="1"<?php if($s0['template'] == 1) { echo ' selected=selected'; } ?>> Tampilan 1 </option>
                            <option value="2"<?php if($s0['template'] == 2) { echo ' selected=selected'; } ?>> Tampilan 2 </option>
                            <option value="4"<?php if($s0['template'] == 4) { echo ' selected=selected'; } ?>> Tampilan 3 </option>
                          </select>
                        </div>
                        <div class="form-group mb-2">
                          <label class="form-label">Pilihan Warna</label>
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #fdd017;" for="customRadioTemp1">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="1"
                                    id="customRadioTemp1"
                                    <?php if($s0['warna'] == 1){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Kuning</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #ff6b6b;" for="customRadioTemp2">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="2"
                                    id="customRadioTemp2"
                                    <?php if($s0['warna'] == 2){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Merah</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #54a0ff;" for="customRadioTemp3">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="3"
                                    id="customRadioTemp3"
                                    <?php if($s0['warna'] == 3){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Biru</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #5f27cd;" for="customRadioTemp4">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="4"
                                    id="customRadioTemp4"
                                    <?php if($s0['warna'] == 4){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Ungu</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #1dd1a1;" for="customRadioTemp5">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="5"
                                    id="customRadioTemp5"
                                    <?php if($s0['warna'] == 5){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Hijau</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #00d2d3;" for="customRadioTemp6">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="6"
                                    id="customRadioTemp6"
                                    <?php if($s0['warna'] == 6){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Teal</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #48dbfb;" for="customRadioTemp7">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="7"
                                    id="customRadioTemp7"
                                    <?php if($s0['warna'] == 7){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Aqua</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" style="background: #ff9ff3;" for="customRadioTemp8">
                                  <input
                                    name="warna"
                                    class="form-check-input"
                                    type="radio"
                                    value="8"
                                    id="customRadioTemp8"
                                    <?php if($s0['warna'] == 8){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <span class="h6 mb-0" style=" color: #fff;">Pink</span>
                                    <span class="text-muted"></span>
                                  </span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group mb-2">
                          <label class="form-label">Tampilan Footer</label>
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioFoot1">
                                  <input
                                    name="footere"
                                    class="form-check-input"
                                    type="radio"
                                    value="1"
                                    id="customRadioFoot1"
                                    <?php if($s0['footer'] == 1){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <img src="<?php echo $urlwebs; ?>/upload/footer_1.png" class="img-fluid" style="display: block; margin: 0 auto;">
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioFoot2">
                                  <input
                                    name="footere"
                                    class="form-check-input"
                                    type="radio"
                                    value="2"
                                    id="customRadioFoot2"
                                    <?php if($s0['footer'] == 2){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <img src="<?php echo $urlwebs; ?>/upload/footer_2.png" class="img-fluid" style="display: block; margin: 0 auto;">
                                  </span>
                                </label>
                              </div>
                            </div>
                            <div class="col-sm-12">
                              <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioFoot3">
                                  <input
                                    name="footere"
                                    class="form-check-input"
                                    type="radio"
                                    value="3"
                                    id="customRadioFoot3"
                                    <?php if($s0['footer'] == 1){ echo 'checked'; } ?>
                                  />
                                  <span class="custom-option-header">
                                    <img src="<?php echo $urlwebs; ?>/upload/footer_3.png" class="img-fluid" style="display: block; margin: 0 auto;">
                                  </span>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Publish</button>
                        <a href="<?php echo $urlweb; ?>/template/" class="btn btn-light">Cancel</a>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4" id="result"></div>
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
      $("#template").change(function (){
        url = "<?php echo $urlweb; ?>/select_template.php?id="+$(this).val();
        $('#result').load(url);
        //console.log(url);
        return false;
      });
    });
  </script>
  </body>
</html>
