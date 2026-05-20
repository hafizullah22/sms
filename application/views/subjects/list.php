<?php $this->load->view('layout/header'); ?>

<section class="content py-4 subject-page">

    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header mb-4">

            <div>
                <h3 class="page-title">
                    Subject Management
                </h3>

                <p class="page-subtitle mb-0">
                    ERP / Academic / Subject List
                </p>
            </div>

            <a href="<?= site_url('subject/create'); ?>"
               class="btn btn-primary add-btn">

                <i class="bi bi-plus-lg"></i>
                Add Subject

            </a>

        </div>

        <!-- CARD -->
        <div class="card erp-card">

            <div class="card-header">

                <h6 class="mb-0 fw-bold">
                    Subject List
                </h6>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0 subject-table"
                           id="dataTable">

                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Year</th>
                                <th>Type</th>
                                <th>Marks</th>
                                <th>Pass</th>
                                <th class="text-center">Actions</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($subjects as $index => $subject) : ?>

                                <?php
                                $class = $this->db
                                    ->get_where('classes', ['id' => $subject->class_id])
                                    ->row();
                                ?>

                                <tr>

                                    <td>
                                        <?= $index + 1; ?>
                                    </td>

                                    <td class="fw-semibold">
                                        <?= $subject->subject_name; ?>
                                    </td>

                                    <td>
                                        <?= $class ? $class->class_name : 'N/A'; ?>
                                    </td>

                                    <td>
                                        <?= $subject->year; ?>
                                    </td>

                                    <td>

                                        <?php if ($subject->subject_type == 1): ?>

                                            <span class="badge bg-success-subtle text-success">
                                                Compulsory
                                            </span>

                                        <?php elseif ($subject->subject_type == 2): ?>

                                            <span class="badge bg-info-subtle text-info">
                                                Optional
                                            </span>

                                        <?php else: ?>

                                            <span class="badge bg-secondary">
                                                Unknown
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>
                                        <?= $subject->total_marks; ?>
                                    </td>

                                    <td>
                                        <?= $subject->pass_marks; ?>
                                    </td>

                                    <td>

                                        <div class="action-buttons">

                                            <a href="<?= site_url("subject/edit/{$subject->id}"); ?>"
                                               class="btn btn-sm btn-primary">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                            <button class="btn btn-sm btn-danger">

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

:root{
    --primary:#2563eb;
    --bg:#f4f7fb;
    --border:#000;
    --text:#111827;
    --muted:#6b7280;
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
    gap:16px;
    flex-wrap:wrap;
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

.add-btn{
    height:44px;
    border-radius:12px;
    padding:0 18px;
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:600;
}

/* CARD */

.erp-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    background:var(--white);
    box-shadow:0 10px 30px rgba(15,23,42,.05);
}

.erp-card .card-header{
    padding:20px 24px;
    background:#fff;
    border-bottom:1px solid var(--border);
}

/* TABLE */

.subject-table{
    min-width:900px;
}

.subject-table thead th{
    background:#f8fafc;
    color:#000;
    font-size:13px;
    font-weight:700;
    border-bottom:1px solid var(--border);
    padding:14px 18px;
    white-space:nowrap;
}

.subject-table tbody td{
    padding:14px 18px;
    vertical-align:middle;
    border-color:#000;
    font-size:14px;
}

.subject-table tbody tr:hover{
    background:#f9fbff;
}

/* BADGE */

.badge{
    padding:7px 12px;
    border-radius:30px;
    font-size:12px;
    font-weight:600;
}

/* ACTIONS */

.action-buttons{
    display:flex;
    justify-content:center;
    gap:8px;
}

.action-buttons .btn{
    width:34px;
    height:34px;
    border-radius:10px;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:0;
}

/* MOBILE */

@media(max-width:768px){

    .content{
        padding-top:12px !important;
    }

    .page-title{
        font-size:20px;
    }

    .page-header{
        align-items:flex-start;
    }

    .add-btn{
        width:100%;
        justify-content:center;
    }

    .erp-card .card-header{
        padding:18px 20px;
    }

    .subject-table thead th,
    .subject-table tbody td{
        padding:12px 14px;
    }

}

</style>

<?php $this->load->view('layout/footer'); ?>