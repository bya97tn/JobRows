<?php
  session_start();
  if(isset($_SESSION['log']))
  {
    header('Location: index.php');
  }
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

    <title>JobRows - Sign in</title>

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
      <h1 class="mt-4 mb-3">Sign in
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Sign in</li>
      </ol>

      <!-- Sign in Content -->
      <form name="f1" method="POST" action="" class="form-horizontal col-md-11">
      <fieldset>

      <!-- Sign in form -->

      <!-- Username input-->
      <div class="form-group">
        <div class="col-md-4">
        <input id="textinput" name="username" type="text" placeholder="Username" class="form-control input-md" required="">
        </div>
      </div>


      <!-- Password input-->
      <div class="form-group">
        <div class="col-md-4">
          <input id="passwordinput" name="password" type="password" placeholder="Password" class="form-control input-md" required=""><br>
          <span class="help-block">Don't have an account? <a href="signup.php">Sign up</a></span>
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <div class="col-md-4">
          <button type="submit" id="singlebutton" name="b1" class="btn btn-primary">Sign in</button>
        </div>
      </div>

      </fieldset>
      </form>
      <br><br><br><br><br><br>
      <!-- /.row -->
      

    </div>
    <!-- /.container -->
    <?php
      if(isset($_POST['b1']))
      {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $res1=mysqli_query($link,"SELECT* FROM user WHERE '$username'=username AND '$password'=password");
        if(mysqli_num_rows($res1)==0)
        {
          echo '<script>alert("Username or password incorrect! Please try again.");</script>';
        }
        else
        {
          $row1=mysqli_fetch_array($res1);
          $_SESSION['log']=true;
          $_SESSION['user']=$row1['username'];
          header('Location: index.php');
        }
      }
    ?>

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
