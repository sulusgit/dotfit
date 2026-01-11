<?php

$course_id = (int) ($_GET['course_id'] ?? 0);

if ($course_id <= 0) {
    echo '<p>No comments yet.</p>';
    exit;
}

_select(
    $stmt,
    $count,
    "SELECT usr_name, review, stars, created_at
     FROM comments
     WHERE course_id=?
     ORDER BY created_at DESC",
    "i",
    [$course_id],
    $user,
    $review,
    $stars,
    $date
);

if ($count === 0) {
    echo '<p style="opacity:.7">No comments yet.</p>';
}

while (_fetch($stmt)):
?>
    <div class="comment-item">
        <div class="comment-user"><?= $user ?></div>

        <div class="comment-stars">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <?= $i <= $stars ? '★' : '☆' ?>
            <?php endfor; ?>
        </div>

        <div><?= $review ?></div>

        <div class="comment-date">
            <?= $date ? date('d M Y', strtotime($date)) : '' ?>
        </div>
    </div>
<?php endwhile;

_close_stmt($stmt);
