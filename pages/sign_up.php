<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="<?= asset('css/signup.css') ?>">
</head>

<body>

    <div class="signup-container">
        <div class="form-section">

            <span class="close-btn" onclick="window.location.href='home'">×</span>

            <h2>Sign Up</h2>

            <?php if (!empty($_SESSION['errors'])): ?>
                <ul>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li style="color:red"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <form action="<?= url('/sign_up_save') ?>" method="POST">

                <div class="role-buttons">
                    <input type="hidden" name="role" id="role" value="User" />
                    <button type="button" id="User-btn" class="active" onclick="selectRole('User')">User</button>
                    <button type="button" id="Administrator-btn" onclick="selectRole('Administrator')">Admin</button>
                </div>

                <p class="signin-link">
                    Already have an account?
                    <a href="<?= url('sign_in') ?>">Sign In</a>
                </p>

                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Your name" required />
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="you@example.com" required />
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password" required />
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmpassword" placeholder="Confirm password" required />
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" required />
                    <label for="terms">I agree to the <a href="#">Terms & Policy</a></label>
                </div>

                <button type="submit" class="signup-button">Sign Up</button>

            </form>
        </div>
    </div>

    <script>
        function selectRole(role) {
            document.getElementById('role').value = role;
            document.getElementById('User-btn').classList.remove('active');
            document.getElementById('Administrator-btn').classList.remove('active');
            document.getElementById(role + '-btn').classList.add('active');
        }
    </script>

</body>

</html>