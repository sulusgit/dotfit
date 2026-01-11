<?php
// PLIK: requests.php

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Requests</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;
            background: #ffffff;
            color: #1a1a1a;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* HERO HEADER - Adaptowany dla panelu administratora */
        .profile-hero {
            min-height: 35vh;
            /* Trochę niższy */
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 40px;
            background: linear-gradient(180deg, #fafafa 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            text-align: center;
            z-index: 1;
        }

        .profile-name {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 42px;
            /* Większy nagłówek */
            font-weight: 700;
            letter-spacing: -1.5px;
            margin-bottom: 8px;
            color: #000;
        }

        .profile-role {
            display: inline-block;
            background: rgba(0, 0, 0, 0.05);
            padding: 8px 20px;
            border-radius: 24px;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #555;
            margin-top: 10px;
        }

        /* MAIN CONTENT */
        .main-content {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 40px 120px;
        }

        /* SECTION STYLES */
        .section {
            margin-bottom: 80px;
            animation: fadeInUp 1s ease;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        /* LIST STYLE (Używamy klasy courses-list do wyświetlania studentów) */
        .requests-list {
            display: grid;
            gap: 16px;
        }

        .student-card {
            background: #fafafa;
            border-radius: 16px;
            padding: 28px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        .student-card:hover {
            background: #f5f5f5;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .student-info h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #000;
        }

        .student-info p {
            font-size: 15px;
            color: #666;
        }

        .student-details {
            text-align: right;
        }

        .detail-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            margin-bottom: 4px;
            display: block;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 600;
            color: #000;
        }

        .date-badge {
            display: inline-block;
            background: #000;
            color: #fff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-top: 8px;
        }

        /* EMPTY STATE */
        .no-requests {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }

        /* ANIMATIONS */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .student-card {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .student-details {
                text-align: left;
                width: 100%;
                border-top: 1px solid rgba(0, 0, 0, 0.05);
                padding-top: 15px;
            }

            .profile-hero {
                padding: 40px 20px;
            }

            .main-content {
                padding: 0 20px 80px;
            }
        }
    </style>
</head>

<body>

    <!-- HERO SECTION (Nagłówek) -->
    <div class="profile-hero">
        <div class="hero-content">
            <!-- Ikona/Avatar administratora -->
            <h1 class="profile-name">Enrollment Requests</h1>
            <div class="profile-role">Dashboard Overview</div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">All Students</h2>
                <!-- Można tu dodać przycisk exportu itp. -->
                <div style="font-size: 14px; color: #999;">Total: </div>
            </div>

            <div class="requests-list">

                <!-- KARTA STUDENTA -->
                <div class="student-card">
                    <div class="student-info">
                        <h3>name of user</h3>
                        <p></p>
                        <span style="font-size: 13px; color: #999; margin-top: 4px; display: block;">
                            Course ID:
                        </span>
                    </div>

                    <div class="student-details">
                        <span class="detail-label">Course Starts</span>
                        <div class="detail-value"></div>

                        <span class="detail-label" style="margin-top: 8px;">Enrolled On</span>
                        <div style="font-size: 14px; color: #666;">

                        </div>
                    </div>
                </div>


                <div class="no-requests">
                    No enrollment requests found yet.
                </div>


            </div>
        </div>

    </div>

</body>

</html>