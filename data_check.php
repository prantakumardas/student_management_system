<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "schoolproject";

// connect to DB
$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("Connection error: " . mysqli_connect_error());
}

// check if form is submitted
if (isset($_POST['apply'])) {
    $data_name    = trim($_POST['name']);
    $data_email   = trim($_POST['email']);
    $data_phone   = trim($_POST['phone']);
    $data_message = trim($_POST['message']);

    // validation
    if ($data_name == "" || $data_email == "" || $data_phone == "" || $data_message == "") {
        $_SESSION['message'] = "All fields are required!";
        $_SESSION['message_type'] = "error";
    } else {
        $sql = "INSERT INTO admission (name, email, phone, message) 
                VALUES (?, ?, ?, ?)";
        $stmt = $data->prepare($sql);
        $stmt->bind_param("ssss", $data_name, $data_email, $data_phone, $data_message);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Your application was sent successfully!";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Application failed: " . $stmt->error;
            $_SESSION['message_type'] = "error";
        }
    }

    header("Location: admission_form.php");
    exit();
}
?>
