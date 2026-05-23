<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('admin');
$pageTitle = 'Manage Books';
$message = '';
$editBook = null;
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare('DELETE FROM books WHERE id = ?');
    $stmt->execute([(int)$_GET['delete']]);
    $message = 'Book deleted successfully.';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [trim($_POST['title']), trim($_POST['author']), trim($_POST['category']), trim($_POST['isbn']), (int)$_POST['quantity'], trim($_POST['shelf_location'])];
    if (!empty($_POST['id'])) {
        $stmt = $pdo->prepare('UPDATE books SET title=?, author=?, category=?, isbn=?, quantity=?, shelf_location=? WHERE id=?');
        $stmt->execute([...$data, (int)$_POST['id']]);
        $message = 'Book updated successfully.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO books (title, author, category, isbn, quantity, shelf_location) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute($data);
        $message = 'Book added successfully.';
    }
}
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM books WHERE id=?');
    $stmt->execute([(int)$_GET['edit']]);
    $editBook = $stmt->fetch();
}
$books = $pdo->query('SELECT * FROM books ORDER BY title')->fetchAll();
require '../includes/header.php';
?>
<div class="row g-4">
    <div class="col-lg-4">
        <div class="card"><div class="card-header"><?= $editBook ? 'Edit Book' : 'Add New Book' ?></div><div class="card-body">
            <?php if ($message): ?><div class="alert alert-success"><?= e($message) ?></div><?php endif; ?>
            <form method="post">
                <input type="hidden" name="id" value="<?= e($editBook['id'] ?? '') ?>">
                <div class="mb-2"><label class="form-label required">Title</label><input name="title" class="form-control" value="<?= e($editBook['title'] ?? '') ?>" required></div>
                <div class="mb-2"><label class="form-label required">Author</label><input name="author" class="form-control" value="<?= e($editBook['author'] ?? '') ?>" required></div>
                <div class="mb-2"><label class="form-label required">Category</label><input name="category" class="form-control" value="<?= e($editBook['category'] ?? '') ?>" required></div>
                <div class="mb-2"><label class="form-label">ISBN</label><input name="isbn" class="form-control" value="<?= e($editBook['isbn'] ?? '') ?>"></div>
                <div class="mb-2"><label class="form-label required">Quantity</label><input type="number" min="0" name="quantity" class="form-control" value="<?= e($editBook['quantity'] ?? 1) ?>" required></div>
                <div class="mb-3"><label class="form-label">Shelf Location</label><input name="shelf_location" class="form-control" value="<?= e($editBook['shelf_location'] ?? '') ?>"></div>
                <button class="btn btn-primary w-100"><?= $editBook ? 'Update Book' : 'Save Book' ?></button>
            </form>
        </div></div>
    </div>
    <div class="col-lg-8">
        <div class="card"><div class="card-header">Book Inventory</div><div class="card-body"><div class="table-responsive">
            <table class="table align-middle"><thead><tr><th>Title</th><th>Author</th><th>Category</th><th>Qty</th><th>Location</th><th>Action</th></tr></thead><tbody>
            <?php foreach ($books as $b): ?><tr><td class="fw-semibold"><?= e($b['title']) ?></td><td><?= e($b['author']) ?></td><td><?= e($b['category']) ?></td><td><?= e($b['quantity']) ?></td><td><?= e($b['shelf_location']) ?></td><td><a class="btn btn-sm btn-outline-primary" href="?edit=<?= $b['id'] ?>">Edit</a> <a class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this book?')" href="?delete=<?= $b['id'] ?>">Delete</a></td></tr><?php endforeach; ?>
            </tbody></table>
        </div></div></div>
    </div>
</div>
<?php require '../includes/footer.php'; ?>
