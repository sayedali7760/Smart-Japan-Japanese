<link rel="stylesheet" href="<?php echo base_url(); ?>assets/login/login.css">
<link rel="icon" href="<?php echo base_url('assets/media/favicon.ico'); ?>" type="image/ico">
<link href="<?php echo base_url(); ?>assets/sweetalert/sweetalert.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/sweetalert/sweetalert-dev.js"></script>
<link href="<?php echo base_url(); ?>assets/css/spinner.css" rel="stylesheet">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="<?php echo base_url(); ?>assets/css/spinner.css" rel="stylesheet">


<title>Benchmark | Recruitment</title>
<style>
    input[type='text']::placeholder {
        text-align: left;
        color: #787d83;
    }

    input[type='password']::placeholder {
        text-align: left;
        color: #787d83;
    }

    a {
        text-decoration: none;
    }
</style>
<div id="loader" class="loading" style="display: none;">Loading&#8230;</div>
<div class="login-box">
    <img src="<?php echo base_url(); ?>assets/login/BMlogo.png" style="height: 50px;padding-left: 50px;">

    <h2>Welcome to Recruitment Manager</h2> <br><br>

    <?php if ($current_flag != 0) { ?>
        <div class="form-group">
            <input type="hidden" class="form-control" readonly placeholder="Email-Id" id="email_id" name="email_id" value="<?php echo $email_id; ?>">
            <input type="password" onPaste="return false" placeholder="Password" id="password" class="form-control" name="password">
            <label for="password">Password</label>

        </div>

        <div class="form-group">
            <input type="password" onPaste="return false" class="form-control" placeholder="Confirm Password" id="confirm_password" name="confirm_password">
            <label for="password">Confirm Password</label>
        </div>
        <div class="form-group" style="top: 5px ;">
            <a href="javascript:void(0);" class="btn btn-primary block full-width m-b" onclick="update_password()" title="Change Password">Change Password</a>
        </div>
        <div class="form-group" style="top: 5px ;">
            <p style="font-size:12px;text-align: center;"><b>Benchmark</b> &copy; <?php echo date('Y') . ' ' . APP_VERSION ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?>
            <p>
        </div>
    <?php } else { ?>
        <div class="form-group" style="top: -21px ;">
            <p style="font-size:17px;text-align: center; color: #3046c8;">Sorry!<br />This link was expired.
            <p>
        </div>
        <div class="form-group" style="top: 5px ;">
            <p style="font-size:12px;text-align: center;"><b>Benchmark</b> &copy; <?php echo date('Y') . ' ' . APP_VERSION ?><?php echo ENVIRONMENT == 'production' ? '' : '-Development' ?>
            <p>
        </div>
    <?php } ?>



</div>

<script type="text/javascript">
    function update_password() {
        $("#loader").show();
        var email_id = $('#email_id').val();
        var password = $('#password').val();
        var conf_password = $('#confirm_password').val();
        if (password == "") {
            swal("", "Password is required.", "info");
            $("#loader").hide();
            return false;
        }
        if (conf_password == "") {
            swal("", "Confirm password is required", "info");
            $("#loader").hide();
            return false;
        }
        if (password != conf_password) {
            swal("", "Password and Confirm password must be same", "info");
            $("#loader").hide();
            return false;
        }
        var baseurl = '<?php echo base_url(); ?>';
        var ops_url = baseurl + 'forgot-password/update-password';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                "email": email_id,
                "password": password
            },
            success: function(result) {
                $("#loader").hide();
                var data = $.parseJSON(result)
                if (data.status == 1) {
                    swal({
                            title: "Success",
                            text: "Password Changed.",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonText: 'OK',
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function(isConfirm) {

                            if (isConfirm) {
                                window.top.close();
                            } else {
                                window.location.reload(true);
                            }
                        });
                } else {
                    swal('', 'Error.', 'error');
                }
            }
        });

    }
</script>