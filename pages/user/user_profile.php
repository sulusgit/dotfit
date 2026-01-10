<?php

if (!isset($_SESSION['email'])) {
    header("Location: /pages/sign_in.php");
    exit;
}

    include 'header_user.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Profile - <?= $_SESSION['name'] ?></title>
    <link rel="stylesheet" href="<?= asset('/css/admin_profile.css') ?>">
</head>

<body>

    <!-- HERO HEADER -->
    <section class="profile-hero">
        <div class="hero-content">
            <div class="avatar"><?= strtoupper($_SESSION['name'][0]) ?></div>
            <h1 class="profile-name"><?= $_SESSION['name'] ?></h1>
            <p class="profile-email"><?= $_SESSION['email'] ?></p>
            <span class="profile-role"><?= $_SESSION['role'] ?></span>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <section class="section" id="profile-section">
            <div class="section-header">
                <div>
                    <p class="section-label">Personal</p>
                    <h2 class="section-title">Profile Information</h2>
                </div>

                <button class="edit-btn" onclick="toggleEdit('profile')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    <span>Edit</span>
                </button>
            </div>

            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Full Name</span>
                    <input type="text" class="info-value editable" id="edit-name"
                           value="<?= $_SESSION['name'] ?>" disabled>
                </div>

                <div class="info-row">
                    <span class="info-label">Email Address</span>
                    <input type="email" class="info-value editable" id="edit-email"
                           value="<?= $_SESSION['email'] ?>" disabled>
                </div>
            </div>

            <div class="action-buttons">
                <button class="back-btn" onclick="goBack()">← Back</button>

                <!-- USER DELETE ACCOUNT -->
                <form method="POST" action="/pages/user/delete_account.php"
                      onsubmit="return confirm('Are you sure you want to delete your account?');">
                    <button type="submit" class="delete-account-btn">Delete Account</button>
                </form>
            </div>
        </section>

    </main>

    <!-- SAVE INDICATOR -->
    <div class="save-indicator" id="save-indicator">
        <div class="checkmark">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                <path d="M20 6L9 17l-5-5"></path>
            </svg>
        </div>
        Changes saved successfully!
    </div>

    <script>
        const editState = { profile: false };

        function toggleEdit(section) {
            editState[section] = !editState[section];
            const sectionEl = document.getElementById(`${section}-section`);
            const btn = sectionEl.querySelector('.edit-btn span');
            const inputs = sectionEl.querySelectorAll('.editable');

            if (editState[section]) {
                sectionEl.classList.add('editing');
                btn.textContent = 'Save';
                inputs.forEach(i => i.disabled = false);
            } else {
                sectionEl.classList.remove('editing');
                btn.textContent = 'Edit';
                inputs.forEach(i => i.disabled = true);
                showSaveIndicator();
            }
        }

        function showSaveIndicator() {
            const indicator = document.getElementById('save-indicator');
            indicator.classList.add('visible');
            setTimeout(() => indicator.classList.remove('visible'), 3000);
        }

        function goBack() {
            window.history.back();
        }

    </script>
    

</body>
</html>
