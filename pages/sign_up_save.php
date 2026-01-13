<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

/* =====================
   1. GET & SANITIZE INPUT
   ===================== */
$name     = post('name', 150);
$email    = post('email', 150);
$password = post('password');
$confirm  = post('confirmpassword');

$role = (post('role') === 'Administrator')
    ? 'administrator'
    : 'user';

/* =====================
   2. VALIDATION
   ===================== */

// name
if (!$name || mb_strlen($name) < 2) {
    $errors[] = "Username must be at least 2 characters";
}

// email
if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email address";
}

// password
if (!$password) {
    $errors[] = "Password must be at least 6 characters";
}

// confirm password
if ($password !== $confirm) {
    $errors[] = "Passwords do not match";
}

/* =====================
   3. CHECK EMAIL EXISTS
   ===================== */
if (!$errors) {
    _selectRow(
        $stmt,
        $count,
        "SELECT COUNT(*) FROM users WHERE email=?",
        "s",
        [$email],
        $emailCount
    );

    if ($emailCount > 0) {
        $errors[] = "This email is already registered";
    }
}

/* =====================
   4. INSERT USER
   ===================== */
if (!$errors) {

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $success = _exec(
        "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)",
        "ssss",
        [$name, $email, $hash, $role],
        $count
    );

    if (!$success || $count !== 1) {
        $errors[] = "Failed to create account. Try again.";
    }
}

/* =====================
   5. LOGIN & REDIRECT
   ===================== */
if (!$errors) {

    $_SESSION['name']  = $name;
    $_SESSION['email'] = $email;
    $_SESSION['role']  = $role;
    /* After sing up direct to home pages of user/adin ??? or back to sign?? */
    /*   if ($role === 'administrator') {
        _redirect('/admin/home_admin_ui');
    } else {
        _redirect('/user/home_user_ui');
    } */
    // if sign up with user/admin  that user/admin btn checked
    _redirect('sign_in');
}

/* =====================
   6. ON ERROR → BACK
   ===================== */
$_SESSION['errors'] = $errors;

_redirect('sign_up');