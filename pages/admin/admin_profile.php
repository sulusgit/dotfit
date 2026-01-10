<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= asset('/css/admin_profile.css') ?>">
    <title>Profile - <?= $_SESSION['name'] ?></title>

</head>

<body>

    <!-- HERO HEADER -->
    <section class="profile-hero">
        <div class="hero-content">
            <div class="avatar"> <?= $_SESSION['name'] ?> </div>
            <h1 class="profile-name"><?= $_SESSION['name'] ?></h1>
            <p class="profile-email"><?= $_SESSION['email'] ?></p>
            <span class="profile-role"><?= $_SESSION['role'] ?></span>
        </div>
    </section>

    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- PROFILE INFO SECTION -->
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
                    <input type="text" class="info-value editable" id="edit-name" value="<?= $_SESSION['name'] ?> "
                        disabled>
                </div>
                <div class="info-row">
                    <span class="info-label">Email Address</span>
                    <input type="email" class="info-value editable" id="edit-email" value="<?= $_SESSION['email'] ?> "
                        disabled>
                </div>

            </div>
            <span class="info-label"> !!!!!!here add DELETE_ACCOUNT BTN </span>
            <span class="info-label"> !!!!!!here add close or back sign(<-) to close this page </span>
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
        // State management
        const editState = {
            profile: false,
            courses: false,
            opinions: false
        };

        // Toggle edit mode for sections
        function toggleEdit(section) {
            editState[section] = !editState[section];
            const sectionEl = document.getElementById(`${section}-section`);
            const btn = sectionEl.querySelector('.edit-btn span');
            const inputs = sectionEl.querySelectorAll('.editable');

            if (editState[section]) {
                // Enable editing
                sectionEl.classList.add('editing');
                btn.textContent = 'Save';
                inputs.forEach(input => {
                    input.disabled = false;
                    input.style.cursor = 'text';
                });

                // Show delete buttons and add button for courses
                if (section === 'courses') {
                    sectionEl.querySelectorAll('.delete-btn').forEach(btn => btn.classList.add('visible'));
                    sectionEl.querySelectorAll('.course-arrow').forEach(arrow => arrow.style.display = 'none');
                    document.getElementById('add-course-btn').classList.add('visible');
                }
            } else {
                // Save and disable editing
                sectionEl.classList.remove('editing');
                btn.textContent = 'Edit';
                inputs.forEach(input => {
                    input.disabled = true;
                    input.style.cursor = 'default';
                });

                // Hide delete buttons and add button
                if (section === 'courses') {
                    sectionEl.querySelectorAll('.delete-btn').forEach(btn => btn.classList.remove('visible'));
                    sectionEl.querySelectorAll('.course-arrow').forEach(arrow => arrow.style.display = 'block');
                    document.getElementById('add-course-btn').classList.remove('visible');
                }

                // Show save indicator
                showSaveIndicator();

                // Update hero section if profile was edited
                if (section === 'profile') {
                    updateHero();
                }
            }
        }

        // Update hero section with new values
        function updateHero() {
            const name = document.getElementById('edit-name').value;
            const email = document.getElementById('edit-email').value;
            const role = document.getElementById('edit-role').value;

            document.querySelector('.profile-name').textContent = name;
            document.querySelector('.profile-email').textContent = email;
            document.querySelector('.profile-role').textContent = role;
            document.querySelector('.avatar').textContent = name.charAt(0).toUpperCase();
        }

        // Show save indicator
        function showSaveIndicator() {
            const indicator = document.getElementById('save-indicator');
            indicator.classList.add('visible');

            setTimeout(() => {
                indicator.classList.remove('visible');
            }, 3000);
        }


        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
        @keyframes fadeOut {
            to {
                opacity: 0;
                transform: translateX(-20px);
            }
        }
    `;
        document.head.appendChild(style);

        // Auto-resize textareas
        document.querySelectorAll('textarea.editable').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });
    </script>

</body>

</html>