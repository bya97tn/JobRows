<?php
  session_start();
  $link = mysqli_connect("localhost", "id5480032_jobrows", "jobrows", "id5480032_jobrows");
            if (!$link) {
                echo "Error: Unable to connect to MySQL." . PHP_EOL;
                echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
                echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                exit;
              }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JobRows - About</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">JobRows</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="postdemand.php">Demand a Job</a>
            </li>
            <?php
            if(!isset($_SESSION['log']))
            {
              ?>
            <li class="nav-item">
              <a class="nav-link" href="signin.php">Sign In</a>
            </li>
            <?php
            }
            else
            {
              ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                echo "Hello, " . $_SESSION['user'];
                ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item" href="profile.php">My profile</a>
                <a class="dropdown-item" href="logout.php">Log out</a>
              </div>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">About
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">About</li>
      </ol>

      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="./images/about.jpg" alt="">
        </div>
        <div class="col-lg-6">
          <h2>About JobRows Platform</h2>
          <p>It is an online platform that reunites three trending concepts in the world; crowd funding, shared economy and freelancing. This will be done by creating temporary jobs for university students who have skills they want to develop and exploit.</p>
          <p>JobRows also works closely with, and helps shape the major systems that impact university students. It also works on covering diverse areas as handcraft jobs, education, babysitting and homemade food etc …, through working on several partnerships with new-born startups in order to encourage young people to take entrepreneurial initiatives that our economy severely lacks.</p>
          <p>The platform consists of an online platform that helps those that need a service or a product for a smaller amount of money, by matching them with appropriate job seeker’s profile.</p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Team Members -->
      <h2>Our Team</h2>

      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <img class="card-img-top" src="./images/amine_pic.jpeg" alt="">
            <div class="card-body">
              <h4 class="card-title">Amine Saied</h4>
              <h6 class="card-subtitle mb-2 text-muted">Team Leader</h6>
              <p class="card-text"></p>
            </div>
            <div class="card-footer">
              <a href="mailto:aminesaied@outlook.com">aminesaied@outlook.com</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <img class="card-img-top" src="./images/ahmed_pic.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Ahmed Ben Yaghlen</h4>
              <h6 class="card-subtitle mb-2 text-muted">Project Manager</h6>
              <p class="card-text"></p>
            </div>
            <div class="card-footer">
              <a href="mailto:benyaghlen.ahmed@tbs.u-tunis.tn">benyaghlen.ahmed@tbs.u-tunis.tn</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100 text-center">
            <img class="card-img-top" src="./images/khalil_pic.png" alt="">
            <div class="card-body">
              <h4 class="card-title">Khalil Rekik</h4>
              <h6 class="card-subtitle mb-2 text-muted">Product Manager</h6>
              <p class="card-text"></p>
            </div>
            <div class="card-footer">
              <a href="mailto:khalil.rekik101@gmail.com">khalil.rekik101@gmail.com</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; JobRows  <?php echo date("Y");?></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
