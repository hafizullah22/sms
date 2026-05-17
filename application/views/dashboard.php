<?php $this->load->view('layout/header'); ?>

<style>
:root {
    --primary: #4f46e5;
    --primary-light: #eef2ff;
    --success: #16a34a;
    --warning: #f59e0b;
    --danger: #dc2626;
    --info: #0ea5e9;
    --dark: #0f172a;
    --gray: #64748b;
    --light-bg: #f8fafc;
    --card-border: #e2e8f0;
}

body {
    background: var(--light-bg);
    font-family: 'Inter', sans-serif;
}

.dashboard-wrapper {
    padding: 24px;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 25px;
}

.dashboard-header h2 {
    font-weight: 700;
    color: var(--dark);
    margin-bottom: 4px;
}

.dashboard-header p {
    color: var(--gray);
    margin: 0;
}

.top-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.top-actions .btn {
    border-radius: 12px;
    padding: 10px 18px;
    font-weight: 600;
}

.stat-card {
    background: #fff;
    border-radius: 20px;
    padding: 24px;
    position: relative;
    overflow: hidden;
    border: 1px solid var(--card-border);
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
}

.stat-card .icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 18px;
}

.bg-primary-soft {
    background: rgba(79, 70, 229, 0.12);
    color: var(--primary);
}

.bg-success-soft {
    background: rgba(22, 163, 74, 0.12);
    color: var(--success);
}

.bg-warning-soft {
    background: rgba(245, 158, 11, 0.15);
    color: var(--warning);
}

.bg-danger-soft {
    background: rgba(220, 38, 38, 0.12);
    color: var(--danger);
}

.stat-card h3 {
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 4px;
    color: var(--dark);
}

.stat-card p {
    color: var(--gray);
    margin-bottom: 10px;
    font-weight: 500;
}

.stat-card .growth {
    font-size: 13px;
    font-weight: 600;
}

.growth.up {
    color: var(--success);
}

.growth.down {
    color: var(--danger);
}

.dashboard-card {
    background: #fff;
    border-radius: 20px;
    border: 1px solid var(--card-border);
    margin-top: 24px;
    overflow: hidden;
}

.card-header-custom {
    padding: 20px 24px;
    border-bottom: 1px solid #edf2f7;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header-custom h5 {
    margin: 0;
    font-weight: 700;
    color: var(--dark);
}

.card-body-custom {
    padding: 24px;
}

.notice-item {
    display: flex;
    gap: 15px;
    align-items: start;
    padding: 14px 0;
    border-bottom: 1px solid #f1f5f9;
}

.notice-item:last-child {
    border-bottom: none;
}

.notice-icon {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.notice-content h6 {
    margin-bottom: 4px;
    font-size: 15px;
    font-weight: 600;
    color: var(--dark);
}

.notice-content p {
    margin: 0;
    color: var(--gray);
    font-size: 13px;
}

.activity-list {
    position: relative;
}

.activity-item {
    position: relative;
    padding-left: 28px;
    margin-bottom: 22px;
}

.activity-item:last-child {
    margin-bottom: 0;
}

.activity-item::before {
    content: '';
    position: absolute;
    left: 5px;
    top: 5px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--primary);
}

.activity-item::after {
    content: '';
    position: absolute;
    left: 9px;
    top: 16px;
    width: 2px;
    height: calc(100% + 10px);
    background: #dbeafe;
}

.activity-item:last-child::after {
    display: none;
}

.activity-item h6 {
    font-size: 15px;
    margin-bottom: 4px;
    font-weight: 600;
}

.activity-item p {
    font-size: 13px;
    color: var(--gray);
    margin-bottom: 0;
}

.quick-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 18px;
    border-radius: 14px;
    border: 1px solid #edf2f7;
    margin-bottom: 14px;
    text-decoration: none;
    color: var(--dark);
    transition: all 0.3s ease;
}

.quick-link:hover {
    background: #f8fafc;
    transform: translateX(3px);
}

.quick-link .left {
    display: flex;
    align-items: center;
    gap: 14px;
}

.quick-link i {
    font-size: 18px;
}

.quick-link span {
    font-weight: 600;
}

.badge-soft {
    background: rgba(14, 165, 233, 0.1);
    color: var(--info);
    padding: 6px 12px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
}

@media (max-width: 768px) {
    .dashboard-wrapper {
        padding: 15px;
    }

    .dashboard-header {
        flex-direction: column;
        align-items: start;
    }
}
</style>

<section class="dashboard-wrapper">

    <!-- HEADER -->
    <div class="dashboard-header">
        <div>
            <h2>Dashboard Overview</h2>
            <p>Welcome back! Here is your school management summary.</p>
        </div>

        <div class="top-actions">
            <a href="#" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle me-1"></i> Add Student
            </a>

            <a href="#" class="btn btn-light border shadow-sm">
                <i class="bi bi-printer me-1"></i> Generate Report
            </a>
        </div>
    </div>

    <!-- STATISTICS -->
    <div class="row g-4">

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon bg-primary-soft">
                    <i class="bi bi-mortarboard-fill"></i>
                </div>

                <h3>1,250</h3>
                <p>Total Students</p>

                <div class="growth up">
                    <i class="bi bi-arrow-up"></i> +12% This Month
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon bg-success-soft">
                    <i class="bi bi-person-workspace"></i>
                </div>

                <h3>85</h3>
                <p>Total Teachers</p>

                <div class="growth up">
                    <i class="bi bi-arrow-up"></i> +4 New Teachers
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon bg-warning-soft">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <h3>৳ 5.2L</h3>
                <p>Total Collection</p>

                <div class="growth up">
                    <i class="bi bi-arrow-up"></i> +18% Revenue
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon bg-danger-soft">
                    <i class="bi bi-exclamation-circle"></i>
                </div>

                <h3>42</h3>
                <p>Pending Fees</p>

                <div class="growth down">
                    <i class="bi bi-arrow-down"></i> Needs Attention
                </div>
            </div>
        </div>

    </div>


    <div class="row">

        <!-- RECENT NOTICE -->
        <div class="col-lg-7">
            <div class="dashboard-card">

                <div class="card-header-custom">
                    <h5>
                        <i class="bi bi-megaphone-fill me-2"></i>
                        Latest Notices
                    </h5>

                    <span class="badge-soft">Updated Today</span>
                </div>

                <div class="card-body-custom">

                    <div class="notice-item">
                        <div class="notice-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>

                        <div class="notice-content">
                            <h6>Monthly Examination Schedule Published</h6>
                            <p>Exam routine for all classes has been uploaded.</p>
                        </div>
                    </div>

                    <div class="notice-item">
                        <div class="notice-icon">
                            <i class="bi bi-trophy-fill"></i>
                        </div>

                        <div class="notice-content">
                            <h6>Annual Sports Registration Open</h6>
                            <p>Students can now participate in annual sports events.</p>
                        </div>
                    </div>

                    <div class="notice-item">
                        <div class="notice-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>

                        <div class="notice-content">
                            <h6>Tuition Fee Submission Reminder</h6>
                            <p>Last submission date is 25th of this month.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <!-- ACTIVITY -->
        <div class="col-lg-5">
            <div class="dashboard-card">

                <div class="card-header-custom">
                    <h5>
                        <i class="bi bi-activity me-2"></i>
                        Recent Activity
                    </h5>
                </div>

                <div class="card-body-custom">

                    <div class="activity-list">

                        <div class="activity-item">
                            <h6>New Student Admission Completed</h6>
                            <p>5 minutes ago</p>
                        </div>

                        <div class="activity-item">
                            <h6>Payment Successfully Received</h6>
                            <p>15 minutes ago</p>
                        </div>

                        <div class="activity-item">
                            <h6>Teacher Attendance Updated</h6>
                            <p>30 minutes ago</p>
                        </div>

                        <div class="activity-item">
                            <h6>Exam Result Generated</h6>
                            <p>1 hour ago</p>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- QUICK ACCESS -->
    <div class="dashboard-card">

        <div class="card-header-custom">
            <h5>
                <i class="bi bi-grid-fill me-2"></i>
                Quick Access
            </h5>
        </div>

        <div class="card-body-custom">

            <div class="row">

                <div class="col-md-6 col-lg-4">
                    <a href="#" class="quick-link">
                        <div class="left">
                            <i class="bi bi-people-fill text-primary"></i>
                            <span>Manage Students</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="#" class="quick-link">
                        <div class="left">
                            <i class="bi bi-journal-bookmark-fill text-success"></i>
                            <span>Manage Classes</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="#" class="quick-link">
                        <div class="left">
                            <i class="bi bi-cash-stack text-warning"></i>
                            <span>Fee Collection</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="#" class="quick-link">
                        <div class="left">
                            <i class="bi bi-file-earmark-bar-graph-fill text-info"></i>
                            <span>Result Management</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="#" class="quick-link">
                        <div class="left">
                            <i class="bi bi-calendar-check-fill text-danger"></i>
                            <span>Attendance</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <div class="col-md-6 col-lg-4">
                    <a href="#" class="quick-link">
                        <div class="left">
                            <i class="bi bi-gear-fill text-secondary"></i>
                            <span>Settings</span>
                        </div>

                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>

</section>

<?php $this->load->view('layout/footer'); ?>
