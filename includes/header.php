<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$currentRole = $_SESSION['role'] ?? null;
$basePath = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false || strpos($_SERVER['PHP_SELF'], '/user/') !== false) ? '../' : '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="PTARKMAL Library Management System for managing books, users, borrowing records, and reports.">
    <meta name="author" content="PTARKMAL">
    <title><?= isset($pageTitle) ? e($pageTitle) . ' | ' : '' ?>PTARKMAL Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="<?= $basePath ?>assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= $basePath ?>index.php">
            <i class="fa-solid fa-book-open-reader"></i> PTARKMAL
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                <?php if ($currentRole === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>admin/dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>admin/books.php">Books</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>admin/borrowings.php">Borrowings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>admin/users.php">Users</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>admin/reports.php">Reports</a></li>
                <?php elseif ($currentRole === 'user'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>user/dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>user/catalog.php">Book Catalog</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>user/my_borrowings.php">My Borrowings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= $basePath ?>user/profile.php">Profile</a></li>
                <?php endif; ?>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item ms-lg-3"><span class="badge rounded-pill text-bg-light text-dark px-3 py-2"><?= e($_SESSION['name']) ?> · <?= e(ucfirst($_SESSION['role'])) ?></span></li>
                    <li class="nav-item"><a class="btn btn-warning btn-sm ms-lg-3 mt-2 mt-lg-0" href="<?= $basePath ?>logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="btn btn-warning btn-sm ms-lg-3" href="register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<main class="container-fluid px-3 px-lg-4 py-4">
