<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div id="kt_content_container" class="container-xxl d-flex flex-column flex-lg-row">

        <!-- <php
        echo form_open_multipart('settings/edit_user', array('id' => 'client_update', 'role' => 'form', 'class' => 'form d-flex flex-column flex-lg-row'));
        ?> -->

        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Thumbnail</h2>
                    </div>
                </div>
                <div class="card-body text-center pt-0">
                    <?php
                    echo form_open_multipart('thumbnail_upload', array('id' => 'thumbnail_upload', 'role' => 'form'));
                    ?>
                    <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true"
                        style="background-image: url(<?php echo base_url(); ?>uploads/<?php echo $user_data['file']; ?>)">
                        <div class="image-input-wrapper w-150px h-150px"></div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar"
                            onclick="show_div()">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <input type="file" onchange="update_thumbnail()" name="avatar[]" id="avatar" accept=".png, .jpg, .jpeg" />
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
                    </form>
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
                                    <h2><?php echo $user_data['name']; ?></h2>
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
                                        <h5>Mobile - <?php echo $user_data['phone']; ?></h5>
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

                            <div class="card-body pt-0">
                                <div class="d-flex flex-wrap gap-5">
                                    <div class="fv-row w-100 flex-md-root">
                                        <h5>Upload Document</h5>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body pt-0">
                                <?php
                                echo form_open_multipart('document_upload', array('id' => 'document_upload', 'role' => 'form'));
                                ?>
                                <div class="row g-3">
                                    <?php if ($count_qry > 0) { ?>

                                        <?php if ($documents_data['account_verify'] == 0) { ?>
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
                                                    <h4 class="mb-1 text-primary">Please upload documents to verify your account</h4>
                                                    <span>To complete the verification process for your account, please upload a document that confirms your identity. This step is necessary to ensure the security and authenticity of your account. Accepted documents may include identification cards, utility bills, or other official records.</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <?php if ($documents_data['eid_status'] == 0 || $documents_data['eid_status'] == 3) { ?>
                                                    <label class="required form-label">ID</label>
                                                    <input type="hidden" name="client_id" id="client_id" value="<?php echo $user_data['id']; ?>">
                                                    <input type="file" class="form-control files" name="files_id[]" id="files_id">
                                                    <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                                <?php } else if ($documents_data['eid_status'] == 1) { ?>
                                                    <label class="required form-label">ID</label>
                                                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-danger">Pending</h4>
                                                        </div>
                                                    </div>
                                                <?php } else if ($documents_data['eid_status'] == 2) { ?>
                                                    <label class="required form-label">ID</label>
                                                    <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-success">Verified</h4>
                                                        </div>
                                                    </div>

                                                <?php } ?>

                                            </div>

                                            <div class="col-md-4">
                                                <?php if ($documents_data['pass_status'] == 0 || $documents_data['pass_status'] == 3) { ?>
                                                    <label class="required form-label">Passport</label>
                                                    <input type="file" class="form-control files" name="files_pass[]" id="files_pass">
                                                    <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                                <?php } else if ($documents_data['pass_status'] == 1) { ?>
                                                    <label class="required form-label">Passport</label>
                                                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-danger">Pending</h4>
                                                        </div>
                                                    </div>
                                                <?php } else if ($documents_data['pass_status'] == 2) { ?>
                                                    <label class="required form-label">Passport</label>
                                                    <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-success">Verified</h4>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                            <div class="col-md-4">
                                                <?php if ($documents_data['bank_status'] == 0 || $documents_data['bank_status'] == 3) { ?>
                                                    <label class="required form-label">Bank Statement</label>
                                                    <input type="file" class="form-control files" name="files_bank[]" id="files_bank">
                                                    <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                                <?php } else if ($documents_data['bank_status'] == 1) { ?>
                                                    <label class="required form-label">Bank Statement</label>
                                                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-danger">Pending</h4>
                                                        </div>
                                                    </div>
                                                <?php } else if ($documents_data['bank_status'] == 2) { ?>
                                                    <label class="required form-label">Bank Statement</label>
                                                    <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-success">Verified</h4>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                            <div class="col-md-4">
                                                <?php if ($documents_data['others_status'] == 0 || $documents_data['others_status'] == 3) { ?>
                                                    <label class="required form-label">Other doc.</label>
                                                    <input type="file" class="form-control files" name="files_other[]" id="files_other">
                                                    <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                                <?php } else if ($documents_data['others_status'] == 1) { ?>
                                                    <label class="required form-label">Other doc.</label>
                                                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-danger">Pending</h4>
                                                        </div>
                                                    </div>
                                                <?php } else if ($documents_data['others_status'] == 2) { ?>
                                                    <label class="required form-label">Other doc.</label>
                                                    <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                        <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                                <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <div class="d-flex flex-column">
                                                            <h4 class="mb-1 text-success">Verified</h4>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                                <span class="svg-icon svg-icon-2hx svg-icon-success me-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="currentColor"></path>
                                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <div class="d-flex flex-column">
                                                    <h4 class="mb-1 text-success">Verification complete. Your account is now active.</h4>
                                                    <span>This message confirms that the user’s account verification process is complete. It informs them that they now have access to additional features, specifically the ability to create both live accounts (for real transactions) and demo accounts (for practice purposes). This is commonly used in financial platforms, trading applications, or any service that offers both test and real environments.</span>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    <?php } else { ?>
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
                                                <h4 class="mb-1 text-primary">Please upload documents to verify your account</h4>
                                                <span>To complete the verification process for your account, please upload a document that confirms your identity. This step is necessary to ensure the security and authenticity of your account. Accepted documents may include identification cards, utility bills, or other official records.</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="required form-label">ID</label>
                                            <input type="file" class="form-control files" name="files_id[]" id="files_id">
                                            <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="required form-label">Passport</label>
                                            <input type="file" class="form-control files" name="files_pass[]" id="files_pass">
                                            <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="required form-label">Bank Statement</label>
                                            <input type="file" class="form-control files" name="files_bank[]" id="files_bank">
                                            <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="required form-label">Other doc.</label>
                                            <input type="file" class="form-control files" name="files_other[]" id="files_other">
                                            <p style="font-size: 11px;">(file format-pdf, jpg, jpeg, png, doc, docx)</p>
                                        </div>
                                    <?php } ?>

                                    <div class="col-md-8">
                                        <?php if (isset($documents_data)) { ?>
                                            <?php if ($documents_data['account_verify'] == 0) { ?>
                                                <label class="form-label">&nbsp;</label>
                                                <div class="d-flex justify-content-end">
                                                    <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes" onclick="upload_doc()">Upload</a>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-flex justify-content-end">
                                                <a href="javascript:void(0);" class="btn btn-primary" title="Save Changes" onclick="upload_doc()">Upload</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <php echo form_close(); ?> -->
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
    function update_thumbnail() {
        var ops_url = baseurl + 'client-crm/update-thumbnail';
        var form = $("#thumbnail_upload");
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
                        text: 'Thumnail updated.'
                    }).then(() => {
                        location.reload(); // Reloads the current page
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to upload Documents!'
                    });
                }
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Document updated.'
                }).then(() => {
                    location.reload(); // Reloads the current page
                });
            }
        });
    }

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

<script>
    function upload_doc() {
        $("#loader").show();
        var ops_url = baseurl + 'client-crm/upload-doc';
        var form = $("#document_upload");
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
                        text: 'Document updated.'
                    }).then(() => {
                        location.reload(); // Reloads the current page
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Failed to upload Documents!'
                    });
                }
            },
            error: function(xhr, status, error) {
                $("#loader").hide();
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Document updated.'
                }).then(() => {
                    location.reload(); // Reloads the current page
                });
            }
        });
    }
</script>