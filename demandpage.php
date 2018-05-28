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

    <title>JobRows - Demand Page</title>

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
      <h1 class="mt-4 mb-3">Demand Page
        <small>JobRows Platform</small>
      </h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Demand Page</li>
      </ol>
      <?php
      if(isset($_GET['demand']))
      {
      $id=$_GET['demand'];
      $res1=mysqli_query($link,"SELECT* FROM demand WHERE id='$id';");
      $raw1=mysqli_fetch_array($res1);
      $title=$raw1['title'];
      $des=$raw1['des'];
      $time=$raw1['date_time'];
      $open=$raw1['open'];
      ?>
      <div class="row">
        <div class="col-lg-9">
          <div class="card mt-4">
            <div class="card-body">
              <h3 class="card-title"><?php echo $title; ?></h3>
              <p class="card-text"><?php echo $des; ?></p>
              <small>Posted on: <?php echo $time; ?></small>
            </div>
          </div>
          <!-- /.card -->

          <div class="card card-outline-secondary my-4">
            <div class="card-header">
              <div class="card-body">
              Bids and Comments
            </div>
            <?php
            $res2=mysqli_query($link,"SELECT* FROM demand_comment WHERE id_demand='$id' ORDER BY date_time DESC");
            while($raw2=mysqli_fetch_array($res2))
            {
            $id=$raw2['id'];
            $price=$raw2['price'];
            $content=$raw2['content'];
            $time=$raw2['date_time'];
            $fakeuser=$raw2['fake_user_id'];
            $user=$raw2['id_user']; ?>
              <small class="text-muted">user_<?php echo $fakeuser; ?> proposed to do the job for <strong><?php echo $price ?> TND </strong> on <?php echo $time; ?></small>
              <p><?php echo $content; ?></p>
              <?php
                if(strcmp($_SESSION['user'], $user)==0 AND $open==1)
                {
                  echo '<p><strong><a href="demandrespond.php?fakeuser=' . $fakeuser . '&id=' . $id . '">Respond</a></strong></p>';
                }
              ?>
              <hr>
              <?php
              } 

              if($open==1)
              {
                ?>
              <form class="form-horizontal" name="f1" action="" method="POST">
              <fieldset>
              <!-- Appended Input-->
              <div class="form-group">
                <label class="col-md-4 control-label" for="appendedtext">Bid for</label>
                <div class="col-md-4">
                  <div class="input-group">
                    <input id="ammount" name="ammount" class="form-control" placeholder="Enter ammount in TND" type="number" required="">
                  </div>
                  
                </div>
              </div>
              <!-- Textarea -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="content" >Comment</label>
                <div class="col-md-4">                     
                  <textarea class="form-control" id="content" name="content" placeholder="Comment if you want..." rows="3"></textarea>
                </div>
              </div>
              <!-- Button -->
              <div class="form-group">
                <label class="col-md-4 control-label" for="b1"></label>
                <div class="col-md-4">
                  <button id="b1" name="b1" class="btn btn-success">Comment and Bid</button>
                </div>
              </div>
              </fieldset>
              </form>
              <?php
              }
              else
              {
                ?>
                <div class="form-group">
                  <label class="col-md-4 control-label" for="b2"></label>
                  <div class="col-md-4">
                    <button class="btn btn-danger">This demand is Closed</button>
                  </div>
                </div>
                <?php
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
      ?>
    </div>
    <!-- /.container -->
    <?php
    if(isset($_POST['b1']))
    {
      $id_demand=$_GET['demand'];
      $user=$_SESSION['user'];
      $ammount=$_POST['ammount'];
      $content=$_POST['content'];
      $res3=mysqli_query($link,"SELECT* FROM demand_comment WHERE id_demand='$id_demand' AND id_user='$user'");
      if(mysqli_num_rows($res3)!=0)
      {
        $raw3=mysqli_fetch_array($res3);
        $fakeuser=$raw3['fake_user_id'];
        $res4=mysqli_query($link,"INSERT INTO demand_comment VALUES('','$ammount','$content','$id_demand','$user','$fakeuser',CURRENT_TIMESTAMP());");
        if(!$res4)
          echo '<script> alert("res4 error: ' . mysqli_error($link) . '");</script>';
        else
        {
          echo '<script> alert("Success");</script>';
        }
      }
      else
      {
        $fakeuser=mt_rand(10000,100000);
        echo '<script> alert("res4 error: ' . $fakeuser . '");</script>';
        $res5=mysqli_query($link,"INSERT INTO demand_comment VALUES('','$ammount','$content','$id_demand','$user',$fakeuser,CURRENT_TIMESTAMP());");
        if(!$res5)
          echo '<script> alert("' . mysqli_error($link) . '");</script>';
        else
        {
          echo '<script> alert("Success");</script>';
        }

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
