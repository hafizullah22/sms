<?php $this->load->view('layout/header'); ?>

<style>
    /* ================= SYSTEM DESIGN CUSTOMIZATIONS ================= */
    :root {
        --dash-blue: #0ea5e9;
        --dash-blue-bg: #e0f2fe;
        --dash-green: #10b981;
        --dash-green-bg: #d1fae5;
        --dash-orange: #f59e0b;
        --dash-orange-bg: #fef3c7;
        --dash-red: #ef4444;
        --dash-red-bg: #fee2e2;
        --text-main: #1e293b;
        --text-sub: #64748b;
    }

    /* ================= METRIC DASHBOARD CARDS ================= */
    .dashboard-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02), 0 1px 2px rgba(0, 0, 0, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
    }

    .dashboard-card .icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .dashboard-card .card-info {
        overflow: hidden;
    }

    .dashboard-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
        line-height: 1.2;
    }

    .dashboard-card p {
        font-size: 0.875rem;
        color: var(--text-sub);
        margin: 4px 0 0 0;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    /* Icon Context Colors */
    .bg-blue { background-color: var(--dash-blue-bg); color: var(--dash-blue); }
    .bg-green { background-color: var(--dash-green-bg); color: var(--dash-green); }
    .bg-orange { background-color: var(--dash-orange-bg); color: var(--dash-orange); }
    .bg-red { background-color: var(--dash-red-bg); color: var(--dash-red); }

    /* ================= TABLE CARD WRAPPER ================= */
    .custom-table {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .custom-table .table th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
        color: var(--text-sub);
        background-color: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
        padding: 12px 16px;
    }

    .custom-table .table td {
        padding: 16px;
        color: var(--text-main);
        font-size: 0.875rem;
        border-bottom: 1px solid #f1f5f9;
    }

    .custom-table .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badge Overrides for Modern Look */
    .badge {
        padding: 6px 10px;
        font-weight: 500;
        border-radius: 6px;
    }

    /* Small Screen Padding Overrides */
    @media (max-width: 576px) {
        .custom-table {
            padding: 16px;
        }
        .custom-table .table td, 
        .custom-table .table th {
            padding: 12px 8px;
        }
    }
</style>

<!-- CONTENT SECTION -->
<section class="content px-3 px-md-4 py-4">

    <!-- METRIC CARDS GRID -->
    <div class="row g-3 g-sm-4 mb-4">

        <!-- Total Students -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="icon bg-blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="card-info">
                    <h3>2,540</h3>
                    <p>Total Students</p>
                </div>
            </div>
        </div>

        <!-- Total Teachers -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="icon bg-green">
                    <i class="bi bi-person-workspace"></i>
                </div>
                <div class="card-info">
                    <h3>124</h3>
                    <p>Total Teachers</p>
                </div>
            </div>
        </div>

        <!-- Total Classes -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="icon bg-orange">
                    <i class="bi bi-building"></i>
                </div>
                <div class="card-info">
                    <h3>18</h3>
                    <p>Total Classes</p>
                </div>
            </div>
        </div>

        <!-- Monthly Collection -->
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="dashboard-card">
                <div class="icon bg-red">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="card-info">
                    <h3>$12,450</h3>
                    <p>Monthly Collection</p>
                </div>
            </div>
        </div>

    </div>

    <!-- MAIN DATA TABLE CARD -->
    <div class="custom-table">

        <!-- Table Utility Header Layer -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
            <div>
                <h5 class="mb-1" style="font-weight: 700; color: var(--text-main);">Recent Students</h5>
                <p class="text-muted small mb-0">Overview of newly registered academic profiles.</p>
            </div>

            <button class="btn btn-primary btn-sm d-flex align-items-center gap-2 py-2 px-3 style-button" style="border-radius: 8px; font-weight: 500;">
                <i class="bi bi-plus-circle"></i>
                <span>Add Student</span>
            </button>
        </div>

        <!-- Modern Borderless Scrolling Table Canvas -->
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="font-weight: 600; color: var(--dash-blue);">#1001</td>
                        <td style="font-weight: 500;">Rahim Uddin</td>
                        <td>Class 10</td>
                        <td class="text-monospace">017XXXXXXXX</td>
                        <td>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: 600; color: var(--dash-blue);">#1002</td>
                        <td style="font-weight: 500;">Karim Hasan</td>
                        <td>Class 9</td>
                        <td class="text-monospace">018XXXXXXXX</td>
                        <td>
                            <span class="badge bg-success-subtle text-success border border-success-subtle">Active</span>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight: 600; color: var(--dash-blue);">#1003</td>
                        <td style="font-weight: 500;">Nusrat Jahan</td>
                        <td>Class 8</td>
                        <td class="text-monospace">019XXXXXXXX</td>
                        <td>
                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">Pending</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</section>

<?php $this->load->view('layout/footer'); ?>