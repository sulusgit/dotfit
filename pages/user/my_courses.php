<?php
if (!isset($_SESSION['id'])) {
    flash('error', 'Please log in to view your courses.');
    _redirect('sign_in');
    return;
}

$user_id = (int) $_SESSION['id'];
$myCourses = [];

_select(
    $stmt,
    $count,
    "SELECT 
        c.name AS course_name,
        r.status,
        r.created_at
     FROM enroll_requests r
     LEFT JOIN courses c ON c.id = r.course_id
     WHERE r.user_id = ?
       AND c.id IS NOT NULL
     ORDER BY r.created_at DESC",
    "i",
    [$user_id],
    $course_name,
    $status,
    $created_at
);

while (_fetch($stmt)) {
    $myCourses[] = [
        'course_name' => $course_name,
        'status'      => $status,
        'created_at'  => $created_at
    ];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>

    <!-- TEST THIS PATH -->
    <link rel="stylesheet" href="/dotfit/css/usr_mycourses.css">
</head>

<body>
    <div class="my-courses-wrapper">

        <div class="my-courses-header">
            <h2>My Courses</h2>
            <a href="<?= url('user/home_user_ui') ?>" class="close-btn">✕</a>
        </div>

        <?php foreach ($myCourses as $course): ?>
        <div class="my-course">
            <h3><?= $course['course_name'] ?></h3>
            <p class="status <?= $course['status'] ?>">
                <?= $course['status'] ?>
            </p>
            <p><?= $course['created_at'] ?></p>
        </div>
        <?php endforeach; ?>

    </div>

</body>

</html>