<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link rel="stylesheet" href="<?= asset('css/sign_in.css') ?>">
</head>

<body>

    <div class="signup-container">
        <div class="form-section">
            <!-- <div class="close-btn" onclick="closeSignup()"> X </div> -->
            <span class="close-btn" onclick="window.location.href='home'">×</span>
            <h2>Sign In</h2>

            <form method="POST" action="<?= url('sign_in_do') ?>">

                <!-- ROLE BUTTONS -->
                <div class="role-buttons">
                    <input type="hidden" name="role" id="role" value="user" />

                    <button type="button" id="user-btn" class="active" onclick="selectRole('user')">
                        User
                    </button>

                    <button type="button" id="administrator-btn" onclick="selectRole('administrator')">
                        Admin
                    </button>
                </div>

                <!-- <div class="role-buttons">
                    <input type="hidden" name="role" id="role" value="user" />

                    <button type="button" id="User-btn" class="active" onclick="selectRole('User')">
                        User
                    </button>

                    <button type="button" id="Administrator-btn" onclick="selectRole('Administrator')">
                        Admin
                    </button>
                </div> -->
                <?php if (!empty($_SESSION['errors'])): //here errors show 
                ?>
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li style="color:red"><?= $error ?> </li>
                        <?php endforeach; ?>
                    </ul>
                <?php unset($_SESSION['errors']);
                endif; ?>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="you@example.com" required />
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter your password" required />
                </div>

                <button type="submit" class="signup-button">Sign In</button>
            </form>

            <p class="signin-link">
                Don't have an account?
                <a href="<?= url('sign_up') ?>">Sign Up</a><!-- sign_up.php -->
            </p>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        function selectRole(role) {
            document.getElementById('role').value = role;

            document.getElementById('user-btn').classList.remove('active');
            document.getElementById('administrator-btn').classList.remove('active');

            document.getElementById(role + '-btn').classList.add('active');
        }

        /*     function selectRole(role) {
                document.getElementById('role').value = role;

                document.getElementById('User-btn').classList.remove('active');
                document.getElementById('Administrator-btn').classList.remove('active');

                document.getElementById(role + '-btn').classList.add('active');
            } */
    </script>

    <script>
        function closeSignup() {
            window.location.href = "<?= url('/') ?>";
        }
    </script>
</body>

</html>