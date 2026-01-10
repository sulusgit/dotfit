<?php
/* -to helper for redirect paths EXAMPLE HERE TO DIRECT-- */
/* if link use this:
     <a href="<?= url('sign_in') ?>">Sign in</a> */
/* if: <form action="<?= url('sign_in') ?>" method="post"> */
    /* if: _redirect(url('dashboard')); */

    /* <form action="<?= url('...') ?>">
        <a href="<?= url('...') ?>">
            asset('css/...') for CSS/JS/images
            _redirect(url('...')) for redirects */
            function url(string $path = ''): string
            {
            $base = rtrim(BASE_URL, '/');
            $path = '/' . ltrim($path, '/');
            /* $path = '/css/add_course.css'
            ltrim() removes /
            becomes 'css/add_course.css' */
            return $base . $path;
            }
            /* TO accets czyli CSS JS etc */
            /*
            <link rel="stylesheet" href="<?= asset('css/add_course.css') ?>"> */
            function asset(string $path): string
            {
            return url($path);
            }