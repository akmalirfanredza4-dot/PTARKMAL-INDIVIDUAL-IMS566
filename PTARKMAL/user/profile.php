<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('user');
$pageTitle = 'Profile';
$stmt=$pdo->prepare('SELECT name,email,role,status,created_at FROM users WHERE id=?'); $stmt->execute([$_SESSION['user_id']]); $user=$stmt->fetch();
require '../includes/header.php';
?>
<div class="card" style="max-width:680px"><div class="card-header">My Profile</div><div class="card-body">
<h3 class="fw-bold"><?= e($user['name']) ?></h3>
<p class="text-muted"><?= e($user['email']) ?></p>
<dl class="row"><dt class="col-sm-3">Role</dt><dd class="col-sm-9"><?= e($user['role']) ?></dd><dt class="col-sm-3">Status</dt><dd class="col-sm-9"><?= e($user['status']) ?></dd><dt class="col-sm-3">Joined</dt><dd class="col-sm-9"><?= e($user['created_at']) ?></dd></dl>
</div></div>
<?php require '../includes/footer.php'; ?>
