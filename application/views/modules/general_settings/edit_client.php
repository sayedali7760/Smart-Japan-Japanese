<div id="kt_content_container" class="container-xxl">

    <?php
    echo form_open_multipart('settings/edit_client', array('id' => 'client_save', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
    ?>

    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Thumbnail</h2>
                </div>
            </div>
            <div class="card-body text-center pt-0">
                <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                    style="background-image: url(<?php echo base_url(); ?>uploads/<?php echo $client_data['file']; ?>)">
                    <div class="image-input-wrapper w-150px h-150px"></div>
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar"
                        onclick="show_div()">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <input type="file" name="avatar[]" id="avatar" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="avatar_remove" />
                    </label>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                </div>
                <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image
                    files are accepted</div>
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
                                <h2>Edit Client</h2>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="d-flex flex-wrap gap-5">


                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">Name</label>
                                    <input type="hidden" id="client_id" name="client_id" value="<?php echo $client_id; ?>">
                                    <input type="text" class="form-control mb-5" id="name" name="name"
                                        placeholder="Full Name" maxlength="50"
                                        value="<?php echo $client_data['name']; ?>">
                                </div>

                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">Email</label>
                                    <input type="text" class="form-control mb-5" id="email" name="email"
                                        placeholder="Email" maxlength="50" value="<?php echo $client_data['email']; ?>">
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">Password</label>
                                    <input type="text" id="password" maxlength="15" name="password"
                                        class="mb-5 form-control make-star" id="" placeholder="Password">
                                </div>

                            </div>
                            <div class="d-flex flex-wrap gap-5">


                                <div class="fv-row w-100 flex-md-root">
                                    <label class="required form-label">Confirm Password</label>
                                    <input type="text" id="con_password" maxlength="15" name="con_password"
                                        class="form-control make-star mb-5"
                                        placeholder="Confirm Password">
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="form-label">Country</label>
                                    <select class="form-select" data-placeholder="Select an option" id="kt_ecommerce_edit_order_billing_country" name="country">
                                        <?php foreach ($countries as $country) { ?>
                                            <?php if ($client_data['country'] == $country->country_code) { ?>
                                                <option selected value="<?php echo $country->country_code; ?>" data-kt-select2-country="<?php echo base_url(); ?><?php echo $country->flag_image_url; ?>"><?php echo $country->country_name; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $country->country_code; ?>" data-kt-select2-country="<?php echo base_url(); ?><?php echo $country->flag_image_url; ?>"><?php echo $country->country_name; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="fv-row w-100 flex-md-root">
                                    <label class="form-label">Phone No</label>
                                    <input type="text" id="phone" name="phone"
                                        class="form-control numeric mb-5"
                                        placeholder="Phone No" maxlength="12" value="<?php echo $client_data['phone']; ?>">
                                </div>


                            </div>
                            <div class="d-flex justify-content-end">

                                <a href="<?php echo base_url(); ?>user-management/client-show" id="kt_ecommerce_add_product_cancel"
                                    class="btn btn-light me-5">Cancel</a>

                                <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes" onclick="update_data()">Save
                                    Changes</a>

                            </div>
                            <?php if (isset($document_details)) { ?>
                                <div id="kt_billing_payment_tab_content" class="card-body tab-content">
                                    <div id="kt_billing_creditcard" class="tab-pane fade show active" role="tabpanel">
                                        <h3 class="mb-5">Uploaded Documents</h3>
                                        <div class="row gx-9 gy-6">

                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Identity
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <?php if ($document_details['eid_status'] == 0) { ?>
                                                            <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['eid_status'] == 1) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['eid']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(1,2)" class="btn btn-sm btn-success btn-active-light-primary me-3" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(1,3)" class="btn btn-sm btn-danger btn-active-light-primary" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        <?php } else if ($document_details['eid_status'] == 3) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['eid']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-danger d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-danger">Rejected</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['eid_status'] == 2) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['eid']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-success d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-success">Verified</h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Passport
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <?php if ($document_details['pass_status'] == 0) { ?>
                                                            <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['pass_status'] == 1) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['passport']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(2,2)" class="btn btn-sm btn-success btn-active-light-primary me-3" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(2,3)" class="btn btn-sm btn-danger btn-active-light-primary" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        <?php } else if ($document_details['pass_status'] == 3) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['passport']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-danger d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-danger">Rejected</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['pass_status'] == 2) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['passport']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-success d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-success">Verified</h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Bank
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <?php if ($document_details['bank_status'] == 0) { ?>
                                                            <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['bank_status'] == 1) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['bank']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(3,2)" class="btn btn-sm btn-success btn-active-light-primary me-3" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(3,3)" class="btn btn-sm btn-danger btn-active-light-primary" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        <?php } else if ($document_details['bank_status'] == 3) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['bank']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-danger d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-danger">Rejected</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['bank_status'] == 2) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['bank']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-success d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-success">Verified</h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Other
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <?php if ($document_details['others_status'] == 0) { ?>
                                                            <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['others_status'] == 1) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['others']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(4,2)" class="btn btn-sm btn-success btn-active-light-primary me-3" title="Approve"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                            <a href="javascript:void(0);" onclick="update_doc_status(4,3)" class="btn btn-sm btn-danger btn-active-light-primary" title="Reject"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        <?php } else if ($document_details['others_status'] == 3) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['others']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-danger d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-danger">Rejected</h4>
                                                                </div>
                                                            </div>
                                                        <?php } else if ($document_details['others_status'] == 2) { ?>
                                                            <a href="<?php echo base_url() ?>uploads/<?php echo $document_details['others']; ?>" target="_blank" class="btn btn-sm btn-primary btn-active-light-primary me-3" title="View"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                            <div class="alert alert-success d-flex align-items-center p-5 mb-4">
                                                                <div class="d-flex flex-column">
                                                                    <h4 class="mb-1 text-success">Verified</h4>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes" onclick="activate_account()">Activate Account</a>
                                </div>

                            <?php } else { ?>
                                <div id="kt_billing_payment_tab_content" class="card-body tab-content">
                                    <div id="kt_billing_creditcard" class="tab-pane fade show active" role="tabpanel">
                                        <h3 class="mb-5">Uploaded Documents</h3>
                                        <div class="row gx-9 gy-6">

                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Identity
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                            <div class="d-flex flex-column">
                                                                <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Passport
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                            <div class="d-flex flex-column">
                                                                <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Bank
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                            <div class="d-flex flex-column">
                                                                <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="card card-dashed h-xl-100 flex-row flex-stack flex-wrap p-6">
                                                    <div class="d-flex flex-column py-2">
                                                        <div class="d-flex align-items-center fs-4 fw-bolder mb-5">Other
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center py-2">
                                                        <div class="alert alert-warning d-flex align-items-center p-5 mb-4">
                                                            <div class="d-flex flex-column">
                                                                <h4 class="mb-1 text-warning">Not Uploaded</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script>
    $(document).ready(function() {
        KTUtil.onDOMContentLoaded(function() {
            KTAppEcommerceSalesSaveOrder.init();
        });
        $('#position').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
    });
    KTImageInput.init();
</script>
<script>
    function show_div() {

    }

    function update_doc_status(doc_id, status) {
        var client_id = $('#client_id').val();
        var ops_url = baseurl + 'client-crm/update-doc-status';
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            data: {
                doc_id: doc_id,
                status: status,
                client_id: client_id
            },
            success: function(result) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Status updated.'
                }).then(() => {
                    edit_client(client_id);
                });
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    }

    function activate_account() {

        var ops_url = baseurl + 'client-crm/activate-client';
        var client_id = $('#client_id').val();
        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to activate?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, activate it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    async: true,
                    url: ops_url,
                    data: {
                        client_id: client_id
                    },
                    success: function(result) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Status updated.'
                        }).then(() => {
                            edit_client(client_id);
                        });
                    },
                    error: function(xhr, status, error) {
                        $("#loader").hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing your request.'
                        });
                    }
                });
            }
        });
    }

    function update_data() {
        $("#loader").show();
        var ops_url = baseurl + 'user-management/update-client';
        var user_id = $('#user_id').val();
        var name = $('#name').val();
        var password = $('#password').val();
        var con_password = $('#con_password').val();
        var email = $('#email').val();
        var phone = $('#phone').val();

        if (name == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Name is required.'
            });
            return false;
        }
        if (name.length < 3) {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Enter at least three characters for Name.'
            });
            return false;
        }

        if (email == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Email is required.'
            });
            return false;
        }
        if (phone == "") {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Phone is required.'
            });
            $("#loader").hide();
            return false;
        }

        if (password != '') {
            if (password.length < 3) {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Enter at least three characters for Password.'
                });
                $("#loader").hide();
                return false;
            }
            if (con_password == '') {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Confirm Password is required.'
                });
                $("#loader").hide();
                return false;
            }
            if (password != con_password) {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Password and Confirm Password must be the same.'
                });
                $("#loader").hide();
                return false;
            }
        }

        var form = $("#client_save");
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
                $("#loader").hide();
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Client updated.'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else if (data.status == 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Info',
                        text: 'Email already exists.'
                    });
                } else {
                    $('#faculty_loader').removeClass('sk-loading');
                }
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request.'
                });
            }
        });
    }

    function edit_client(id) {
        var ops_url = baseurl + 'user-management/edit-client';
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: ops_url,
            data: {
                "load": 1,
                "client_id": id,
            },
            success: function(result) {
                console.log(result);
                var data = $.parseJSON(result);
                $("#kt_post").html(data.view);
                $('#kt_post').addClass('in-down');
                $("html, body").animate({
                    scrollTop: 0
                }, "slow");
            }
        });
    }
</script>