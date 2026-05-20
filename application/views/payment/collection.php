<?php $this->load->view('layout/header'); ?>

<section class="content py-4 payment-history">

<div class="container-fluid">

    <!-- HEADER -->
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="page-title">Payment History</h3>
            <p class="page-subtitle">Student Wise Payment Collection</p>
        </div>

        <a href="<?= site_url('payment/create') ?>" class="btn btn-outline-primary btn-back">
            <i class="bi bi-arrow-left"></i> Back
        </a>

    </div>

    <!-- STUDENT CARD -->
    <div class="card info-card mb-4">

        <div class="card-body">

            <div class="info-grid">

                <div>
                    <small>Student Name</small>
                    <div class="value"><?= $student->full_name ?? '-' ?></div>
                </div>

                <div>
                    <small>Student ID</small>
                    <div class="value"><?= $student->id ?? '-' ?></div>
                </div>

                <div>
                    <small>Class</small>
                    <div class="value"><?= $student->class_id ?? '-' ?></div>
                </div>

                <div>
                    <small>Status</small>
                    <div class="badge bg-success">Active</div>
                </div>

            </div>

        </div>

    </div>

    <!-- TABLE CARD -->
    <div class="card table-card">

        <div class="card-header bg-white">
            <h5 class="mb-0 fw-semibold">Payment Records</h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th>Type</th>
                            <th>Due</th>
                            <th>Status</th>
                            <th>Pay</th>
                            <th>Date</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
    1           
                    <tbody>

                        <?php if(!empty($payment)): ?>
 
                            <?php $i=1; foreach($payment as $p): ?>

                                <tr>
                                    <td><?= $i++ ?></td>
                                    <?php 
                                    $months = [
                                    1=>'January',2=>'February',3=>'March',4=>'April',
                                    5=>'May',6=>'June',7=>'July',8=>'August',
                                    9=>'September',10=>'October',11=>'November',12=>'December'
                                ];?>
                                   <td><?= $months[$p->month] ?? '-' ?></td>
                                    <td><?= $p->year ?></td>
                                    <td><?= $p->payment_type == 1 ? 'Tuition' : 'Exam' ?></td>

                                    <td>৳<?= $p->due_amount ?></td>

                                    <td>
                                        <?php if($p->status=='paid'): ?>
                                            <span class="badge bg-success">Paid</span>
                                        <?php elseif($p->status=='partial'): ?>
                                            <span class="badge bg-warning text-dark">Partial</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Unpaid</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                    <?php if($p->due_amount > 0): ?>
                                        <!-- Added data-due attribute here so JavaScript can read the exact row limit -->
                                        <form method="post" action="<?= site_url('payment/payment_update'); ?>" class="pay-form" data-due="<?= $p->due_amount; ?>">

                                            <input type="hidden" name="payment_id" value="<?= $p->id ?>">

                                            <div class="pay-box">
                                                <span class="currency">৳</span>
                                                <input type="number" step="any" name="paid_amount" placeholder="Amount" required>
                                                <button type="submit"><b>Pay</b></button>
                                            </div>

                                        </form>
                                    <?php else: ?>
                                        <span class="text-success small">No due</span>
                                    <?php endif; ?>
                                </td>

                                    <td><?= $p->pay_date ?? '-' ?></td>

                                    <td>
                                        <a href="<?= site_url('payment/receipt/'.$p->student_id) ?>"
                                           class="btn btn-sm btn-outline-primary">
                                            Receipt
                                        </a>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="9" class="text-center py-4 text-muted">
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
    background:#f5f7fb;
    font-family:'Inter',sans-serif;
}

/* HEADER */

.page-title{
    font-size:24px;
    font-weight:700;
    margin:0;
}

.page-subtitle{
    font-size:13px;
    color:#6b7280;
    margin:4px 0 0;
}

.btn-back{
    border-radius:12px;
    height:42px;
    display:flex;
    align-items:center;
    gap:6px;
}

/* INFO CARD */

.info-card{
    border:none;
    border-radius:16px;
    box-shadow:0 8px 25px rgba(0,0,0,.06);
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:15px;
}

.info-grid small{
    color:#6b7280;
}

.info-grid .value{
    font-weight:600;
    margin-top:4px;
}

/* TABLE */

.table-card{
    border:none;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 8px 25px rgba(0,0,0,.06);
}

.table th{
    font-size:13px;
}

.table td{
    font-size:14px;
    vertical-align:middle;
}

/* PAY FORM */

.pay-box{
    display:flex;
    align-items:center;
    gap:6px;
    background:#f9fafb;
    border:1px solid #000;
    border-radius:10px;
    padding:4px;
    max-width:200px;
}

.pay-box .currency{
    padding-left:6px;
    color:#000;
    font-weight:600;
}

.pay-box input{
    border:none;
    outline:none;
    width:85px;
    background:transparent;
    font-size:13px;
}

.pay-box button{
    background:#2563eb;
    color:#fff;
    border:none;
    padding:6px 28px;
    border-radius:8px;
    font-size:12px;
}

/* RESPONSIVE */

@media(max-width:992px){

    .info-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:768px){

    .table-responsive{
        overflow-x:auto;
    }

    .pay-box{
        min-width:140px;
    }
}

@media(max-width:576px){

    .info-grid{
        grid-template-columns:1fr;
    }

    .page-title{
        font-size:20px;
    }

    .pay-box{
        flex-direction:column;
        align-items:stretch;
    }

    .pay-box input{
        width:100%;
    }

    .pay-box button{
        width:100%;
    }
}

</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Select all payment forms on the page
    const payForms = document.querySelectorAll(".pay-form");

    payForms.forEach(form => {
        const paidInput = form.querySelector('input[name="paid_amount"]');
        // Extract the maximum allowed amount from the form's data-due attribute
        const maxDue = parseFloat(form.getAttribute("data-due")) || 0;

        function validateRowAmount() {
            const paidAmount = parseFloat(paidInput.value) || 0;

            if (paidAmount > maxDue) {
                // Set native browser validation warning popup message
                paidInput.setCustomValidity(`Amount cannot exceed the remaining due (৳${maxDue})`);
                // UI warning styling accents
                paidInput.style.borderColor = "#ef4444"; 
                paidInput.style.color = "#b91c1c";
                return false;
            } else {
                // Reset styling and validity clear rules
                paidInput.setCustomValidity("");
                paidInput.style.borderColor = "";
                paidInput.style.color = "";
                return true;
            }
        }

        // 1. Run validation instantly as the user types/changes the value
        paidInput.addEventListener("input", validateRowAmount);

        // 2. Hard submission block check to prevent bypassing
        form.addEventListener("submit", function (event) {
            if (!validateRowAmount()) {
                event.preventDefault(); // Stop processing submit back to server
                form.reportValidity();  // Trigger browser built-in warning bubble
            }
        });
    });
});
    </script>

<?php $this->load->view('layout/footer'); ?>