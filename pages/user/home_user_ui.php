 <?php
    include 'header_user.php'; //!!!!!!!!!!!!!
    ?>
 <!DOCTYPE html>
 <html lang="pl">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>.Fit - Transform Your Life</title> <!-- HOME PAGE CSS -->
     <link rel="stylesheet" href="<?= asset('css/home_user_ui.css') ?>">

     <!-- FOR ICON-BTNS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <!-- This styke for for comment scrool  -->
     <style>
         .comments-overlay {
             position: fixed;
             inset: 0;
             background: rgba(0, 0, 0, 0.7);
             display: flex;
             align-items: center;
             justify-content: center;
             z-index: 9999;
         }

         .comments-overlay.hidden {
             display: none;
         }

         .comments-box {
             background: #2b2b2b;
             color: #fff;
             width: 420px;
             max-height: 80vh;
             border-radius: 16px;
             padding: 20px;
             display: flex;
             flex-direction: column;
         }

         .comments-list {
             flex: 1;
             /* take remaining space */
             overflow-y: auto;
             /* scroll INSIDE popup */
             margin: 15px 0;
         }

         .comment-item {
             background: #3a3a3a;
             border-radius: 12px;
             padding: 12px;
             margin-bottom: 10px;
         }

         .comment-user {
             font-weight: 600;
         }

         .comment-stars {
             color: gold;
             font-size: 14px;
         }

         .comment-date {
             font-size: 12px;
             opacity: 0.6;
         }

         .close-btn {
             border: none;
             background: #d6d3c8;
             color: #000;
             padding: 10px;
             border-radius: 20px;
             cursor: pointer;
         }
     </style>
 </head>


 <body>
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
                $user_id = $_SESSION['id'] ?? 0;
                if ($search !== '') {
                    // SEARCH HAS VALUE → filter
                    _select(
                        $stmt,
                        $count,
                        "SELECT id, name, description, duration, badge, price, difficulty
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
                        $price,
                        $difficulty
                    );
                } else {t(
                        $stmt,
                        $count,
                        "SELECT
        c.id,
        c.name,
        c.description,
        c.duration,
        c.badge,
        c.price,
        c.difficulty,
        f.id AS fav_id
     FROM courses c
     LEFT JOIN favorites f
        ON f.course_id = c.id
       AND f.user_id = ?
     ORDER BY c.created_at DESC",
                        "i",
                        [$user_id],
                        $id,
                        $name,
                        $description,
                        $duration,
                        $badge,
                        $price,
                        $difficulty,
                        $fav_id
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

                                 <a href="<?= url('user/learn_more?id=' . $id) ?>" class="learn-more">
                                     LEARN MORE →
                                 </a>

                                 <a href="#" class="icon-btn fav-btn" data-id="<?= $id ?>">
                                     <i class="<?= $is_fav ? 'fa-solid' : 'fa-regular' ?> fa-heart"></i>
                                 </a>

                                 <!-- Coment scrool view -->

                                 <!--  <a href="javascript:void(0)" class="icon-btn comment-btn" data-course="<?= $id ?>">
                                 </a> -->
                                 <a href="javascript:void(0)" class="icon-btn comment-btn" data-course="<?= $id ?>">
                                     <i class="fa-regular fa-comment"></i>
                                 </a>

                                 <!-- btn-view-details == ENROLL btn -->
                                 <a href="<?= url('user/add_to_enroll') ?>" class="icon-btn">
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
     <!-- for comments scrool -->

     <div id="commentsModal" class="comments-overlay hidden">
         <div class="comments-box">
             <h3>Comments</h3>
             <div id="commentsList" class="comments-list"></div>
             <button id="closeComments" class="close-btn">Close</button>
         </div>
     </div>

     <!-- search  end-->
     <!-- CTA SECTION -->
     <section class="cta-section"> <a href="<?= url('all-courses') ?>" class="cta-button">View All Courses</a>
     </section>
     <?php require ROOT . '../pages/footer.php'; ?>

     <!-- script for comment btn -->

     <script>
         document.addEventListener('DOMContentLoaded', function() {

             const modal = document.getElementById('commentsModal');
             const box = modal.querySelector('.comments-box');
             const list = document.getElementById('commentsList');
             const close = document.getElementById('closeComments');

             function openModal(html) {
                 list.innerHTML = html;
                 modal.classList.remove('hidden');
                 document.body.style.overflow = 'hidden'; // disable scroll background
             }

             function closeModal() {
                 modal.classList.add('hidden');
                 document.body.style.overflow = ''; // restore scroll bground
             }

             // open comments
             document.querySelectorAll('.comment-btn').forEach(btn => {
                 btn.addEventListener('click', function(e) {
                     e.preventDefault();

                     const courseId = this.dataset.course;
                     if (!courseId) return;

                     fetch('<?= url("user/comment_scroll") ?>?course_id=' + courseId)
                         .then(res => res.text())
                         .then(html => openModal(html))
                         .catch(err => console.error(err));
                 });
             });

             // close via button
             close.addEventListener('click', closeModal);

             // close when clicking outside the popup
             modal.addEventListener('click', function() {
                 closeModal();
             });

             // prevent closing when clicking inside the popup
             box.addEventListener('click', function(e) {
                 e.stopPropagation();
             });

         });
     </script>


     <!-- script for fevo btn -->
     <script>
         document.addEventListener('DOMContentLoaded', () => {
             document.querySelectorAll('.fav-btn').forEach(btn => {
                 btn.addEventListener('click', function(e) {
                     e.preventDefault();

                     const icon = this.querySelector('i');
                     const courseId = this.dataset.id;

                     fetch('/user/add_to_fevo.php', {
                             method: 'POST',
                             headers: {
                                 'Content-Type': 'application/x-www-form-urlencoded'
                             },
                             credentials: 'same-origin',
                             body: 'id=' + courseId
                         })
                         .then(res => res.text())
                         .then(result => {
                             if (result === 'added') {
                                 icon.classList.remove('fa-regular');
                                 icon.classList.add('fa-solid');
                             } else if (result === 'removed') {
                                 icon.classList.remove('fa-solid');
                                 icon.classList.add('fa-regular');
                             }
                         });
                 });
             });
         });
     </script>

 </body>

 </html>