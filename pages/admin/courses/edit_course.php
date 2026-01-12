<?php
//require ROOT . '/pages/admin/header_admin.php';

$id = (int) get('id', 10);

_selectRow(
    $stmt,
    $count,
    "SELECT
        id,
        image,
        name,
        description,
        text_add_info,
        duration,
        badge,
        price,
        difficulty
     FROM courses
     WHERE id=?",
    'i',
    [$id],

    // OUTPUT VARIABLES (DO NOT reuse $id)
    $course_id,
    $image,
    $name,
    $description,
    $text_add_info,
    $duration,
    $badge,
    $price,
    $difficulty
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Course</title>
    <link rel="stylesheet" href="<?= asset('css/add_course.css') ?>">
</head>

<body>

    <div class="profile-form">
        <h2>Edit Course</h2>

        <form method="POST" action="<?= url('admin/courses/edit_save') ?>" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= (int)$course_id ?>"> <!-- for course_id -->

            <!-- Upload zdjęcia -->
            <div class="image-upload-wrapper">
                <input type="file" id="imageInput" name="course_image" accept="image/*" style="display:none;">
                <div class="image-upload" id="previewBox" onclick="triggerUpload()">
                    
                </div>
            </div>

            <!-- Nazwa kursu -->
            <div class="input-group">
                <label>Course Name</label>
                <input value="<?= htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8') ?>" type="text" name="course_name"
                    placeholder="e.g. Swimming, Yoga" required />
            </div>
            <!-- Choosing the diff level -->

            <div class="input-group">
                <label>Difficulty Level</label>
                <select name="difficulty">
                    <option value="" <?= empty($difficulty) ? 'selected' : '' ?>>Not specified</option>
                    <option value="beginner" <?= $difficulty === 'beginner' ? 'selected' : '' ?>>Beginner</option>
                    <option value="intermediate" <?= $difficulty === 'intermediate' ? 'selected' : '' ?>>Intermediate
                    </option>
                    <option value="advanced" <?= $difficulty === 'advanced' ? 'selected' : '' ?>>Advanced</option>
                </select>
            </div>

            <!-- Opis kursu -->
            <div class="input-group">
                <label>Description</label>
                <textarea name="description" rows="4" placeholder="Describe the course..."
                    required><?= htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
            </div>
            <!-- Czas trwania -->
            <div class="input-group">
                <label>Duration</label>
                <input type="text" name="duration" value="<?= htmlspecialchars($duration ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    placeholder="e.g. 8 weeks program" required />
            </div>

            <!-- Cena -->
            <div class="input-group">
                <label>Price</label>
                <input value="<?= $price ?>" type="number" name="price" placeholder="e.g. 299" step="0.01" min="0"
                    required />
            </div>

            <!-- OPTIONAL FIELDS -->
            <h3 class="optional-title">Optional <div class="input-group">
                    <label>Additional Information | Article</label>
                    <textarea class="text_add_info" name="text_add_info" rows="4"
                        placeholder="You can write any article or additional information about your course..."><?= htmlspecialchars($text_add_info ?? '') ?></textarea>
                </div>

                <!-- Przyciski -->

                <div class="button-group">
                    <a href="<?= url('admin/home_admin_ui') ?>" class="cancel-btn">
                        Edit Cancel
                    </a>

                    <button type="submit" class="save-btn">
                        Edit Save
                    </button>
                </div>
        </form>
    </div>

    <script>
        function triggerUpload() {
            document.getElementById("imageInput").click();
        }

        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            const previewBox = document.getElementById("previewBox");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewBox.style.backgroundImage = `url('${e.target.result}')`;
                    previewBox.style.backgroundSize = 'cover';
                    previewBox.style.backgroundRepeat = 'no-repeat';
                    previewBox.style.backgroundPosition = 'center';
                    previewBox.innerHTML = '';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>