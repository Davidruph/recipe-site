<?php
//include database connection
require 'admin/functions/dbconn.php';

//fetch category
$sql = 'SELECT * FROM tblcategory';
$statement = $connection->prepare($sql);
$statement->execute();
$category = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Recipe Details</title>
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
<main role="main" class="bg-light" style="">

 <div class="container-fluid">
  
    <ol class="breadcrumb mb-4 d-block" style="margin-top: 80px;">
            <li class="breadcrumb-item active">Recipe Details Page</li>

        </ol>

      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
          <div class="col-md-8">

            <?php
                if(isset($_POST['btn_edit'])) {
                  $id = $_POST['edit_id'];
                   
                  $sql = 'SELECT * FROM tblrecipe WHERE id=:id';
                  $statement = $connection->prepare($sql);
                  $statement->execute([':id' => $id ]);
                  $recipe = $statement->fetchAll(PDO::FETCH_OBJ);

                  
                  foreach ($recipe as $reci) {
                    ?>

                       <div class="card mb-4">
      
                            <div class="card-body">
                              <h2 class="card-title"><?php echo $reci->RecipeName;?></h2>
                              <p><b>Category : </b><?php echo htmlentities($reci->category);?><br>
                                <b> Posted on: </b><?php echo htmlentities($reci->PostingDate);?></p>
                                <b> Author: </b><?php echo htmlentities($reci->Author);?></p>
                                <hr />

                                <img class="img-fluid rounded w-100" style="height: 300px;" src="admin/uploads/<?php echo htmlentities($reci->image);?>" alt="<?php echo htmlentities($reci->RecipeName);?>">

                                            <p class="card-text"><?php 
                                                    echo $reci->RecipeDescription;
                                            ?></p>
                             
                            </div>
                             <div class="card-footer">
                              <a href="index.php">Back to Homepage</a>
                          </div>
                          </div>
                         

                    <?php
          }
        }
        ?>
          </div>
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

<div class="col text-right">
        <a class="social" href="#"><i title="go back up" style="color: teal;" class="fa fa-arrow-up"></i></a>
</div>
</main>
<footer class="footer mt-auto py-3 text-center bg-dark sticky">
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