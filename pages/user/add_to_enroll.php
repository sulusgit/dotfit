<?php

if (!isset($_SESSION['id'])) {
    die('Login required');
}
$name  = $_SESSION['name'];
$email = $_SESSION['email'];


$course_id = (int) ($_GET['course_id'] ?? 0);
if ($course_id <= 0) {
    die('Invalid course');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Enroll</title>
    <link rel="stylesheet" href="<?= asset('style.css') ?>">
    <style>
        .enrollOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
        }

        h2,
        label {
            color: #0b0a0a;
        }

        .profile-form {
            max-width: 600px;
            width: 90%;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            font-family: "Segoe UI", sans-serif;
        }

        .profile-form h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }

        .cancel-btn,
        .save-btn {
            flex: 1;
            text-align: center;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .cancel-btn {
            background: #d2d2d2;
            color: #fff;
        }

        .save-btn {
            background: #333;
            color: #fff;
            border: none;
        }

        .close-x {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            text-decoration: none;
            color: #999;
        }

        .close-x:hover {
            color: #333;
        }
    </style>
</head>

<body>

    <!-- ENROLL MODAL -->
    <div class="enrollOverlay">
        <div class="profile-form">

            <!-- Close -->

            <a href="<?= url('user/home_user_ui') ?>" class="close-x">&times;</a>
            <h2>Enroll in Course</h2>



            <form action="<?= url('user/enroll_submit') ?>" method="post">

                <!-- IMPORTANT -->
                <input type="hidden" name="course_id" value="<?= $course_id ?>">

                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?= $name ?>" required>
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $email ?>" required>
                </div>
                <div class="input-group">
                    <label>Choose your start date </label>
                    <input type="date" name="start_date" value="<?= date('Y-m-d') ?>" min="<?= date('Y-m-d') ?>"
                        required>
                </div>
                <div class="button-group">
                    <a href="<?= url('user/home_user_ui') ?>" class="cancel-btn">Cancel</a>

                    <button type="submit" class="save-btn">
                        Enroll Now
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>