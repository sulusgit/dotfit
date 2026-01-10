Home page GUEST

<!--OTHERS  -->
<!--janper8877 -->

<?php require 'header.php';
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.Fit - Transform Your Life</title>
    <link rel="stylesheet" href="<?= asset('/css/home.css') ?>">
    <!-- thie STYLE what for !!!! -->
    <!--   <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');
    </style> -->
</head>

<body>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Just Do It</h1>
            <p class="hero-subtitle">Transform your body and mind with our premium fitness courses</p>
        </div>
    </section>

    <!-- COURSES SECTION -->
    <section class="courses">
        <div class="section-header">
            <p class="section-label">Our Courses</p>
            <h2 class="section-title">Choose Your Journey</h2>
            <p class="section-description">Expert-led programs designed to help you achieve your fitness goals</p>
        </div>

        <div class="courses-grid">
            <!-- SWIMMING COURSE -->
            <a href="course-swimming.php" class="course-card">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&h=600&fit=crop"
                        alt="Swimming" class="course-image">
                    <span class="course-badge">Popular</span>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Swimming</h3>
                    <p class="course-description">
                        Master the art of swimming with professional techniques. From beginners to advanced swimmers,
                        improve your strokes, breathing, and endurance in our state-of-the-art pools.
                    </p>
                    <div class="course-meta">
                        <span class="course-duration">8 weeks program</span>
                        <span class="course-link">Learn More</span>
                    </div>
                </div>
            </a>

            <!-- YOGA COURSE -->
            <a href="course-yoga.php" class="course-card">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&h=600&fit=crop" alt="Yoga"
                        class="course-image">
                    <span class="course-badge">Bestseller</span>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Yoga</h3>
                    <p class="course-description">
                        Find your inner peace and flexibility through ancient yoga practices. Build strength,
                        improve posture, and achieve mental clarity with our certified yoga instructors.
                    </p>
                    <div class="course-meta">
                        <span class="course-duration">6 weeks program</span>
                        <span class="course-link">Learn More</span>
                    </div>
                </div>
            </a>

            <!-- PILATES COURSE -->
            <a href="course-pilates.php" class="course-card">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?w=800&h=600&fit=crop"
                        alt="Pilates" class="course-image">
                    <span class="course-badge">New</span>
                </div>
                <div class="course-content">
                    <h3 class="course-title">Pilates</h3>
                    <p class="course-description">
                        Strengthen your core and improve body alignment with controlled Pilates movements.
                        Perfect for rehabilitation, toning, and developing long, lean muscles.
                    </p>
                    <div class="course-meta">
                        <span class="course-duration">10 weeks program</span>
                        <span class="course-link">Learn More</span>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <a href="all-courses.php" class="cta-button">View All Courses</a>
    </section>

</body>
<?php //include '../pages/footer.php'; 
?>
<?php require ROOT . '/pages/footer.php'; ?>



</html>