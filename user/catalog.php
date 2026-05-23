<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('user');
$pageTitle = 'Book Catalog';
$msg='';
if (isset($_GET['borrow'])) {
    $bookId=(int)$_GET['borrow'];
    $stmt=$pdo->prepare('SELECT quantity FROM books WHERE id=?'); $stmt->execute([$bookId]); $book=$stmt->fetch();
    if ($book && $book['quantity'] > 0) {
        $pdo->beginTransaction();
        $pdo->prepare('INSERT INTO borrowings (user_id, book_id, borrow_date, due_date, status) VALUES (?, ?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 14 DAY), "borrowed")')->execute([$_SESSION['user_id'],$bookId]);
        $pdo->prepare('UPDATE books SET quantity=quantity-1 WHERE id=?')->execute([$bookId]);
        $pdo->commit();
        $msg='Book borrowed successfully. Due date is 14 days from today.';
    } else { $msg='This book is currently unavailable.'; }
}
$search = trim($_GET['q'] ?? '');
if ($search) { $stmt=$pdo->prepare('SELECT * FROM books WHERE title LIKE ? OR author LIKE ? OR category LIKE ? ORDER BY title'); $like="%$search%"; $stmt->execute([$like,$like,$like]); $books=$stmt->fetchAll(); }
else { $books=$pdo->query('SELECT * FROM books ORDER BY title')->fetchAll(); }
require '../includes/header.php';
?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-3"><div><h1 class="fw-bold mb-0">Book Catalog</h1><p class="text-muted mb-0">Search and borrow available books.</p></div><form class="d-flex" method="get"><input name="q" class="form-control me-2" placeholder="Search books..." value="<?= e($search) ?>"><button class="btn btn-primary">Search</button></form></div>
<?php if($msg): ?><div class="alert alert-info"><?= e($msg) ?></div><?php endif; ?>
<div class="row g-4">
<?php foreach($books as $b): ?>
<div class="col-md-6 col-xl-4"><div class="card book-card h-100"><div class="card-body d-flex flex-column"><span class="badge text-bg-light text-dark align-self-start mb-3"><?= e($b['category']) ?></span><h5 class="fw-bold mb-3"><?= e($b['title']) ?></h5><div class="book-detail-box mb-3"><p class="mb-1"><strong>Title:</strong> <?= e($b['title']) ?></p><p class="mb-1"><strong>Author:</strong> <?= e($b['author']) ?></p><p class="mb-0"><strong>Category:</strong> <?= e($b['category']) ?></p></div><small class="text-muted">ISBN: <?= e($b['isbn']) ?> · Shelf: <?= e($b['shelf_location']) ?></small><div class="mt-auto pt-3 d-flex justify-content-between align-items-center"><span class="badge <?= $b['quantity']>0 ? 'text-bg-success' : 'text-bg-secondary' ?>">Qty: <?= e($b['quantity']) ?></span><?php if($b['quantity']>0): ?><a class="btn btn-sm btn-primary" href="?borrow=<?= $b['id'] ?>">Borrow</a><?php else: ?><button class="btn btn-sm btn-secondary" disabled>Unavailable</button><?php endif; ?></div></div></div></div>
<?php endforeach; ?>
</div>
<?php require '../includes/footer.php'; ?>
