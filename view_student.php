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

// Fetch students
$sql = "SELECT * FROM user WHERE usertype = 'student'";
$result = mysqli_query($data, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Students</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="deshboard.css"> <!-- use student/admin dashboard CSS -->
</head>
<body>

<?php include "admin_sidebar.php"; ?>

<!-- Main content -->
<main class="content mt-5 container-fluid">
    <h3 class="mb-4 font-weight-bold">👨‍🎓 Student Data</h3>

    <div class="table-responsive card shadow p-3">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Password</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($info = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= htmlspecialchars($info['id']) ?></td>
                    <td><?= htmlspecialchars($info['username']) ?></td>
                    <td><?= htmlspecialchars($info['email']) ?></td>
                    <td><?= htmlspecialchars($info['phone']) ?></td>
                    <td><?= htmlspecialchars($info['password']) ?></td>
                    <td>
                        <a href="delete.php?student_id=<?= $info['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
