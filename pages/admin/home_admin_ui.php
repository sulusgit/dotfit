   <?php require "header_admin.php";

    ?>
   <!-- HTML -->
   <!DOCTYPE html>
   <html lang="pl">

   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">

       <!-- HEADER CSS -->
       <link rel="stylesheet" href="<?= asset('/css/admin_home.css') ?>">
       <link rel="stylesheet" href="<?= asset('/css/home_user_ui.css') ?>">

       <!-- FOOTER CSS -->
       <link rel="stylesheet" href="<?= asset('/footer.css') ?>">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
       <script>
       function toggleMenu(e, id) {
           e.stopPropagation(); // prevents card click const 
           menu = document.getElementById('menu-' + id);
           menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
       } // close menu when clicking elsewhere document.
       addEventListener('click', () => {
           document.querySelectorAll('.menu-dropdown').forEach(m => m.style.display = 'none');
       });
       </script>
   </head>
   <style>
.errorss {
    background-color: aqua;
}
   </style>



   <body>

       <div class="errorss">
           <?php if (!empty($_SESSION['errors'])): ?>
           <div class="alert alert-danger" role="alert">
               <ul class="mb-0">
                   <?php foreach ($_SESSION['errors'] as $error): ?>
                   <li><?= $error ?></li>
                   <?php endforeach; ?>
               </ul>
           </div>
           <?php unset($_SESSION['errors']);
            endif; ?>

           <?php if (!empty($_SESSION['messages'])): ?>
           <div class="alert alert-primary" role="alert">
               <ul class="mb-0">
                   <?php foreach ($_SESSION['messages'] as $message): ?>
                   <li><?= $message ?></li>
                   <?php endforeach; ?>
               </ul>
           </div>
           <?php unset($_SESSION['messages']);
            endif; ?>
       </div>

       <!-- COURSES SECTION -->
       <section class="courses">

           <h2>My Courses list</h2>
           <div class="courses-grid">
               <?php
                $search = trim($_GET['search'] ?? '');
                $admin_id = $_SESSION['id'];



                if ($search !== '') {
                    _select(
                        $stmt,
                        $count,
                        "SELECT id, image, name, description, duration, badge, price, difficulty
         FROM courses
         WHERE create_admin_id = ?
           AND name LIKE ?
         ORDER BY created_at DESC",
                        'is',
                        [$admin_id, "%$search%"],
                        $id,
                        $image,
                        $name,
                        $description,
                        $duration,
                        $badge,
                        $price,
                        $difficulty
                    );
                } else {
                    _select(
                        $stmt,
                        $count,
                        "SELECT id, image, name, description, duration, badge, price, difficulty
         FROM courses
         WHERE create_admin_id = ?
         ORDER BY created_at DESC",
                        'i',
                        [$admin_id],
                        $id,
                        $image,
                        $name,
                        $description,
                        $duration,
                        $badge,
                        $price,
                        $difficulty
                    );
                }

                if ($count > 0):
                    while (_fetch($stmt)): ?>

               <!-- SWIMMING COURSE -->
               <div class="course-card">
                   <div class="course-image-wrapper">
                       <div class="card-menu">
                           <!-- was in local like this  <a href="/admin/courses/edit_course?id=<?= $id ?>"> -->

                           <a href="<?= url('admin/courses/edit_course') ?>?id=<?= $id ?>" class="menu-item">
                               Edit
                           </a>

                           <button type="button" class="menu-item danger" onclick="confirmDelete(
            <?= (int)$id ?>,
            '<?= htmlspecialchars((string)$name, ENT_QUOTES) ?>'
        )">
                               Delete
                           </button>
                       </div>


                       <span class="course-badge"><?= $badge ?></span>
                       <span class="course-difficulty"><?= $difficulty ?></span>
                       <img src="<?= $image ?>" alt="course_images" class="course-image">



                   </div>

                   <div class="course-content">
                       <h3 class="course-title"><?= $name ?></h3>
                       <p class="course-description"><?= $description ?></p>
                   </div>
               </div>

               <?php endwhile;
                else:
                    echo "NO COURSES FOUND";
                endif;

                _close_stmt($stmt);
                ?>

           </div>
           <script>
           function confirmDelete(id, name) {
               if (confirm(`Are you sure you want to delete this "${name}" course?`)) {
                   window.location.href =
                       "<?= url('admin/courses/delete_course') ?>" +
                       "?id=" + id +
                       "&name=" + encodeURIComponent(name);
               }
           }
           </script>


       </section>
       <!-- CTA SECTION -->
       <section class="cta-section"> <a href="" class="cta-button">View All Courses</a> </section>

       <?php require ROOT . '/pages/footer.php'; ?>



   </body>

   </html>