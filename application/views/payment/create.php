<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1">Payment Management</h3>
                <p class="text-muted small mb-0">
                    ERP / Academic / Monthly Fee Generator
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="<?= site_url('payment/bulk_add') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Bulk Add
                </a>

                <a href="<?= site_url('payment/list') ?>" class="btn btn-outline-primary">
                    <i class="bi bi-list-ul me-1"></i> Payment List
                </a>
            </div>

        </div>

        <!-- FORM -->
        <form method="post" action="<?= site_url('payment/store'); ?>">

            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <div class="card erp-card">

                        <!-- CARD HEADER -->
                        <div class="card-header bg-white">
                            <h5 class="mb-0 fw-semibold">Monthly Fee Generator</h5>
                        </div>

                        <!-- BODY -->
                        <div class="card-body">

                            <div class="row g-4">

                                <!-- CLASS -->
                                <div class="col-md-6">
                                    <label class="form-label">Class</label>
                                    <select name="class_id" class="form-select" required>
                                        <option value="">Select Class</option>
                                        <?php foreach($classes as $class): ?>
                                            <option value="<?= $class->class_numeric ?>">
                                                <?= $class->class_name ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- MONTH -->
                                <div class="col-md-6">
                                    <label class="form-label">Month</label>
                                    <select name="month" class="form-select" required>
                                        <option value="">Select Month</option>

                                        <?php
                                        $months = [
                                            1=>'January',2=>'February',3=>'March',4=>'April',
                                            5=>'May',6=>'June',7=>'July',8=>'August',
                                            9=>'September',10=>'October',11=>'November',12=>'December'
                                        ];

                                        foreach($months as $key => $month):
                                        ?>
                                            <option value="<?= $key ?>">
                                                <?= $month ?>
                                            </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>

                                <!-- YEAR -->
                                <div class="col-md-6">
                                    <label class="form-label">Year</label>
                                    <select name="year" class="form-select" required>
                                        <option value="">Select Year</option>

                                        <?php
                                        $current_year = date('Y');
                                        for($year = $current_year; $year >= 2022; $year--):
                                        ?>
                                            <option value="<?= $year ?>">
                                                <?= $year ?>
                                            </option>
                                        <?php endfor; ?>

                                    </select>
                                </div>

                                <!-- PAYMENT TYPE -->
                                <div class="col-md-6">
                                    <label class="form-label">Payment Type</label>
                                    <select name="payment_type" class="form-select" required>
                                        <option value="">Select Type</option>
                                        <option value="1">Tuition Fee</option>
                                        <option value="2">Exam Fee</option>
                                    </select>
                                </div>

                                <!-- AMOUNT -->
                                <div class="col-md-6">
                                    <label class="form-label">Amount</label>

                                    <div class="input-group">
                                        <span class="input-group-text">৳</span>
                                        <input type="number" name="amount" class="form-control"
                                               placeholder="Enter amount" required>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- FOOTER -->
                        <div class="card-footer bg-white border-0 pt-0 pb-4 px-4">

                            <div class="d-flex justify-content-end gap-2">

                                <button type="reset" class="btn btn-light border">
                                    Reset
                                </button>

                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Generate Fee
                                </button>

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
    font-family:'Inter', sans-serif;
}

.erp-card{
    border:none;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 4px 20px rgba(0,0,0,0.05);
}

.card-header{
    padding:18px 22px;
    border-bottom:1px solid #edf0f5;
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
    height:44px;
    border-radius:10px;
    border:1px solid #dce1e7;
    font-size:14px;
}

.form-control:focus,
.form-select:focus{
    border-color:#0d6efd;
    box-shadow:0 0 0 3px rgba(13,110,253,0.10);
}

.input-group-text{
    border-radius:10px 0 0 10px;
    background:#f8f9fa;
}

.btn{
    border-radius:10px;
    padding:10px 18px;
    font-weight:600;
}

</style>

<?php $this->load->view('layout/footer'); ?>