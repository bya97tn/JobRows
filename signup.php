<?php
  session_start();
  if(isset($_SESSION['log']))
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

    <title>JobRows - Sign up</title>

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
                echo "Hello, " . $_SESSION['username'];
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
      <h1 class="mt-4 mb-3">Sign up
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Sign up</li>
      </ol>

      <form class="form-horizontal" name="f1" method="POST" action="">
      <fieldset>

      <!-- Sign up -->

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="username"></label>  
        <div class="col-md-4">
        <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required="">
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="name"></label>  
        <div class="col-md-4">
        <input id="name" name="name" type="text" placeholder="Full Name" class="form-control input-md" required="">
          
        </div>
      </div>

      <!-- Multiple Radios -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="gender">Gender</label>
        <div class="col-md-4">
        <div class="radio">
          <label for="gender-0">
            <input type="radio" name="gender" id="gender-0" value="Male" checked="checked">
            Male
          </label>
        </div>
        <div class="radio">
          <label for="gender-1">
            <input type="radio" name="gender" id="gender-1" value="Female">
            Female
          </label>
        </div>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="birthday"></label>  
        <div class="col-md-4">
        <input id="birthday" name="birthday" type="date" placeholder="" class="form-control input-md" required="">
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="email"></label>  
        <div class="col-md-4">
        <input id="email" name="email" type="email" placeholder="E-mail" class="form-control input-md" required="">
          
        </div>
      </div>

      <!-- Password input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="password"></label>
        <div class="col-md-4">
          <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">
          
        </div>
      </div>

      <!-- Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="b1"></label>
        <div class="col-md-4">
          <button id="b1" name="b1" class="btn btn-primary">Sign up</button>
        </div>
      </div>

      </fieldset>
      </form>
      <?php
        if(isset($_POST['b1']))
        {
          $username=$_POST['username'];
          $name=$_POST['name'];
          $gender=$_POST['gender'];
          $birthday=$_POST['birthday'];
          $email=$_POST['email'];
          $password=$_POST['password'];
          $res1=mysqli_query($link,"SELECT* FROM user WHERE username='$username' OR email='$email'");
          if(mysqli_num_rows($res1)!=0)
          {
            echo '<script>alert("Username or email already exist!");</script>';
          }
          else
          {
            $res2=mysqli_query($link,"INSERT INTO user VALUES('$username','$name','$gender','$birthday','$email','$password');");
            if($res2)
            {
              echo '<script>alert("Sucess");</script>';
              $_SESSION['log']=true;
              $_SESSION['user']=$username;
              header('Location: index.php'); 
            }
            else
            {
              echo '<script>alert("Error' . mysqli_error($link) . '");</script>'; 
            }
          }
        }

      ?>
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