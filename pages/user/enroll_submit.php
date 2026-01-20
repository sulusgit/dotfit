<?php

/* !!if (!isset($_SESSION['id'])) {
    die('Login required');
} */

$user_id = $_SESSION['id'] ?? 0;
$course_id  = (int)($_POST['course_id'] ?? 0);
$name       = trim($_POST['name'] ?? '');
$email      = trim($_POST['email'] ?? '');
$start_date = $_POST['start_date'] ?? '';

if ($course_id <= 0 || $name === '' || $email === '' || $start_date === '') {
    die('Invalid data');
}
$today = date('Y-m-d');

if ($start_date < $today) {
    die('Invalid start date');
}/* check existing request */
_selectRow(
    $stmt,
    $count,
    "SELECT id, status FROM enroll_requests
     WHERE user_id=? AND course_id=?",
    "ii",
    [$user_id, $course_id],
    $req_id,
    $status
);

if ($count === 0) {
    // first time → create request
    _exec(
        "INSERT INTO enroll_requests
         (user_id, course_id, name, email, start_date, status)
         VALUES (?, ?, ?, ?, ?, 'pending')",
        "iisss",
        [$user_id, $course_id, $name, $email, $start_date],
        $affected
    );
}



flash('success',  'Your enrollment request succesesfully submitted');

_redirect('user/home_user_ui');
