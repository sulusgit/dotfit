<?php

$course_name = post('course_name', 150);
$description = post('description');
$duration = post('duration', 100);
$price = (float) post('price');

// must NOT be NULL (DB rule)
$text_add_info = trim($_POST['text_add_info'] ?? '');

// badge is NOT decided now only NEW Badge
$badge = '';

// difficulty: empty allowed → store NULL so default applies
$difficulty = trim($_POST['difficulty'] ?? '');
if ($difficulty === '') {
    $difficulty = null;
} else {
    $difficulty = strtolower($difficulty);
}
/* ===== IMAGE LOGIC from our COURCE_IMAGES it choose random pic only adding new course ===== */
// Normalize course name: remove extra spaces and convert to lowercase
// This helps with case-insensitive matching against folder names
$courseLower = strtolower(trim($course_name));

// Absolute path on the server where course images are stored
// Example: C:/xampp/htdocs/dotfit/course_images
$baseDir = ROOT . '/course_images';

// Public URL path used in HTML to load images in the browser
// Example: http://localhost/dotfit/course_images
$webPath = BASE_URL . '/course_images';

// Default image used when no matching course folder is found
$imagePath = $webPath . '/default.jpg';

// Get all subfolders inside /course_images
// Each folder is assumed to represent a course category (e.g. yoga, swimming)
$folders = glob($baseDir . '/*', GLOB_ONLYDIR);

// Loop through each course image folder
foreach ($folders as $folder) {

    // Get folder name only (without full path) and normalize it
    // Example: "Yoga" → "yoga"
    $folderName = strtolower(basename($folder));

    // Check if course name matches folder name (either direction)
    // Example:
    // "yoga basics" contains "yoga"
    // OR folder "yoga basics" contains course name "yoga"
    if (
        strpos($courseLower, $folderName) !== false ||
        strpos($folderName, $courseLower) !== false
    ) {

        // Find all image files inside the matched folder
        // Supports jpg, jpeg, png, webp (any case)
        $files = glob(
            $folder . '/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}',
            GLOB_BRACE
        );

        // If images exist in that folder
        if (!empty($files)) {

            // Pick a random image from the folder
            // This adds visual variety for courses
            $imagePath = $webPath . '/' . $folderName . '/' . basename(
                $files[array_rand($files)]
            );
        }

        // Stop searching after first matched folder
        break;
    }
}

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
        $imagePath, //image path
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

_redirect('/admin/home_admin_ui');