<?php
session_start();



$id   = (int) ($_GET['id'] ?? 0);
$name = $_GET['name'] ?? '';

/* if ($id <= 0) {
    $_SESSION['errors'] = ['Invalid course ID'];
    _redirect('admin/home_admin_ui');
} */

//deleting info that clicked ID
try {
    $success = _exec(
        "DELETE from courses where id=?",
        'i',
        [$id],
        $count
    );
    /*    $_SESSION['messsages'] = ["Your $name - of course record is deleted."]; */
    flash('success', "Your $name of course record is deleted.");
} catch (Exception $e) {
    flash('error', "Your $name of course record couldn't deleted, try again");
    /*  $_SESSION['errors'] = ["Your $name of course record couldn't deleted, try again"]; */
}

_redirect('admin/home_admin_ui');