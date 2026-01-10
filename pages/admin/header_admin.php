<?php



if ($_SESSION['role'] !== 'administrator') {
    $_SESSION['errors'] = ["you don't sign in, at first you have to sign in"];
    _redirect('sign_in');
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Header</title>


    <link rel="stylesheet" href="<?= asset('css/header_admin.css') ?>">

</head>

<body>
    <header class="header">
        <!-- LOGO -->

        <a href="<?= url('admin/home_admin_ui') ?>" class="logo">.Fit</a>

        <!-- CENTER SECTION -->
        <div class="center-section">

            <!-- FILTER at the heqader--- NOWY FILTR --- -->
            <div class="filter-dropdown" id="filterDropdown">
                <button class="filter-btn" onclick="toggleFilter()" title="Sort by Price">
                    <!-- Ikona Lejka / Filtru -->
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                </button>

                <div class="filter-menu">
                    <a href="" class="filter-option">
                        <div class="checkbox-box"></div>
                        Lowest Price
                    </a>
                    <a href="" class="filter-option">
                        <div class="checkbox-box"></div>
                        Highest Price
                    </a>
                </div>
            </div>
            <!-- --- KONIEC FILTRA --- -->
            <!-- SEARCH -->
            <div class="search-box">

                <form method="GET" action="">
                    <input value="<?php if (isset($_GET['search'])) {
                                        echo $_GET['search'];
                                    } ?>" type="text" name="search" placeholder="Search courses..."
                        oninput="if(this.value==='') window.location='<?= strtok($_SERVER['REQUEST_URI'], '?') ?>'">
                </form>
            </div>

            <!-- ADD COURSE BUTTON -->
            <a href="<?= url('admin/add_course') ?>" class="add-course-btn">
                Add Coursee
            </a>
        </div>

        <!-- PROFILE DROPDOWN -->
        <div class="profile-dropdown">
            <button class="profile-trigger" onclick="toggleProfile()">
                <span class="profile-name"><?= $_SESSION['name']; //what for?? 
                                            ?></span>

                <img src="https://ui-avatars.com/api/?name=<?= $_SESSION['name']; ?>&background=000&color=fff"
                    alt="Profile" class="profile-avatar">
                <span class="profile-arrow"></span>
            </button>

            <div class="profile-menu">
                <div class="profile-menu-header">
                    <div class="profile-menu-name"><?= $_SESSION['name']; ?></div>
                    <div class="profile-menu-email"><?= $_SESSION['email']; ?></div>

                </div>

                <a href="<?= url('admin/admin_profile') ?>">
                    <svg class="profile-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    My Profile
                </a>

                <a href="<?= url('/admin/list_review') ?>">
                    <svg class="profile-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Reviews
                </a>

                <a href="<?= url('/admin/list_requist') ?>">
                    <svg class="profile-menu-icon" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                    Requests
                </a>

                <div class="profile-menu-divider"></div>

                <a href="<?= url('/sign_in') ?>" class="danger">
                    <svg class="profile-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </a>
            </div>
        </div>
    </header>

    <script>
        // Toggle profile dropdown
        function toggleProfile() {
            const dropdown = document.querySelector('.profile-dropdown');
            dropdown.classList.toggle('active');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const dropdown = document.querySelector('.profile-dropdown');
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove('active');
            }
        });

        // Optional: Add scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>