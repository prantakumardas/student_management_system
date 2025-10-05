<?php
session_start();

// Allow only admin
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'admin') {
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

$username = $_SESSION['username'];
$admin_query = mysqli_query($data, "SELECT * FROM user WHERE username='$username' LIMIT 1");
$admin = mysqli_fetch_assoc($admin_query);
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
    <h3 class="mb-4 font-weight-bold">👤 Admin Profile</h3>

    <!-- Admin Info -->
    <div class="card mb-4 shadow">
        <div class="card-body">
            <h5><?= htmlspecialchars($admin['username']) ?></h5>
            <p><strong>Email:</strong> <?= htmlspecialchars($admin['email']) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($admin['phone']) ?></p>
            <p><strong>User Type:</strong> <?= htmlspecialchars($admin['usertype']) ?></p>
        </div>
    </div>

    <!-- Optional Section: Summary -->
    <div class="card shadow">
        <div class="card-body">
            <h5 class="mb-3">📊 Dashboard Summary</h5>
            <p>Use the sidebar to manage Admissions, Students, and Courses.</p>
        </div>
    </div>
</main>

</body>
</html>
