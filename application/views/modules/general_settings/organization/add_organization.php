<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <div class="post d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container-xxl">

            <?php
                echo form_open_multipart('general_settings/organization/add_organization', array('id' => 'organization_save', 'role' => 'form','class' => 'form d-flex flex-column flex-lg-row'));
                ?>


            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Add Distributors</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Name</label>
                                            <input type="text" class="form-control mb-5 alphanumeric" id="organization"
                                                name="organization" placeholder="Name" maxlength="50">
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Mail-Id</label>
                                            <input type="text" class="form-control mb-5" id="mail" name="mail"
                                                placeholder="Mail-Id" maxlength="50">
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Mobile</label>
                                            <input type="text" class="form-control mb-5 numeric" id="mobile"
                                                name="mobile" placeholder="Mobile" maxlength="12">
                                        </div>

                                    </div>



                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-end">

                    <a href="<?php echo base_url();?>home" id="kt_ecommerce_add_product_cancel"
                        class="btn btn-light me-5">Cancel</a>

                    <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes"
                        onclick="submit_data()">Save Changes</a>

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<script>
function submit_data() {
    var ops_url = baseurl + 'organization/save-organization';
    var organization = $('#organization').val();
    var mail = $('#mail').val();
    var mobile = $('#mobile').val();
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (organization == "") {
        Swal.fire({
            icon: 'info',
            title: '',
            text: 'Name is required.'
        });
        return false;
    }

    if (mail == '') {
        Swal.fire({
            icon: 'info',
            title: '',
            text: 'Mail is required.'
        });
        return false;
    }
    if (mail.length < 5) {
        Swal.fire({
            icon: 'info',
            title: '',
            text: 'Enter atleast 5 characters for Mail-Id.'
        });
        return false;
    }
    if (!regex.test(mail)) {
        Swal.fire({
            icon: 'info',
            title: '',
            text: 'Enter valid mail-id.'
        });
        return false;
    }
    if (mobile == '') {
        Swal.fire({
            icon: 'info',
            title: '',
            text: 'Mobile is required.'
        });
        return false;
    }
    if (mobile.length < 4) {
        Swal.fire({
            icon: 'info',
            title: '',
            text: 'Enter valid Mobile Number.'
        });
        return false;
    }

    var form = $("#organization_save");
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
                    text: 'Distributor created.'
                });
                $('#organization_save').trigger("reset");
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