<!DOCTYPE html>

<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4 & Angular 8
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en">

<!-- begin::Head -->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>WFM | Login Page</title>
    <meta name="description" content="Login page">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <!-- <link href="<?php echo base_url('assets/css/pages/login/login-3.css'); ?>" rel="stylesheet" type="text/css" /> -->
    <link href="<?php echo base_url('assets/css/login.css'); ?>" rel="stylesheet" type="text/css" />

    <!--end::Page Custom Styles -->

    <!--begin::Global Theme Styles(used by all pages) -->
    <link href="<?php echo base_url('assets/plugins/global/plugins.bundle.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/css/style.bundle.css'); ?>" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="icon" href="<?php echo base_url('assets/media/logos/reslogo.png'); ?>" type="image/ico">

    <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/plugins/global/plugins.bundle.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/js/scripts.bundle.js'); ?>" type="text/javascript"></script>
    <link href="<?php echo base_url('assets/css/sweetalert.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/js/sweetalert-dev.js'); ?>"></script>
    <link href="<?php echo base_url(); ?>assets/css/spinner.css" rel="stylesheet">

    <!-- <script src="<?php //echo base_url('assets/js/pages/custom/login/login-general.js'); 
                        ?>" type="text/javascript"></script> -->
    <script type="text/javascript">
        function activate_toast_login(message, title, type) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": 200,
                "hideDuration": 200,
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr[type](message, title);

        }

        function activate_toast_login_for_error(message, title, type) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "preventDuplicates": true,
                "positionClass": "toast-top-right",
                "onclick": null,
                "showDuration": 500,
                "hideDuration": 500,
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            toastr[type](message, title);

        }
    </script>
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
    <div id="loader" class="loading" style="display: none;">Loading&#8230;</div>
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root kt-page">
        <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(assets/media/bg/bg-3.jpg);">
                <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__logo">
                            <a href="#">
                                <img src="<?php echo base_url('assets/media/logos/logo.png'); ?>" width="20%" height="10%">
                            </a>
                            <div class="kt-login__head">
                                <h3 class="kt-login__title">Work Force Management</h3>
                            </div>
                        </div>
                        <?php echo $this->load->view($template); ?>

                        <!-- <div class="kt-login__account">
                                <span class="kt-login__account-msg">
                                    Don't have an account yet ?
                                </span>
                                &nbsp;&nbsp;
                                <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
        =======

        <body>
            <div id="loader" class="overlay">
                <div class="spinner"></div>
            </div>
            <!--header start here-->
            <div class="login-box">
                <?php echo $this->load->view($template); ?>
                >>>>>>> origin/development-vk
            </div>

            <!-- end:: Page -->

            <!-- begin::Global Config(global config for global JS sciprts) -->
            <script>
                var KTAppOptions = {
                    "colors": {
                        "state": {
                            "brand": "#2c77f4",
                            "light": "#ffffff",
                            "dark": "#282a3c",
                            "primary": "#5867dd",
                            "success": "#34bfa3",
                            "info": "#36a3f7",
                            "warning": "#ffb822",
                            "danger": "#fd3995"
                        },
                        "base": {
                            "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                            "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                        }
                    }
                };
            </script>
        </body>

        <!-- end::Body -->
        <script type="text/javascript">
            // jQuery(function($) {
            //     if (window.IsDuplicate()) {
            //         // alert("This is duplicate window\n\n Closing...");
            //         // window.opener = self;
            //         // window.close();
            //         // Wrap in an IIFE accepting jQuery as a parameter.
            //         var setCookie,
            //             removeCookie,
            //             // Create constants for things instead of having same string
            //             // in multiple places in code.
            //             COOKIE_NAME = 'TabOpen',
            //             SITE_WIDE_PATH = {
            //                 path: '/'
            //             };

            //         setCookie = function() {
            //             $.cookie(COOKIE_NAME, '1', SITE_WIDE_PATH);
            //         };

            //         removeCookie = function() {
            //             $.removeCookie(COOKIE_NAME, SITE_WIDE_PATH);
            //         };

            //         // We don't need to wait for DOM ready to check the cookie
            //         if (COOKIE_NAME === undefined) {
            //             setCookie();
            //             $(window).unload(removeCookie);
            //         } else {
            //             // Replace the whole body with an error message when the DOM is ready.
            //             $(function() {
            //                 $('body').html(
            //                     '<div class="error" style="text-align:center;margin-top:15%">' +
            //                     '<h1>Sorry!</h1>' +
            //                     '<p>You can only have one instance of this web page open at a time.</p>' +
            //                     '</div>'
            //                 );
            //             });
            //         }
            //     }
            // });
        </script>


</html>