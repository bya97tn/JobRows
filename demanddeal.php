<?php
  session_start();
  if(!isset($_SESSION['log']))
  {
    header('Location: signin.php');
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

    <title>JobRows - Demand Deal</title>

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
      <h1 class="mt-4 mb-3">Demand Deal
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Demand Deal</li>
      </ol>
      <?php
      if(isset($_GET['fakeuser']) AND (isset($_GET['id'])))
      {
      $id=$_GET['id'];
      $fakeuserid=$_GET['fakeuser']; 
      $res1=mysqli_query($link,"SELECT* FROM demand_comment WHERE fake_user_id='$fakeuserid' AND id_demand='$id';") or die(mysqli_error($link));
      $raw1=mysqli_fetch_array($res1);
      $iddemand=$raw1['id_demand'];
      $ammount=$raw1['price'];
      $iduser=$raw1['id_user'];
      $time=$raw1['date_time'];
      $iduseraccepted=$_SESSION['user'];
      $res2=mysqli_query($link,"SELECT* FROM demand_deal WHERE id_demand='$iddemand' AND fake_user_id='$fakeuserid' AND id_user_accepted='$iduseraccepted';")or die(mysqli_error($link));  
      if(mysqli_num_rows($res2)==0)
      {
        $res3=mysqli_query($link,"INSERT INTO demand_deal VALUES('','$iddemand','$fakeuserid','$ammount','$iduser','$iduseraccepted','25');") or die(mysqli_error($link));  
        if(!$res3)
      {
        echo '<script>alert("' . mysqli_error($link) . '"");</script>';
      }
      }
      else
      {
      ?>
      <div class="row">
        <div class="col-lg-9">
          <div class="card mt-4">
            <div class="card-body">
              <h3 class="card-title">user_<?php echo $fakeuserid; ?> <small>offered to do the job  <?php echo $ammount; ?></small></h3>
                              <?php
                              $row2=mysqli_fetch_array($res2);
                  $progress=$row2['progress'];
                  ?>
              <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="70"
              aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $progress; ?>%">
                <?php
                switch ($progress) {
                  case 25:
                    echo "Matched";
                    break;

                  case 50:
                    echo "Approved";
                    break;

                  case 75:
                    echo "Realized";
                    break;

                  case 100:
                    echo "Completed";
                    break;
                  
                  default:
                    echo "error";
                    break;
                }

                ?>
              </div>

            </div>
            <?php
                if ($progress>=50) {
                  $res4=mysqli_query($link,"SELECT* FROM user WHERE username='$iduser';") or die(mysqli_error($link));
                  $row4=mysqli_fetch_array($res4);

                  echo "The real username is " . $row4['name'] . ". You can contact him by email on the adress: " . $row4['email'];
                }
                ?>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-lg-9 -->
      </div>
      <?php
  }
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
