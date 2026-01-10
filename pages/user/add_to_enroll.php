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

            <!-- Close → back to home -->
            <a href="<?= url('user/home_user_ui') ?>" class="close-x">&times;</a>

            <h2>Enroll in Course</h2>

            <!-- FORM (can be connected later to admin/publisher) -->
            <form action="#" method="post">

                <div class="input-group">
                    <label>Name</label>
                    <input type="text" required placeholder="Enter your full name">
                </div>

                <div class="input-group">
                    <label>Email</label>
                    <input type="email" required placeholder="Enter your email">
                </div>

                <div class="input-group">
                    <label>Choose start date</label>
                    <select required>
                        <option disabled selected>-- Select date --</option>
                        <option>20.01.2026</option>
                        <option>05.03.2026</option>
                    </select>
                </div>

                <div class="button-group">
                    <!-- Cancel → home -->
                    <a href="<?= url('user/home_user_ui') ?>" class="cancel-btn">Cancel</a>

                    <!-- Enroll → submit -->
                    <button type="submit" class="save-btn">
                        Enroll Now
                    </button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>