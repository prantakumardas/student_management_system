
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
  <title>Student Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Course Card Hover Effect */
    .course-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .course-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
    .course-card img {
      transition: transform 0.3s ease;
    }
    .course-card:hover img {
      transform: scale(1.05);
    }

	/* Responsive font sizes Hero Section */
    @media (max-width: 576px) {
      h1 {
        font-size: 1.5rem !important;
      }
      p {
        font-size: 0.9rem !important;
      }
    }

    @media (min-width: 577px) and (max-width: 768px) {
      h1 {
        font-size: 2rem !important;
      }
      p {
        font-size: 1rem !important;
      }
    }

    @media (min-width: 769px) {
      h1 {
        font-size: 2.5rem !important;
      }
      p {
        font-size: 1.2rem !important;
      }
    }
	 /* Dark mode adjustments Admission Section */
  body.bg-dark #admission {
    background-color: #212529;
  }

  body.bg-dark #admissionTitle {
    color: #ffffff;
  }

  /* Optional: change button style in dark mode */
  body.bg-dark #applyBtn {
    background-color: #0d6efd;
    border-color: #0d6efd;
  }

  /* Padding for small devices */
  @media (max-width: 576px) {
    #admissionTitle {
      font-size: 1.5rem;
    }

    #applyBtn {
      font-size: 1rem;
      padding: 0.5rem 1rem;
    }
  }
  </style>

</head>
<body>

  <!-- Responsive Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">Upskill</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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

<!-- Hero Section with Overlay -->
<section class="position-relative">
  <!-- Background Image -->
  <img src="school_management.png" alt="School Management" class="img-fluid w-100" style="height: 60vh; object-fit: cover;">

  <!-- Dark Overlay -->
  <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.5);"></div>

  <!-- Overlay Text -->
  <div class="position-absolute top-50 start-50 translate-middle text-center px-3">
    <h1 class="text-white fw-bold mb-2" style="font-size: clamp(1.5rem, 4vw, 2.5rem);">
      Committed to Caring, Dedicated to Teaching
    </h1>
    <p class="text-white mb-3" style="font-size: clamp(0.9rem, 2.5vw, 1.2rem);">
      We nurture students' growth and creativity in a supportive learning environment.
    </p>
    <a href="admission_form.php" class="btn btn-primary btn-lg">Apply Now</a>
  </div>
</section>

  <!-- Welcome Section -->
  <section class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-4">
          <img src="school2.jpg" alt="Welcome" class="img-fluid rounded shadow">
        </div>
        <div class="col-md-8">
          <h1 class="fw-bold">Welcome to Upskill</h1>
          <p class="lead">We teach students with care, focusing on their individual growth and learning needs. Our dedicated educators create a supportive environment that encourages curiosity, confidence, and academic success.</p>
        </div>
      </div>
    </div>
  </section>

	<!-- Redesigned Teachers Section -->
	<section class="py-5 bg-light">
	<div class="container">
		<h2 class="fw-bold mb-4 text-center">Our Teachers</h2>
		<div class="row g-4">
		
		<div class="col-md-4">
			<div class="card h-100 text-center shadow-sm">
			<img src="teacher1.png" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="Teacher 1" style="width: 150px; height: 150px; object-fit: cover;">
			<div class="card-body">
				<h5 class="card-title">John Doe</h5>
				<p class="card-text">In a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.</p>
			</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card h-100 text-center shadow-sm">
			<img src="teacher2.png" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="Teacher 2" style="width: 150px; height: 150px; object-fit: cover;">
			<div class="card-body">
				<h5 class="card-title">Jane Smith</h5>
				<p class="card-text">In a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.</p>
			</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="card h-100 text-center shadow-sm">
			<img src="teacher3.png" class="card-img-top img-fluid rounded-circle mx-auto mt-3" alt="Teacher 3" style="width: 150px; height: 150px; object-fit: cover;">
			<div class="card-body">
				<h5 class="card-title">Robert Lee</h5>
				<p class="card-text">In a vibrant, academically challenging, and encouraging environment where manifold viewpoints are prized and celebrated.</p>
			</div>
			</div>
		</div>

		</div>
	</div>
	</section>


  <!-- Courses Section with Cards + Hover -->
  <section class="py-5">
    <div class="container">
      <h2 class="fw-bold mb-4 text-center">Our Courses</h2>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100 shadow-sm course-card">
            <img src="web.png" class="card-img-top p-3" alt="Web Development">
            <div class="card-body text-center">
              <h5 class="card-title">Web Development</h5>
              <p class="card-text">Learn to build modern, responsive websites and web applications with HTML, CSS, JavaScript, and frameworks.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm course-card">
            <img src="graphic.png" class="card-img-top p-3" alt="Graphics Design">
            <div class="card-body text-center">
              <h5 class="card-title">Graphics Design</h5>
              <p class="card-text">Master the principles of visual design and create stunning graphics with industry-standard tools and software.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow-sm course-card">
            <img src="marketing.png" class="card-img-top p-3" alt="Marketing">
            <div class="card-body text-center">
              <h5 class="card-title">Marketing</h5>
              <p class="card-text">Develop strategies to reach and engage audiences effectively using both digital and traditional marketing methods.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- Redesigned Admission Section -->
<section id="admission" class="py-5">
  <div class="container text-center">
    <h2 class="fw-bold mb-4" id="admissionTitle">Online Admission</h2>
    <a href="admission_form.php" class="btn btn-primary btn-lg" id="applyBtn">Apply Now</a>
  </div>
</section>



  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-3">
    <p class="mb-0">© Upskill - All rights reserved</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
