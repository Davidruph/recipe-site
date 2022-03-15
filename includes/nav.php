<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    $session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;
?>
<nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
    <a class="navbar-brand" href="#">YummyStummy</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index#recipe">Recipe</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="index#featured">Featured</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="index#contact">Contact</a>
        </li>
        <?php 
        if(!$session){
        ?>
        <li class="nav-item">
          <a class="nav-link " href="login">Login</a>
        </li>
        <?php } ?>
        <?php 
        if($session){
        ?>
        <li class="nav-item">
          <a class="nav-link " href="logout">Log out</a>
        </li>
        <?php } ?>
        <?php 
        if(!$session){
        ?>
        <li class="nav-item">
          <a class="nav-link " href="signup">Sign up</a>
        </li>
        <?php } ?>
      </ul>
      <form class="form-inline mt-2 mt-md-0" action="search.php" method="post">
        <input class="form-control mr-sm-2" name="searchcriteria" type="text" placeholder="Search for..." required aria-label="Search">
        <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" name="submit">Search</button>
      </form>
    </div>
  </nav>
  </header>