
<?php
    require 'functions/dbconn.php';

    
    //All header tag to be included
    include('include/header.php');
?>

<?php
    //sidebar tag to be included
    include('include/sidebar.php');
?>
        
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    <div class="row">
      <?php
          if($session_user['role']=="Content Editor"){
      ?>
      <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="manage-recipe.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recipes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php

                    if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }


                 $session_user=isset($_SESSION['user'])? $_SESSION['user']: '';

                     $count=$connection->prepare("SELECT * FROM tblrecipe WHERE user_id=:id");
                        $count->execute(['id'=>$session_user['id']]);
                        $recipe=$count->rowCount();
                        echo $recipe; 
                ?>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-utensils fa-2x text-green-300 text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
     <?php } ?>

       <?php
          if($session_user['role']=="Account Admin"){
      ?>
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="manage-authors.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Authors</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php

                 $session_user=isset($_SESSION['user'])? $_SESSION['user']: '';

                     $count=$connection->prepare("SELECT * FROM tblauthor WHERE user_id=:id");
                        $count->execute(['id'=>$session_user['id']]);
                        $author=$count->rowCount();
                        echo $author; 

                ?>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-green-300 text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="manage-recipe.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recipes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php
                  
                     $session_user=isset($_SESSION['user'])? $_SESSION['user']: '';

                     $count=$connection->prepare("SELECT * FROM tblrecipe WHERE user_id=:id");
                        $count->execute(['id'=>$session_user['id']]);
                        $recipe=$count->rowCount();
                        echo $recipe; 
                ?>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-utensils fa-2x text-green-300 text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
     <?php } ?>


       <?php
          if($session_user['role']=="Site Admin"){
      ?>
      <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="manage-authors.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Authors</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php
                   $count=$connection->prepare("SELECT * FROM tblauthor");
                        $count->execute();
                        $author=$count->rowCount();
                        echo $author; 
                ?>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-green-300 text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="manage-recipe.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Recipes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php
                  
                     $count=$connection->prepare("SELECT * FROM tblrecipe");
                        $count->execute();
                        $recipe=$count->rowCount();
                        echo $recipe; 
                ?>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-utensils fa-2x text-green-300 text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="manage-categories.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Categories</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php
                     $count=$connection->prepare("SELECT * FROM tblcategory");
                        $count->execute();
                        $category=$count->rowCount();
                        echo $category; 

                ?>

              </div>
            </div>
            <div class="col-auto">
              <i class="fa fa-list-alt fa-2x text-green-300 text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <a href="mails.php" style="text-decoration: none;">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User Mails</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800 text-dark">
                <?php
                   $count=$connection->prepare("SELECT * FROM tblmail");
                        $count->execute();
                        $author=$count->rowCount();
                        echo $author; 
                ?>

              </div>
            </div>
            <div class="col-auto">
                <i class="fas fa-envelope-open fa-2x text-dark"></i>
            </div>
          </div>
        </div>
        </a>
      </div>
    </div>
 <?php } ?>
        </div>
    </div>
</main>
            
<?php
    //footer tag to be included
    include('include/footer.php');
?>

<?php
    //javascripts files to be included
    include('include/scripts.php');
?>
    
