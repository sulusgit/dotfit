 <?php
    include 'header_user.php';
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
         /* ennroll btn status */

         /* BASE BUTTON STYLE */
         .enroll-btn {
             display: inline-flex;
             align-items: center;
             gap: 6px;
             font-size: 13px;
             font-weight: 600;
             padding: 6px 14px;
             border-radius: 20px;
             border: none;
             text-decoration: none;
             white-space: nowrap;
             line-height: 1;
             transition: all 0.2s ease;
         }

         /* ENROLL (default) */
         .enroll-btn.enroll {
             color: #fff;
         }


         .enroll-btn.enroll:hover {
             background: #333;
         }

         /* REQUESTED */
         .enroll-btn.requested {
             background: #333;
             color: #fff;
             cursor: default;
         }

         .enroll-btn.requested .dot {
             width: 8px;
             height: 8px;
             border-radius: 50%;
             background: #999;
             animation: pulse 1.5s infinite;
         }

         /* ENROLLED */
         .enroll-btn.enrolled {
             background: #333;
             color: #ccc;
             cursor: default;
         }

         .enroll-btn.enrolled .dot {
             width: 8px;
             height: 8px;
             border-radius: 50%;
             background: #666;
         }

         /* PULSE ANIMATION */
         @keyframes pulse {
             0% {
                 transform: scale(1);
                 opacity: 0.6;
             }

             50% {
                 transform: scale(1.4);
                 opacity: 1;
             }

             100% {
                 transform: scale(1);
                 opacity: 0.6;
             }
         }

         /* MOBILE RESPONSIVE */
         @media (max-width: 768px) {
             .enroll-btn {
                 font-size: 12px;
                 padding: 5px 12px;
                 gap: 4px;
             }

             .enroll-btn .dot {
                 width: 6px;
                 height: 6px;
             }
         }

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
     <!-- COURSES SECTION -->
     <!--start  search try -->
     <section class="courses">
         <div class="section-header">

             <h2 class="section-title">Your Fevorited Courses </h2>

         </div>
         <div class="courses-grid">
             <!-- last 4 gets new badge -->
             <?php
                $newCourseIds = [];

                _selectAll(
                    $stmtNew,
                    $cntNew,
                    "SELECT id
     FROM courses
     ORDER BY created_at DESC
     LIMIT 4",
                    $new_id
                );

                while (_fetch($stmtNew)) {
                    $newCourseIds[] = $new_id;
                }

                _close_stmt($stmtNew);
                ?>

             <?php
                $search  = trim($_GET['search'] ?? '');
                $user_id = (int) ($_SESSION['id'] ?? 0);

                /*
 | Build SQL for favorites page
 | - ALWAYS favorites only (INNER JOIN)
 | - Optional search
 */
                $sql = "
    SELECT
        c.id,
        c.name,
        c.image,
        c.description,
        c.duration,
        c.badge,
        c.price,
        c.difficulty
    FROM courses c
    INNER JOIN favorites f
        ON f.course_id = c.id
       AND f.user_id = ?
";

                $params = [$user_id];
                $types  = 'i';

                if ($search !== '') {
                    $sql .= " AND c.name LIKE ? ";
                    $params[] = "%$search%";
                    $types   .= 's';
                }

                $sql .= " ORDER BY c.created_at DESC";

                /* run query */
                _select(
                    $stmt,
                    $count,
                    $sql,
                    $types,
                    $params,
                    $id,
                    $name,
                    $image,
                    $description,
                    $duration,
                    $badge,
                    $price,
                    $difficulty
                );
                ?>

             <?php if ($count > 0): ?>
                 <?php while (_fetch($stmt)): ?>
                     <?php $is_new = in_array($id, $newCourseIds); ?>

                     <?php
                        /* check enroll status */
                        $enroll_status = null;

                        _selectRow(
                            $stmt2,
                            $count2,
                            "SELECT status FROM enroll_requests WHERE user_id=? AND course_id=?",
                            "ii",
                            [$user_id, $id],
                            $status
                        );

                        if ($count2 > 0) {
                            $enroll_status = $status; // pending | approved | rejected
                        }
                        ?>



                     <!-- TO CHECK EVERY COURSE ENROLLS -->


                     <!-- COURSE CARD -->
                     <div class="course-card">

                         <div class="course-image-wrapper <?= $is_new ? 'has-new' : '' ?>">
                             <a href="<?= url('user/learn_more?id=' . $id) ?> id=<?= $id ?>" class="course-image-wrapper">
                                 <img src="<?= $image ?>" alt="course_images" class="course-image">
                             </a>

                             <?php if ($is_new): ?>
                                 <span class="course-badge new">NEW</span>
                             <?php endif; ?>

                             <span class="course-difficulty">
                                 <?= $difficulty ?>
                             </span>

                         </div>

                         <div class="course-content">
                             <h3 class="course-title"><?= $name ?></h3>
                             <p class="course-description"> <?= $description ?> </p>


                             <div class="meta-actions">

                                 <a href="<?= url('user/learn_more?id=' . $id) ?>" class="learn-more">
                                     LEARN MORE →
                                 </a>

                                 <!-- FEVO WITH ACTION -->
                                 <a href="javascript:void(0)" class="icon-btn fav-btn active" data-id="<?= (int)$id ?>">
                                     <i class="fa-solid fa-heart"></i>
                                 </a>

                                 <!--comment btn -->
                                 <a href="javascript:void(0)" class="icon-btn comment-btn" data-course="<?= $id ?>">
                                     <i class="fa-regular fa-comment"></i>
                                 </a>
                                 <!-- ENTROLL BTN WITH STATUS -->
                                 <?php if ($enroll_status === 'pending'): ?>

                                     <button class="enroll-btn requested" data-course="<?= $id ?>">
                                         Requested
                                     </button>

                                 <?php elseif ($enroll_status === 'approved'): ?>

                                     <button class="enroll-btn approved" disabled>
                                         Enrolled
                                     </button>

                                 <?php else: ?>
                                     <a href="<?= url('user/add_to_enroll?course_id=' . $id) ?>" class="enroll-btn enroll">
                                         ENROLL
                                     </a>
                                 <?php endif; ?>

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
     <?php require ROOT . '../pages/footer.php'; ?>

     <!-- for entroll btn controll -->

     <script>
         document.addEventListener('DOMContentLoaded', () => {
             document.querySelectorAll('.enroll-btn.requested').forEach(btn => {
                 btn.addEventListener('click', () => {
                     if (!confirm('Cancel enrollment request?')) return;

                     fetch('<?= url("user/enroll_cancel") ?>', {
                             method: 'POST',
                             headers: {
                                 'Content-Type': 'application/x-www-form-urlencoded'
                             },
                             body: 'course_id=' + btn.dataset.course
                         })
                         .then(() => location.reload());
                 });
             });
         });
     </script>

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
                 btn.addEventListener('click', e => {
                     e.preventDefault();

                     fetch('<?= url("user/toggle_fevo_btn") ?>', {
                             method: 'POST',
                             headers: {
                                 'Content-Type': 'application/x-www-form-urlencoded'
                             },
                             body: 'course_id=' + btn.dataset.id
                         })
                         .then(res => res.text())
                         .then(result => {
                             if (result === 'added') {
                                 btn.classList.add('active');
                             }
                             if (result === 'removed') {
                                 btn.classList.remove('active');
                             }
                         });
                 });
             });
         });
     </script>

 </body>

 </html>