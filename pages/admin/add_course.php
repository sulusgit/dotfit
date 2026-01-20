<?php
//require ROOT . "header_admin.php";
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
        <h2>Add Course</h2>
        <form method="POST" action="<?= url('admin/courses/save_course') ?>" enctype="multipart/form-data">
            <!-- Upload zdjęcia -->
            <div class="image-upload-wrapper">
                <input type="file" id="imageInput" name="course_image" accept="image/*" style="display:none;">
                <!--  <div class="image-upload" id="previewBox" onclick="triggerUpload()">
                    Insert course image here
                </div> -->
            </div>
            <!-- Nazwa kursu -->
            <div class="input-group">
                <label>Course Name</label>
                <input type="text" name="course_name" velue="Yoga" placeholder="e.g. Swimming, Yoga" required />
            </div>
            <div class="input-group">
                <label>Difficulty Level</label>
                <select name="difficulty">
                    <option value=""></option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <!-- Opis kursu -->
            <div class="input-group">
                <label>Description</label>
                <textarea name="description" class="text_description" rows="4" placeholder="Describe the course..."
                    required></textarea>
            </div>

            <!-- Czas trwania -->
            <div class="input-group">
                <label>Duration</label>
                <input type="text" name="duration" placeholder="e.g. 8 weeks program" required />
            </div>
            <!-- Cena -->
            <div class="input-group">
                <label>Price</label>
                <input type="number" name="price" placeholder="e.g. 299" step="0.01" min="0" required />
            </div>
            <!-- OPTIONAL FIELDS -->
            <h3 class="optional-title">Optional Information</h3>
            <div class="input-group">
                <label>Additional Imformation/Article</label>
                <textarea class="text_add_info" name="text_add_info" rows="4"
                    placeholder="You can write article any other information about you and your course..."></textarea>
            </div>

            <!-- Przyciski -->
            <div class="button-group">
                <button type="button" class="cancel-btn"
                    onclick="window.location.href='<?= url('admin/home_admin_ui') ?>'">
                    Cancel
                </button>
                <button type="submit" class="save-btn">Save Course</button>
            </div>
        </form>
    </div>



</body>

</html>