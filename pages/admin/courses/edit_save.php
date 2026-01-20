<?php
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
_redirect('admin/home_admin_ui');

/* if ($success) {
    //   flash('info', 'Course edit saved successfully.');
  
} else {
    //   flash('error', 'An error occurred while updating the course. Please try again.');
} */
 


/* if ($id <= 0) {
    flash('error', 'Invalid course ID.');
    /*   _redirect('admin/home_admin_ui'); */


/* if ($success) {
    flash('success', $count > 0 ? "Course updated successfully!" : "No changes were made.");
} else {
    flash('error', 'An error occurred while updating the course. Please try again.');
}
 */




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