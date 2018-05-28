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

    <title>JobRows - Search</title>

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
              <a class="nav-link" href="signin.php">Sign in</a>
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
      <h1 class="mt-4 mb-3">Search
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Search</li>
      </ol>

      <form class="form-horizontal" name="f1" action="search.php" method="POST">
      <fieldset>
      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="category">Category: </label>
        <div class="col-md-4">
          <select id="category" name="category" class="form-control" required="">
            <option>Choose a category</option>
            <?php
              $res4=mysqli_query($link,"SELECT* FROM category;");

              while($row4=mysqli_fetch_array($res4))
              {
                $id=$row4['id'];
                $cat=$row4['label'];
                ?>
                  <option value="<?php echo $id; ?>"><?php echo $cat; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="governorate"></label>
        <div class="col-md-4">
          <select id="governorate" name="governorate" class="form-control" required>
            <option value="">Choose a governorate</option>
            <?php
              $res5=mysqli_query($link,"SELECT* FROM governorate;");

              while($row5=mysqli_fetch_array($res5))
              {
                $id=$row5['id'];
                $gov=$row5['name'];
                ?>
                  <option value="<?php echo $id; ?>"><?php echo $gov; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>


      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="b1"></label>
        <div class="col-md-4">
          <button id="b1" name="b1" class="btn btn-success">Search</button>
        </div>
      </div>

      </fieldset>
      </form>

      <?php
        if(isset($_GET['category']))
        {
          $cat=$_GET['category'];
          ?>
          <div class="row">
            <?php
            $res1=mysqli_query($link,"SELECT* FROM demand WHERE category=$cat ORDER BY date_time DESC");

            while($row1=mysqli_fetch_array($res1))
            { 
            $id=$row1['id'];
            $title=$row1['title'];
            $des=$row1['des'];
            $open=$row1['open'];
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
          <?php
        }
        elseif (isset($_POST['b1'])) {
          ?>
          <div class="row">
            <?php
            $cat=$_POST['category'];
            $gov=$_POST['governorate'];
            $type="demand";
            $res3=mysqli_query($link,"SELECT* FROM $type WHERE category=$cat AND id_governorate=$gov ORDER BY date_time DESC") or die(mysqli_error($link));

            while($row3=mysqli_fetch_array($res3))
            { 
            $id=$row3['id'];
            $title=$row3['title'];
            $des=$row3['des'];
            ?>
            <div class="col-lg-4 mb-4">
              <div class="card h-100">
                <h4 class="card-header"><?php echo $title; ?></h4>
                <div class="card-body">
                  <p class="card-text"><?php echo $des; ?></p>
                </div>
                <div class="card-footer">
                  <a href="<?php echo $type; ?>page.php?<?php echo $type; ?>=<?php echo $id; ?>" class="btn btn-primary">Learn More</a>
                </div>
              </div>
            </div>
            <?php
            }
            ?>
          </div>
          <!-- /.row -->
          <?php  
        }

      ?>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
