<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Subject Management</h3>
                <p class="text-muted mb-0 small">
                    ERP / Academic / Edit Subject
                </p>
            </div>

            <div>
                <button class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Bulk Add
                </button>

                <button class="btn btn-primary">
                    <i class="bi bi-list"></i> Subject List
                </button>
            </div>
        </div>

        <form method="post" action="<?php echo site_url('subject/update/' . $subject->id); ?>">

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    <!-- SUBJECT INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Subject Information</h6>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Subject Name</label>
                                    <input type="text" name="subject_name" class="form-control" placeholder="Enter subject name" value="<?php echo $subject->subject_name; ?>" required>
                                </div>


                                 <div class="col-md-6">
                                    <label class="form-label">Subject Type</label>
                                    <select name="subject_type" class="form-select">
                                        <option value="">--Select--</option>
                                        <option value="1" <?php echo $subject->subject_type == 1 ? 'selected' : ''; ?>>Compulsory</option>
                                        <option value="2" <?php echo $subject->subject_type == 2 ? 'selected' : ''; ?>>Optional</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Total Marks</label>
                                    <input type="text" name="total_marks" class="form-control" placeholder="e.g. ENG101" value="<?php echo $subject->total_marks; ?>" required>
                                </div>

                               

                                <div class="col-md-6">
                                    <label class="form-label">Pass Marks</label>
                                    <input type="number" name="pass_marks" class="form-control" placeholder="e.g. 3" value="<?php echo $subject->pass_marks; ?>">
                                </div>

                                

                                    <!-- ACTION -->
                                <div class="card erp-card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-book"></i> Update Subject
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col-lg-4">

                    <!-- ACADEMIC INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Academic Setup</h6>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Class</label>
                               
                                <select name="class_id" class="form-select">
                                    
                                    <option value="<?php echo $subject->class_id; ?>" selected>
                                       <?php echo $subject->class_id; ?> 
                                    </option>
                                </select>
                            </div>

                            

                            <div class="mb-3">
                                <label class="form-label">Year / Session</label>
                                <select name="year" class="form-select">
                                    <option value="<?php echo $subject->year; ?>" selected>
                                        <?php echo $subject->year; ?>
                                    </option>
                                <?php $year = $subject->year; 
                                 for($y = $year-1; $y >= $year - 3; $y--): ?>
                                    <option value="<?= $y ?>"><?= $y ?></option>
                                <?php endfor; ?>
                                
                                </select>

                              

                              
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