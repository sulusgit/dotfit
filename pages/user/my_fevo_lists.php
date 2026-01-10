my fevorite /liked course lists
<!--  session_start();
require '../db.php';

$user_id   = $_SESSION['user_id'];
$course_id = $_POST['id'];

$stmt = $con->prepare("INSERT IGNORE INTO favorites (user_id, course_id) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $course_id);
$stmt->execute();  -->