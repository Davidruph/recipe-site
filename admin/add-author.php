<?php
//db connection included
require 'functions/dbconn.php';

$errors = array();
$success = array();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


 $session_user=isset($_SESSION['user'])? $_SESSION['user']: '';

//if submit button is clicked and inputs are not empty
if (isset ($_POST['submit']) && (isset ($_POST['author']))){

  $author = $_POST['author'];
  $email = $_POST['email'];
  $postingdate = date("Y-m-d H:i:s", time());
  $sql = 'INSERT INTO tblauthor(Author, email, user_id, PostingDate) VALUES(:author, :email, :userid, :postingdate)';
  $statement = $connection->prepare($sql);

  if ($statement->execute([':author' => $author, ':email' => $email, ':postingdate' => $postingdate, 'userid'=>$session_user['id']])) {
    $success['data'] = 'Author inserted successfully';
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
            <li class="breadcrumb-item active">Add Author Page</li>
        </ol>
        <!-- if there is an error, echo all of them -->
         <?php if (count($errors) > 0): ?>
            <div class="alert alert-danger">
                <?php foreach($errors as $error): ?> 
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- if there is success, echo all of them -->
        <?php if (count($success) > 0): ?>
            <div class="alert alert-success">
              <?php foreach($success as $succes): ?> 
                <li class=""><?php echo $succes; ?></li>
              <?php endforeach; ?>
            </div>
        <?php endif; ?>

     <div class="card-box">
        <div class="col-md-6">
        <form class="form-horizontal" name="author" method="post">
            <div class="form-group">
                <label class="col-md-2 control-label">Author</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="author" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Author Email</label>
                <div class="col-md-10">
                    <input type="email" class="form-control" value="" name="email" required>
                </div>
            </div>
         
                <div class="form-group">
                <label class="col-md-2 control-label">&nbsp;</label>
                <div class="col-md-10">
              
            <button type="submit" class="btn btn-primary btn-md" name="submit">
                Submit
            </button>
                </div>
            </div>

        </form>
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
    
