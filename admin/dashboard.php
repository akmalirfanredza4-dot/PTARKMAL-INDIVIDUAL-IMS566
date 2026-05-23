<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('admin');
$pageTitle = 'Admin Dashboard';
$totalBooks = $pdo->query('SELECT COUNT(*) FROM books')->fetchColumn();
$totalUsers = $pdo->query('SELECT COUNT(*) FROM users WHERE role = "user"')->fetchColumn();
$activeBorrowings = $pdo->query('SELECT COUNT(*) FROM borrowings WHERE status = "borrowed"')->fetchColumn();
$overdue = $pdo->query('SELECT COUNT(*) FROM borrowings WHERE status = "borrowed" AND due_date < CURDATE()')->fetchColumn();
$statusData = $pdo->query('SELECT status, COUNT(*) total FROM borrowings GROUP BY status')->fetchAll();
$monthlyData = $pdo->query('SELECT DATE_FORMAT(borrow_date, "%b") month, COUNT(*) total FROM borrowings WHERE borrow_date >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH) GROUP BY YEAR(borrow_date), MONTH(borrow_date) ORDER BY MIN(borrow_date)')->fetchAll();
require '../includes/header.php';
?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
    <div><h1 class="fw-bold mb-0">Admin Dashboard</h1><p class="text-muted mb-0">Overview of PTARKMAL library operations.</p></div>
    <a href="books.php?action=create" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add Book</a>
</div>
<div class="row g-4 mb-4">
    <?php $stats = [['Books',$totalBooks,'fa-book'],['Users',$totalUsers,'fa-users'],['Active Borrowings',$activeBorrowings,'fa-hand-holding'],['Overdue',$overdue,'fa-triangle-exclamation']]; ?>
    <?php foreach ($stats as $s): ?>
    <div class="col-6 col-lg-3"><div class="card stat-card h-100"><div class="card-body d-flex justify-content-between align-items-center"><div><p class="text-muted mb-1"><?= $s[0] ?></p><h3 class="fw-bold mb-0"><?= $s[1] ?></h3></div><span class="stat-icon"><i class="fa-solid <?= $s[2] ?>"></i></span></div></div></div>
    <?php endforeach; ?>
</div>
<div class="row g-4">
    <div class="col-lg-5"><div class="card h-100"><div class="card-header">Borrowing Status Chart</div><div class="card-body" style="height:330px"><canvas id="statusChart"></canvas></div></div></div>
    <div class="col-lg-7"><div class="card h-100"><div class="card-header">Monthly Borrowing Chart</div><div class="card-body" style="height:330px"><canvas id="monthlyChart"></canvas></div></div></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    makeChart('statusChart','pie', <?= json_encode(array_column($statusData,'status')) ?>, <?= json_encode(array_map('intval', array_column($statusData,'total'))) ?>, 'Borrowings');
    makeChart('monthlyChart','bar', <?= json_encode(array_column($monthlyData,'month')) ?>, <?= json_encode(array_map('intval', array_column($monthlyData,'total'))) ?>, 'Borrowings');
});
</script>
<?php require '../includes/footer.php'; ?>
