<?php
$user_id = $_SESSION['id'] ?? 0;
if ($user_id === 0) {
    die('Login required');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('css/home_user_ui.css') ?>">
    <script src="<?= asset('css/favorites.js') ?>"></script>

    <title>My Favorites</title>
</head>
<script>
    document.querySelectorAll('.fav-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            const icon = this.querySelector('i');
            const courseId = this.dataset.id;

            // toggle UI immediately
            icon.classList.toggle('fa-regular');
            icon.classList.toggle('fa-solid');

            // save to backend
            fetch('user/add_to_fevo.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                credentials: 'same-origin',
                body: 'id=' + courseId
            });
        });
    });
</script>

<body>

    <section class="courses">

        <div class="section-header">
            <h2>My Favorite Courses</h2>
        </div>

        <?php
        $user_id = $_SESSION['id'] ?? 0;

        _select(
            $stmt,
            $count,
            "SELECT
        c.id,
        c.name,
        c.description,
        c.duration,
        c.badge,
        c.price,
        c.difficulty,
        f.id AS fav_id
     FROM courses c
     LEFT JOIN favorites f
        ON f.course_id = c.id
       AND f.user_id = ?
     ORDER BY c.created_at DESC",
            "i",
            [$user_id],
            $id,
            $name,
            $description,
            $duration,
            $badge,
            $price,
            $difficulty,
            $fav_id
        );

        ?>

        <div class="courses-grid">
            <?php if ($count > 0): ?>
                <?php while (_fetch($stmt)): ?>
                    <div class="course-card">

                        <div class="course-image-wrapper">
                            <a href="<?= url('user/learn_more?id=' . $id) ?>">
                                <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&h=600&fit=crop"
                                    alt="<?= htmlspecialchars((string)$name) ?>" class="course-image">
                            </a>
                            <span class="course-badge"><?= htmlspecialchars($badge) ?></span>
                            <span class="course-difficulty"><?= htmlspecialchars((string)$difficulty) ?></span>
                        </div>

                        <div class="course-content">
                            <h3 class="course-title"><?= htmlspecialchars((string)$name) ?></h3>
                            <p class="course-description"><?= htmlspecialchars((string)$description) ?></p>

                            <div class="meta-actions">

                                <a href="<?= url('user/learn_more?id=' . $id) ?>" class="learn-more">
                                    LEARN MORE →
                                </a>

                                <!-- FAVORITE (always solid on this page) -->
                                <a href="#" class="icon-btn fav-btn" data-id="<?= $id ?>">
                                    <i class="fa-solid fa-heart"></i>
                                </a>

                                <a href="<?= url('user/comment_scroll?id=' . $id) ?>" class="icon-btn">
                                    <i class="fa-regular fa-comment"></i>
                                </a>

                                <a href="<?= url('user/add_to_enroll?id=' . $id) ?>" class="icon-btn">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    <span class="tooltip">Enroll</span>
                                </a>

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No favorite courses yet.</p>
            <?php endif; ?>
        </div>

        <?php _close_stmt($stmt); ?>

    </section>

    <!-- ONE JS SCRIPT (outside loop) -->
    <script>
        document.querySelectorAll('.fav-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const card = this.closest('.course-card');
                const courseId = this.dataset.id;

                fetch('/user/add_to_fevo.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    credentials: 'same-origin',
                    body: 'id=' + courseId
                }).then(() => {
                    // remove card from favorites page
                    card.remove();
                });
            });
        });
    </script>

</body>

</html>