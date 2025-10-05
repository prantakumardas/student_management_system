
<?php
session_start();

// Allow only students
if (!isset($_SESSION['username']) || $_SESSION['usertype'] != 'student') {
    header("Location: login.php");
    exit();
}


// Check if a message exists
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    
    // Show alert
    echo "<script type='text/javascript'>alert('$message');</script>";
    
    // Remove message after showing it
    unset($_SESSION['message']);
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Online Admission - Upskill</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    main {
      flex: 1;
    }
    /* Fix for your custom classes */
    .adm_int {
      margin-bottom: 1rem;
    }
    .label_text {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
    }
    .input_deg,
    .input_txt {
      width: 100%;
      padding: 0.6rem;
      border: 1px solid #ced4da;
      border-radius: 0.375rem;
      font-size: 1rem;
    }
    .input_txt {
      min-height: 120px;
      resize: vertical;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.html">Upskill</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
          <li class="nav-item"><a class="nav-link active" href="admission_form.php">Admission</a></li>


          <?php if ($_SESSION['usertype']=='admin') { ?>
          <li class="nav-item"><a class="nav-link" href="adminhome.php">Deshboard</a></li>
          <?php } elseif($_SESSION['usertype'] == 'student') { ?>
          <li class="nav-item"><a class="nav-link" href="student_profile.php">Student Profile</a></li>
          <?php } ?>

          <?php if (isset($_SESSION['username'])) { ?>
          <li class="nav-item"><a class="btn btn-danger ms-2" href="logout.php">Logout</a></li>
          <?php } else { ?>
          <li class="nav-item"><a class="btn btn-success ms-2" href="login.php">Login</a></li>
          <?php } ?>
                 
        </ul>
      </div>
    </div>
  </nav>

  <!-- Admission Form Section -->
  <main class="py-5" style="margin-top: 70px;">
    <div class="container">
      <h2 class="fw-bold mb-4 text-center">Online Admission Form</h2>
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body p-4">
              
              <form action="data_check.php" method="POST">
                
                <div class="adm_int">
                  <label class="label_text">Name</label>
                  <input class="input_deg" type="text" name="name" required>
                </div>

                <div class="adm_int">
                  <label class="label_text">Email</label>
                  <input class="input_deg" type="email" name="email" required>
                </div>

                <div class="adm_int">
                  <label class="label_text">Phone</label>
                  <input class="input_deg" type="tel" name="phone" required>
                </div>

                <div class="adm_int">
                  <label class="label_text">Message</label>
                  <textarea class="input_txt" name="message"></textarea>
                </div>

                <div class="adm_int">
                  <input class="btn btn-primary" id="submit" type="submit" value="Apply" name="apply">
                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3 mt-auto">
    <p class="mb-0">© Upskill - All rights reserved</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
