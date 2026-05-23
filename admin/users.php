<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('admin');
$pageTitle = 'Users';
$users = $pdo->query('SELECT id, name, email, role, status, created_at FROM users ORDER BY created_at DESC')->fetchAll();
require '../includes/header.php';
?>
<div class="card"><div class="card-header">Registered Users</div><div class="card-body"><div class="table-responsive">
<table class="table align-middle"><thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Joined</th></tr></thead><tbody>
<?php foreach ($users as $u): ?><tr><td class="fw-semibold"><?= e($u['name']) ?></td><td><?= e($u['email']) ?></td><td><span class="badge text-bg-info"><?= e($u['role']) ?></span></td><td><?= e($u['status']) ?></td><td><?= e($u['created_at']) ?></td></tr><?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require '../includes/footer.php'; ?>
