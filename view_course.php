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
if (!$data) die("Connection error: " . mysqli_connect_error());

// Fetch all courses
$sql = "SELECT * FROM courses ORDER BY course_id ASC";
$result = mysqli_query($data, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Courses</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="deshboard.css"> <!-- admin/student dashboard CSS -->
</head>
<body>



<?php include "admin_sidebar.php"; ?>

<!-- Main content -->
<main class="content mt-5 container-fluid">
    <h3 class="mb-4 font-weight-bold">📚 Course Data</h3>

    <div class="table-responsive card shadow p-3">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Course Name</th>
                    <th>Course Code</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['course_id']) ?></td>
                    <td><?= htmlspecialchars($row['course_name']) ?></td>
                    <td><?= htmlspecialchars($row['course_code']) ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
