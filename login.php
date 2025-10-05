<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"> <!--  important for mobile -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('school2.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 15px; /*  spacing for small screens */
    }
    .form-container {
      background: rgba(255,255,255,0.95);
      padding: 25px;
      border-radius: 12px;
      box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 400px; /*  limits width on large screens */
    }
    @media (max-width: 576px) { /*  extra tweaks for mobile */
      .form-container {
        padding: 20px 15px;
      }
      h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h2 class="text-center mb-4">Login Form</h2>

    <!-- Show session message -->
    <?php if (isset($_SESSION['loginMessage'])) { ?>
      <div class="alert alert-danger text-center">
        <?php 
          echo $_SESSION['loginMessage'];  
          unset($_SESSION['loginMessage']); // clear message after showing
        ?>
      </div>
    <?php } ?>

    <form action="login_check.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="d-grid">
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
