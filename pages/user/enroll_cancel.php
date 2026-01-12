<?php

if (!isset($_SESSION['id'])) {

    flash('error', 'Login required');
    exit;
}

flash('info:',  'Enrollment request cancelled');
$user_id   = $_SESSION['id'] ?? 0;
$course_id = (int) ($_POST['course_id'] ?? 0);

if (!$user_id || !$course_id) {

    flash('error', 'Invalid request');
    exit;
}

_exec(
    "DELETE FROM enroll_requests WHERE user_id=? AND course_id=?",
    "ii",
    [$user_id, $course_id],
    $affected
);
