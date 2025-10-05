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

$sql = "SELECT * FROM admission ORDER BY id DESC";
$result = mysqli_query($data, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admission Requests</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="deshboard.css"> <!-- Use student/admin dashboard CSS -->
<style>
.table-container {
    margin-top: 50px;
}
.table th, .table td {
    vertical-align: middle !important;
    text-align: center;
}
</style>
</head>
<body>

<?php include "admin_sidebar.php"; ?>

<main class="content container-fluid table-container">
    <h3 class="mb-4 text-center font-weight-bold">📋 Admission Requests</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0) { 
                    while($info = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($info['name']) ?></td>
                            <td><?= htmlspecialchars($info['email']) ?></td>
                            <td><?= htmlspecialchars($info['phone']) ?></td>
                            <td><?= htmlspecialchars($info['message']) ?></td>
                        </tr>
                <?php } 
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted">No admission requests found.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
