<?php

/* function auth_login(array $user): void
{
    session_regenerate_id(true);

    $_SESSION['auth'] = [
        'id'    => $user['id'],
        'name'  => $user['name'],
        'email' => $user['email'],
        'role'  => $user['role'],
    ];
}

function auth_logout(): void
{
    $_SESSION = [];
    session_destroy();
}

function auth_user(): ?array
{
    return $_SESSION['auth'] ?? null;
}

function auth_require_login(): void
{
    if (!auth_user()) { */
        // _redirect(url('sign_in'));
/*         flash_set('error', 'You must be signed in to access that page.');
        // _redirect(url('sign_in.php'));
    }
} */
/* 
function auth_require_admin(): void
{ */
    /*     if (!auth_user() || auth_user()['role'] !== 'admin') {
        flash_set('error', 'You do not have permission to access that page.');
        //  _redirect(url('sign_in.php'));
 }   } */