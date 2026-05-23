<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('admin');
$pageTitle = 'Borrowings';
if (isset($_GET['return'])) {
    $id = (int)$_GET['return'];
    $pdo->beginTransaction();
    $borrow = $pdo->prepare('SELECT book_id FROM borrowings WHERE id=? AND status="borrowed"');
    $borrow->execute([$id]);
    if ($row = $borrow->fetch()) {
        $pdo->prepare('UPDATE borrowings SET status="returned", return_date=CURDATE() WHERE id=?')->execute([$id]);
        $pdo->prepare('UPDATE books SET quantity=quantity+1 WHERE id=?')->execute([$row['book_id']]);
    }
    $pdo->commit();
}
$rows = $pdo->query('SELECT br.*, b.title, u.name FROM borrowings br JOIN books b ON br.book_id=b.id JOIN users u ON br.user_id=u.id ORDER BY br.borrow_date DESC')->fetchAll();
require '../includes/header.php';
?>
<div class="card"><div class="card-header">Borrowing Records</div><div class="card-body"><div class="table-responsive">
<table class="table align-middle"><thead><tr><th>User</th><th>Book</th><th>Borrow Date</th><th>Due Date</th><th>Return Date</th><th>Status</th><th>Action</th></tr></thead><tbody>
<?php foreach ($rows as $r): ?>
<tr><td><?= e($r['name']) ?></td><td class="fw-semibold"><?= e($r['title']) ?></td><td><?= e($r['borrow_date']) ?></td><td><?= e($r['due_date']) ?></td><td><?= e($r['return_date'] ?? '-') ?></td><td><span class="badge badge-status <?= $r['status']==='borrowed' ? 'text-bg-warning' : 'text-bg-success' ?>"><?= e($r['status']) ?></span></td><td><?php if ($r['status']==='borrowed'): ?><a class="btn btn-sm btn-primary" href="?return=<?= $r['id'] ?>">Mark Returned</a><?php else: ?>-<?php endif; ?></td></tr>
<?php endforeach; ?>
</tbody></table>
</div></div></div>
<?php require '../includes/footer.php'; ?>
