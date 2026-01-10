<?php
session_start();
require_once '../../inc/db.php'; // замаа тааруулна уу

// Session‑ээс email авна
$email = $_SESSION['email'] ?? null;

// Хэрвээ email байхгүй бол redirect
if (!$email) {
    header("Location: /pages/sign_in.php");
    exit;
}

// DB‑ээс устгана
$sql = "DELETE FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);

// Session устгана
session_destroy();

// ✅ Redirect хийнэ
header("Location: /pages/home.php");
exit;
