<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>.Fit - Transform Your Life</title> <!-- HOME PAGE CSS -->
    <link rel="stylesheet" href="<?= asset('/css/home_user_ui.css') ?>">

    <!-- FOR ICON-BTNS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php
    include 'header_user.php'; //!!!!!!!!!!!!!
    ?>
    <!-- Main title section -->
    <section class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Just Do It</h1>
            <p class="hero-subtitle">Transform your body and mind with our premium fitness courses</p>
        </div>
    </section>

    <!-- COURSES SECTION -->
    <!--start  search try -->
    <section class="courses">
        <div class="section-header">
            <p class="section-label">Our Courses</p>
            <h2 class="section-title">Choose Your Journey</h2>
            <p class="section-description">Expert-led programs designed to help you achieve your fitness goals</p>
        </div>
        <div class="courses-grid">

            <?php
            $search = trim($_GET['search'] ?? '');

            if ($search !== '') {
                // SEARCH HAS VALUE → filter
                _select(
                    $stmt,
                    $count,
                    "SELECT id, name, description, duration, badge, price
                    FROM courses
                    WHERE name LIKE ?
                    ORDER BY created_at DESC",
                    's',
                    ["%$search%"],
                    $id,
                    $name,
                    $description,
                    $duration,
                    $badge,
                    $price
                );
            } else {
                // SEARCH EMPTY → show all
                _selectAll(
                    $stmt,
                    $count,
                    "SELECT id, name, description, duration, badge, price FROM courses ORDER BY created_at DESC",
                    $id,
                    $name,
                    $description,
                    $duration,
                    $badge,
                    $price
                );
            }

            if ($count > 0):
                while (_fetch($stmt)): ?>
            <!-- COURSE CARD -->
            <div class="course-card">
                <div class="course-image-wrapper">
                    <a href="<?= url('/course_details') ?> id=<?= $id ?>" class="course-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1530549387789-4c1017266635?w=800&h=600&fit=crop"
                            alt="<?= $name ?>" class="course-image">
                    </a>
                    <span class="course-badge"><?= $badge ?></span>
                    <span class="course-difficulty"><?= $difficulty ?></span>
                </div>

                <div class="course-content">
                    <h3 class="course-title"><?= $name ?></h3>
                    <p class="course-description"> <?= $description ?> </p>


                    <div class="meta-actions">

                        <a href="<?= url('/user/learn_more') ?>" class="learn-more">
                            LEARN MORE →
                        </a>

                        <a href="#" class="icon-btn fav-btn" data-id="<?= $id ?>">
                            <i class="fa-regular fa-heart"></i>
                        </a>
                        <script>
                        document.querySelectorAll('.fav-btn').forEach(btn => {
                            btn.addEventListener('click', function(e) {
                                e.preventDefault(); // STOP redirect

                                const icon = this.querySelector('i');
                                const courseId = this.dataset.id;

                                // toggle heart visually
                                icon.classList.toggle('fa-regular');
                                icon.classList.toggle('fa-solid');

                                // save in backend
                                fetch('/user/add_to_fevo.php', { //!!!!!!!!!!!!!!!
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                    },
                                    body: 'id=' + courseId
                                });
                            });
                        });
                        </script>

                        <a href="<?= url('/user/comment_scroll') ?>" class="icon-btn">
                            <i class="fa-regular fa-comment"></i>
                        </a>
                        <!-- btn-view-details == ENROLL btn -->
                        <a href="<?= url('/user/add_to_enroll') ?>" class="icon-btn">
                            <i class="fa-solid fa-circle-plus"></i> <span class="tooltip">Enroll</span>
                        </a>

                    </div>
                </div>
            </div>
            <?php endwhile;
            else:
                echo "NO COURSES FOUND";
            endif;

            _close_stmt($stmt);
            ?>
        </div>
    </section>

    <!-- search try  end-->




    <!-- CTA SECTION -->
    <section class="cta-section"> <a href="all-courses.php" class="cta-button">View All Courses</a> </section>
    <?php require ROOT . '../pages/footer.php'; ?>
</body>

</html>