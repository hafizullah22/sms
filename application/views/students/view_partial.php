<div class="container-fluid">

    <div class="row g-4">

        <!-- LEFT PROFILE CARD -->
        <div class="col-md-4">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body text-center p-4">

                    <!-- PROFILE IMAGE -->
                    <div class="mb-3">
                        <img src="<?= base_url('assets/images/avatars/default.jpg'); ?>"
                             class="rounded-circle border shadow"
                             style="width:120px;height:120px;object-fit:cover;">
                    </div>

                    <!-- NAME -->
                    <h5 class="fw-bold mb-1">
                        <?= $student->full_name; ?>
                    </h5>

                    <small class="text-muted">Student Profile</small>

                    <hr class="my-3">

                    <!-- INFO LIST -->
                    <div class="text-start">

                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Class</span>
                            <span class="fw-semibold"><?= $student->class_id; ?></span>
                        </div>

                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Roll</span>
                            <span class="fw-semibold"><?= $student->roll_no; ?></span>
                        </div>

                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Reg No</span>
                            <span class="fw-semibold"><?= $student->registration_no; ?></span>
                        </div>

                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">Session</span>
                            <span class="fw-semibold"><?= $student->session_year; ?></span>
                        </div>

                        <div class="d-flex justify-content-between py-1">
                            <span class="text-muted">DOB</span>
                            <span class="fw-semibold"><?= $student->date_of_birth; ?></span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT DETAILS CARD -->
        <div class="col-md-8">

            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h5 class="fw-bold mb-0">Guardian Information</h5>
                </div>

                <div class="card-body px-4 pb-4">

                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Father's Name</div>
                        <div class="col-md-8 fw-semibold"><?= $student->father_name; ?></div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Mother's Name</div>
                        <div class="col-md-8 fw-semibold"><?= $student->mother_name; ?></div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4 text-muted">Guardian Phone</div>
                        <div class="col-md-8 fw-semibold"><?= $student->guardian_phone; ?></div>
                    </div>

                    <hr>

                    <div class="row mb-0">
                        <div class="col-md-4 text-muted">Address</div>
                        <div class="col-md-8 fw-semibold"><?= $student->permanent_address; ?></div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>