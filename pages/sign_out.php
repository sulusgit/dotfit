<?php
session_start();
session_unset();
session_destroy();
$_SESSION = array();
_redirect(url('/sign_in'));
