<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('transaction/add_deposit', array('id' => 'transfer_save', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>


            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                <div class="card card-flush py-2">
                    <div class="card-body text-center pt-3">
                        <div class="image-input mb-3" data-kt-image-input="true">
                            <div class="image-input-wrapper w-150px h-150px d-flex align-items-center justify-content-center">
                                <span class="svg-icon svg-icon-primary svg-icon-5hx">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M22 7H2V11H22V7Z" fill="currentColor" />
                                        <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19ZM14 14C14 13.4 13.6 13 13 13H5C4.4 13 4 13.4 4 14C4 14.6 4.4 15 5 15H13C13.6 15 14 14.6 14 14ZM16 15.5C16 16.3 16.7 17 17.5 17H18.5C19.3 17 20 16.3 20 15.5C20 14.7 19.3 14 18.5 14H17.5C16.7 14 16 14.7 16 15.5Z" fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="text-danger fs-7">The minimum transfer amount is <span style="font-size:20px;">$50</span>.</div>
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
                                        <h2>Transfer to MT5 </h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">From Account</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="account" id="account" onchange="get_account_details()">
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
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">To Account</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="to_account" id="to_account">
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
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Transfer Amount</label>
                                            <input type="text" class="form-control mb-5" id="amount" name="amount"
                                                placeholder="Withdraw Amount" maxlength="10">
                                            <input type="hidden" class="form-control mb-5" id="transfer_amount" name="transfer_amount"
                                                maxlength="10">
                                        </div>

                                    </div>

                                    <div class="gap-5 wallet_div" style="display: none;">
                                        <div class="alert alert-primary d-flex align-items-center p-5 mb-10">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                            <span class="svg-icon svg-icon-2hx svg-icon-primary me-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor" />
                                                    <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor" />
                                                    <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <div class="d-flex flex-column">
                                                <h4 class="mb-1 text-primary">Account Details (<span id="account_span"></span>)</h4>
                                                <table>
                                                    <tr>
                                                        <td>Balance</td>
                                                        <td> - <span id="balance_span"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Equity</td>
                                                        <td> - <span id="equity_span"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MarginFree</td>
                                                        <td> - <span id="free_span"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MarginLeverage</td>
                                                        <td> - <span id="leverage_span"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Outstanding Withdraw</td>
                                                        <td> - <span id="withdraw_span">0.00</span></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-5">




                                        <div class="fv-row w-100 flex-md-root">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">

                                        <a href="<?php echo base_url(); ?>home" id="kt_ecommerce_add_product_cancel"
                                            class="btn btn-light me-5">Cancel</a>

                                        <a id="actual_submit" href="javascript:void(0);" class="btn btn-primary submit_butt" title="Save Changes"
                                            onclick="submit_data()">Transfer</a>
                                        <a id="loader_submit" style="display:none;" href="javascript:void(0);" class="btn btn-primary" data-kt-indicator="on">
                                            <span class="indicator-label">Submit</span>
                                            <span class="indicator-progress">Please wait...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </a>

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
    function get_account_details() {
        var ops_url = baseurl + 'transaction/get-mtaccount-details';
        var account = $('#account').val();
        var form = $("#transfer_save");
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
                console.log(data.account_data);
                if (data.status == 1) {
                    $('#account_span').html(account);
                    $('.wallet_div').show();
                    $('#balance_span').html(data.account_data['Balance']);
                    $('#equity_span').html(data.account_data['Equity']);
                    $('#equity_amount').val(data.account_data['Equity']);
                    $('#free_span').html(data.account_data['MarginFree']);
                    $('#leverage_span').html(data.account_data['MarginLeverage']);
                    $('#withdraw_span').html('');
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

    function submit_data() {
        $("#actual_submit").hide();
        $("#loader_submit").show();

        var ops_url = baseurl + 'transaction/transfer-save';
        var account = $('#account').val();
        var to_account = $('#to_account').val();
        var amount = $('#amount').val();
        if (account == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'From Account is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (to_account == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'To Account is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (account == to_account) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'From Account and To Account should not be same.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }
        if (amount == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Amount is required.'
            });
            $("#actual_submit").show();
            $("#loader_submit").hide();
            return false;
        }

        var form = $("#transfer_save");
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
                $("#actual_submit").show();
                $("#loader_submit").hide();
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Transfer Completed.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    $('#faculty_loader').removeClass('sk-loading');
                }
            },
            error: function(xhr, status, error) {
                $("#actual_submit").show();
                $("#loader_submit").hide();
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