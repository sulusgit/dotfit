<?php
/* USED TO URLs  $ redirect */
function url(string $path = ''): string
{
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
}


function asset(string $path): string
{
    return url($path);
}
//Redirect func to a route (NOT a file path)
function _redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}
?>
<?php
/* <?php
/**
 * ------------ NOT SUING JUST CHECK IF NEEDS HOW TO DIRECT--------------------------------------
 * URL HELPERS — FOR FRONT CONTROLLER PROJECT
 * --------------------------------------------------
 * BASE_URL is defined in index.php
 * Example: define('BASE_URL', '/dotfit');
 *
 * IMPORTANT RULE:
 * - URLs NEVER contain: "pages", ".php"
 * - URLs ALWAYS represent ROUTES
 */

/**
 * Build a public URL for links and forms
 *
 *  USE FOR:
 *   <a href="<?= url('sign_in') ?>">
 * <form action="<?= url('user/comment_add') ?>">
 *
 * DO NOT USE FOR:
 * redirects directly (use _redirect)
 */
    /* function url(string $path = ''): string
    {
    return rtrim(BASE_URL, '/') . '/' . ltrim($path, '/');
    }
    */
/**
 * Build URL for static assets (CSS, JS, images)
 *
 * USE FOR:
 *
 *
 *
 *
 *
 *
 *
 *

 * <img src="<?= asset('course_images/pic.jpg') ?>">
 */
    /* function asset(string $path): string
    {
    return url($path);
    }
    */
/**
 * Redirect to a route (NOT a file path)
 *
 * USE:
 * _redirect('sign_in');
 * _redirect('user/learn_more');
 *
 * NEVER DO:
 * _redirect(url('sign_in'));
 */
    /* function _redirect(string $path): void
    {
    header('Location: ' . url($path));
    exit;
    } */

/**
 * Safe POST value getter
 *
 * USE:
 * $email = post('email', 100);
 * $comment = post('comment');
 */
    /* function post(string $key, int $maxLength = null): ?string
    {
    if (!isset($_POST[$key])) {
    return null;
    }

    $value = trim($_POST[$key]);

    if ($maxLength !== null && mb_strlen($value) > $maxLength) {
    $value = mb_substr($value, 0, $maxLength);
    }

    return $value;
    }
    */
/**
 * Safe GET value getter
 *
 * USE:
 * $id = get('id');
 * $page = get('page', 50);
 */
    /* function get(string $key, int $maxLength = null): ?string
    {
    if (!isset($_GET[$key])) {
    return null;
    }

    $value = trim($_GET[$key]);

    if ($maxLength !== null && mb_strlen($value) > $maxLength) {
    $value = mb_substr($value, 0, $maxLength);
    }

    return $value;
    } */

/**
 * Debug helper (development only)
 *
 * USE:
 * dd($_POST);
 */
    /* function dd($data): void
    {
    echo '
    <pre>';
    print_r($data);
    exit;
}  */