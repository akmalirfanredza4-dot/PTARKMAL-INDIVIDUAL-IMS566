<?php
session_start();
require 'config/database.php';
require 'includes/auth.php';
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    if (!$name || !$email || strlen($password) < 6) {
        $error = 'Please complete all fields. Password must contain at least 6 characters.';
    } else {
        try {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, "user", "active")');
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $success = 'Registration successful. You can now login.';
        } catch (PDOException $e) {
            $error = 'Email already exists. Please use another email.';
        }
    }
}
$pageTitle = 'Register';
require 'includes/header.php';
?>
<div class="auth-wrapper">
    <div class="card">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-1">Create Account</h2>
            <p class="text-muted">Register as a PTARKMAL library user.</p>
            <?php if ($error): ?><div class="alert alert-danger"><?= e($error) ?></div><?php endif; ?>
            <?php if ($success): ?><div class="alert alert-success"><?= e($success) ?></div><?php endif; ?>
            <form method="post">
                <div class="mb-3"><label class="form-label required">Full Name</label><input type="text" name="name" class="form-control" required></div>
                <div class="mb-3"><label class="form-label required">Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="mb-3"><label class="form-label required">Password</label><input type="password" name="password" class="form-control" required></div>
                <button class="btn btn-primary w-100" type="submit">Register</button>
            </form>
        </div>
    </div>
</div>
<?php require 'includes/footer.php'; ?>
