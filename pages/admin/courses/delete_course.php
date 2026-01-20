<?php
session_start();



$id   = (int) ($_GET['id'] ?? 0);
$name = $_GET['name'] ?? '';

try {
    $success = _exec(
        "DELETE from courses where id=?",
        'i',
        [$id],
        $count
    );

    // flash('success', "Your $name of course record is deleted.");
} catch (Exception $e) {
    // flash('error', "Your $name of course record couldn't deleted, try again");
}

_redirect('admin/home_admin_ui');
