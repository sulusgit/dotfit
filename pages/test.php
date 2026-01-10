<?php
/* $password = "1234";
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;

if (password_verify("mine3456", $hash)) {
    echo "you are logged in";
} else {
    echo " your pass not correct try again";
} */
echo "nkgrsle";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        // Definiujemy funkcje globalnie, aby były dostępne dla przycisku
        function openEnrollModal(courseId) {
            console.log("Otwieranie modalu, ID: " + courseId); // Pomocniczy log w konsoli
            var modal = document.getElementById('enrollOverlay');
            var hiddenInput = document.getElementById('modal_course_id');

            hiddenInput.value = courseId;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeEnrollModal() {
            var modal = document.getElementById('enrollOverlay');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            var modal = document.getElementById('enrollOverlay');
            if (event.target == modal) {
                closeEnrollModal();
            }
        }
    </script>
    <style>
        #enrollOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            z-index: 10000;
            display: none;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #enrollOverlay.active {
            display: flex;
            opacity: 1;
        }

        .profile-form {
            max-width: 600px;
            width: 90%;
            margin: 0;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            font-family: 'Segoe UI', sans-serif;
            position: relative;
            transform: translateY(-20px);
            transition: transform 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        #enrollOverlay.active .profile-form {
            transform: translateY(0);
        }

        .profile-form h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 10px;
        }

        .button-group button {
            flex: 1;
            padding: 12px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .cancel-btn {
            background-color: #d2d2d2;
            color: white;
        }

        .save-btn {
            background-color: #333;
            color: white;
        }

        .close-x {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            border: none;
            background: transparent;
            color: #999;
        }

        .close-x:hover {
            color: #333;
        }
    </style>
    <title>Document</title>
</head>

<body>




    <!-- -------------------------------
     HTML MODALA
     ------------------------------------ -->
    <div id="enrollOverlay">
        <div class="profile-form">
            <button class="close-x" onclick="closeEnrollModal()">&times;</button>

            <h2>Enroll in Course</h2>

            <form method="POST">
                <input type="hidden" name="course_id" id="modal_course_id">


                <input type="hidden" name="enroll_submit" value="1">

                <div class="input-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required placeholder="Enter your full name">
                </div>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="Enter your email address">
                </div>

                <div class="input-group">
                    <label for="start_date">Choose date start</label>
                    <select id="start_date" name="start_date" required>
                        <option value="" disabled selected>-- Select Available Date --</option>
                        <?php foreach ($available_dates as $date): ?>
                            <option value="<?= $date ?>">
                                <?= date("d.m.Y", strtotime($date)) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="button-group">
                    <button type="button" class="cancel-btn" onclick="closeEnrollModal()">Cancel</button>
                    <button type="submit" class="save-btn">Enroll Now</button>
                </div>
            </form>
        </div>
    </div>

    <!-- -------------------------------------------------------------------------
     JAVASCRIPT
     ------------------------------------------------------------------------- -->

</body>

</html>