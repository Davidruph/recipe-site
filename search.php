<?php
//include database connection
require 'admin/functions/dbconn.php';

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Recipe Search Details</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">

<script src="admin/assets/js/all.min.js"></script>

</head>
<body>

<header>
  <?php include('includes/nav.php'); ?> 
</header>
<main role="main" class="bg-light">

 <div class="container-fluid">
  
    <ol class="breadcrumb mb-4 d-block" style="margin-top: 80px;">
            <li class="breadcrumb-item active">Recipe Search Results</li>

        </ol>
	
      <div class="row" style="margin-top: 4%;">
      	
  	<?php

          //if search button is clicked anywhere, select db for a match else echo error
        if(isset($_POST['submit'])) {
          $searchcriteria = $_POST['searchcriteria'];
          $sql = 'SELECT * FROM tblrecipe WHERE RecipeName LIKE :searchcriteria OR Author LIKE :searchcriteria OR RecipeDescription LIKE :searchcriteria OR category LIKE :searchcriteria';
          $statement = $connection->prepare($sql);
          $statement->execute(array(':searchcriteria' => '%'.$searchcriteria.'%'));
          $recipe = $statement->fetchAll(PDO::FETCH_OBJ);
          
          if(sizeof($recipe) == 0){ 
            echo '<div class="container">
            <div class="alert alert-danger text-center">
                    <li>Oooops...  No Record Found.</li>
            </div>
        </div>
             ';
             
            }else{
          	
	          foreach ($recipe as $reci) {
		        // if a match is found, foreach of the records print them out with the below template
           ?>

           	 <div class="col-md-6" id="recipe">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><?php echo $reci->Author ?></strong>
          <h3 class="mb-0"><?php echo $reci->RecipeName ?></h3>
          <div class="mb-1 text-muted"><?php echo $reci->PostingDate ?></div>
          <p class="card-text mb-auto"><?php echo $reci->category ?></p>
           <form action="recipe-details.php"  method="post">
                <input type="hidden" name="edit_id" value="<?php echo $reci->id ?>">
                  <button type="submit" name="btn_edit" class="btn btn-link stretched-link">Continue reading</button>
            </form>
          <!-- <a href="#" class="stretched-link">Continue reading</a> -->
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="admin/uploads/<?php echo $reci->image ?>" class="img-fluid w-100" style="height: 300px;">
        </div>
      </div>
    </div>
           <?php
          }
        
          }
         }
        ?>
        <br>
        <br>
         <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card mb-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                   <form name="search" action="search.php" method="post">
              <div class="input-group">
           
        <input type="text" name="searchcriteria" class="form-control" placeholder="Search for..." required>
                <span class="input-group-btn">
                  <button class="btn btn-secondary" name="submit" type="submit">Go!</button>
                </span>
              </form>
              </div>
            </div>
          </div>


  		</div>
          
      </div>


</div>

<div class="col text-right">
        <a class="social" href="#"><i title="go back up" style="color: teal;" class="fa fa-arrow-up"></i></a>
</div>

</main>

<footer class="footer py-3 text-center bg-dark" style="bottom: 0;top: 100vh;">
<div class="container-fluid">
  <div class="row">
  <div class="col-sm-3 col-md-3 col-lg-3">
    <div class="text-white">Copyright &copy; Your Website 2020</div>
  </div>
  
     <div class="col-sm-5 col-md-4 col-lg-5">
        <a href="#" class="text-white" style="text-decoration: none;">Privacy Policy</a>
        &middot;
        <a href="#" class="text-white" style="text-decoration: none;">Terms &amp; Conditions</a>
     </div>
     
     <div class="col-sm-4 col-md-4 col-lg-3 text-center">
    <div class="">
    <a href="#" class="social text-white"><i class="fab fa-facebook-f social"></i></a>
      <a href="#" class="social text-white"> <i class="fab fa-twitter"></i></a>
      <a href="#" class="social text-white"><i class="fab fa-instagram"></i></a>
    </div>
      
  </div>
    
    </div>
</div>
</footer>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>