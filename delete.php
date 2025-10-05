<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";
$data = mysqli_connect($host, $user, $password, $db);

if (!$data) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_GET['student_id'])) {
    $user_id = $_GET['student_id'];
    $sql = "DELETE FROM user WHERE id='$user_id'";
    $result = mysqli_query($data, $sql);

    if ($result) {
        header("Location: view_student.php");
        exit();
    }
}
?>
