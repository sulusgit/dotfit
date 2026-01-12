<?php $id = (int)($_GET['id'] ?? 0);
dd($_SESSION);
exit;
_exec(
    "UPDATE enroll_requests
SET status='approved'
WHERE id=?",
    "i",
    [$id],
    $affected
);

flash('success', 'Enrollment approved');
_redirect('admin/requests');
