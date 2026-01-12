<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    <title>Header Guest </title> -->
    <style>
        /*     @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap'); */

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

        /* FILTER  */

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
            color: #787874;
            /*  transition: background 0.2s; */
            ;
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
            /* transition: background 0.2s; */
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


        /* NAVIGATION */
        .nav {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav a {
            padding: 10px 16px;
            text-decoration: none;
            color: #666;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.3px;
            border-radius: 6px;
            transition: all 0.2s ease;
            cursor: pointer;
            white-space: nowrap;
        }

        .nav a:hover {
            color: #000;
            background: rgba(0, 0, 0, 0.04);
        }

        /* DROPDOWN */
        .dropdown {
            position: relative;
        }

        .dropdown>a {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .dropdown>a::after {
            content: '';
            width: 8px;
            height: 8px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-size: contain;
            transition: transform 0.2s ease;
            opacity: 0.6;
        }

        .dropdown:hover>a::after {
            transform: rotate(180deg);
        }

        .dropdown-content {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            background: #fff;
            min-width: 180px;
            border-radius: 8px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.08);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            padding: 8px;
        }

        .dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-content a {
            display: block;
            padding: 10px 12px;
            color: #666;
            font-size: 14px;
            font-weight: 400;
            border-radius: 4px;
            transition: all 0.15s ease;
        }

        .dropdown-content a:hover {
            background: #f5f5f5;
            color: #000;
            transform: translateX(2px);
        }

        /* Login Button Special Style */
        .nav a[href*="login"] {
            background: #000;
            color: #fff;
            font-weight: 500;
            padding: 10px 20px;
        }

        .nav a[href*="login"]:hover {
            background: #222;
            transform: translateY(-1px);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 16px 20px;
            }

            .search-box {
                display: none;
            }

            .nav {
                gap: 4px;
            }

            .nav a {
                padding: 8px 12px;
                font-size: 13px;
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
                border-color: transparent;
            }

            .search-box input:focus {
                background: #222;
                border-color: rgba(255, 255, 255, 0.15);
                box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.04);
            }

            .search-box input::placeholder {
                color: #666;
            }

            .nav a {
                color: #a0a0a0;
            }

            .nav a:hover {
                color: #fff;
                background: rgba(255, 255, 255, 0.08);
            }

            .dropdown-content {
                background: #1a1a1a;
                border-color: rgba(255, 255, 255, 0.1);
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
            }

            .dropdown-content a {
                color: #a0a0a0;
            }

            .dropdown-content a:hover {
                background: rgba(255, 255, 255, 0.08);
                color: #fff;
            }

            .nav a[href*="login"] {
                background: #fff;
                color: #000;
            }

            .nav a[href*="login"]:hover {
                background: #e0e0e0;
            }
        }

        /* Scroll Effect */
        .header.scrolled {
            padding: 16px 40px;
            box-shadow: 0 1px 20px rgba(0, 0, 0, 0.06);
        }

        /* filter checkbox*/
        /* --- STYPIE DLA FILTRA - DARK MODE --- */
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

            .filter-option.active-sort .checkbox-box {
                border-color: #fff;
            }

            .filter-option.active-sort .checkbox-box::after {
                background: #fff;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <!-- LOGO -->
        <div class="logo">
            <a href="<?= url('home') ?>" class="logo">.Fit</a>

        </div>

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



        </div>

        <!-- NAVIGATION  SIGN IN/ SIGN OUT-->
        <nav class="nav">

            <a href=" <?= url('sign_in') ?> ">Sign in</a>
            <a href="<?= url('sign_up') ?>">Sign up</a>

        </nav>
    </header>

    <!--     <script>
        // Optional:  what for!!! Add scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script> -->





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