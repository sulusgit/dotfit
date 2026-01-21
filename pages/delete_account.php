<?php
/* NOT DELETING ACCOUNT
if (!isset($_SESSION['user']['id'])) {
    flash('error', 'You must be logged in.');
    _redirect('sign_in');
    return;
}

$userId   = (int) $_SESSION['user']['id'];
$userName = $_SESSION['user']['name'] ?? '';

try {
    _exec(
        "DELETE FROM users WHERE id=?",
        'i',
        [$userId],
        $count
    );

    // destroy session after delete
    session_destroy();

    flash('success', "Your account has been deleted.");
} catch (Exception $e) {
    flash('error', "Your account couldn't be deleted, try again.");
}

_redirect('home'); */