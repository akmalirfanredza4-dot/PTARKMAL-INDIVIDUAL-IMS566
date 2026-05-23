<?php
session_start();
require 'config/database.php';
require 'includes/auth.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ? AND status = "active" LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        header('Location: ' . ($user['role'] === 'admin' ? 'admin/dashboard.php' : 'user/dashboard.php'));
        exit;
    } else {
        $error = 'Invalid username or password. Please try again.';
    }
}
$pageTitle = 'Login';
require 'includes/header.php';
?>
<div class="auth-wrapper">
    <div class="card">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-1">Welcome Back</h2>
            <p class="text-muted">Login to PTARKMAL Library.</p>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <form method="post" class="needs-validation" novalidate>
                <div class="mb-3"><label class="form-label required">Username</label><input type="text" name="username" class="form-control" placeholder="Enter admin or student" required></div>
                <div class="mb-3"><label class="form-label required">Password</label><input type="password" name="password" class="form-control" required></div>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
