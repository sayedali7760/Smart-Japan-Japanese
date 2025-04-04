<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div id="kt_content_container" class="container-xxl">

        <?php
        echo form_open_multipart('settings/edit_user', array('id' => 'client_update', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
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
                        style="background-image: url(<?php echo base_url(); ?>uploads/<?php echo $user_data['file']; ?>)">
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
                                    <h2><?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?></h2>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="d-flex flex-wrap gap-5">
                                    <div class="fv-row w-100 flex-md-root">
                                        <h5>Email - <?php echo $user_data['email']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex flex-wrap gap-5">
                                    <div class="fv-row w-100 flex-md-root">
                                        <h5>Role - <?php echo $user_data['description']; ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="d-flex flex-wrap gap-5">
                                    <div class="fv-row w-100 flex-md-root">
                                        <h5>Created On - <?php echo date('d/m/Y', strtotime($user_data['created_on'])); ?></h5>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0">

                                <div class="d-flex flex-wrap gap-5">


                                    <div class="fv-row w-100 flex-md-root">
                                        <label class="required form-label">Password</label>
                                        <input type="hidden" name="client_id" id="client_id" value="<?php echo $user_data['id']; ?>">
                                        <input type="text" id="password" maxlength="15" name="password"
                                            class="mb-5 form-control make-star" id="" placeholder="Password">
                                    </div>

                                    <div class="fv-row w-100 flex-md-root">
                                        <label class="required form-label">Confirm Password</label>
                                        <input type="text" id="con_password" maxlength="15" name="con_password"
                                            class="form-control make-star mb-5" id="" placeholder="Confirm Password">
                                    </div>
                                    <div class="fv-row w-100 flex-md-root">
                                        <label class="form-label">&nbsp;</label>
                                        <div class="d-flex justify-content-end">
                                            <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes" onclick="update_data()">Update Password</a>
                                        </div>
                                    </div>

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
<script>
    $(document).ready(function() {
        $('#position').select2({
            placeholder: 'Select an option',
            allowClear: true
        });
    });
    KTImageInput.init();
</script>
<script>
    function update_data() {
        $("#loader").show();
        var ops_url = baseurl + 'client-crm/update-password';
        var password = $('#password').val();
        var confirm_password = $('#con_password').val();
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
            if (confirm_password == '') {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Confirm Password is required.'
                });
                $("#loader").hide();
                return false;
            }
            if (password != confirm_password) {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Password and Confirm Password must be the same.'
                });
                $("#loader").hide();
                return false;
            }
        } else {
            Swal.fire({
                icon: 'info',
                title: '',
                text: 'Please Enter Password.'
            });
            $("#loader").hide();
            return false;
        }
        $.ajax({
            type: "POST",
            cache: false,
            async: true,
            url: ops_url,
            processData: false,
            contentType: false,
            data: {
                password: password
            },
            success: function(result) {
                $("#loader").hide();
                var data = $.parseJSON(result);
                if (data.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Password updated.'
                    });
                    $('#password').val('');
                    $('#con_password').val('');
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
</script>