<?php
session_start();

// Only allow admin access
if (!isset($_SESSION['username']) || $_SESSION["usertype"] != "admin") {
    header("Location: login.php");
    exit();
}



// Database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection error: " . mysqli_connect_error());
}

$message = "";

// Fetch students
$students = mysqli_query($data, "SELECT id, username FROM user WHERE usertype='student'");

// Fetch courses
$courses = mysqli_query($data, "SELECT course_id, course_name FROM courses");

// Handle form submission
if (isset($_POST['enroll'])) {
    $student_id = $_POST['student_id'];
    $course_id  = $_POST['course_id'];

    if (empty($student_id) || empty($course_id)) {
        $message = "Please select both a student and a course.";
    } else {
        // Prevent duplicate enrollment
        $check = mysqli_query($data, "SELECT * FROM student_course WHERE student_id='$student_id' AND course_id='$course_id'");
        if (mysqli_num_rows($check) > 0) {
            $message = " Student is already enrolled in this course.";
        } else {
            $sql = "INSERT INTO student_course (student_id, course_id) VALUES ('$student_id', '$course_id')";
            $result = mysqli_query($data, $sql);

            if ($result) {
                $message = "Student enrolled successfully!";
            } else {
                $message = "Error: " . mysqli_error($data);
            }
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="deshboard.css"> <!-- use the student dashboard CSS -->

</head>
<body>


<?php
    include "admin_sidebar.php"
?>


<!-- Main content -->
<main class="content mt-5 container-fluid">

    <!-- Enroll Student Section -->
    <div class="card shadow p-4">
        <h4 class="mb-3">🎓 Enroll Student into a Course</h4>

        <?php if (!empty($message)) { ?>
            <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
        <?php } ?>

        <form method="POST">
            <div class="form-group">
                <label>Select Student</label>
                <select name="student_id" class="form-control" required>
                    <option value="">-- Choose Student --</option>
                    <?php while ($s = mysqli_fetch_assoc($students)) { ?>
                        <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['username']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Select Course</label>
                <select name="course_id" class="form-control" required>
                    <option value="">-- Choose Course --</option>
                    <?php while ($c = mysqli_fetch_assoc($courses)) { ?>
                        <option value="<?= $c['course_id'] ?>"><?= htmlspecialchars($c['course_name']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" name="enroll" class="btn btn-success mt-2">Enroll</button>
            <a href="view_course.php" class="btn btn-secondary mt-2">Back to Courses</a>
        </form>
    </div>
</main>

</body>
</html>


