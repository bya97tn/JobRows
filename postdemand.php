<?php
  session_start();
  if(!isset($_SESSION['log']))
  {
    header('Location: signin.php');
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

    <title>JobRows - Demand a Job</title>

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
      <h1 class="mt-4 mb-3">Demand a Job
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Demand a Job</li>
      </ol>

      <form class="form-horizontal" name="f1" action="" method="POST">
      <fieldset>

      <!-- Offer a Service-->
      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="title"></label>  
        <div class="col-md-4">
        <input id="title" name="title" type="text" placeholder="Job Title" class="form-control input-md" required="">
          
        </div>
      </div>

      <!-- Textarea -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="desc"></label>
        <div class="col-md-4">                     
          <textarea class="form-control" id="desc" name="des" placeholder="Describe your offer in few words..." rows="5" required=""></textarea>
        </div>
      </div>

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="governorate"></label>
        <div class="col-md-4">
          <select id="governorate" name="governorate" class="form-control" required="">
            <option>Choose a governorate</option>
            <?php
              $res1=mysqli_query($link,"SELECT* FROM governorate;");

              while($row1=mysqli_fetch_array($res1))
              {
                $id=$row1['id'];
                $gov=$row1['name'];
                ?>
                  <option value="<?php echo $id; ?>"><?php echo $gov; ?></option>
                <?php
              }
            ?>
          </select>
        </div>
      </div>

<!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="category"></label>
        <div class="col-md-4">
          <select id="category" name="category" class="form-control" required="">
            <option>Choose a category</option>
            <?php
              $res2=mysqli_query($link,"SELECT* FROM category;");

              while($row2=mysqli_fetch_array($res2))
              {
                $id=$row2['id'];
                $cat=$row2['label'];
                ?>
                  <option value="<?php echo $id; ?>"><?php echo $cat; ?></option>
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
          <button id="b1" name="b1" class="btn btn-primary">Post</button>
        </div>
      </div>

      </fieldset>
      </form>
      <br><br>
      <?php
      	if(isset($_POST['b1']))
      	{
      		$title=$_POST['title'];
      		$des=$_POST['des'];
      		$gov=$_POST['governorate'];
      		$cat=$_POST['category'];
      		$user=$_SESSION['user'];
      		$res3=mysqli_query($link,"INSERT INTO demand values ('','$title','$des',CURRENT_TIMESTAMP(),1,'$user','$gov','$cat');");
      		if($res3)
      		{
      			echo '<script>alert("Your demand has been posted!");</script>';
				echo '<script type="text/javascript">';
				echo 'window.location.href = "index.php"';
				echo '</script>';
      		}
      		else
      		{
      			echo '<script>alert("' . mysqli_error($link) . '");</script>';
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
