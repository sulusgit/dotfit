<?php require "header_admin.php";
$admin_id = (int) $_SESSION['id'];
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('/css/home_user_ui.css') ?>">
    <!-- HEADER CSS -->
    <link rel="stylesheet" href="<?= asset('/css/admin_home.css') ?>">
    <link rel="stylesheet" href="<?= asset('/Header User/header_user.css') ?>"> <!-- FOOTER CSS -->
    <link rel="stylesheet" href="<?= asset('/footer.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<!-- Style for ALERT MESSAGES -->
<style>
    .site-alert {
        max-width: 1100px;
        margin: 12px auto;
        padding: 12px 16px;
        border-radius: 6px;
        font-size: 14px;
    }

    .site-alert.error {
        background: #ffecec;
        color: #b30000;
        border: 1px solid #ffb3b3;
    }

    .site-alert.success {
        background: #eef8ff;
        color: #004a80;
        border: 1px solid #b3daff;
    }

    .site-alert p {
        margin: 4px 0;
    }
</style>
<script>
    function toggleMenu(e, id) {
        e.stopPropagation(); // prevents card click const 
        menu = document.getElementById('menu-' + id);
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    } // close menu when clicking elsewhere document.
    addEventListener('click', () => {
        document.querySelectorAll('.menu-dropdown').forEach(m => m.style.display = 'none');
    });
</script>

<body>

    <!-- ALERTS -->
    <?php if (!empty($_SESSION['errors'])): ?>
        <div class="site-alert error">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <?php /* if (!empty($_SESSION['errors'])): ?> <div class="site-alert error">
        <?php foreach ($_SESSION['errors'] as $error): ?> <p><?= $error ?></p> <?php endforeach; ?> </div>
    <?php unset($_SESSION['errors']); ?> <?php endif;  */ ?>

    <!-- msg Uptades -->
    <?php if (!empty($_SESSION['messages'])): ?> <div class="site-alert success">
            <?php foreach ($_SESSION['messages'] as $message): ?>
                <p><?= $message ?></p> <?php endforeach; ?>
        </div>
        <?php unset($_SESSION['messages']); ?> <?php endif; ?>

    <!-- COURSES SECTION -->
    <section class="courses">
        <h2>My Courses list</h2>
        <div class="courses-grid">
            <?php
            $search = trim($_GET['search'] ?? '');

            if ($search !== '') {
                // SEARCH HAS VALUE → filter
                _select(
                    $stmt,
                    $count,
                    "SELECT id, image, name, description, duration, badge, price, difficulty
     FROM courses
     WHERE name LIKE ?
     ORDER BY created_at DESC",
                    's',
                    ["%$search%"],
                    $id,
                    $image,
                    $name,
                    $description,
                    $duration,
                    $badge,
                    $price,
                    $difficulty
                );
            } else {
                // SEARCH EMPTY → show all
                _select( //with pararam 
                    $stmt,
                    $count,
                    "SELECT id, image, name, description, duration, badge, price, difficulty
     FROM courses where  create_admin_id =?
     ORDER BY created_at DESC",
                    'i',
                    [$admin_id],
                    $id,
                    $image,
                    $name,
                    $description,
                    $duration,
                    $badge,
                    $price,
                    $difficulty
                );
            }
            if ($count > 0):
                while (_fetch($stmt)): ?>

                    <!-- SWIMMING COURSE -->
                    <div class="course-card">
                        <div class="course-image-wrapper">
                            <div class="card-menu">
                                <!-- was in local like this  <a href="/admin/courses/edit_course?id=<?= $id ?>"> -->

                                <a href="<?= url('admin/courses/edit_course') ?>?id=<?= $id ?>" class="menu-item">
                                    Edit
                                </a>

                                <button type="button" class="menu-item danger" onclick="confirmDelete(
            <?= (int)$id ?>,
            '<?= htmlspecialchars((string)$name, ENT_QUOTES) ?>'
        )">
                                    Delete
                                </button>
                            </div>


                            <span class="course-badge"><?= $badge ?></span>
                            <span class="course-difficulty"><?= $difficulty ?></span>

                            <img src="<?= $image ? asset($image) : asset('course_images/default.jpg') ?>">


                            alt="<?= htmlspecialchars((string)$name) ?>" class="course-image">
                        </div>

                        <div class="course-content">
                            <h3 class="course-title"><?= $name ?></h3>
                            <p class="course-description"><?= $description ?></p>
                        </div>
                    </div>

            <?php endwhile;
            else:
                echo "NO COURSES FOUND";
            endif;

            _close_stmt($stmt);
            ?>

        </div>
        <script>
            function confirmDelete(id, name) {
                if (confirm(`Are you sure you want to delete this "${name}" course?`)) {
                    window.location.href =
                        "<?= url('admin/courses/delete_course') ?>" +
                        "?id=" + id +
                        "&name=" + encodeURIComponent(name);
                }
            }
        </script>


    </section>
    <!-- CTA SECTION -->
    <section class="cta-section"> <a href="all-courses.php" class="cta-button">View All Courses</a> </section>

    <?php require ROOT . '/pages/footer.php'; ?>



</body>

</html>
<!-- JAVASCRIPT for delete confrimation  -->
<!-- <script>
function confirmDelete(courseid, courseName) {
    var ok = confirm('Are you sure delete this "' + courseName + '" course?');

    if (ok) {
        window.location.href =
            '/admin/courses/delete_course?id=' + courseid +
            '&name=' + encodeURIComponent(courseName);
    }
}
</script> -->
<!-- <script>
function confirmDelete(id, name) {
    if (confirm(`Are you sure you want to delete "${name}"?`)) {
        window.location.href = "<?= url('admin/courses/delete_course') ?>?id=" + id + "&name=" +
            encodeURIComponent(name);
    }
}
</script> -->