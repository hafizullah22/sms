<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Teacher Management</h3>
                <p class="text-muted mb-0 small">
                    ERP / Academic / Add Teacher
                </p>
            </div>

            <div>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Back
                </button>

                <a href="<?php echo site_url('teachers/index'); ?>" class="btn btn-primary">
                    <i class="bi bi-list"></i> Teacher List
                </a>
            </div>
        </div>

        <form method="post" action="<?php echo site_url('teachers/store'); ?>" enctype="multipart/form-data">

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-12">

                    <!-- SUBJECT INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Teacher Information</h6>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Teacher Name</label>
                                    <input type="text" name="teacher_name" class="form-control" placeholder="Enter teacher name" required>
                                </div>


                                 <div class="col-md-6">
                                    <label class="form-label">Designation </label>
                                    <select name="designation" class="form-select">
                                        <option value="">--Select--</option>
                                        <option value="1">Principle</option>
                                        <option value="2">Assistant Principle</option>
                                        <option value="3">Senior Teacher</option>
                                        <option value="4">Assistant Teacher</option>
                                        <option value="5">Computer Operator</option>
                                        <option value="6">Office Staff</option>

                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Salary</label>
                                    <input type="number" name="salary" class="form-control"  required>
                                </div>

                               

                                <div class="col-md-4">
                                    <label class="form-label">Joining Date</label>
                                    <input type="date" name="joining_date" class="form-control" placeholder="e.g. 3">
                                </div>

                               


                                <div class="col-md-4">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" placeholder="e.g. 3">
                                </div>


                             
                                    <!-- ACTION -->
                                <div class="card erp-card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-check-circle"></i> Save Information
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

               

            </div>

        </form>

    </div>
</section>

<style>
body{
    background:#f4f6f9;
    font-family: 'Inter', sans-serif;
}

.erp-card{
    border:none;
    border-radius:12px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}

.card-header{
    border-bottom:1px solid #edf0f5;
    padding:14px 18px;
    border-radius:12px 12px 0 0 !important;
}

.card-body{
    padding:20px;
}

.form-label{
    font-size:13px;
    font-weight:600;
    color:#495057;
    margin-bottom:4px;
}

.form-control,
.form-select{
    height:38px;
    border-radius:8px;
    border:1px solid #0e0f10;
    font-size:14px;
    box-shadow:none;
}

textarea.form-control{
    height:auto;
}

.form-control:focus,
.form-select:focus{
    border-color:#0d6efd;
    box-shadow:none;
}

.btn{
    border-radius:8px;
    padding:10px 18px;
    font-weight:600;
}
</style>

<?php $this->load->view('layout/footer'); ?>