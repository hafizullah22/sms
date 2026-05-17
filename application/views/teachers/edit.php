<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
            
            <div>
                <h3 class="fw-bold mb-1">Edit Teacher</h3>
                <p class="text-muted mb-0 small">
                    ERP / Academic / Edit Teacher
                </p>
            </div>

            <div class="d-flex gap-2">
                
                <a href="<?php echo site_url('teachers'); ?>" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i> Back
                </a>

                <a href="<?php echo site_url('teachers/index'); ?>" class="btn btn-primary">
                    <i class="bi bi-list"></i> Teacher List
                </a>

            </div>

        </div>

        <!-- FORM -->
        <form method="post" 
              action="<?php echo site_url('teachers/update/' . $teacher->id); ?>" 
              enctype="multipart/form-data">

            <div class="card erp-card">

                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold">
                        Teacher Information
                    </h6>
                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <!-- Teacher Name -->
                        <div class="col-md-6">
                            <label class="form-label">Teacher Name</label>

                            <input type="text"
                                   name="teacher_name"
                                   class="form-control"
                                   value="<?php echo html_escape($teacher->teacher_name); ?>"
                                   required>
                        </div>

                        <!-- Designation -->
                        <div class="col-md-6">
                            <label class="form-label">Designation</label>

                            <select name="designation" class="form-select" required>

                                <option value="">-- Select --</option>

                                <option value="Principle"
                                    <?php echo ($teacher->designation == 'Principle') ? 'selected' : ''; ?>>
                                    Principle
                                </option>

                                <option value="Assistant Principle"
                                    <?php echo ($teacher->designation == 'Assistant Principle') ? 'selected' : ''; ?>>
                                    Assistant Principle
                                </option>

                                <option value="Senior Teacher"
                                    <?php echo ($teacher->designation == 'Senior Teacher') ? 'selected' : ''; ?>>
                                    Senior Teacher
                                </option>

                                <option value="Assistant Teacher"
                                    <?php echo ($teacher->designation == 'Assistant Teacher') ? 'selected' : ''; ?>>
                                    Assistant Teacher
                                </option>

                                <option value="Computer Operator"
                                    <?php echo ($teacher->designation == 'Computer Operator') ? 'selected' : ''; ?>>
                                    Computer Operator
                                </option>

                                <option value="Office Staff"
                                    <?php echo ($teacher->designation == 'Office Staff') ? 'selected' : ''; ?>>
                                    Office Staff
                                </option>

                            </select>
                        </div>

                        <!-- Salary -->
                        <div class="col-md-4">
                            <label class="form-label">Salary</label>

                            <input type="number"
                                   name="salary"
                                   class="form-control"
                                   value="<?php echo html_escape($teacher->salary); ?>"
                                   required>
                        </div>

                        <!-- Joining Date -->
                        <div class="col-md-4">
                            <label class="form-label">Joining Date</label>

                            <input type="date"
                                   name="joining_date"
                                   class="form-control"
                                   value="<?php echo html_escape($teacher->joining_date); ?>">
                        </div>

                        <!-- Image -->
                        <div class="col-md-4">
                            <label class="form-label">Teacher Image</label>

                            <input type="file"
                                   name="image"
                                   class="form-control">
                        </div>

                        <!-- Current Image -->
                        <?php if (!empty($teacher->image)) : ?>
                            
                            <div class="col-md-12">

                                <label class="form-label d-block">
                                    Current Image
                                </label>

                                <img src="<?php echo base_url($teacher->image); ?>"
                                     alt="Teacher Image"
                                     class="img-thumbnail"
                                     style="width:120px; height:120px; object-fit:cover;">

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

            <!-- ACTION -->
            <div class="card erp-card mt-4">

                <div class="card-body text-end">

                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle"></i>
                        Update Information
                    </button>

                </div>

            </div>

        </form>

    </div>
</section>

<style>

body{
    background:#f4f6f9;
    font-family:'Inter', sans-serif;
}

.erp-card{
    border:none;
    border-radius:14px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05);
}

.card-header{
    border-bottom:1px solid #edf0f5;
    padding:16px 20px;
    border-radius:14px 14px 0 0 !important;
}

.card-body{
    padding:24px;
}

.form-label{
    font-size:13px;
    font-weight:600;
    color:#495057;
    margin-bottom:6px;
}

.form-control,
.form-select{
    height:42px;
    border-radius:10px;
    border:1px solid #dcdfe5;
    font-size:14px;
    box-shadow:none;
}

.form-control:focus,
.form-select:focus{
    border-color:#0d6efd;
    box-shadow:none;
}

.btn{
    border-radius:10px;
    padding:10px 18px;
    font-weight:600;
}

.img-thumbnail{
    border-radius:12px;
    border:1px solid #dee2e6;
    padding:4px;
}

</style>

<?php $this->load->view('layout/footer'); ?>