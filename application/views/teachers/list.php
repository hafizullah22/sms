<?php $this->load->view('layout/header'); ?>

<section class="content py-4">

    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h3 class="fw-bold mb-1 text-dark">
                    Teacher Management
                </h3>

                <p class="text-muted mb-0 small">
                    ERP / Academic / Teacher List
                </p>

            </div>

            <a href="<?php echo site_url('teachers/create'); ?>" 
               class="btn btn-primary add-btn">

                <i class="bi bi-plus-lg"></i>
                Add Teacher

            </a>

        </div>

        <!-- CARD -->
        <div class="card erp-card border-0">

            <!-- CARD HEADER -->
            <div class="card-header bg-white border-0 py-3">

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                    <h6 class="mb-0 fw-bold">
                        Teacher List
                    </h6>

                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                        Total: <?php echo count($teachers); ?>
                    </span>

                </div>

            </div>

            <!-- CARD BODY -->
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle table-hover" id="dataTable">

                        <thead>

                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th>Teacher Name</th>
                                <th>Designation</th>
                                <th>Salary</th>
                                <th>Joining Date</th>
                                <th class="text-center">Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($teachers as $index => $teacher) : ?>

                                <tr>

                                    <!-- SL -->
                                    <td>
                                        <?php echo $index + 1; ?>
                                    </td>

                                    <!-- IMAGE -->
                                    <td>

                                        <img src="<?php echo base_url($teacher->image); ?>"
                                             alt="Teacher Image"
                                             class="teacher-img">

                                    </td>

                                    <!-- NAME -->
                                    <td>

                                        <div class="fw-semibold text-dark">
                                            <?php echo $teacher->teacher_name; ?>
                                        </div>

                                    </td>

                                    <!-- DESIGNATION -->
                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            <?php echo $teacher->designation; ?>
                                        </span>
                                    </td>

                                    <!-- SALARY -->
                                    <td>
                                        ৳ <?php echo number_format($teacher->salary); ?>
                                    </td>

                                    <!-- JOIN DATE -->
                                    <td>
                                        <?php echo date('d M Y', strtotime($teacher->joining_date)); ?>
                                    </td>

                                    <!-- ACTION -->
                                    <td>

                                        <div class="d-flex gap-2 justify-content-center flex-wrap">

                                            <!-- EDIT -->
                                            <a href="<?php echo site_url("teachers/edit/{$teacher->id}"); ?>"
                                               class="btn btn-sm btn-primary action-btn">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                            <!-- DELETE -->
                                            <button class="btn btn-sm btn-danger action-btn">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* ================= GLOBAL ================= */

body{
    background:#f4f6f9;
    font-family:'Inter',sans-serif;
}

/* ================= CARD ================= */

.erp-card{
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 30px rgba(0,0,0,.05);
}

/* ================= TABLE ================= */

.table{
    margin-bottom:0;
}

.table thead th{
    background:#f8fafc;
    border-bottom:1px solid #e5e7eb;
    color:#374151;
    font-size:14px;
    font-weight:700;
    padding:14px;
    white-space:nowrap;
}

.table tbody td{
    padding:14px;
    vertical-align:middle;
    border-color:#f1f5f9;
    font-size:14px;
}

/* ================= IMAGE ================= */

.teacher-img{
    width:55px;
    height:55px;
    border-radius:12px;
    object-fit:cover;
    border:2px solid #e5e7eb;
}

/* ================= BUTTONS ================= */

.add-btn{
    border-radius:10px;
    padding:10px 18px;
    font-weight:600;
    display:flex;
    align-items:center;
    gap:6px;
}

.action-btn{
    width:36px;
    height:36px;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:10px;
}

/* ================= MOBILE CARD TABLE ================= */

@media(max-width:768px){

    .table-responsive{
        border-radius:14px;
    }

    .table{
        min-width:800px;
    }

    .card-body{
        padding:14px;
    }

    .teacher-img{
        width:48px;
        height:48px;
    }

    .table thead th,
    .table tbody td{
        padding:12px;
        font-size:13px;
    }

    .add-btn{
        width:100%;
        justify-content:center;
    }

}

/* ================= SMALL MOBILE ================= */

@media(max-width:576px){

    .content{
        padding-left:0 !important;
        padding-right:0 !important;
    }

    .erp-card{
        border-radius:14px;
    }

    .card-header{
        padding:16px !important;
    }

}

</style>

<?php $this->load->view('layout/footer'); ?>