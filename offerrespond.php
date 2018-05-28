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

    <title>JobRows - Offer Respond</title>

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
              <a class="nav-link" href="postoffer.php">offer a Job</a>
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
      <h1 class="mt-4 mb-3">Offer Respond
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Offer Respond</li>
      </ol>
      <?php
      if(isset($_GET['fakeuser']) AND (isset($_GET['id'])))
      {
      $id=$_GET['id'];
      $fakeuserid=$_GET['fakeuser'];
      $res1=mysqli_query($link,"SELECT* FROM offer_comment WHERE fake_user_id='$fakeuserid' AND id='$id';");
      $raw1=mysqli_fetch_array($res1);
      $price=$raw1['price'];
      $content=$raw1['content'];
      $iduser=['id_user'];
      $time=$raw1['date_time'];
      ?>
      <div class="row">
        <div class="col-lg-9">
          <div class="card mt-4">
            <div class="card-body">
              <h3 class="card-title">user_<?php echo $fakeuserid; ?> <small>asked to have the service for <?php echo $price ?></small></h3>
              <p class="card-text"><?php echo $content; ?></p>
              <small>Posted on: <?php echo $time; ?></small>
            </div>
            <form class="form-horizontal" name="f1" action="" method="POST">
              <fieldset>
              <!-- Button -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="b1"></label>
                <div class="col-md-4">
                  <a href="offerdeal.php?id=<?php echo $id; ?>&fakeuser= <?php echo $fakeuserid; ?>"><button id="b1" name="b1" class="btn btn-success" type="button">Accept</button></a>
                  <button id="b2" name="b2" class="btn btn-danger" type="button" onclick="">Decline</button> 
                </div>
              </div>
              </fieldset>
              </form>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
      </div>
      <?php
  }
  ?>
    </div>
    <br><br><br><br>
    <?php
    if(isset($_POST['b1']))
    {

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
