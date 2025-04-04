<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">


  <!-- begin: Header Menu -->
  <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
  <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
    <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">

    </div>
  </div>

  <!-- end: Header Menu -->

  <!-- begin:: Header Topbar -->

  <nav class="navbar fixed-top navbar-expand-sm bm-navbar">
    <!-- Brand/logo -->
    <button class="w3-button w3-hide-large" onclick="w3_open()">&#9776;</button>
    <a class="bm-logo">
      <img src="<?php echo base_url(); ?>assets/img/Logo.png" alt="logo" style="width:160px;margin-left: 5px;">&nbsp;

    </a>

    <!--Drop down-->
    <div class="row" style="margin: 0px 5px 0px auto;">
      <img src="<?php echo base_url(); ?>assets/img/inst_logos/Nims-Logo_1.png" alt="logo" style="width:218px;margin-left: 100px;">
    </div>

    <!--Drop down-->

    <!-- Links -->
    <div class="row" style="margin: 0px 5px 0px auto;">
      <div style="margin-top: 5px;">
        <div class="nav_name"><?php echo $this->session->userdata('name'); ?></div>
        <div class="nav_job"><?php echo $this->session->userdata('description'); ?></div>
      </div>

      <div>
        <a class="nav-link">
          <img src="<?php echo base_url(); ?>assets/img/1.jpg" alt="" width="50px" style="border-radius: 50%;">
        </a>

      </div>
      <div style="margin-top: 15px;">
        <a href="javascript:void(0)" onclick="log_out()" title="Log Out"><i class=" bi bi-box-arrow-right"></i>
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
          </svg></a>
      </div>

    </div>
    <!-- end:: Header Topbar -->
</div>