<style media="screen">
@media (min-width: 992px) {
.animate {
  animation-duration: 0.3s;
  -webkit-animation-duration: 0.3s;
  animation-fill-mode: both;
  -webkit-animation-fill-mode: both;
}
}

@keyframes slideIn {
0% {
  transform: translateY(1rem);
  opacity: 0;
}
100% {
  transform:translateY(0rem);
  opacity: 1;
}
0% {
  transform: translateY(1rem);
  opacity: 0;
}
}

@-webkit-keyframes slideIn {
0% {
  -webkit-transform: transform;
  -webkit-opacity: 0;
}
100% {
  -webkit-transform: translateY(0);
  -webkit-opacity: 1;
}
0% {
  -webkit-transform: translateY(1rem);
  -webkit-opacity: 0;
}
}

.slideIn {
-webkit-animation-name: slideIn;
animation-name: slideIn;
}

.space-right {
  margin-right: 25px;
}

</style>

<nav class="navbar navbar-expand-sm navbar-light bg-light shadow navbar-fixed-top">
      <a class="navbar-brand">
        <img src="https://img.icons8.com/ios/50/000000/comment-discussion.png" width="30" height="30" class="d-inline-block align-top" alt="">
        CRUDFURM.
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <?php
      //If a session or a cookie is detected the website welcomes the user.
    if(isset($_SESSION['userN'])){
      print "
      <div class='navbar-nav'>
      <a class='nav-item nav-link' href='index.php'>Home <span class='sr-only'>(current)</span></a>
      <a class='nav-item nav-link' href='create_topic.php'>Create Topic<span class='sr-only'></span></a>
      <a class='nav-item nav-link' href='your_topic.php'>Your Topic<span class='sr-only'></span></a>
      ";
    }else if(isset($_COOKIE['username'])){
      print "
      <a class='nav-item nav-link' href='index.php'>Home <span class='sr-only'>(current)</span></a>
      <a class='nav-item nav-link' href='create_topic.php'>Create Topic<span class='sr-only'></span></a>
      <a class='nav-item nav-link' href='your_topic.php'>Your Topic<span class='sr-only'></span></a>
      ";
    }else{
      print "
      <a class='nav-item nav-link' href='index.php'>Home <span class='sr-only'>(current)</span></a>
      </div>
      ";
    }

  ?>
  <!-- <div class="navbar-nav">

    <a class="nav-item nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    <a class="nav-item nav-link" href="create_topic.php">Create Topic<span class="sr-only"></span></a>
    <a class="nav-item nav-link" href="#">View User<span class="sr-only"></span></a>

  </div> -->
</div>

  <div class="navbar">
  <?php
  //If a session or a cookie is detected the website welcomes the user.
    if(isset($_SESSION['userN'])){
      print "<a class='float-left' '>Welcome, ".$_SESSION['userN']."</a>";
    }else if(isset($_COOKIE['username'])){
      print "<a class='float-left' '>Welcome, ".$_COOKIE['username']."</a>";
    }else{
      print "<a class='float-left' '></a>";
    }

  ?>

  </div>

  <div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Menu
    </a>

    <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby="dropdownMenuLink">

      <div class="navbar" id="login">
      <?php
      //Here the system checks if the user has logged in. If they have, a logout button will be created instead of the login form.
        if(isset($_SESSION['userN']) || isset($_COOKIE['username'])){
          echo "<form class='navbar-item d-flex justify-content-right' action='functions.php' method='post'>";
          //
          if(isset($_GET["t"])){
            echo "<input type='hidden' name='tID' value='".$_GET["t"]."'>";
          //
          }
          echo "
              <input class='btn btn-primary btn-sm' type='submit' name='submit' value='Logout' action=''>
          </form>";
        }else{
          //If username isn't found from session or cookie we create the login form.
          echo "
          <form class='navbar-item d-flex justify-content-center' action='functions.php' method='post'>
          <div class='form-group'>
            <a class=''>Username</a>
            <input type='text' class='form-control form-control-sm space-right' name='username' placeholder='Username' maxlength='30'>
            <a class=''>Password</a>
            <input type='password' class='form-control form-control-sm space-right' name='userpass' placeholder='Password' maxlength='30'>";
          if(isset($_GET["t"])){
            echo "<input type='hidden' name='tID' value='".$_GET["t"]."'>";
          }
          echo "
            <div class='dropdown-divider'></div>
              <div class='d-flex justify-content-center'>

                <input class='btn btn-primary btn-sm space-right' type='submit' name='submit' value='Login' action=''>
                <input class='btn btn-primary btn-sm ' type='submit' name='submit' value='Register' action=''>
              </div>
            </div>
          </form>";
        }

        ?>
      </div>
    </div>
  </div>

</nav>
