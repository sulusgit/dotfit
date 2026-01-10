<?php
require ROOT . '/pages/user/header_user.php';
$course_id = (int) ($_GET['id'] ?? 0); /* to get course id from query !!!  */
if ($course_id <= 0) {
    // die('Invalid course');
}
?>
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

<body>

    <div class="course-details">
        <div class="course-header">
            <h1 class="course-title-main">Pilates Course</h1>
            <a href="<?= url('/user/home_user_ui') ?>" class="close-inline">✕</a>
        </div>

        <p class="course-intro">
            Strengthen your core and improve body alignment with controlled Pilates movements.
            Perfect for rehabilitation, toning, and developing long, lean muscles.
        </p>

        <!-- ADDITIONAL INFO -->
        <div class="info-card">
            <h2>Additional Information</h2>
            <ul>
                <li><strong>Duration:</strong> 6 weeks</li>
                <li><strong>Level:</strong> Beginner – Intermediate</li>
                <li><strong>Instructor:</strong> Sarah Johnson</li>
                <li><strong>Includes:</strong> Video lessons, PDF guides, weekly check-ins</li>
            </ul>
        </div>

        <!-- COMMENTS SECTION -->

        <div class="comment-card">
            <h2>Comments</h2>
            <form method="post" action="<?= url('comment_add') ?> ">
                <textarea name=" comment" required placeholder="Write your comment..."></textarea>
                <!-- Stars -->
                <div class="stars-input">
                    <input type="radio" name="stars" value="5" id="star5" checked>
                    <label for="star5">★</label>

                    <input type="radio" name="stars" value="4" id="star4">
                    <label for="star4">★</label>

                    <input type="radio" name="stars" value="3" id="star3">
                    <label for="star3">★</label>

                    <input type="radio" name="stars" value="2" id="star2">
                    <label for="star2">★</label>

                    <input type="radio" name="stars" value="1" id="star1">
                    <label for="star1">★</label>
                </div>

                <input type="hidden" name="course_id" value="<?= $course_id ?>">
                <button type="submit">Submit</button>
            </form>
            <!-- MY RECENT COMMENTS ONLY ON THIS COURSE -->
            <div class="existing-comments">
                <h3>My Reviews </h3>
                <?php

                $user_id = $_SESSION['id'] ?? 0;


                _select(
                    $stmt,
                    $count,
                    "SELECT id, review, stars, user_id
     FROM comments
     WHERE course_id = ?
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

                    <p><?= htmlspecialchars($review ?? '') ?></p>

                    <?php if ($comment_user_id == $user_id): ?>
                    <div class="comment-actions">
                        <a href="<?= url('/user/comment_edit') ?>?id=<?= $comment_id ?>">Edit</a>
                        <a href="<?= url('/user/comment_delete') ?>?id=<?= $comment_id ?>"
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