<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'student') {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) die("Connection error: " . mysqli_connect_error());

$username = $_SESSION['username'];
$student_query = mysqli_query($data, "SELECT * FROM user WHERE username='$username' LIMIT 1");
$student = mysqli_fetch_assoc($student_query);
$student_id = $student['id'];

$courses_query = "
    SELECT c.course_id, c.course_name, c.course_code
    FROM student_course sc
    JOIN courses c ON sc.course_id = c.course_id
    WHERE sc.student_id = '$student_id'
";
$courses = mysqli_query($data, $courses_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="deshboard.css"> <!-- include your CSS -->
</head>
<body>

  <!-- Sidebar toggle -->
  <input type="checkbox" id="sidebar-toggle">
  <label for="sidebar-toggle" class="toggle-btn">&#9776;</label>

  <!-- Sidebar -->
  <aside class="sidebar d-flex flex-column align-items-center p-3">
    <img src="profile.png" class="profile rounded-circle mb-2" alt="Profile">
    <h6 class="text-white"><?= htmlspecialchars($student['username']) ?></h6>
    <ul class="sidebar-menu list-unstyled w-100 mt-4">
      <li class="active"><a href="student_profile.php">&#127968; Home</a></li>
      <li><a href="logout.php" class="text-danger">🚪 Logout</a></li>
    </ul>
  </aside>

  <!-- Main content -->
  <main class="content mt-5 container-fluid">
    <h3 class="mb-4 font-weight-bold">👤 Student Profile</h3>

    <!-- Student Info -->
    <div class="card mb-4 shadow">
      <div class="card-body">
        <h5><?= htmlspecialchars($student['username']) ?></h5>
        <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($student['phone']) ?></p>
        <p><strong>User Type:</strong> <?= htmlspecialchars($student['usertype']) ?></p>
      </div>
    </div>

    <!-- Enrolled Courses -->
    <div id="courses" class="card shadow">
      <div class="card-body">
        <h5 class="mb-3">📚 My Courses</h5>
        <?php if (mysqli_num_rows($courses) > 0) { ?>
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead class="thead-light">
                <tr>
                  <th>Course Code</th>
                  <th>Course Name</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($c = mysqli_fetch_assoc($courses)) { ?>
                <tr>
                  <td><?= htmlspecialchars($c['course_code']) ?></td>
                  <td><?= htmlspecialchars($c['course_name']) ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        <?php } else { ?>
          <p class="text-muted">⚠️ You are not enrolled in any courses yet.</p>
        <?php } ?>
      </div>
    </div>
  </main>

</body>
</html>
