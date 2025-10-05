<?php
session_start();

// Only allow admin access
if (!isset($_SESSION['username']) || $_SESSION["usertype"] != "admin") {
    header("Location: login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db);
if (!$data) die("Connection error: " . mysqli_connect_error());

if (isset($_POST['add_course'])) {
    $name = trim($_POST['name']);
    $code = trim($_POST['code']);

    if (empty($name) || empty($code)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        $check = "SELECT * FROM courses WHERE course_name='$name' OR course_code='$code' LIMIT 1";
        $check_course = mysqli_query($data, $check);

        if (mysqli_num_rows($check_course) > 0) {
            echo "<script>alert('Course name or code already exists.');</script>";
        } else {
            $sql = "INSERT INTO courses (course_name, course_code) VALUES ('$name', '$code')";
            $result = mysqli_query($data, $sql);
            if ($result) {
                echo "<script>alert('Course added successfully!'); window.location.href='view_course.php';</script>";
            } else {
                echo "<script>alert('Database error: " . mysqli_error($data) . "');</script>";
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
<title>Add Course</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="deshboard.css"> <!-- Reuse student/admin CSS -->
<style>
.div_deg {
    background-color: #87ceeb;
    max-width: 500px;
    padding: 40px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

label {
    font-weight: bold;
}

input[type="text"], input[type="number"] {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
</style>
</head>
<body>

<?php include "admin_sidebar.php"; ?>

<!-- Main content -->
<main class="content mt-5 container-fluid">
    <h3 class="mb-4 text-center font-weight-bold">➕ Add Course</h3>
    <div class="d-flex justify-content-center">
        <div class="div_deg">
            <form method="POST" action="">
                <div>
                    <label>Course Name</label>
                    <input type="text" name="name" required>
                </div>
                <div>
                    <label>Course Code</label>
                    <input type="text" name="code" required>
                </div>
                <div class="text-center">
                    <input type="submit" class="btn btn-primary" name="add_course" value="Add Course">
                    <a href="view_course.php" class="btn btn-secondary">View Courses</a>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>
