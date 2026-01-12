<!DOCTYPE html>
<!-- OHTERS  REGISTER.PHP sign_up-->
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
            <?php if (!empty($_SESSION['errors'])): //here errors show 
            ?>
                <ul>
                    <?php foreach ($_SESSION['errors'] as $error): ?>
                        <li style="color:red"><?= $error ?> </li>
                    <?php endforeach; ?>
                </ul>
            <?php unset($_SESSION['errors']);
            endif; ?>
            <!-- unset($_SESSION['errors']);  for clear the shown error  -->
            <form action="<?= url('/sign_up_save') ?>" method="POST">
                <!-- shows sign_up_save php  -->
                <div class="role-buttons">
                    <input type="hidden" name="role" id="role" value="User" />
                    <button type="button" id="User-btn" class="active" onclick="selectRole('User')">User</button>
                    <button type="button" id="Administrator-btn" onclick="selectRole('Administrator')">Admin</button>
                </div>



                <?php
                // if (!empty($_SESSION['errors'])) // here check //the that session's error value is empty that means
                // no errors
                // {
                // echo '<ul>';
                // foreach ($_SESSION['errors'] as $error) {
                // echo "<li style=\"color: red\">$error </li>";
                // }
                // echo '</ul>';
                // }
                ?> <p class="signin-link">
                    Already have an account?
                    <a href="<?= url('sign_in') ?> ">Sign In</a><!-- sign_in.php -->
                </p>
                <div class="input-group">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Your name" required />
                    <!-- using "name" atribute we sent to page we want to sent -->
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
                    <label>Confirm password</label>
                    <input type="password" name="confirmpassword" placeholder="Confirm a password" required />


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
    <script>
        function closeSignup() {
            window.location.href = "<?= url('/') ?>";
        }
    </script>


</body>

</html>