here no need any STYLE delted your commmens
<?php
$user_id    = $_SESSION['id'] ?? 0;
$comment_id = (int) ($_GET['id'] ?? 0);
$course_id  = (int) ($_GET['course_id'] ?? 0);
if ($user_id === 0 || $comment_id === 0 || $course_id === 0) {
    die('Invalid request');
}
_exec(
    "DELETE FROM comments WHERE id=? AND user_id=?",
    "ii",
    [$comment_id, $user_id],
    $affected
);

//$_SESSION['flash'] = 'Your comment deleted';
flash('info',  "your comment deleted");
_redirect('user/learn_more?id=' . $course_id);
exit;
