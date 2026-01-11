<?php
//commment add or edit here
$user_id   = $_SESSION['id'] ?? 0;
$course_id = (int) ($_POST['course_id'] ?? 0);
$review    = trim($_POST['comment'] ?? '');
$stars     = (int) ($_POST['stars'] ?? 5);
$edit_id   = (int) ($_POST['edit_id'] ?? 0);

if ($user_id === 0 || $course_id === 0 || $review === '') {
    die('Invalid data');
}

if ($stars < 1 || $stars > 5) {
    $stars = 5;
}

if ($edit_id > 0) {
    // UPDATE
    _exec(
        "UPDATE comments SET review=?, stars=? WHERE id=? AND user_id=?",
        "siii",
        [$review, $stars, $edit_id, $user_id],
        $affected
    );
    $_SESSION['flash'] = 'Comment updated';
} else {
    // INSERT
    _exec(
        "INSERT INTO comments (user_id, course_id, review, stars)
         VALUES (?, ?, ?, ?)",
        "iisi",
        [$user_id, $course_id, $review, $stars],
        $affected
    );
    $_SESSION['flash'] = 'Comment added';
}

_redirect('user/learn_more?id=' . $course_id);
exit;
