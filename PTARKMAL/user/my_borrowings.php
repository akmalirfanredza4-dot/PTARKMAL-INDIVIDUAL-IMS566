<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('user');
$pageTitle = 'My Borrowings';
$stmt = $pdo->prepare('SELECT br.*, b.title, b.author FROM borrowings br JOIN books b ON br.book_id=b.id WHERE br.user_id=? ORDER BY br.borrow_date DESC');
$stmt->execute([$_SESSION['user_id']]);
$rows = $stmt->fetchAll();
require '../includes/header.php';
?>
<div class="card"><div class="card-header">My Borrowing History</div><div class="card-body"><div class="table-responsive">
<table class="table align-middle"><thead><tr><th>Book</th><th>Author</th><th>Borrow Date</th><th>Due Date</th><th>Return Date</th><th>Status</th></tr></thead><tbody>
<?php foreach($rows as $r): ?><tr><td class="fw-semibold"><?= e($r['title']) ?></td><td><?= e($r['author']) ?></td><td><?= e($r['borrow_date']) ?></td><td><?= e($r['due_date']) ?></td><td><?= e($r['return_date'] ?? '-') ?></td><td><span class="badge <?= $r['status']==='borrowed' ? 'text-bg-warning' : 'text-bg-success' ?>"><?= e($r['status']) ?></span></td></tr><?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require '../includes/footer.php'; ?>
