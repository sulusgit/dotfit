<?php
if (!isset($_SESSION['id'])) {
    flash('error', 'Login required');
    exit;
}

$user_id   = (int) $_SESSION['id'];
$course_id = (int) ($_POST['course_id'] ?? 0);

if ($course_id <= 0) {
    flash('error', 'Invalid request');
    exit;
}

_exec(
    "DELETE FROM enroll_requests
     WHERE user_id=? AND course_id=? AND status='pending'",
    "ii",
    [$user_id, $course_id],
    $affected
);

if ($affected > 0) {
    flash('info', 'Request cancelled.');
} else {
    // not an error → just means nothing to cancel
    flash('info', 'No pending request to cancel.');
}

_redirect('user/home_user_ui');
