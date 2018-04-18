<?php
  session_start();
  $link = mysqli_connect("localhost", "root", "", "jobrows");
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
    <meta name="Khakil Rekik" content="">

    <title>JobRows - Mini Services</title>

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

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('images/slide1.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>IT Services</h3>
              <p>Web dev, web design, design, video editing, photo editing, etc...</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('images/slide2.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Tutoring Services</h3>
              <p>Privately teaching other people</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('images/slide3.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Crafting</h3>
              <p>Hand made stuff, painting, etc...</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Welcome to JobRows Platform</h1>

      <!-- Marketing Icons Section -->
      <div class="row">
      <?php
      $res2=mysqli_query($link,"SELECT* FROM category");
      while($row2=mysqli_fetch_array($res2))
      {
        $id=$row2['id'];
        $label=$row2['label'];
        $desc=$row2['description'];
        $img=$row2['imageurl'];
      ?>
        <div class="col-lg-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="search.php?category=<?php echo $id; ?>"><img class="card-img-top" src="<?php echo $img; ?>" alt="<?php echo $label; ?>"></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="search.php?category=<?php echo $id; ?>"><?php echo $label; ?></a>
              </h4>
              <p class="card-text"><?php echo $desc; ?></p>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
      </div>
      <!-- /.row -->

      <!-- Portfolio Section -->
      <h2>Latest Offers</h2>
      <div class="row">
        <?php
        $res3=mysqli_query($link,"SELECT* FROM offer WHERE open=1 ORDER BY date_time DESC");
        $i=0;
        while($row3=mysqli_fetch_array($res3) and $i<3)
        {
        $id=$row3['id'];
        $title=$row3['title'];
        $des=$row3['des'];
        $i++;
        ?>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header"><?php echo $title; ?></h4>
            <div class="card-body">
              <p class="card-text"><?php echo $des; ?></p>
            </div>
            <div class="card-footer">
              <a href="offerpage.php?offer=<?php echo $id; ?>" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- /.row -->

      <!-- Portfolio Section -->
      <h2>Latest Demands</h2>
      <div class="row">
        <?php
        $res4=mysqli_query($link,"SELECT* FROM demand WHERE open=1 ORDER BY date_time DESC");
        $i=0;
        while($row4=mysqli_fetch_array($res4) and $i<3)
        {
        $id=$row4['id'];
        $title=$row4['title'];
        $des=$row4['des'];
        $i++;
        ?>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header"><?php echo $title; ?></h4>
            <div class="card-body">
              <p class="card-text"><?php echo $des; ?></p>
            </div>
            <div class="card-footer">
              <a href="demandpage.php?offer=<?php echo $id; ?>" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- /.row -->

      <!-- Features Section -->
      <div class="row">
        <div class="col-lg-6">
          <h2>JobRows Platform</h2>
          <p>The JobRows platform allows you to:</p>
          <ul>
            <li>Offer a service</li>
            <li>Demand a Job</li>
            <li>Find new opportunities for you career</li>
            <li>Apply for freelance jobs</li>
          </ul>
          <p>In JobRows you can find professionals and talented people that can help you accomplish some tasks in your daily life and you also can do the same and be a part of the community!</p>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded" src="./images/description.jpg" alt="">
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="col-md-8">
          <p>JobRows is only responsible for matching the users. After the service is performed, JobRows won't perform any kind of refund for any reason.</p>
        </div>
        <?php
            if(!isset($_SESSION['log']))
            {
            ?>
        <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="signin.php">Start Now!</a>
        </div>
        <?php
      }
      else
      {
        ?>
        <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="postdemand.php">Start Now!</a>
        </div>
        <?php
      }
      ?>
      </div>

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
