<?php
/* FOR TEMPRORY COMMYNCATION MESSAGES */


function flash_set(string $type, string $message): void
{
    $_SESSION['flash'][$type][] = $message;
}

function flash_get(): array
{
    $flash = $_SESSION['flash'] ?? [];
    unset($_SESSION['flash']);
    return $flash;
}
