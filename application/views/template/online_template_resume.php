<!DOCTYPE html>
<html lang="en">

<head>
    <link href="<?php echo base_url(); ?>assets/css/old/fullcalendar.bundle.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/old/prismjs.bundle.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/old/datatables.bundle.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/MIS.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.bundle.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style1.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/style3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/w3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="icon" href="<?php echo base_url('assets/media/favicon.ico'); ?>" type="image/ico">
    <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/select2-bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/datepicker/datapicker/datepicker3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/datepicker/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/clockpicker/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/spinner.css" rel="stylesheet">


    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="LQxK9Ft2UDuLqAPvq0UO85jjS6YuCOINhSJyn7aL7e9iWzCRCyJnT_OROoSaLTqc7tIfkh9SkFixVEHt2eqcgA==">
    <title><?php echo APP_TITLE; ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="MIS.scss" rel="stylesheet/scss" type="text/scss">

    <script>
        var KTAppSettings;
        var KTUtil;
    </script>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/old/plugins.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/old/prismjs.bundle.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/js/old/datatables.bundle.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/widgets.js"></script>
    <script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert-dev.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/datepicker/js/datapicker/bootstrap-datepicker.js"></script>
    <!-- <script src="<?php echo base_url(); ?>assets/datepicker/js/daterangepicker/daterangepicker.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/clockpicker/js/clockpicker/clockpicker.js"></script>

</head>

<body style="background-color: #ecf1f7 !important;">
    <div id="loader" class="loading" style="display: none;">Loading&#8230;</div>
    <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">


        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-tab ">

            </div>
        </div>
        <nav class="navbar fixed-top navbar-expand-sm bm-navbar">
            <button class="w3-button w3-hide-large" onclick="w3_open()">&#9776;</button>
            <a class="bm-logo" href="javascript:void(0);">
                <img src="<?php echo base_url(); ?>assets/img/Logo.png" alt="logo" style="width:160px;margin-left: 5px;">&nbsp;

            </a>
            <div class="row" style="margin: 0px 5px 0px auto;">
                <img src="<?php echo base_url(); ?>assets/img/inst_logos/Nims-Logo_1.png" alt="logo" style="width: 218px;margin-left: -206px;">
            </div>
            <div class="row" style="margin: 0px 5px 0px auto;">

            </div>
    </div>
    <div class="d-flex flex-row flex-column-fluid page container-fluid" style="margin-top:80px;">

        <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <div id="content-loader"></div>
            <?php $this->load->view($template); ?>
            <div id="kt_scrolltop" class="scrolltop">
                <span class="svg-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                            <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                </span>
            </div>
        </div>

    </div>

    <script>
        $(document).on("keypress", ".alphanumeric", function(e) {
            var alphanumeric = /[\w]|\-|\s+?$/;
            if (!alphanumeric.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });
        $(document).on("keypress", ".numeric", function(e) {
            var dec_numbers = /[0-9]|\.+?$/;
            if (!dec_numbers.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });
        $(document).on("keypress", ".alpha", function(e) {
            var alpha = /[a-zA-Z]|\-|\s+?$/;
            if (!alpha.test(e.key)) {
                return false;
            } else {
                return true;
            }
        });
        $(document).on("keypress", ".specialalphanumeric", function(e) {
            var alphaNoSpace = /^[ A-Za-z0-9_@.,/#&+-]*$/;
            if (!alphaNoSpace.test(e.key)) {
                return false;
            } else {
                return true;
            }

        });
        $(document).on("blur", ".email", function(e) {
            var email_reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if (!email_reg.test($(this).val())) {
                console.log(e)
                swal('', 'Enter a valid E-mail.', 'info');
                return false;
            } else {
                return true;
            }

        });

        $(document).on("blur", ".bm-error", function(e) {
            if ($(this).val() != '') {
                $(this).removeClass('bm-error');
            }
        });
        $(document).on("change", ".bm-error", function(e) {
            if ($(this).val() != '') {
                $(this).removeClass('bm-error');
            }
        });

        $(document).on("change", ".select2-hidden-accessible ", function(e) {
            if ($(this).val() != -1) {
                $(this).removeClass('bm-error');
                $(this).next("span.select2-container").find(".select2-selection--single").css('border-color', '');
            }
        });


        var baseurl = '<?php echo base_url(); ?>';

        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }
        var KTAppSettings;
        var KTUtil;
    </script>

</body>

</html>