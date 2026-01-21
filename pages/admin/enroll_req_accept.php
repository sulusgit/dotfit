<?php
$req_id = (int) ($_GET['id'] ?? 0);

if ($req_id <= 0) {
    _redirect('admin/home_admin_ui');
}

_exec(
    "UPDATE enroll_requests
     SET status='approved'
     WHERE id=?",
    "i",
    [$req_id],
    $affected
);

//flash('success', 'Enrollment approved');
_redirect('admin/home_admin_ui');
