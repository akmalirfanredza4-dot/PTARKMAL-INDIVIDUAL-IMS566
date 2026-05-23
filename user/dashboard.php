<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('user');
$pageTitle = 'User Dashboard';
$userId = $_SESSION['user_id'];
$totalAvailable = $pdo->query('SELECT SUM(quantity) FROM books')->fetchColumn() ?: 0;
$stmt = $pdo->prepare('SELECT COUNT(*) FROM borrowings WHERE user_id=? AND status="borrowed"'); $stmt->execute([$userId]); $myActive = $stmt->fetchColumn();
$stmt = $pdo->prepare('SELECT COUNT(*) FROM borrowings WHERE user_id=?'); $stmt->execute([$userId]); $myTotal = $stmt->fetchColumn();
$stmt = $pdo->prepare('SELECT status, COUNT(*) total FROM borrowings WHERE user_id=? GROUP BY status'); $stmt->execute([$userId]); $statusData = $stmt->fetchAll();
require '../includes/header.php';
?>
<h1 class="fw-bold mb-1">Student Dashboard</h1><p class="text-muted">Track your PTARKMAL borrowing activity.</p>
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="card stat-card"><div class="card-body"><p class="text-muted mb-1">Available Books</p><h3><?= e($totalAvailable) ?></h3></div></div></div>
    <div class="col-md-4"><div class="card stat-card"><div class="card-body"><p class="text-muted mb-1">My Active Borrowings</p><h3><?= e($myActive) ?></h3></div></div></div>
    <div class="col-md-4"><div class="card stat-card"><div class="card-body"><p class="text-muted mb-1">My Total Borrowings</p><h3><?= e($myTotal) ?></h3></div></div></div>
</div>
<div class="card"><div class="card-header">My Borrowing Status</div><div class="card-body" style="height:330px"><canvas id="myStatusChart"></canvas></div></div>
<script>document.addEventListener('DOMContentLoaded', function(){ makeChart('myStatusChart','pie', <?= json_encode(array_column($statusData,'status')) ?>, <?= json_encode(array_map('intval', array_column($statusData,'total'))) ?>, 'My Borrowings'); });</script>
<?php require '../includes/footer.php'; ?>
