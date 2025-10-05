<?php
session_start();
?>

<?php
error_reporting(0); // Turn off all error reporting
ini_set('display_errors', 0); // Do not display errors in the browser
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact Us - Upskill</title>
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
          <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
          <li class="nav-item"><a class="nav-link" href="admission_form.php">Admission</a></li>

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

  <!-- Contact Section -->
  <main class="py-5" style="margin-top: 70px;">
    <div class="container">
      <h2 class="fw-bold mb-4 text-center">Contact Us</h2>
      <div class="row justify-content-center g-4">
        <!-- Contact Info / Map -->
        <div class="col-lg-6 col-md-8">
          <div class="card shadow-sm h-100 p-4 text-center">
            <h5 class="fw-bold mb-3">Get in Touch</h5>
            <p><strong>Address:</strong> 123 Upskill Street, City, Country</p>
            <p><strong>Email:</strong> contact@upskill.com</p>
            <p><strong>Phone:</strong> +123 456 7890</p>
            <!-- Optional Map Placeholder -->
            <div class="mt-3 d-flex align-items-center justify-content-center" style="height: 250px; background-color: #e9ecef;">
              <span class="text-muted">Map Placeholder</span>
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
