<?php
session_start();
if (isset($_SESSION['role'])) {
    header('Location: ' . ($_SESSION['role'] === 'admin' ? 'admin/dashboard.php' : 'user/dashboard.php'));
    exit;
}
$pageTitle = 'Welcome';
require 'includes/auth.php';
require 'includes/header.php';
?>
<section class="hero p-4 p-lg-5 mb-4">
    <div class="row align-items-center g-4">
        <div class="col-lg-7">
            <span class="badge text-bg-warning text-dark mb-3">Library System Prototype</span>
            <h1 class="display-5 fw-bold">PTARKMAL Library Management System</h1>
            <p class="lead mb-4">A responsive PHP and MySQL system for managing books, members, borrowing activity, and visual library reports.</p>
            <a href="login.php" class="btn btn-warning btn-lg me-2">Login</a>
            <a href="register.php" class="btn btn-outline-light btn-lg">Register</a>
        </div>
        <div class="col-lg-5">
            <div class="card text-dark">
                <div class="card-body p-4">
                    <h5 class="fw-bold">Demo Accounts</h5>
                    <p class="mb-2"><strong>Admin:</strong> admin / 1234</p>
                    <p class="mb-0"><strong>User:</strong> student / 1234</p>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="row g-4">
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><i class="fa-solid fa-shield-halved stat-icon mb-3"></i><h5>Role-based Access</h5><p>Admin and student/user areas with protected pages.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><i class="fa-solid fa-chart-pie stat-icon mb-3"></i><h5>Visual Reports</h5><p>Meaningful charts for borrowing status and monthly activity.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100"><div class="card-body"><i class="fa-solid fa-mobile-screen stat-icon mb-3"></i><h5>Responsive Design</h5><p>Built with Bootstrap 5 for desktop and mobile screens.</p></div></div></div>
</div>
<?php require 'includes/footer.php'; ?>
