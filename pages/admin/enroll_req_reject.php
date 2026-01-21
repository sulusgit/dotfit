<?php
$req_id = (int) ($_GET['id'] ?? 0);

if ($req_id <= 0) {
    _redirect('admin/home_admin_ui');
}
_exec("UPDATE enroll_requests
     SET status='rejected'
     WHERE id=?", "i", [$req_id], $affected);
//flash('info', 'Enrollment rejected');
_redirect('admin/home_admin_ui');
