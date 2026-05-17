
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            color: #333;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0f172a, #1e293b);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 999;
        }

        .sidebar .logo {
            padding: 22px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            text-align: center;
        }

        .sidebar .logo h4 {
            font-weight: 700;
            margin-bottom: 0;
            color: #fff;
        }

        .sidebar .menu {
            padding: 20px 0;
        }

        .sidebar .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            color: #cbd5e1;
            text-decoration: none;
            transition: 0.3s;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar .menu a:hover,
        .sidebar .menu a.active {
            background: rgba(255,255,255,0.08);
            color: #fff;
            border-left: 4px solid #38bdf8;
        }

        .sidebar .menu i {
            font-size: 18px;
        }

        /* ================= MAIN CONTENT ================= */
        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ================= HEADER ================= */
        .topbar {
            background: #fff;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .topbar h5 {
            margin-bottom: 0;
            font-weight: 600;
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-box img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* ================= CONTENT ================= */
        .content {
            flex: 1;
            padding: 25px;
        }

        .dashboard-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            transition: 0.3s;
            height: 100%;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
        }

        .dashboard-card .icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .bg-blue {
            background: rgba(59,130,246,0.12);
            color: #2563eb;
        }

        .bg-green {
            background: rgba(34,197,94,0.12);
            color: #16a34a;
        }

        .bg-orange {
            background: rgba(249,115,22,0.12);
            color: #ea580c;
        }

        .bg-red {
            background: rgba(239,68,68,0.12);
            color: #dc2626;
        }

        .dashboard-card h3 {
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .dashboard-card p {
            margin-bottom: 0;
            color: #64748b;
        }

        /* ================= TABLE ================= */
        .custom-table {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        }

        .table thead {
            background: #f1f5f9;
        }

        .table th {
            font-weight: 600;
            color: #334155;
        }

        /* ================= FOOTER ================= */
        .footer {
            background: #fff;
            padding: 15px 25px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 14px;
        }

        /* ================= MOBILE ================= */
        @media(max-width: 992px) {
            .sidebar {
                margin-left: -260px;12345
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">

        <div class="logo">
            <h4>School ERP</h4>
        </div>

        <div class="menu">
            <a href="#" class="active">
                <i class="bi bi-grid-fill"></i>
                Dashboard
            </a>

            <a href="#">
                <i class="bi bi-people-fill"></i>
                Students
            </a>

            <a href="#">
                <i class="bi bi-person-badge-fill"></i>
                Teachers
            </a>

            <a href="#">
                <i class="bi bi-building"></i>
                Classes
            </a>

            <a href="#">
                <i class="bi bi-journal-bookmark-fill"></i>
                Subjects
            </a>

            <a href="#">
                <i class="bi bi-clipboard-data-fill"></i>
                Results
            </a>

            <a href="#">
                <i class="bi bi-cash-stack"></i>
                Fees Collection
            </a>

            <a href="#">
                <i class="bi bi-gear-fill"></i>
                Settings
            </a>
        </div>

    </aside>


    <!-- MAIN -->
    <main class="main">

        <!-- HEADER -->
        <header class="topbar">

            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-outline-secondary d-lg-none" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>

                <h5>Dashboard</h5>
            </div>

            <div class="profile-box">
                <div class="text-end">
                    <strong>Admin User</strong><br>
                    <small class="text-muted">Administrator</small>
                </div>

                <img src="https://i.pravatar.cc/100" alt="profile">
            </div>

        </header>


        <!-- CONTENT -->
        <section class="content">

            <!-- CARDS -->
            <div class="row g-4 mb-4">

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-blue">
                            <i class="bi bi-people-fill"></i>
                        </div>

                        <h3>2,540</h3>
                        <p>Total Students</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-green">
                            <i class="bi bi-person-workspace"></i>
                        </div>

                        <h3>124</h3>
                        <p>Total Teachers</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-orange">
                            <i class="bi bi-building"></i>
                        </div>

                        <h3>18</h3>
                        <p>Total Classes</p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="dashboard-card">
                        <div class="icon bg-red">
                            <i class="bi bi-currency-dollar"></i>
                        </div>

                        <h3>$12,450</h3>
                        <p>Monthly Collection</p>
                    </div>
                </div>

            </div>


            <!-- TABLE -->
            <div class="custom-table">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Recent Students</h5>

                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle"></i>
                        Add Student
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle">
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
                                <td>#1001</td>
                                <td>Rahim Uddin</td>
                                <td>Class 10</td>
                                <td>017XXXXXXXX</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tr>

                            <tr>
                                <td>#1002</td>
                                <td>Karim Hasan</td>
                                <td>Class 9</td>
                                <td>018XXXXXXXX</td>
                                <td>
                                    <span class="badge bg-success">Active</span>
                                </td>
                            </tr>

                            <tr>
                                <td>#1003</td>
                                <td>Nusrat Jahan</td>
                                <td>Class 8</td>
                                <td>019XXXXXXXX</td>
                                <td>
                                    <span class="badge bg-warning text-dark">Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </section>


        <!-- FOOTER -->
        <footer class="footer">
            © 2026 School Management System | Developed by Your Company
        </footer>

    </main>

</div>


<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

</body>
</html>
