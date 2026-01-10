<?php
session_start();
echo '<pre>';
print_r($_POST);
//require 'db.php';

if (!isset($_SESSION['id'])) {
    die('Login required');
}

$user_id   = (int) $_SESSION['id'];
$usr_name  = $_SESSION['name'];
$review    = trim($_POST['comment'] ?? '');
$stars     = $_POST['stars'] ?? '5'; // varchar in DB
$course_id = (int) ($_POST['course_id'] ?? 0);
//$comments . user_id === $_SESSION['id'];


if ($review === '') {
    die('Review cannot be empty');
}
$count = 0;
_exec(
    "INSERT INTO comments (user_id, stars, usr_name, review, course_id)
     VALUES (?, ?, ?, ?, ?)",
    "isssi",
    [$user_id, $stars, $usr_name, $review, $course_id],
    $count
);

//header("Location: /course.php?id=" . $course_id);
_redirect(url('learn_more'));
exit;
