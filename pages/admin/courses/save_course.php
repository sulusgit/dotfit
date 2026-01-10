<?php
session_start();

/* ===== REQUIRED ===== */
$course_name = post('course_name', 150);
$description = post('description');
$duration = post('duration', 100);
$price = (float) post('price');

/* ===== OPTIONAL (FIXED) ===== */
// must NOT be NULL (DB rule)
$text_add_info = trim($_POST['text_add_info'] ?? '');

// badge is NOT decided now → DB logic later
$badge = '';

// difficulty: empty allowed → store NULL so default applies
$difficulty = trim($_POST['difficulty'] ?? '');
if ($difficulty === '') {
    $difficulty = null;
} else {
    $difficulty = strtolower($difficulty);
}

/* ===== IMAGE LOGIC (UNCHANGED) ===== */
$slug = strtolower(trim($course_name));
$slug = preg_replace('/[^a-z0-9]+/', '', $slug);

$imageDir = $_SERVER['DOCUMENT_ROOT'] . "/course_images";
$image = "/course_images/default.jpg";

$images = glob($imageDir . "/" . $slug . "*.{jpg,jpeg,png,webp}", GLOB_BRACE);
if (!empty($images)) {
    $image = "/course_images/" . basename($images[array_rand($images)]);
}

/* ===== INSERT (YOUR STYLE) ===== */
$success = _exec(
    "INSERT INTO courses SET
image=?,
name=?,
description=?,
text_add_info=?,
duration=?,
badge=?,
price=?,
create_admin_id=?,
difficulty=?",
    "ssssssdis",
    [
        $image,
        $course_name,
        $description,
        $text_add_info,
        $duration,
        $badge,
        $price,
        $_SESSION['id'],
        $difficulty
    ],
    $count
);

/* ===== RESULT ===== */
if ($count > 0) {
    $_SESSION['messages'][] = "Course added successfully!" . $success;
} else {
    $_SESSION['errors'][] = "Course was not saved.";
}

_redirect('/admin/home_admin_ui');
