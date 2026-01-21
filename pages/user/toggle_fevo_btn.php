<?php
$user_id = ($_SESSION['id'] ?? 0);
$course_id =  ($_POST['course_id'] ?? 0);

if ($user_id <= 0 || $course_id <= 0) {
    exit;
}
_selectRow(
    $stmt,
    $count,
    "SELECT id FROM favorites WHERE user_id=? AND course_id=?",
    "ii",
    [$user_id, $course_id],
    $fav_id
);
if ($count > 0) {
    // REMOVE
    _exec(
        "DELETE FROM favorites WHERE user_id=? AND course_id=?",
        "ii",
        [$user_id, $course_id],
        $affected
    );
    echo 'removed';
} else {
    // ADD
    _exec(
        "INSERT INTO favorites (user_id, course_id) VALUES (?,?)",
        "ii",
        [$user_id, $course_id],
        $affected
    );
    echo 'added';
}

exit;
