<!DOCTYPE html>


<html lang="en">
<!--begin::Head-->


<head>
    <title><?php echo APP_TITLE; ?></title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->


<body id="kt_body" class="bg-body">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
            style="background-image: url(assets/media/bg/login.png">
            <!--begin::Content-->
            <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
                <!--begin::Logo-->

                <!--end::Logo-->
                <!--begin::Wrapper-->
                <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                    <!--begin::Form-->


                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <!--begin::Title-->
                        <a href="<?php echo base_url(); ?>../../demo8/dist/index.html" class="mb-12">
                            <img alt="Logo" src="<?php echo base_url(); ?>assets/media/logos/Logo.png" class="h-40px" />
                        </a>
                        <!--end::Title-->
                        <!--begin::Link-->
                        <div class="text-gray-400 fw-bold fs-4">Already have an account?
                            <a href="<?php echo base_url(); ?>login"
                                class="link-primary fw-bolder">Login</a>
                        </div>
                        <!--end::Link-->
                    </div>

                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Fullname</label>
                        <input type="text" class="form-control form-control-lg form-control-solid" autocomplete="off"
                            onPaste="return false" placeholder="Enter your name" id="name" name="name" value="<?php if (isset($_COOKIE["ecomm_firstname"])) {
                                                                                                                    echo $_COOKIE["green_username"];
                                                                                                                } ?>">
                    </div>


                    <!-- <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Lastname</label>
                        <input type="text" class="form-control form-control-lg form-control-solid" autocomplete="off"
                            onPaste="return false" placeholder="Enter Lastname" id="lastname" name="lastname" value="<?php if (isset($_COOKIE["ecomm_lastname"])) {
                                                                                                                            echo $_COOKIE["green_username"];
                                                                                                                        } ?>">
                    </div> -->


                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Phone No</label>
                        <input type="text" class="form-control form-control-lg form-control-solid" autocomplete="off"
                            onPaste="return false" placeholder="Enter Phone No" id="phno" name="phno" value="<?php if (isset($_COOKIE["ecomm_phno"])) {
                                                                                                                    echo $_COOKIE["green_username"];
                                                                                                                } ?>">
                    </div>


                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid" autocomplete="off"
                            onPaste="return false" placeholder="Enter Username" id="username" name="username" value="<?php if (isset($_COOKIE["ecomm_username"])) {
                                                                                                                            echo $_COOKIE["green_username"];
                                                                                                                        } ?>">
                        <!--end::Input-->
                    </div>


                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack mb-2">
                            <!--begin::Label-->
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                            <!--end::Label-->
                            <!--begin::Link-->
                            <!--end::Link-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Input-->
                        <input type="password" onPaste="return false" autocomplete="off" placeholder="Enter Password"
                            id="password" class="form-control form-control-lg form-control-solid" name="password" value="<?php if (isset($_COOKIE["ecomm_password"])) {
                                                                                                                                echo $_COOKIE["green_password"];
                                                                                                                            } ?>">
                        <!--end::Input-->
                    </div>




                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <!--begin::Submit button-->


                        <a href="javascript:void(0);" onclick="submit()" class="btn btn-lg btn-primary w-100 mb-5"
                            title="Login"><i class="icon-unlock2"></i> Sign up</a>
                        <!--end::Submit button-->
                        <!--begin::Separator-->
                        <!--end::Separator-->
                        <!--begin::Google link-->

                        <!--end::Google link-->
                        <!--begin::Google link-->


                        <!--end::Google link-->
                    </div>
                    <!--end::Actions-->


                    <!--end::Form-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Content-->
            <!--begin::Footer-->

            <!--end::Footer-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="<?php echo base_url(); ?>assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="<?php echo base_url(); ?>assets/js/custom/authentication/sign-in/general.js"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <script type="text/javascript">
        function submit() {
            var baseurl = '<?php echo base_url(); ?>';
            var ops_url = baseurl + 'register';
            var username = $('#username').val();
            var password = $('#password').val();
            var name = $('#name').val();
            var phno = $('#phno').val();
            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (name == '') {
                Swal.fire({
                    title: 'Login failed',
                    text: 'Name is required',
                    icon: 'error'
                });
                return false;
            }
            if (username == '') {
                Swal.fire({
                    title: 'Login failed',
                    text: 'Email is required',
                    icon: 'error'
                });
                return false;
            }
            if (!emailRegex.test(username)) {
                Swal.fire({
                    title: 'Login failed',
                    text: 'Email is not valid',
                    icon: 'error'
                });
                return false;
            }
            if (password == '') {
                Swal.fire({
                    title: 'Login failed',
                    text: 'Password is required',
                    icon: 'error'
                });
                return false;
            }


            $.ajax({
                type: "POST",
                cache: false,
                async: true,
                url: ops_url,
                data: {
                    "email": username,
                    "password": password,
                    "name": name,
                    "phno": phno,
                },
                success: function(result) {
                    var data = $.parseJSON(result);
                    if (data.status == 1) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Account created.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else if (data.status == 2) {
                        Swal.fire({
                            title: 'Failed',
                            text: 'Email Already registered.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error while creating.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $("#loader").hide();
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Email is already taken.'
                    });
                }
            });


        }
    </script>


    <script type="text/javascript">
        function send_verification() {
            $("#loader").show();
            var email = $('#forgot_email').val();
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (email == '') {
                swal('', 'Email-Id Required.', 'info');
                $("#loader").hide();
                return false;
            } else if (!regex.test(email)) {
                swal('', 'Enter valid Email-id.', 'info');
                $("#loader").hide();
                return false;
            }
            var baseurl = '<?php echo base_url(); ?>';
            var ops_url = baseurl + 'login/forgot-password';
            $.ajax({
                type: "POST",
                cache: false,
                async: true,
                url: ops_url,
                data: {
                    "email": email
                },
                success: function(result) {
                    $("#loader").hide();
                    var data = $.parseJSON(result)
                    if (data.status == 1) {
                        swal({
                                title: "Success",
                                text: "Please check your Email.",
                                type: "success",
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm) {


                                if (isConfirm) {
                                    window.location.reload(true);


                                } else {
                                    window.location.reload(true);
                                }
                            });
                    } else {
                        swal('', 'Email not registered.', 'error');
                    }
                }
            });


        }
    </script>
</body>


</html>
<?php ?>