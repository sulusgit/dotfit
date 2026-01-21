<?php
$stmt  = null;
$count = 0;

// 1. get input
$inputemail = post('email', 120);
$password   = post('password', 255);

// 2. get user from DB
_selectRow(
    $stmt,
    $count,
    "SELECT id, name, email, password, role FROM users WHERE email=?",
    's',
    [$inputemail],
    $id,
    $name,
    $dbEmail,
    $dbPassword,
    $role
);

// 3. validate login
if (!$count || !password_verify($password, (string)$dbPassword)) {
    $_SESSION['errors'][] = "Your email or password is not correct";
    _redirect('sign_in');
    exit;
}

// 4. LOGIN SUCCESS → save session
$_SESSION['id']    = $id;
$_SESSION['name']  = $name;
$_SESSION['email'] = $dbEmail;
$_SESSION['role']  = $role;

// 5. redirect by role
if ($role === 'administrator') {
    _redirect('admin/home_admin_ui');
} else {
    _redirect('user/home_user_ui');
}

exit;
