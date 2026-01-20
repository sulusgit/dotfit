<?php

$course_name = post('course_name', 150);
$description = post('description');
$duration = post('duration', 100);
$price = (float) post('price');


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
$courseLower = strtolower(trim($course_name));

$baseDir = ROOT . '/course_images';
$webPath = BASE_URL . '/course_images';

$imagePath = $webPath . '/default.jpg';

$folders = glob($baseDir . '/*', GLOB_ONLYDIR);

foreach ($folders as $folder) {
    $folderName = strtolower(basename($folder));

    if (
        strpos($courseLower, $folderName) !== false ||
        strpos($folderName, $courseLower) !== false
    ) {
        $files = glob(
            $folder . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}',
            GLOB_BRACE
        );

        if (!empty($files)) {
            $imagePath = $webPath . '/' . $folderName . '/' . basename(
                $files[array_rand($files)]
            );
        }
        break;
    }
}




/* ===== INSERT  ===== */
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
        $imagePath,
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
//flash('success', 'Course added successfully!');
//if else was about save not info but no used no notfications
/* } catch (Exception $e) {
    echo "aldaa garlla" . $e->getMessage();
    // echo $e->getMessage();
    // flash('error', 'Error occured could you try again?');
      $_SESSION['error'] = [$e->getMessage()];
    exit;
}
 */
/* } finally {
    //write to db about finally worked the end
    _exec(
        "INSERT INTO error set 
        date_time=?,
        ip=?, 
        error_code=?,
        error=?,
        file=?,
        line=?,
        site_usr_adm=? ",
        'sisssis',
        [getIpAddress(), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine()],
        $count
    );
} */



_redirect('/admin/home_admin_ui');
