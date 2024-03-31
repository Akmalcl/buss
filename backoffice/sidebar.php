        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="<?php echo $urlweb; ?>/dashboard/" class="app-brand-link">
              <img src="<?php echo $urlwebs; ?>/upload/<?php echo $s0['image']; ?>" alt="logo icon" style="display: block; margin: 0 auto; width: 100%;">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item active">
              <a href="<?php echo $urlweb; ?>/dashboard/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboard</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlwebs; ?>/" class="menu-link" target="_blank">
                <i class="menu-icon tf-icons ti ti-globe"></i>
                <div data-i18n="View Store">View Store</div>
              </a>
            </li>

            <!-- Information -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Information</span>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/page/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-bookmark"></i>
                <div data-i18n="Content Page">Content Page</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/slide/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-album"></i>
                <div data-i18n="Slide Show">Slide Show</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/social/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-share"></i>
                <div data-i18n="Social Media">Social Media</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/member/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user"></i>
                <div data-i18n="Basic Member">Basic Member</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/reseller/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Reseller Member">Reseller Member</div>
              </a>
            </li>
            <?php if($u['level'] == 'superadmin'){ ?>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/user/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-user-plus"></i>
                <div data-i18n="User Account">User Account</div>
              </a>
            </li>
            <?php } ?>
            <!-- Product -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Product</span>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/category/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-list"></i>
                <div data-i18n="Category">Category</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/product/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-device-gamepad"></i>
                <div data-i18n="Product Game">Product Game</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/prepaid/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-device-mobile"></i>
                <div data-i18n="Product Prepaid">Product Prepaid</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/social_media/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-brand-instagram"></i>
                <div data-i18n="Product Social">Product Social</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/product_apigames/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-device-gamepad"></i>
                <div data-i18n="Product Apigames">Product Apigames</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/product_manual/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-ticket"></i>
                <div data-i18n="Product Manual">Product Manual</div>
              </a>
            </li>

            <!-- Transaction -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Transaction</span>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/order/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                <div data-i18n="Order List">Order List</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/topup/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-currency-dollar"></i>
                <div data-i18n="Top Up Request">Top Up Request</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/payment/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-calendar"></i>
                <div data-i18n="Payment History">Payment History</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="<?php echo $urlweb; ?>/balance/" class="menu-link">
                <i class="menu-icon tf-icons ti ti-wallet"></i>
                <div data-i18n="Balance Member">Balance Member</div>
              </a>
            </li>

            <!-- SYSTEM -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">System</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-api-app"></i>
                <div data-i18n="Manage API">Manage API</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/provider/" class="menu-link">
                    <div data-i18n="Provider">Provider</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/payment_gateway/" class="menu-link">
                    <div data-i18n="Payment Gateway">Payment Gateway</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/cekmutasi/" class="menu-link">
                    <div data-i18n="Cekmutasi">Cekmutasi</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/whatsapp/" class="menu-link">
                    <div data-i18n="Whatsapp">Whatsapp</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Settings">Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/setting/" class="menu-link">
                    <div data-i18n="SEO Website & Logo">SEO Website & Logo</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/template/" class="menu-link">
                    <div data-i18n="Template">Template</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/jenis/" class="menu-link">
                    <div data-i18n="Product Tab Homepage">Product Tab Homepage</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/admin/" class="menu-link">
                    <div data-i18n="Markup Selling">Markup Selling</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/service/" class="menu-link">
                    <div data-i18n="Services">Services</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/voucher/" class="menu-link">
                    <div data-i18n="Voucher">Voucher</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/banner/" class="menu-link">
                    <div data-i18n="Pop Up Homepage">Pop Up Homepage</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="<?php echo $urlweb; ?>/popup_product/" class="menu-link">
                    <div data-i18n="Pop Up Product">Pop Up Product</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </aside>