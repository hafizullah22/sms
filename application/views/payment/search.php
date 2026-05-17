<?php $this->load->view('layout/header'); ?>

<section class="content py-4">
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1 text-dark">
                    Payment History
                </h3>

                <p class="text-muted mb-0 small">
                    Search and view student wise payment collection history
                </p>
            </div>

            <div>
                <a href="<?= site_url('dashboard'); ?>" class="btn btn-light border">
                    <i class="bi bi-arrow-left"></i>
                    Back Dashboard
                </a>
            </div>

        </div>

        <!-- MAIN CONTENT -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-6 col-md-8">

                <div class="card payment-card border-0">

                    <!-- TOP HEADER -->
                    <div class="card-top text-center">

                        <div class="icon-box mx-auto mb-3">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>

                        <h4 class="fw-bold mb-1">
                            Payment Search
                        </h4>

                        <p class="text-muted small mb-0">
                            Enter student ID to check payment records
                        </p>

                    </div>

                    <!-- FORM BODY -->
                    <div class="card-body p-4">

                        <form method="GET"
                              action="<?= site_url('payment/payment_collection'); ?>">

                            <!-- STUDENT ID -->
                            <div class="mb-4">

                                <label class="form-label">
                                    Student ID
                                </label>

                                <div class="input-group custom-input-group">

                                    <span class="input-group-text">
                                        <i class="bi bi-person-badge"></i>
                                    </span>

                                    <input type="text"
                                           name="student_id"
                                           class="form-control"
                                           placeholder="Enter Student ID"
                                           required>

                                </div>

                            </div>

                            <!-- BUTTON -->
                            <button type="submit"
                                    class="btn btn-primary btn-search w-100">

                                <i class="bi bi-search me-2"></i>
                                Search Payment History

                            </button>

                        </form>

                    </div>

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

/* CARD */
.payment-card{
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
}

/* TOP */
.card-top{
    padding:40px 30px 30px;
    background:linear-gradient(135deg,#0d6efd,#3b82f6);
    color:#fff;
}

/* ICON */
.icon-box{
    width:70px;
    height:70px;
    border-radius:50%;
    background:rgba(255,255,255,0.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    color:#fff;
}

/* LABEL */
.form-label{
    font-size:14px;
    font-weight:600;
    color:#495057;
    margin-bottom:8px;
}

/* INPUT */
.custom-input-group{
    border-radius:12px;
    overflow:hidden;
    border:1px solid #dee2e6;
    transition:all .2s ease;
}

.custom-input-group:focus-within{
    border-color:#0d6efd;
    box-shadow:0 0 0 3px rgba(13,110,253,.1);
}

.custom-input-group .input-group-text{
    background:#fff;
    border:none;
    padding:0 16px;
    color:#6c757d;
}

.custom-input-group .form-control{
    border:none;
    height:52px;
    font-size:15px;
    box-shadow:none;
}

/* BUTTON */
.btn-search{
    height:52px;
    border-radius:12px;
    font-weight:600;
    font-size:15px;
    transition:.2s;
}

.btn-search:hover{
    transform:translateY(-1px);
}

/* RESPONSIVE */
@media(max-width:768px){

    .card-top{
        padding:30px 20px 25px;
    }

    .card-body{
        padding:24px !important;
    }

}

</style>

<?php $this->load->view('layout/footer'); ?>