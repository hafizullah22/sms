<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

        <form method="post" action="<?php echo site_url('settings/update'); ?>" enctype="multipart/form-data">

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-12">

                    <!-- SUBJECT INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">School Information</h6>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                 <div class="col-md-6">
                                    <label class="form-label">School Name (English)</label>
                                    <input type="text" name="school_name_en" class="form-control" value="<?php echo $school_info->school_name_en ?>" required>
                                </div>


                                 <div class="col-md-6">
                                    <label class="form-label">School Name (Bangla)</label>
                                    <input type="text" name="school_name_bn" class="form-control" value="<?php echo $school_info->school_name_bn?>" required>
                                </div>


                                <div class="col-md-12">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo $school_info->address?>" required>
                            </div>

                            <div class="col-md-3">
                                    <label class="form-label">EIIN Number</label>
                                    <input type="text" name="eiin_number" class="form-control" value="<?php echo $school_info->eiin_number?>" required>
                            </div>


                            <div class="col-md-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo $school_info->phone?>" required>
                            </div>

                             
                                 

                                <div class="col-md-3">
                                    <label class="form-label">Establishment Year</label>
                                    <input type="text" name="establishment_year" class="form-control" value="<?php echo $school_info->establishment_year?>" required>
                                </div>

                               

                                <div class="col-md-3">
                                    <label class="form-label">logo</label>
                                    <input type="file" name="logo" class="form-control" placeholder="e.g. 3">
                                </div>

                                

                                    <!-- ACTION -->
                                <div class="card erp-card">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="bi bi-check-circle"></i> Update Information
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