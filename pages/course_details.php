<?php
/* DO DTH !!!!!!! or same like LEARN MORE */
$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    _redirect('/404');
    exit;
}

_selectRow(
    $stmt,
    $count,
    "SELECT name, description, duration, badge, price
     FROM courses
     WHERE id = ?",
    'i',
    [$id],
    $name,
    $description,
    $duration,
    $badge,
    $price
);

if (!$count) {
    _redirect('/404');
    exit;
}
?>
<!-- <img src="/<?= $image ?: url('uploads/courses/default.png') ?>" alt="<?= $name ?>"> -->

<h1><?= $name ?></h1>

<p><?= $description ?></p>

<ul>
    <li>Duration: <?= $duration ?></li>
    <li>Price: <?= $price ?> PLN</li>
</ul>

<?php if ($badge !== 'none'): ?>
    <span class="course-badge"><?= $badge ?></span>
<?php endif; ?>
<?php
if (!$count) {
    _redirect('/404');
    exit;
}
