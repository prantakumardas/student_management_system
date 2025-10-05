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

if (!$data) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_POST['add_student'])) {
    // Get and trim form inputs
    $username      = trim($_POST['name']);
    $user_email    = trim($_POST['email']);
    $user_phone    = trim($_POST['phone']);
    $user_password = trim($_POST['password']);
    $usertype      = "student";

    //Validation ===
    if (empty($username) || empty($user_email) || empty($user_phone) || empty($user_password)) {
        echo "<script>alert('All fields are required. Please fill them in.');</script>";
    } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Please enter a valid email address.');</script>";
    }else {

        // Check if username already exists
        $check = "SELECT * FROM user WHERE username = '$username' OR email = '$user_email' LIMIT 1";
        $check_user = mysqli_query($data, $check);

        if (mysqli_num_rows($check_user) > 0) {
            echo "<script>alert('Username or Email already exists. Please choose another.');</script>";
        } else {
            // Insert into database
            $sql = "INSERT INTO user (username, email, phone, usertype, password) 
                    VALUES ('$username', '$user_email', '$user_phone', '$usertype', '$user_password')";
            
            $result = mysqli_query($data, $sql);

            if ($result) {
                echo "<script>alert('Student added successfully!');</script>";
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

    <!-- Add Student Section -->
    <!-- Add Student Form -->
    <div class="card shadow p-4">
        <h4 class="mb-3">➕ Add Student</h4>

        <?php if(!empty($message)) { ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php } ?>

        <form action="#" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="name" class="form-control" placeholder="Enter student username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter student email">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone" class="form-control" placeholder="Enter phone number">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" placeholder="Enter password">
            </div>
            <button type="submit" name="add_student" class="btn btn-primary mt-2">Add Student</button>
        </form>
    </div>
</main>

</body>
</html>
