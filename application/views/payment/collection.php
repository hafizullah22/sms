<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
<div class="container-fluid">



    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Payment History
            </h3>

            <p class="text-muted small mb-0">
                Student Wise Payment Collection
            </p>
        </div>

        <a href="<?= site_url('payment/create') ?>" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>

    </div>

    <!-- STUDENT INFO CARD -->
    <div class="card erp-card mb-4">

        <div class="card-body">

            <div class="row">

                <div class="col-md-3">
                    <strong>Student Name</strong><br>
                    <?= $student->full_name ?? '-' ?>
                </div>

                <div class="col-md-3">
                    <strong>Student ID</strong><br>
                    <?= $student->id ?? '-' ?>
                </div>

                <div class="col-md-3">
                    <strong>Class</strong><br>
                    <?= $student->class_id ?? '-' ?>
                </div>

                <div class="col-md-3">
                    <strong>Status</strong><br>
                    <span class="badge bg-success">Active</span>
                </div>

            </div>

        </div>

    </div>

    <!-- PAYMENT TABLE -->
    <div class="card erp-card">

        <div class="card-header bg-white">
            <h5 class="mb-0 fw-semibold">
                Payment Records
            </h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Due Amount</th>
                            <th>Pay Now</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if(!empty($payment)): ?>

                            <?php $i = 1; foreach($payment as $p): ?>

                                <tr>
                                    <td><?= $i++ ?></td>

                                    <td><?= $p->month ?></td>

                                    <td><?= $p->year ?></td>

                                    <td>
                                        <?= $p->payment_type == 1 ? 'Tuition' : 'Exam' ?>
                                    </td>

                                    <td>৳<?= $p->due_amount ?></td>

                                    <td>
                                        <?php if($p->due_amount > 0): ?>

                                            <form method="post" action="<?= site_url('payment/payment_update'); ?>">
                                            <input type="hidden" name="payment_id" value="<?= $p->id ?>">
                                            <div class="input-group">
                                                <span class="input-group-text">৳</span>
                                                <input type="number" name="paid_amount" class="form-control form-control-sm"
                                                       placeholder="Enter amount" required>
                                            
                                            <button type="submit" class="btn btn-sm btn-primary mt-1 w-100">
                                                <i class="bi bi-cash-coin me-1"></i>
                                                Pay Now 
                                            </button>
                                            </div>
                                            </form>

                            

                                        <?php else: ?>
                                            <span class="text-success">No due amount</span>
                                        <?php endif; ?>

                                    <td>
                                        <?php if($p->status == 'paid'): ?>
                                            <span class="badge bg-success">Paid</span>
                                        <?php elseif($p->status == 'partial'): ?>
                                            <span class="badge bg-warning">Partial</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Unpaid</span>
                                        <?php endif; ?>
                                    </td>

                                    <td><?= $p->pay_date ?? '-' ?></td>

                                    <td>
                                        <a href="<?= site_url('payment/receipt/' . $p->student_id) ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-receipt me-1"></i> Receipt
                                        </a>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    No payment records found
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

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
    box-shadow:0 3px 15px rgba(0,0,0,0.05);
    overflow:hidden;
}

.table th{
    font-size:13px;
}

.table td{
    font-size:14px;
    vertical-align: middle;
}

</style>

<?php $this->load->view('layout/footer'); ?>