<?php
$months = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
];


$current_year = date('Y');
?>

<?php $this->load->view('layout/header'); ?>

<section class="content py-4 payment-page">

    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header mb-4">

            <div>
                <h3 class="page-title">Payment Management</h3>

                <p class="page-subtitle mb-0">
                    ERP / Academic / Monthly Fee Generator
                </p>
            </div>

            <div class="page-actions">

                <a href="<?= site_url('payment/bulk_add') ?>"
                   class="btn btn-primary">

                    <i class="bi bi-arrow-left"></i>
                    Back

                </a>

                <a href="<?= site_url('payment/report') ?>"
                   class="btn btn-success">

                    <i class="bi bi-file-earmark-text"></i>
                    Payment Reports

                </a>

            </div>

        </div>

        <!-- FORM -->
        <form method="post" action="<?= site_url('payment/store'); ?>">

            <div class="card payment-card">

                <!-- CARD HEADER -->
                <div class="card-header">

                    <h5 class="card-title mb-1">
                        Monthly Fee Generator
                    </h5>

                    <p class="card-subtitle mb-0">
                        Generate monthly fees for students by class
                    </p>

                </div>

                <!-- CARD BODY -->
                <div class="card-body">

                    <div class="row g-4 align-items-end">

                        <!-- CLASS -->
                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Class
                            </label>

                            <div class="input-icon">

                                <i class="bi bi-mortarboard"></i>

                                <select name="class_id"
                                        class="form-select"
                                        required>

                                    <option value="">
                                        Select Class
                                    </option>

                                    <?php foreach($classes as $class): ?>

                                        <option value="<?= $class->class_numeric ?>">
                                            <?= $class->class_name ?>
                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                        <!-- MONTH -->
                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Month
                            </label>

                            <div class="input-icon">

                                <i class="bi bi-calendar-event"></i>

                                <select name="month"
                                        class="form-select"
                                        required>

                                    <option value="">
                                        Select Month
                                    </option>

                                    <?php foreach($months as $key => $month): ?>

                                        <option value="<?= $key ?>">
                                            <?= $month ?>
                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                        </div>

                        <!-- YEAR -->
                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Year
                            </label>

                            <div class="input-icon">

                                <i class="bi bi-calendar3"></i>

                                <select name="year" class="form-select" required>
                                    <option value=""> Select Year</option>

                                    <?php for($year = $current_year; $year >= 2022; $year--): ?>
                                        <option value="<?= $year ?>">
                                            <?= $year ?>
                                        </option>
                                    <?php endfor; ?>

                                </select>

                            </div>

                        </div>

                        <!-- PAYMENT TYPE -->
                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Payment Type
                            </label>

                            <div class="input-icon">

                                <i class="bi bi-wallet2"></i>

                                <select name="payment_type" class="form-select" required>
                                           
                                <option value="">Select Type </option>                                   
                                <option value="1">Tuition Fee </option>                                          
                                <option value="2">  Exam Fee </option>
                                            
                                </select>

                            </div>

                        </div>

                        <!-- AMOUNT -->
                        <div class="col-12 col-md-4">

                            <label class="form-label">
                                Amount
                            </label>

                            <div class="amount-group">

                                <span class="currency-symbol">
                                    ৳
                                </span>

                                <input type="number"
                                       name="amount"
                                       class="form-control"
                                       placeholder="Enter fee amount"
                                       required>

                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="col-12 col-md-4">

                            <button type="submit"
                                    class="btn btn-submit w-100">

                                <i class="bi bi-check-circle-fill"></i>
                                Generate Fee

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</section>

<style>

:root{
    --primary:#2563eb;
    --border:#000;
    --text:#111827;
    --muted:#6b7280;
    --bg:#f3f6fb;
    --white:#ffffff;
}

body{
    background:var(--bg);
    font-family:'Inter',sans-serif;
    color:var(--text);
}

/* PAGE HEADER */

.page-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    flex-wrap:wrap;
    gap:16px;
}

.page-title{
    margin:0;
    font-size:24px;
    font-weight:700;
}

.page-subtitle{
    color:var(--muted);
    font-size:14px;
}

.page-actions{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.page-actions .btn{
    height:44px;
    padding:0 18px;
    border-radius:12px;
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:600;
}

/* CARD */

.payment-card{
    border:none;
    border-radius:20px;
    background:var(--white);
    box-shadow:0 10px 30px rgba(15,23,42,.06);
}

.payment-card .card-header{
    padding:24px 24px 1px;
    border:none;
    background:#fff;
}

.payment-card .card-body{
    padding:28px;
}

.card-title{
    font-size:18px;
    font-weight:700;
}

.card-subtitle{
    font-size:14px;
    color:var(--muted);
}

/* FORM */

.form-label{
    font-size:14px;
    font-weight:600;
    margin-bottom:10px;
}

.form-control,
.form-select{
    height:40px;
    border-radius:12px;
    border:1px solid var(--border);
    font-size:14px;
    padding-left:44px;
    transition:.2s ease;
}

.form-control:focus,
.form-select:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 3px rgba(37,99,235,.10);
}

/* INPUT ICON */

.input-icon,
.amount-group{
    position:relative;
}

.input-icon i,
.currency-symbol{
    position:absolute;
    top:50%;
    left:15px;
    transform:translateY(-50%);
    z-index:5;
    font-size:15px;
}

.input-icon i{
    color:#6b7280;
}

.currency-symbol{
    color:var(--primary);
    font-weight:700;
}

.amount-group .form-control{
    padding-left:42px;
}

/* BUTTON */

.btn-submit{
    height:40px;
    border:none;
    border-radius:12px;
    background:linear-gradient(135deg,#2563eb,#3b82f6);
    color:#fff;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    transition:.2s ease;
}

.btn-submit:hover{
    color:#000;
    transform:translateY(-1px);
}

/* MOBILE */

@media(max-width:768px){

    .content{
        padding-top:12px !important;
    }

    .page-actions{
        width:100%;
    }

    .page-actions .btn{
        flex:1;
        justify-content:center;
    }

    .payment-card .card-header,
    .payment-card .card-body{
        padding:20px;
    }

}

@media(max-width:576px){

    .page-title{
        font-size:20px;
    }

    .form-control,
    .form-select,
    .btn-submit{
        height:48px;
    }

}

</style>

<?php $this->load->view('layout/footer'); ?>