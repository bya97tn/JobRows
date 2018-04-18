<?php
  session_start();
  if(!isset($_SESSION['log']))
  {
    header('Location: index.php');
  }
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
    <meta name="author" content="">

    <title>JobRows - My Profile</title>

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
      <h1 class="mt-4 mb-3">My Profile
        <small><?php echo $_SESSION['user']; ?></small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">My profile</li>
      </ol>      

      <!-- Dashboard Section -->

        <div class="col-lg-6">
          <h2>Dashboard</h2>
            <p>My rating: 

              <div class="form-group">
                <label class="col-md-4 control-label" for="b1"></label>
                <div class="col-md-4">
                  <button id="b1" name="b1" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Delete Account</button>
                </div>
              </div>

            </p>
        </div>
        <br><br>

      <!-- My demand deals Section -->
      <h2>My demand deals</h2>
      <div class="row">
        <?php
        $user=$_SESSION['user'];
        $res3=mysqli_query($link,"SELECT* FROM demand_deal WHERE '$user'=id_user_accepted") or die(mysqli_error($link));
        while($row3=mysqli_fetch_array($res3))
        {
        $id=$row3['id'];
        $progress=$row3['progress'];
        $fakeuserid=$row3['fake_user_id'];
        ?>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header"><?php echo 'user_'.$fakeuserid.' accepted to do a job.'; ?></h4>
            <div class="card-body">
              <p class="card-text"><?php echo 'Progress: ' . $progress . '%'; ?></p>
            </div>
            <div class="card-footer">
              <a href="demanddeal.php?id=<?php echo $id; ?>&fakeuser=<?php echo $fakeuserid; ?>" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- /.row -->

      <!-- My offer deals Section -->
      <h2>My offer deals</h2>
      <div class="row">
        <?php
        $user=$_SESSION['user'];
        $res3=mysqli_query($link,"SELECT* FROM offer_deal WHERE '$user'=id_user_accepted") or die(mysqli_error($link));
        while($row3=mysqli_fetch_array($res3))
        {
        $id=$row3['id'];
        $progress=$row3['progress'];
        $fakeuserid=$row3['fake_user_id'];
        ?>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header"><?php echo 'user_'.$fakeuserid.' wants the service.'; ?></h4>
            <div class="card-body">
              <p class="card-text"><?php echo 'Progress: ' . $progress . '%'; ?></p>
            </div>
            <div class="card-footer">
              <a href="offerdeal.php?id=<?php echo $id; ?>&fakeuser=<?php echo $fakeuserid; ?>" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
      <!-- /.row -->

      <!-- My offers Section -->
      <h2>My offers</h2>
      <div class="row">
        <?php
        $user=$_SESSION['user'];
        $res1=mysqli_query($link,"SELECT* FROM offer WHERE '$user'=username ORDER BY date_time DESC") or die(mysqli_error($link));
        while($row1=mysqli_fetch_array($res1))
        {
        $id=$row1['id'];
        $title=$row1['title'];
        $des=$row1['des'];
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
      <br><br> 
      <!-- My demands Section -->
      <h2>My demands</h2>
      <div class="row">
        <?php
        $user=$_SESSION['user'];
        $res2=mysqli_query($link,"SELECT* FROM demand WHERE '$user'=username ORDER BY date_time DESC") or die(mysqli_error($link));
        while($row2=mysqli_fetch_array($res2))
        {
        $id=$row2['id'];
        $title=$row2['title'];
        $des=$row2['des'];
        ?>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header"><?php echo $title; ?></h4>
            <div class="card-body">
              <p class="card-text"><?php echo $des; ?></p>
            </div>
            <div class="card-footer">
              <a href="demandpage.php?demand=<?php echo $id; ?>" class="btn btn-primary">Learn More</a>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
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
    
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete your account?</p>
          </div>
          <div class="modal-footer">
            <form class="form-horizontal">
            <fieldset>

            <!-- Form Name -->

            <!-- Button (Double) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="b1"></label>
              <div class="col-md-8">
                <button id="b1" name="b1" class="btn btn-danger">Delete</button>
              </div>
            </div>
            </fieldset>
            </form>
          </div>
        </div>

      </div>
    </div>

  </body>

</html>
