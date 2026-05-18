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

                <a href="<?= site_url('dashboard'); ?>" 
                   class="btn btn-light border rounded-3 px-3">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back Dashboard

                </a>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-12">

                <div class="card payment-card border-0">

                    <!-- CARD TOP -->
                    <div class="card-top text-center">

                        <div class="icon-box mx-auto mb-3">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>

                        <h4 class="fw-bold mb-1">
                            Payment Search
                        </h4>

                        <p class="small opacity-75 mb-0">
                            Enter student ID to check payment records
                        </p>

                    </div>

                    <!-- CARD BODY -->
                    <div class="card-body p-4 p-lg-5">

                        <form method="GET"
                              action="<?= site_url('payment/payment_collection'); ?>">

                            <!-- LABEL -->
                            <label class="form-label">
                                Student ID
                            </label>

                            <!-- SEARCH ROW -->
                            <div class="search-wrapper">

                                <!-- INPUT -->
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

                                <!-- BUTTON -->
                                <button type="submit"
                                        class="btn btn-primary btn-search">

                                    <i class="bi bi-search"></i>

                                    <span>
                                        Search
                                    </span>

                                </button>

                            </div>

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
    font-family:'Inter',sans-serif;
}

/* ================= CARD ================= */

.payment-card{
    border-radius:22px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 10px 35px rgba(0,0,0,.06);
}

/* ================= TOP ================= */

.card-top{
    padding:42px 30px 34px;
    background:linear-gradient(135deg,#0d6efd,#2563eb);
    color:#fff;
}

/* ================= ICON ================= */

.icon-box{
    width:75px;
    height:75px;
    border-radius:50%;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:32px;
    backdrop-filter:blur(10px);
}

/* ================= LABEL ================= */

.form-label{
    font-size:14px;
    font-weight:600;
    color:#374151;
    margin-bottom:10px;
}

/* ================= SEARCH ROW ================= */

.search-wrapper{
    display:flex;
    align-items:center;
    gap:14px;
}

/* ================= INPUT GROUP ================= */

.custom-input-group{
    flex:1;
    height:56px;
    border-radius:14px;
    overflow:hidden;
    border:1px solid #dbe1e8;
    transition:all .2s ease;
    background:#fff;
}

.custom-input-group:focus-within{
    border-color:#0d6efd;
    box-shadow:0 0 0 4px rgba(13,110,253,.10);
}

.custom-input-group .input-group-text{
    background:#fff;
    border:none;
    padding:0 18px;
    color:#6b7280;
    font-size:18px;
}

.custom-input-group .form-control{
    border:none;
    box-shadow:none;
    font-size:15px;
    padding-left:0;
}

.custom-input-group .form-control::placeholder{
    color:#9ca3af;
}

/* ================= BUTTON ================= */

.btn-search{
    height:56px;
    padding:0 26px;
    border-radius:14px;
    font-size:15px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    white-space:nowrap;
    transition:.2s ease;
}

.btn-search:hover{
    transform:translateY(-1px);
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .card-top{
        padding:32px 20px 28px;
    }

    .card-body{
        padding:24px !important;
    }

    .search-wrapper{
        flex-direction:column;
        align-items:stretch;
    }

    .btn-search{
        width:100%;
    }

}

@media(max-width:576px){

    .icon-box{
        width:65px;
        height:65px;
        font-size:28px;
    }

    .card-top h4{
        font-size:22px;
    }

    .custom-input-group{
        height:52px;
    }

    .btn-search{
        height:52px;
    }

}

</style>

<?php $this->load->view('layout/footer'); ?>