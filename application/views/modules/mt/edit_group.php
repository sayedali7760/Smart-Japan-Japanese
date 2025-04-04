        <div id="kt_content_container" class="container-xxl">

            <?php
            echo form_open_multipart('mt/edit_group', array('id' => 'group_save', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
            ?>

            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                <div class="tab-content">

                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                        <div class="d-flex flex-column gap-7 gap-lg-10">

                            <div class="card card-flush py-4">

                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Edit MT Group</h2>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <div class="d-flex flex-wrap gap-5">


                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Group Name</label>
                                            <input type="hidden" id="group_id" name="group_id" value="<?php echo $group_data['id']; ?>">
                                            <input type="text" class="form-control mb-5" id="name" name="name"
                                                placeholder="Group Name" maxlength="50" value="<?php echo $group_data['name']; ?>">
                                        </div>

                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Currency</label>
                                            <select class="form-select mb-5" data-control="select2"
                                                data-placeholder="Select an option"
                                                name="currency" id="currency">
                                                <option value=""></option>
                                                <?php
                                                if (isset($currency_data) && !empty($currency_data)) {
                                                    foreach ($currency_data as $currency) {
                                                        if ($currency->code == $group_data['currency']) {
                                                            echo '<option selected value ="' . $currency->code . '">' . $currency->code . ' / ' . $currency->name . '</option>';
                                                        } else {
                                                            echo '<option value ="' . $currency->code . '">' . $currency->code . ' / ' . $currency->name . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="fv-row w-100 flex-md-root">
                                            <label class="required form-label">Description</label>
                                            <input type="text" class="form-control mb-5" id="description" name="description"
                                                placeholder="Description" maxlength="100" value="<?php echo $group_data['description']; ?>">
                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-end">

                                        <a href="<?php echo base_url(); ?>mt/group-show" id="kt_ecommerce_add_product_cancel"
                                            class="btn btn-light me-5">Cancel</a>

                                        <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes" onclick="update_data()">Save
                                            Changes</a>

                                    </div>

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
                $('#currency').select2({
                    placeholder: 'Select an option',
                });
            });
            KTImageInput.init();
        </script>
        <script>
            function update_data() {
                $("#loader").show();
                var ops_url = baseurl + 'mt/update-group';
                var group_id = $('#group_id').val();
                var name = $('#name').val();
                var currency = $('#currency').val();
                var description = $('#description').val();

                if (name == "") {
                    Swal.fire({
                        icon: 'info',
                        title: '',
                        text: 'Group Name is required.'
                    });
                    $("#loader").hide();
                    return false;
                }
                if (currency == "") {
                    Swal.fire({
                        icon: 'info',
                        title: '',
                        text: 'Currency is required.'
                    });
                    $("#loader").hide();
                    return false;
                }
                if (description == "") {
                    Swal.fire({
                        icon: 'info',
                        title: '',
                        text: 'Description is required.'
                    });
                    $("#loader").hide();
                    return false;
                }

                var form = $("#group_save");
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
                                text: 'Group updated.'
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