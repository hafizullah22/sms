<?php $this->load->view('layout/header'); ?>

<section class="payment-search-container">

    <div class="container">

        <!-- HEADER -->
        <header class="top-bar">

            <div class="brand-meta">
                <h2>Payment History</h2>
                <p>Search student payment records quickly</p>
            </div>

            <a href="<?= site_url('welcome/dashboard'); ?>" class="btn-back">
                <i class="bi bi-arrow-left"></i>
                <span>Dashboard</span>
            </a>

        </header>

        <!-- SEARCH -->
        <div class="search-wrapper">

            <div class="search-card">

                <form method="GET"
                      action="<?= site_url('payment/payment_collection'); ?>"
                      class="search-inline-form">

                    <!-- INPUT -->
                    <div class="input-wrapper">

                        <i class="bi bi-search input-icon"></i>

                        <input
                            type="text"
                            id="student_id"
                            name="student_id"
                            placeholder="Search by Student ID..."
                            autocomplete="off"
                            required>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" class="btn-submit">

                        <i class="bi bi-search"></i>

                        <span>Payment Search</span>

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<style>

:root{
    --bg:#f8fafc;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --primary:#2563eb;
    --primary-hover:#1d4ed8;
    --border:#e2e8f0;
}

body{
    background:var(--bg);
    font-family:'Inter',sans-serif;
    color:var(--text);
    -webkit-font-smoothing:antialiased;
}

/* PAGE */

.payment-search-container{
    padding:24px 12px;
}

.container{
    max-width:1000px;
    margin:auto;
}

/* HEADER */

.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:16px;
    margin-bottom:24px;
    flex-wrap:wrap;
}

.brand-meta h2{
    margin:0;
    font-size:26px;
    font-weight:700;
}

.brand-meta p{
    margin:4px 0 0;
    color:var(--muted);
    font-size:14px;
}

/* BUTTON */

.btn-back{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    padding:10px 16px;
    background:#fff;
    border:1px solid var(--border);
    border-radius:12px;
    text-decoration:none;
    font-size:14px;
    font-weight:600;
    color:#334155;
    transition:.2s ease;
}

.btn-back:hover{
    background:#f1f5f9;
    color:#0f172a;
}

/* CARD */

.search-card{
    background:var(--card);
    border:1px solid var(--border);
    border-radius:18px;
    padding:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.04);
}

/* FORM */

.search-inline-form{
    display:flex;
    align-items:center;
    gap:12px;
}

/* INPUT */

.input-wrapper{
    position:relative;
    flex:1;
}

.input-icon{
    position:absolute;
    top:50%;
    left:14px;
    transform:translateY(-50%);
    color:#94a3b8;
    font-size:15px;
}

.input-wrapper input{
    width:100%;
    height:52px;
    border-radius:14px;
    border:1px solid #000;
    background:#f8fafc;
    padding:0 16px 0 42px;
    font-size:15px;
    transition:.2s ease;
}

.input-wrapper input:focus{
    outline:none;
    border-color:var(--primary);
    background:#fff;
    box-shadow:0 0 0 4px rgba(37,99,235,.10);
}

.input-wrapper input::placeholder{
    color:#94a3b8;
}

/* SUBMIT */

.btn-submit{
    height:52px;
    min-width:180px;
    padding:0 18px;
    border:none;
    border-radius:14px;
    background:var(--primary);
    color:#fff;
    font-size:14px;
    font-weight:600;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    transition:.2s ease;
    white-space:nowrap;
}

.btn-submit:hover{
    background:var(--primary-hover);
}

/* =========================
   MOBILE OPTIMIZATION
========================= */

@media(max-width:768px){

    .payment-search-container{
        padding:18px 10px;
    }

    .top-bar{
        flex-direction:column;
        align-items:stretch;
        margin-bottom:18px;
    }

    .brand-meta h2{
        font-size:22px;
    }

    .brand-meta p{
        font-size:13px;
    }

    .btn-back{
        width:100%;
    }

    .search-card{
        padding:14px;
        border-radius:16px;
    }

    .search-inline-form{
        flex-direction:column;
        align-items:stretch;
        gap:10px;
    }

    .input-wrapper{
        width:100%;
    }

    .input-wrapper input{
        height:50px;
        font-size:16px; /* Prevent iOS zoom */
    }

    .btn-submit{
        width:100%;
        height:50px;
        min-width:100%;
    }
}

/* EXTRA SMALL */

@media(max-width:480px){

    .brand-meta h2{
        font-size:20px;
    }

    .search-card{
        padding:12px;
    }

    .input-wrapper input{
        border-radius:12px;
    }

    .btn-submit{
        border-radius:12px;
        font-size:13px;
    }
}

</style>

<?php $this->load->view('layout/footer'); ?>