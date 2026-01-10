<?php
session_start();



if (!isset($_SESSION['id'])) {
    http_response_code(401);
    exit;
}
$user_id   = (int) $_SESSION['id'];
$course_id = (int) ($_POST['id'] ?? 0);

if ($course_id <= 0) {
    http_response_code(400);
    exit;
}


/* check if already favorited */
_selectRow(
    $stmt,
    $count,
    "SELECT id FROM favorites WHERE user_id=? AND course_id=?",
    "ii",
    [$user_id, $course_id],
    $fav_id
);

if ($count > 0) {
    // remove favorite
    _exec(
        "DELETE FROM favorites WHERE user_id=? AND course_id=?",
        "ii",
        [$user_id, $course_id],
        $affected
    );
    echo "removed";
} else {
    // add favorite
    _exec(
        "INSERT INTO favorites (user_id, course_id) VALUES (?, ?)",
        "ii",
        [$user_id, $course_id],
        $affected
    );
    echo "added";
}
