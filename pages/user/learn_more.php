<?php
/* LEARN MORE THIS PAGE SHOOS */
require ROOT . '/pages/user/header_user.php';
$course_id = (int) ($_GET['id'] ?? 0);
$user_id   = $_SESSION['id'] ?? 0;

if ($course_id <= 0) {
    die('Invalid course');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Course Details</title>
    <link rel="stylesheet" href="<?= asset('/css/learn_more.css') ?>">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<style>
    .flash-msg {
        background: #e8ffe8;
        padding: 10px;
        border-radius: 6px;
        margin-bottom: 12px;
    }

    .stars-input label,
    .stars span {
        color: gold;
        font-size: 18px;
        cursor: pointer;
    }

    .stars span:not(.filled) {
        color: #ccc;
    }
</style>

<body>

    <div class="course-details">
        <div class="course-header">
            <a href="<?= url('user/home_user_ui') ?>" class="close-inline">✕</a>
            <?php



            /*  $course_id = (int) ($_GET['id'] ?? 0);

            if ($course_id <= 0) {
                die('Invalid course');
            }
 */

            if ($course_id <= 0) {
                die('Invalid course id');
            }
            _select(
                $stmt,
                $count,
                "SELECT id, image, name, description,text_add_info, duration, badge, price, difficulty
     FROM courses
     WHERE id = ?",
                'i',
                [$course_id],
                $id,
                $image,
                $name,
                $description,
                $article,
                $duration,
                $badge,
                $price,
                $difficulty

            );
            _fetch($stmt);
            ?>

        </div>
        <h1 class="course-title-main"><?= $name ?></h1>


        <p class="course-intro">
        <p>
            Welcome to the <?= $name ?> course! This comprehensive program is designed to equip you with the
            knowledge and skills needed to excel in this field. Whether you're a beginner or looking to enhance
            your expertise, our course offers valuable insights and practical applications to help you achieve your
            goals.


            <!-- ADDITIONAL INFO -->
        <div class="info-card">
            <h2> Details: </h2>
            <li> <strong> </strong><?= $description ?></li>
            <h2> <?= $badge ?> </h2>
            </li>
            <ul>
                <li><strong>Duration: </strong><?= $duration ?></li>
                <li><strong>Level:</strong> For <?= $difficulty ?></li>
                <li><strong>Pricing:</strong>
                    Per moths arount <?= $price ?> PLN </li>
                <li><strong>Includes:</strong> Video lessons, PDF guides, weekly check-ins</li>
            </ul>
            <div class="info-card">
                <h2>Additional Information & About Us </h2>
                <h3> Why Choose Our Courses? </h3>
                <p>
                    Our courses are designed by industry experts to provide you with the most up-to-date knowledge and
                    skills. Whether you're a beginner or looking to advance your career, we have something for everyone.
                    Join our community of learners and take the next step in your professional journey!
                </p>
                <h3> Course Details </h3>
                <p>
                    <?= $article ?>

                </p>

            </div>


        </div>
        <?php


        /* FLASH MESSAGE */
        if (!empty($_SESSION['flash'])) {
            echo '<div class="flash-msg">' . $_SESSION['flash'] . '</div>';
            unset($_SESSION['flash']);
        }

        /* EDIT MODE */
        $edit_id     = (int) ($_GET['edit'] ?? 0);
        $edit_review = '';
        $edit_stars  = 5;

        if ($edit_id > 0 && $user_id > 0) {
            _selectRow(
                $stmt,
                $count,
                "SELECT review, stars FROM comments WHERE id=? AND user_id=?",
                "ii",
                [$edit_id, $user_id],
                $edit_review,
                $edit_stars
            );
        }
        ?>


        <!-- COMMENTS SECTION -->
        <div class="comment-card">

            <h2><?= $edit_id ? 'Edit your review' : 'Write about this course' ?></h2>

            <form method="post" action="<?= url('user/comment_add') ?>">
                <textarea name="comment" required
                    placeholder="Write your comment..."><?= htmlspecialchars($edit_review) ?></textarea>

                <!-- STARS -->
                <div class="stars-input">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" name="stars" value="<?= $i ?>" id="star<?= $i ?>"
                            <?= $edit_stars == $i ? 'checked' : '' ?>>
                        <label for="star<?= $i ?>">★</label>
                    <?php endfor; ?>
                </div>

                <input type="hidden" name="course_id" value="<?= $course_id ?>">
                <input type="hidden" name="edit_id" value="<?= $edit_id ?>">

                <button type="submit"><?= $edit_id ? 'Update' : 'Submit' ?></button>
            </form>

            <!-- RECENT COMMENTS -->
            <div class="existing-comments">
                <h3>Recent Comments</h3>

                <?php
                _select(
                    $stmt,
                    $count,
                    "SELECT id, review, stars, user_id
             FROM comments
             WHERE course_id=?
             ORDER BY created_at DESC
             LIMIT 5",
                    "i",
                    [$course_id],
                    $comment_id,
                    $review,
                    $stars,
                    $comment_user_id
                );
                ?>

                <?php while (_fetch($stmt)): ?>
                    <div class="recent-comment">
                        <div class="stars">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span class="<?= $i <= $stars ? 'filled' : '' ?>">★</span>
                            <?php endfor; ?>
                        </div>

                        <p><?= $review ?></p>

                        <?php if ($comment_user_id == $user_id): ?>
                            <div class="comment-actions">
                                <a href="<?= url('user/learn_more?id=' . $course_id . '&edit=' . $comment_id) ?>">Edit</a>
                                <a href="<?= url('user/comment_delete?id=' . $comment_id . '&course_id=' . $course_id) ?>"
                                    onclick="return confirm('Delete this comment?')">
                                    Delete
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>

                <?php _close_stmt($stmt); ?>
            </div>
        </div>

    </div>

    <?php require ROOT . '/pages/footer.php'; ?>

</body>

</html>