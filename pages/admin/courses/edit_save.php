<?php
session_start();
$id          = (int) post('id');
$course_name = post('course_name', 150);
$description = post('description');
$duration    = post('duration', 100);
$price       = (float) post('price');

$text_add_info = trim($_POST['text_add_info'] ?? '');

$badge = '';

$difficulty = trim($_POST['difficulty'] ?? '');
$difficulty = $difficulty === '' ? null : $difficulty;

// image not handled yet
$image = null;

$success = _exec(
    "UPDATE courses SET
        name=?,
        description=?,
        text_add_info=?,
        duration=?,
        badge=?,
        price=?,
        difficulty=?
     WHERE id=?",
    "sssssdsi",
    [
        $course_name,
        $description,
        $text_add_info,
        $duration,
        $badge,
        $price,
        $difficulty,
        $id
    ],
    $count
);
/* if ($success) {
    $_SESSION['messages'][] = "Course saved successfully.";
} */
if ($id <= 0) {
    $_SESSION['errors'][] = 'Invalid course ID.';
    _redirect('admin/home_admin_ui');
}

if ($success) {
    $_SESSION['messages'][] =
        $count > 0 ? "Course updated successfully!" : "No changes were made.";
} else {
    $_SESSION['errors'][] = "Update failed.";
}

_redirect('admin/home_admin_ui');




 // using try catch show errors better way

    // first sql
    // then fields/pola
    // type
    //sql parameters


    /*      $success = _exec(    "UPDATE courses SET
            image=?,
            name=?,
            description=?,
            duration=?,
            badge=?,
            price=?
         WHERE id=?",
        "ssssssi",
        [
            $image,
            $course_name,
            $description,
            $duration,
            $badge,
            $price,
            $id
        ],
        $count
    ); */