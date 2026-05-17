<?php
$role = $this->session->userdata('role');
$username = $this->session->userdata('username');
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>School ERP</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>

/* ================= BODY ================= */
body{
    font-family: 'Inter', sans-serif;
    background:#f4f6f9;
}

/* ================= WRAPPER ================= */
.wrapper{
    display:flex;
}

/* ================= SIDEBAR ================= */
.main-sidebar{
    width:250px;
    background:#000;
    min-height:100vh;
    position:fixed;
    left:0;
    top:0;
    transition:0.3s;
}

.brand-link{
    display:flex;
    align-items:center;
    justify-content:center;
    padding:15px;
    font-weight:700;
    color:#fff;
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.sidebar-menu{
    padding:10px 0;
}

.sidebar-menu a{
    display:flex;
    align-items:center;
    gap:10px;
    padding:12px 18px;
    color:#c2c7d0;
    text-decoration:none;
    font-size:14px;
}

.sidebar-menu a:hover,
.sidebar-menu a.active{
    background:#495057;
    color:#fff;
    border-left:3px solid #0d6efd;
}

/* ================= MAIN CONTENT ================= */
.content-wrapper{
    margin-left:250px;
    width:calc(100% - 250px);
    transition:0.3s;
}

/* ================= TOP NAVBAR ================= */
.main-header{
    height:55px;
    background:#fff;
    border-bottom:1px solid #dee2e6;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 15px;
    position:sticky;
    top:0;
    z-index:100;
}

/* LEFT */
.left-nav{
    display:flex;
    align-items:center;
    gap:15px;
}

.sidebar-toggle{
    border:none;
    background:transparent;
    font-size:20px;
}

/* RIGHT */
.right-nav{
    display:flex;
    align-items:center;
    gap:15px;
}

.user-box{
    display:flex;
    align-items:center;
    gap:10px;
}

.user-box img{
    width:35px;
    height:35px;
    border-radius:50%;
}

/* ================= CONTENT ================= */
.content{
    padding:20px;
}

/* ================= CARD ================= */
.card{
    border:none;
    border-radius:10px;
    box-shadow:0 1px 4px rgba(0,0,0,0.08);
}

/* ================= SIDEBAR COLLAPSE ================= */
.sidebar-collapsed .main-sidebar{
    margin-left:-250px;
}

.sidebar-collapsed .content-wrapper{
    margin-left:0;
    width:100%;
}

.logout-btn {
            font-size: 0.813rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            border: 1px solid #000;
            color: #ef4444;
            text-decoration: none;
        
        }

        .logout-btn:hover {
            background: #fef2f2;
            border-color: #fecaca;
        }

/* ================= MOBILE ================= */
@media(max-width:992px){
    .main-sidebar{
        margin-left:-250px;
    }

    .main-sidebar.show{
        margin-left:0;
    }

    .content-wrapper{
        margin-left:0;
        width:100%;
    }
}

</style>
</head>

<body>

<div class="wrapper">

<!-- ================= SIDEBAR ================= -->
<aside class="main-sidebar" id="sidebar">

    <a href="#" class="brand-link">
        School ERP
    </a>

    <div class="sidebar-menu">

        <a href="#" class="active">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <?php if ($role == 'admin' || $role == 'super_admin') { ?>

   

        <a href="<?php echo site_url('student');?>" > <i class="bi bi-people-fill"></i>
            Students
        </a>

   
    
        <a href="<?php echo site_url('teachers');?>"><i class="bi bi-person-badge"></i> Teachers</a>
        <a href="<?php echo site_url('classes');?>"><i class="bi bi-building"></i> Classes</a>
        <a href="<?php echo site_url('subject');?>"><i class="bi bi-journal"></i> Subjects</a>
        <a href="<?php echo site_url('payment/payment_search');?>"><i class="bi bi-cash"></i> Fees Collect</a>

        <?php } ?>

        <?php if ($role == 'super_admin') { ?>

        <a href="<?php echo site_url('settings'); ?>">
            <i class="bi bi-gear"></i> Settings
        </a>

        <?php } ?>

    </div>

</aside>

<!-- ================= CONTENT ================= -->
<div class="content-wrapper">

<!-- TOP NAV -->
<nav class="main-header">

    <div class="left-nav">
        <button class="sidebar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>

        <strong>Dashboard</strong>
    </div>

    <div class="right-nav">

        <!-- USER -->
        <div class="user-box">
            <img src="https://i.pravatar.cc/100">
            <div>
                <div style="font-size:14px;font-weight:600;">
                    <?php echo $username; ?>
                </div>
                <small class="text-muted">
                    <?php echo $role; ?>
                </small>
            </div>
        </div>

        <!-- LOGOUT -->
       <a class="logout-btn" href="<?php echo site_url('Welcome/logout'); ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

    </div>

</nav>

