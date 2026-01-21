<?php
session_start();
ini_set('display_errors', 1);
define('ROOT', __DIR__);
define('BASE_URL', '/dotfit');
require ROOT . '/inc/helper.php';
require ROOT . '/inc/conf.php';
require ROOT . '/inc/db.php';
require ROOT . '/inc/flash.php';
require ROOT . '/inc/auth.php';

/* FRONT CONTROL TO URL LOOK BETTER */
$uri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = rtrim(BASE_URL, '/');

if ($base && strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
$page = trim($uri, '/');

if ($page === '') {
    require ROOT . '/pages/home.php';
    exit;
}

$file = ROOT . '/pages/' . $page . '.php';
/* if not find that file it will show 404 page */
if (file_exists($file)) {
    require $file;
} else {
    require ROOT . '/pages/404.php';
}

//debug function print array
function dd($arr)
{
    echo '<pre>';
    print_r($arr);
    #exit;
}

function flash(string $type, string $message): void
{
    if (!isset($_SESSION['messages'])) {
        $_SESSION['messages'] = [];
    }

    if (!isset($_SESSION['messages'][$type])) {
        $_SESSION['messages'][$type] = [];
    }

    $_SESSION['messages'][$type][] = $message;
}


/* POST GET FUNC  */
//Prevention to valid date type POST; sign_up.php d :: if inputs to long trim etc 
function post($name, $length = null) // if that len is longer than our name's length so it is sth wierd so to prevent this
{
    if (!isset($_POST[$name])) {
        return null;
    }
    $value = $_POST[$name];
    $value = addslashes($value); // WORk if Ann's$ => Ann's
    if (! is_null($length) && mb_strlen($value) > $length) {
        $value = mb_substr($value, 0, $length); // mb_substr does if that input for value is too long it just cut until the our setted length not extra things

        //if want you can add Security alert! e.g. BD write, email send
        echo "<br>security alert: $name is value is longer, must be $length !<br>";
    }
    return $value;
}
//func for GET clean/trip etc. we don't used much
function get($name, $length = null) // if that len is longer than our name's length so it is sth wierd so to prevent this
{
    $value = $_GET[$name];
    $value = addslashes($value); //!!DIDN"T WORk if Ann's$ => Ann's
    if (! is_null($length) && mb_strlen($value) > $length) {
        $value = mb_substr($value, 0, $length); // mb_substr does if that input for value is too long it just cut until the our setted length not extra things

        //if want you can add Security alert! e.g. BD write, email send
        echo "<br>security alert: $name is value is longer, must be $length !<br>";
    }
    return $value;
}
