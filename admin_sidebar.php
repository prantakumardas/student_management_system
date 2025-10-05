
<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) die("Connection error: " . mysqli_connect_error());

$username = $_SESSION['username'];
$admin_query = mysqli_query($data, "SELECT * FROM user WHERE username='$username' LIMIT 1");
$admin = mysqli_fetch_assoc($admin_query);

?>

<!-- Sidebar toggle -->
<input type="checkbox" id="sidebar-toggle">
<label for="sidebar-toggle" class="toggle-btn">&#9776;</label>

<!-- Sidebar -->
<aside class="sidebar d-flex flex-column align-items-center p-3">
    <img src="profile.png" class="profile rounded-circle mb-2" alt="Profile">
    <h6 class="text-white"><?= htmlspecialchars($admin['username']) ?></h6>
    <ul class="sidebar-menu list-unstyled w-100 mt-4">
        <li class="active"><a href="adminhome.php">&#127968; Home</a></li>
        <li><a href="admission.php" class="text-danger">Admission</a></li>
        <li><a href="add_student.php" class="text-danger">Add Student</a></li>
        <li><a href="enroll_student.php" class="text-danger">Enroll Student</a></li>
        <li><a href="view_student.php" class="text-danger">View Student</a></li>
        <li><a href="add_course.php" class="text-danger">Add Courses</a></li>
        <li><a href="view_course.php" class="text-danger">View Courses</a></li>
        <li><a href="logout.php" class="text-danger">🚪 Logout</a></li>
    </ul>
</aside>