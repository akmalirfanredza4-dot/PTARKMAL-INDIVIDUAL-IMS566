<?php
require '../config/database.php';
require '../includes/auth.php';
requireRole('admin');
$pageTitle = 'Reports';
$categoryData = $pdo->query('SELECT category, COUNT(*) total FROM books GROUP BY category ORDER BY total DESC')->fetchAll();
$topBooks = $pdo->query('SELECT b.title, COUNT(br.id) total FROM books b LEFT JOIN borrowings br ON b.id=br.book_id GROUP BY b.id ORDER BY total DESC LIMIT 5')->fetchAll();
require '../includes/header.php';
?>
<h1 class="fw-bold mb-3">Reports & Visual Analytics</h1>
<div class="row g-4">
    <div class="col-lg-6"><div class="card"><div class="card-header">Books by Category</div><div class="card-body" style="height:340px"><canvas id="categoryChart"></canvas></div></div></div>
    <div class="col-lg-6"><div class="card"><div class="card-header">Top Borrowed Books</div><div class="card-body" style="height:340px"><canvas id="topBooksChart"></canvas></div></div></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){
    makeChart('categoryChart','doughnut', <?= json_encode(array_column($categoryData,'category')) ?>, <?= json_encode(array_map('intval', array_column($categoryData,'total'))) ?>, 'Books');
    makeChart('topBooksChart','bar', <?= json_encode(array_column($topBooks,'title')) ?>, <?= json_encode(array_map('intval', array_column($topBooks,'total'))) ?>, 'Borrowed');
});
</script>
<?php require '../includes/footer.php'; ?>
