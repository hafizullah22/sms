<?php $this->load->view('layout/header'); ?>
      

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">Student Admission</h3>
                <p class="text-muted mb-0 small">
                    ERP / Student Management / Add Student
                </p>
            </div>

            <div>
                <button class="btn btn-primary">
                    <i class="bi bi-check-circle"></i>  Bulk Add
                </button>

                
                <a href="<?php echo site_url('student/index'); ?>" class="btn btn-primary"> <i class="bi bi-check-circle"></i>  Student List</a>
            </div>
        </div>

        <form action="<?= site_url('student/store'); ?>" method="post" enctype="multipart/form-data">

            <div class="row g-4">

                <!-- LEFT SIDE -->
                <div class="col-lg-8">

                    <!-- PERSONAL INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Personal Information</h6>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" name="full_name"class="form-control" placeholder="Enter full name" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Roll Number</label>
                                    <input type="text" name="roll_no" class="form-control" placeholder="Roll Number">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Registration No</label>
                                    <input type="text" name="registration_no"class="form-control" placeholder="Registration No">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Gender</label>
                                    <select class="form-select" name="gender">
                                        <option>Select</option>
                                        <option>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Blood Group</label>
                                    <select class="form-select" name="blood_group">
                                        <option>--Select--</option>
                                        <option>A+</option>
                                        <option>B+</option>
                                        <option>O+</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Religion</label>
                                    <select class="form-select" name="religion">
                                        <option>--Select--</option>
                                        <option>Islam</option>
                                        <option>Hindu</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- CONTACT INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Contact Information</h6>
                        </div>

                        <div class="card-body">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" placeholder="01XXXXXXXXX">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="example@mail.com">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Present Address</label>
                                    <textarea rows="3" name="present_address" class="form-control"></textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Permanent Address</label>
                                    <textarea rows="3" name="permanent_address" class="form-control"></textarea>
                                </div>


                                <button class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Save Student
                            </button>

                            </div>
                        </div>
                    </div>

                </div>

                <!-- RIGHT SIDE -->
                <div class="col-lg-4">

                    <!-- ACADEMIC INFO -->
                    <div class="card erp-card mb-4">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Academic Information</h6>
                        </div>

                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">Class</label>
                                <select name="class_id" class="form-select">
                                    <?php foreach($classes as $class): ?>
                                        <option value="<?= $class->class_numeric ?>"><?= $class->class_name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Section</label>
                                <select name="section" class="form-select">
                                    <option>A</option>
                                    <option>B</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Year / Session</label>
                                <select name="year" class="form-select">
                                    <option value="2026">2026</option>
                                </select>
                            </div>

                            <div>
                                <label class="form-label">Admission Date</label>
                                <input type="date" name="admission_date" class="form-control">
                            </div>

                        </div>
                    </div>

                    <!-- GUARDIAN INFO -->
                    <div class="card erp-card">
                        <div class="card-header bg-white">
                            <h6 class="mb-0 fw-bold">Guardian Information</h6>
                        </div>

                        <div class="card-body">

                            <div class="mb-2">
                                <label class="form-label">Father's Name</label>
                                <input type="text" name="father_name"class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Mother's Number</label>
                                <input type="text" name="mother_name" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Guardian Name</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Guardian Phone</label>
                                <input type="text" name="guardian_phone"class="form-control">
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
        height:35px;
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


     