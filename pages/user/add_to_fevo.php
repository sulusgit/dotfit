<?php
$user_id   = (int) $_SESSION['id'];
$course_id = (int) ($_POST['course_id'] ?? 0);

if ($course_id <= 0) {
    die('NO COURSE ID');
}

_exec(
    "INSERT INTO favorites (user_id, course_id) VALUES (?,?)",
    "ii",
    [$user_id, $course_id],
    $c
);

echo 'SAVED';
exit;