<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('layout/header'); ?>

<section class=" py-4">
    <div class="container-fluid">

        <?php if (!empty($school_info)): ?>

        <div class="gov-school-card">

            <!-- HEADER (OFFICIAL STYLE BANNER) -->
            <div class="gov-header">

                <div class="gov-header-top">

                    <!-- LOGO -->
                    <div class="gov-logo">
                        <img src="<?php echo base_url($school_info->logo); ?>" alt="Logo">
                    </div>

                    <!-- TITLE -->
                    <div class="gov-title">
                        <h2><?php echo html_escape($school_info->school_name_en); ?></h2>
                        <p style="text-align:center;">EIIN:<?php echo html_escape($school_info->eiin_number); ?> | 
                        Established: <?php echo html_escape($school_info->establishment_year); ?> |
                         Phone: <?php echo html_escape($school_info->phone); ?></p>
                    </div>

                    <!-- EDIT BUTTON -->
                    <div class="gov-action">
                        <a href="<?php echo site_url('settings/edit'); ?>" class="gov-btn">
                            <i class="bi bi-pencil"></i> Edit Information
                        </a>
                    </div>

                </div>

            </div>

            <!-- BODY -->
            <div class="gov-body">

                <h3 class="gov-section-title">
                    <i class="fas fa-info-circle"></i>
                    Basic Information
                </h3>

                <table class="gov-table">

                    <tr>
                        <th>School Name (English)</th>
                        <td><?php echo html_escape($school_info->school_name_en); ?></td>
                    </tr>

                    <tr>
                        <th>School Name (Bangla)</th>
                        <td><?php echo html_escape($school_info->school_name_bn); ?></td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td><?php echo html_escape($school_info->address); ?></td>
                    </tr>

                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo html_escape($school_info->phone); ?></td>
                    </tr>

                    <tr>
                        <th>EIIN Number</th>
                        <td><?php echo html_escape($school_info->eiin_number); ?></td>
                    </tr>

                    <tr>
                        <th>Established Year</th>
                        <td><?php echo html_escape($school_info->establishment_year); ?></td>
                    </tr>

                </table>

            </div>

        </div>

        <?php else: ?>

        <div class="gov-empty">
            <i class="fas fa-school"></i>
            <h3>No School Information Found</h3>
            <p>Please create school profile first</p>
            <a href="<?php echo site_url('settings/create'); ?>" class="gov-btn">
                Create Profile
            </a>
        </div>

        <?php endif; ?>

    </div>
</section>

<style>
    body{
    background:#eef2f7;
    font-family: 'Inter', sans-serif;
}

/* MAIN CARD */
.gov-school-card{
    background:#fff;
    border:1px solid #d9e2ec;
    border-radius:8px;
    overflow:hidden;
}

/* HEADER */
.gov-header{
    background:#1f3b64;
    color:#fff;
    padding:10px 25px;
    border-bottom:3px solid #0f2a4a;
}

.gov-header-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;
}

/* LOGO */
.gov-logo{
    width:100px;
    height:100px;
    background:#fff;
    padding:5px;
    border-radius:4px;
}

.gov-logo img{
    width:100%;
    height:100%;
    object-fit:contain;
}

/* TITLE */
.gov-title h2{
    font-size:22px;
    margin:0;
    font-weight:700;
}

.gov-title p{
    margin:2px 0 0;
    font-size:13px;
    opacity:0.85;
}

/* BUTTON */
.gov-btn{
    background:#ffffff;
    color:#1f3b64;
    padding:8px 14px;
    border-radius:4px;
    font-weight:600;
    text-decoration:none;
    font-size:14px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    border:1px solid #d9e2ec;
}

.gov-btn:hover{
    background:#f1f5f9;
}

/* BODY */
.gov-body{
    padding:25px;
}

/* SECTION TITLE */
.gov-section-title{
    font-size:16px;
    font-weight:700;
    margin-bottom:15px;
    color:#1f3b64;
    border-left:4px solid #1f3b64;
    padding-left:10px;
}

/* TABLE STYLE */
.gov-table{
    width:100%;
    border-collapse:collapse;
    font-size:14px;
}

.gov-table th,
.gov-table td{
    border:1px solid #d9e2ec;
    padding:10px 12px;
    text-align:left;
}

.gov-table th{
    width:30%;
    background:#f1f5f9;
    color:#334e68;
    font-weight:600;
}

/* EMPTY */
.gov-empty{
    text-align:center;
    padding:80px 20px;
    background:#fff;
    border-radius:8px;
    border:1px solid #d9e2ec;
}

.gov-empty i{
    font-size:50px;
    color:#94a3b8;
    margin-bottom:15px;
}
</style>


<?php $this->load->view('layout/footer'); ?>