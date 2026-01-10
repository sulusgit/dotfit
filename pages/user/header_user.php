<?php
//cheching that user has login? while search directly=> http://dotfit.pl/user/home_user_ui
if ($_SESSION['role'] !== 'user') {
    $_SESSION['errors'] = ["you don't have account at first you have to sign up"];
    _redirect(url('/sign_in'));
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Header</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;
            background: #fafafa;
        }

        /* HEADER */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
            transition: all 0.3s ease;
        }

        /* LOGO */
        .logo {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -1px;
            color: #000;
            cursor: pointer;
            transition: opacity 0.2s ease;
            text-decoration: none;
        }

        .logo:hover {
            opacity: 0.7;
        }

        /* CENTER SECTION */
        .center-section {
            display: flex;
            align-items: center;
            gap: 20px;
            flex: 1;
            justify-content: center;
            max-width: 600px;
        }

        /* FILTER */
        /*  DODANE STYLE DLA FILTRA - */

        .filter-dropdown {
            position: relative;
            margin-right: 15px;
        }

        /* Przycisk ikony */
        .filter-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            transition: background 0.2s;
        }

        .filter-btn:hover {
            background-color: #f0f0f0;
        }

        /* "Dymek" z opcjami */
        .filter-menu {
            position: absolute;
            top: 120%;
            left: 0;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            min-width: 180px;
            display: none;
            /* Ukryty domyślnie */
            flex-direction: column;
            z-index: 100;
            padding: 8px 0;
            border: 1px solid #eee;
        }

        /* Klasa aktywująca dymek */
        .filter-dropdown.active .filter-menu {
            display: flex;
            animation: fadeIn 0.2s ease;
        }

        /* Elementy w dymku */
        .filter-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: background 0.2s;
        }

        .filter-option:hover {
            background-color: #f9f9f9;
        }

        /* Checkbox wizualny (kwadracik z kropką) */
        .checkbox-box {
            width: 16px;
            height: 16px;
            border: 2px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        /* Stan aktywny (jeśli użytkownik wybrał tę opcję) */
        .filter-option.active-sort {
            background-color: #f0f7ff;
            color: #000;
            font-weight: 500;
        }

        .filter-option.active-sort .checkbox-box {
            border-color: #000;
        }

     

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* SEARCH */
        .search-box {
            position: relative;
            flex: 1;
            max-width: 350px;
        }

        .search-box form {
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 20px 12px 44px;
            font-size: 14px;
            font-weight: 400;
            color: #1a1a1a;
            background: #f5f5f5;
            border: 1px solid transparent;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease;
            font-family: inherit;
            letter-spacing: 0.2px;
        }

        .search-box input::placeholder {
            color: #999;
            font-weight: 400;
        }

        .search-box input:focus {
            background: #fff;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.04);
        }

        /* Search Icon */
        .search-box::before {
            content: '';
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23999'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
            background-size: contain;
            pointer-events: none;
            z-index: 1;
        }


        /* PROFILE SECTION */
        .profile-dropdown {
            position: relative;
        }

        .profile-trigger {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px;
            background: transparent;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .profile-trigger:hover {
            background: rgba(0, 0, 0, 0.04);
        }

        /* Profile Avatar */
        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .profile-trigger:hover .profile-avatar {
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Profile Name (optional) */
        .profile-name {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-right: 4px;
            display: none;
            /* Hidden by default, uncomment to show */
        }

        /* Dropdown Arrow */
        .profile-arrow {
            width: 10px;
            height: 10px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23666'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-size: contain;
            transition: transform 0.2s ease;
            margin-right: 8px;
        }

        .profile-dropdown.active .profile-arrow {
            transform: rotate(180deg);
        }

        /* Profile Dropdown Menu */
        .profile-menu {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            background: #fff;
            min-width: 220px;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
            border: 1px solid rgba(0, 0, 0, 0.08);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            padding: 8px;
        }

        .profile-dropdown:hover .profile-menu,
        .profile-dropdown.active .profile-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Profile Menu Header */
        .profile-menu-header {
            padding: 12px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            margin-bottom: 8px;
        }

        .profile-menu-email {
            font-size: 12px;
            color: #666;
            font-weight: 400;
        }

        .profile-menu-name {
            font-size: 14px;
            color: #000;
            font-weight: 600;
            margin-bottom: 4px;
        }

        /* Profile Menu Links */
        .profile-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            border-radius: 8px;
            transition: all 0.15s ease;
        }

        .profile-menu a:hover {
            background: #f5f5f5;
            color: #000;
        }

        .profile-menu a.danger {
            color: #dc2626;
        }

        .profile-menu a.danger:hover {
            background: #fee2e2;
        }

        /* Profile Menu Icons */
        .profile-menu-icon {
            width: 18px;
            height: 18px;
            opacity: 0.6;
        }

        /* Divider */
        .profile-menu-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.06);
            margin: 8px 0;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
            }

            .center-section {
                display: none;
            }

            .profile-name {
                display: none;
            }
        }

        /* Dark Mode Support */
        @media (prefers-color-scheme: dark) {
            body {
                background: #0a0a0a;
            }

            .header {
                background: rgba(10, 10, 10, 0.98);
                border-bottom-color: rgba(255, 255, 255, 0.1);
            }

            .logo {
                color: #fff;
            }

            .search-box input {
                background: #1a1a1a;
                color: #f0f0f0;
            }

            .search-box input:focus {
                background: #222;
                border-color: rgba(255, 255, 255, 0.15);
                box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.04);
            }



            .profile-trigger:hover {
                background: rgba(255, 255, 255, 0.08);
            }

            .profile-menu {
                background: #1a1a1a;
                border-color: rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            }

            .profile-menu-header {
                border-bottom-color: rgba(255, 255, 255, 0.1);
            }

            .profile-menu-name {
                color: #fff;
            }

            .profile-menu-email {
                color: #999;
            }

            .profile-menu a {
                color: #ccc;
            }

            .profile-menu a:hover {
                background: rgba(255, 255, 255, 0.08);
                color: #fff;
            }

            .profile-menu-divider {
                background: rgba(255, 255, 255, 0.1);
            }
                 /* --- STYLE DLA FILTRA - DARK MODE --- */
    @media (prefers-color-scheme: dark) {
        .filter-menu {
            background: #1a1a1a;
            border: 1px solid #333;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        .filter-option {
            color: #ccc;
        }

        .filter-option:hover {
            background-color: #333;
            color: #fff;
        }

        /* Aktywna opcja w trybie ciemnym */
        .filter-option.active-sort {
            background-color: #252525;
            color: #fff;
        }

        /* Checkbox w trybie ciemnym - wypełniony biało z czarną kratką */
        .filter-option.active-sort .checkbox-box {
            background-color: #fff;
            border-color: #fff;
            
            /* SVG Checkmark (Czarna kratka na białym tle) */
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='20 6 9 17 4 12'%3E%3C/polyline%3E%3C/svg%3E");
            background-size: 14px;
            background-position: center;
            background-repeat: no-repeat;
        }
    }
    
        }
    </style>
</head>

<body>
    <header class="header">
        <!-- LOGO -->
        <a href="<?= url('/user/home_user_ui') ?>" class="logo">.Fit</a>

        <!-- CENTER SECTION -->
        <div class="center-section">
                            <!-- FILTER at the header --- SORT UI --- -->
        <div class="filter-dropdown" id="filterDropdown">
            <button class="filter-btn" onclick="toggleFilter(event)" title="Filter & Sort">
                <!-- Ikona Lejka / Filtru -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                </svg>
            </button>

            <div class="filter-menu">
                <!-- Lowest Price -->
                <a href="javascript:void(0)" class="filter-option" onclick="selectOption(this)">
                    <div class="checkbox-box"></div>
                    Lowest Price
                </a>
                <!-- Highest Price -->
                <a href="javascript:void(0)" class="filter-option" onclick="selectOption(this)">
                    <div class="checkbox-box"></div>
                    Highest Price
                </a>
                <!-- Newest -->
                <a href="javascript:void(0)" class="filter-option" onclick="selectOption(this)">
                    <div class="checkbox-box"></div>
                    Newest
                </a>
                <!-- Oldest -->
                <a href="javascript:void(0)" class="filter-option" onclick="selectOption(this)">
                    <div class="checkbox-box"></div>
                    Oldest
                </a>
            </div>
        </div>
        <!-- --- END FILTER --- -->

            <!-- SEARCH -->
            <div class="search-box">
                <form method="GET" action="">
                    <input value="<?php if (isset($_GET['search'])) {
                                        echo $_GET['search'];
                                    } ?>" type="text" name="search" placeholder="Search courses..."
                        oninput="if(this.value==='') window.location='<?= strtok($_SERVER['REQUEST_URI'], '?') ?>'">
                </form>
            </div>

            <!--  COURSES ADDED YOUR FEVORITE LIST  -->
            <a href="<?= url('/user/my_fevo_lists') ?>" class="icon-btn">
                <i class="fa-regular fa-heart"></i>
            </a>

        </div>

        <!-- PROFILE DROPDOWN -->
        <div class="profile-dropdown">
            <button class="profile-trigger" onclick="toggleProfile()">
                <span class="profile-name"> </span>

                <img src="https://ui-avatars.com/api/?name=<?= isset($_SESSION['name']) ? $_SESSION['name'] : '' ?>&background=000&color=fff"
                    alt="Profile" class="profile-avatar">
                <span class="profile-arrow"></span>
            </button>

            <div class="profile-menu">
                <div class="profile-menu-header">
                    <div class="profile-menu-name"> <?= $_SESSION['name'] ?></div>
                    <div class="profile-menu-email"> <?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?></div>
                </div>
                
                <a href="<?= url('user/user_profile') ?>">
                    <svg class="profile-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    My Profile
                </a>


                <a href="/pages/user/user_courses.php">
                    <svg class="profile-menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    My Courses
                </a>

                <div class="profile-menu-divider"></div>
                <!-- SIGN OUT -->
                <a href="<?= url('/sign_out') ?>" class="danger">
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

    <script>

                // --- FILTER LOGIC ---

        // 1. Funkcja otwierająca/zamykająca menu (zatrzymuje propagację, żeby nie zamknąć się od razu)
        function toggleFilter(event) {
            event.stopPropagation(); // Zapobiega zamknięciu po kliknięciu w przycisk
            const dropdown = document.getElementById('filterDropdown');
            dropdown.classList.toggle('active');
        }

        // 2. Funkcja obsługująca wybór opcji
        function selectOption(element) {
            // Usuń klasę 'active-sort' ze wszystkich opcji
            const options = document.querySelectorAll('.filter-option');
            options.forEach(opt => opt.classList.remove('active-sort'));

            // Dodaj klasę 'active-sort' do klikniętego elementu
            element.classList.add('active-sort');

            // Tutaj możesz dodać logikę sortowania produktów, np.:
            // console.log('Wybrano:', element.innerText.trim());
            
            // Opcjonalnie: Zamknij menu po wybraniu (usuń poniższą linię, jeśli chcesz, żeby zostało otwarte)
            document.getElementById('filterDropdown').classList.remove('active');
        }

        // 3. Zamknij menu, jeśli klikniesz poza nim
        window.addEventListener('click', function(event) {
            const dropdown = document.getElementById('filterDropdown');
            const isClickInside = dropdown.contains(event.target);

            if (!isClickInside) {
                dropdown.classList.remove('active');
            }
        });
    </script>
</body>

</html>