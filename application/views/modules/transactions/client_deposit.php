<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('transaction/add_deposit', array('id' => 'deposit_save', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>



            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-2">
                    <div class="card-body text-center pt-3">
                        <div class="image-input mb-3" data-kt-image-input="true">
                            <div class="image-input-wrapper w-150px h-150px d-flex align-items-center justify-content-center">
                                <span class="svg-icon svg-icon-primary svg-icon-5hx">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor" />
                                        <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor" />
                                        <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="text-danger fs-7">The minimum deposit amount is <span style="font-size:20px;">$50</span>.</div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Deposit to MT5</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">
                                        <div class="fv-row w-100 flex-md-root form_div">
                                            <label class="required form-label">Account</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="account" id="account">
                                                <option value=""></option>
                                                <?php
                                                if (isset($account_details) && !empty($account_details)) {
                                                    foreach ($account_details as $account) {
                                                        echo '<option value ="' . $account->login . '">' . $account->login . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root form_div">
                                            <label class="required form-label">Deposit Method</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="method" id="method">
                                                <option value=""></option>
                                                <option value="1">NexusPay</option>
                                                <!-- <option value="2">SticPay</option> -->
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root form_div">
                                            <label class="required form-label">Currency</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="currency" id="currency">
                                                <option value="1">USD</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="gap-5 wallet_div" style="display: none;">
                                        <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                            <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                    <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <div class="d-flex flex-column">
                                                <h4 class="mb-1 text-primary">Warning</h4>
                                                <span>This wallet address will disappear once you reload this page. Please make sure to copy and save it before refreshing or navigating away. Failure to do so may result in losing access to this address.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gap-5 wallet_div" style="display: none;">
                                        <p class="mb-1 text-success"><b>Wallet Address(TRC-20) - </b><span id="wallet_address" class="mb-5 text-primary" style="font-size: 19px;"></span>
                                        </p>
                                        <input type="hidden" name="wallet_input" id="wallet_input">
                                    </div>

                                    <div class="d-flex justify-content-end">

                                        <a href="<?php echo base_url(); ?>transaction/deposit-client" id="kt_ecommerce_add_product_cancel"
                                            class="btn btn-light me-5">Cancel</a>

                                        <a id="actual_submit" href="javascript:void(0);" class="btn btn-primary submit_butt" title="Save Changes"
                                            onclick="submit_data()">Deposit</a>
                                        <a id="loader_submit" style="display:none;" href="javascript:void(0);" class="btn btn-primary" data-kt-indicator="on">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </a>

                                        <a href="javascript:void(0);" style="display:none;" class="btn btn-success copy_butt" id="copyButton" title="Copy" onclick="copy_address()">Copy</a>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>


            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
    function copy_address() {
        var walletText = $("#wallet_input").val();

        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(walletText).select();
        document.execCommand("copy");
        tempInput.remove();

        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Wallet address copied successfully! You can now paste it into any TRC-20 transfer application to proceed with your transaction safely. Make sure to double-check the address before confirming the transfer.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    }

    function submit_data() {
        $("#actual_submit").hide();
        $("#loader_submit").show();
        var ops_url = baseurl + 'transaction/deposit-save';
        var account = $('#account').val();
        var currency = $('#currency').val();
        var method = $('#method').val();

        if (account == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Account is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (method == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Method is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (currency == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Currency is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        var form = $("#deposit_save");
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            processData: false,
            contentType: false,
            data: formData,
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    console.log(data.result_data);
                    $('#wallet_address').html(data.wallet_address);
                    $('#wallet_input').val(data.wallet_address);
                    $('.wallet_div').show();
                    $('.form_div').hide();
                    $('.submit_butt').hide();
                    $('.copy_butt').show();
                    $("#loader_submit").hide();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Wallet address successfully generated. Please copy it and use any TRC-20 transfer application to complete the transaction.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while processing your request.'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    }
</script>

<script>
    document.getElementById('discount').addEventListener('input', function(e) {
        var value = parseInt(e.target.value);
        if (value > 200) {
            e.target.value = 200;
        }
    });
</script>