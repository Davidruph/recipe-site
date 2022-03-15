<?php
//db connection included
require 'functions/dbconn.php';

$errors = array();
$success = array();

if (isset ($_POST['btnupdate'])){
  $author = $_POST['author'];
  $id = $_POST['edit_id'];
  $email = $_POST['email'];
  $postingdate = date("Y-m-d H:i:s", time());
  $sql = 'UPDATE tblauthor SET Author=:author, email=:email, PostingDate=:postingdate WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':author' => $author, ':email' => $email, ':postingdate' => $postingdate, ':id' => $id])) {
    $success['data'] = "author details has been updated successfully <a href='manage-authors.php'>Go Back</a>";
  }else{
    $errors['data'] = 'Ooops, an error occured';
  }
}

?>

<?php
    //All header tag to be included
    include('include/header.php');
?>

<?php
    //sidebar tag to be included
    include('include/sidebar.php');
?>


<main>
    <div class="container-fluid">
        <h1 class="mt-4">Author</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Author Page</li>
        </ol>
         <?php if (count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?> 
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (count($success) > 0): ?>
            <div class="alert alert-success">
              <?php foreach($success as $succes): ?> 
                <li class=""><?php echo $succes; ?></li>
              <?php endforeach; ?>
            </div>
        <?php endif; ?>

      <div class="col-md-12">
           <div class="card-body">
                <?php
                //if button btn_edit is clicked, save the id of the item and echo it here with a match
                if(isset($_POST['btn_edit'])) {
                  $id = $_POST['edit_id'];
                   
                  $sql = 'SELECT * FROM tblauthor WHERE id=:id';
                  $statement = $connection->prepare($sql);
                  $statement->execute([':id' => $id ]);
                  $author = $statement->fetchAll(PDO::FETCH_OBJ);

                  
                  foreach ($author as $auth) {
                    ?>
            
                   <form action="edit-author.php" method="post">
                    <input type="hidden" name="edit_id" value="<?= $auth->id; ?>">
                   <div class="form-group">
                      <label class="col-md-2 control-label">Author Name</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" value="<?= $auth->Author; ?>" name="author" required>
                      </div>
                  </div>
                   
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email</label>
                        <div class="col-md-10">
                          <input type="text" class="form-control" name="email" required value="<?= $auth->email; ?>">
                        </div>
                    </div>
                   
                    
                    <a href="manage-authors.php" class="btn btn-danger">Cancel</a>
                    <button type="submit" name="btnupdate" class="btn btn-primary">Update</button>
                    
                   </form>
                   <?php
			    }
				}
				?>

      </div>
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

