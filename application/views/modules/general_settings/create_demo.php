<div class="card-body d-flex flex-column justify-content-center ps-lg-12">
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <div class="card card-flush py-4" style="background-color: transparent; border: none;">
                        <div class="card-body pt-0">
                            <h3 class="text-white fs-2qx fw-bolder mb-7">Hello <?php echo $this->session->userdata('name'); ?>
                                <br>Install the MT5 platform on your device.
                            </h3>
                            <div class="d-flex flex-wrap gap-5">
                                <div class="fv-row w-100 flex-md-root">
                                    <select class="form-select mb-5" data-control="select2"
                                        data-placeholder="Select Currency" name="currency" id="currency">
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <a href="<?php echo base_url(); ?>home" class="btn btn-danger me-5">Cancel</a>
                                    <a id="actual_submit" href="javascript:void(0);" class="btn btn-primary" title="Save Changes"
                                        onclick="create_demo_account_in_server()">Create Demo Account</a>
                                    <a id="loader_submit" style="display:none;" href="javascript:void(0);" class="btn btn-primary" data-kt-indicator="on">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </a>
                                </div>
                            </div>
                            <p class="text-white fw-bolder mb-7">Trading platform MT5</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function create_demo_account_in_server() {
        $('#actual_submit').hide();
        $('#loader_submit').show();
        var ops_url = baseurl + 'mt-account/create-demo-server';
        $.ajax({
            url: ops_url,
            type: 'POST',
            data: {
                'load': 1,
            },
            success: function(result) {
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Demo Account Created, Please check your mail for login details.',
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
                        text: 'You can’t able to create more accounts. Three accounts have already been created. Please contact the administrator.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Failed',
                        text: 'Please Contact Administrator.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }
            }
        });
    }
</script>