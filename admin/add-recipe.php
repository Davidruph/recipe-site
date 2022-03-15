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
if (isset ($_POST['submit'])){

  $recipe = $_POST['recipe'];
  $author = $_POST['author'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $postingdate = date("Y-m-d H:i:s", time());

  if($description === "") {
        $errors['description'] = "Recipe description is required";
  }else{

  $imgfile = $_FILES["postimage"]["name"];
  $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
  // allowed extensions
  $allowed_extensions = array(".jpg","jpeg",".png",".gif");
  // Validation for allowed extensions .in_array() function searches an array for a specific value.
  if(!in_array($extension, $allowed_extensions))
  {
  echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
  }
  else
  {
  //rename the image file
  $imgnewfile = md5($imgfile).$extension;
  $temp_name = $_FILES['postimage']['tmp_name'];
  
  

  $sql = 'INSERT INTO tblrecipe(RecipeName, Author, RecipeDescription, image, category, PostingDate, user_id) VALUES(:recipe, :author, :description, :imgnewfile, :category, :postingdate, :userid)';
  $statement = $connection->prepare($sql);

  if ($statement->execute([':recipe' => $recipe, ':author' => $author, ':description' => $description, ':category' => $category, ':imgnewfile' => $imgnewfile, ':postingdate' => $postingdate, 'userid'=>$session_user['id']])) {
    // Code for move image into directory
    move_uploaded_file($temp_name,"uploads/".$imgnewfile);
    $success['data'] = 'Recipe inserted successfully';
  }else{
    $errors['data'] = 'Ooops, an error occured';
  }

}
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
        <h1 class="mt-4">Recipe</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Add Recipe Page</li>
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

     <div class="card-box">
        <div class="col-md-12">
        <form class="form-horizontal" name="recipe-form" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-5 control-label">Feature Image</label>
                <div class="col-md-10">
                    <input type="file" class="form-control-file" id="postimage" name="postimage"  required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-5 control-label">Recipe Name</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" value="" name="recipe" required>
                </div>
            </div>

             <div class="form-group">
                <label class="col-md-6 control-label">Select or Enter Author name</label>
                <div class="col-md-10">
                    <input list="browser" name="author" id="author" class="form-control" required="">
                </div>
            </div>
              <?php
                  $sql = 'SELECT * FROM tblauthor';
                  $statement = $connection->prepare($sql);
                  $statement->execute();
                  $author = $statement->fetchAll(PDO::FETCH_OBJ);
              ?>

              <datalist id="browser">

                <?php foreach($author as $auth): ?>
                 <option value="<?= $auth->Author; ?>"></option>
                 <?php endforeach; ?>
              </datalist>

              <div class="form-group">
                <label class="col-md-6 control-label">Select or Enter Category name</label>
                <div class="col-md-10">
                    <input list="browser" name="category" id="category" class="form-control" required="">
                </div>
            </div>
              <?php
                  $sql = 'SELECT * FROM tblcategory';
                  $statement = $connection->prepare($sql);
                  $statement->execute();
                  $category = $statement->fetchAll(PDO::FETCH_OBJ);
              ?>

              <datalist id="browser">

                <?php foreach($category as $cat): ?>
                 <option value="<?= $cat->CategoryName; ?>"></option>
                 <?php endforeach; ?>
              </datalist>
         
                <div class="form-group">
                    <label class="col-md-5 control-label">Recipe Description</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5" name="description" id="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                <label class="col-md-2 control-label">&nbsp;</label>
                <div class="col-md-10">
              
            <button type="submit" class="btn btn-primary btn-block" name="submit">
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

<script>
$("#description").summernote({
  placeholder: 'Enter Recipe Descriptions here...',
        height: 100,
         callbacks: {
        onImageUpload : function(files, editor, welEditable) {
 
             for(var i = files.length - 1; i >= 0; i--) {
                     sendFile(files[i], this);
            }
        }
    }
    });

function sendFile(file, el) {
var form_data = new FormData();
form_data.append('file', file);
$.ajax({
    data: form_data,
    type: "POST",
    url: 'include/editor-upload.php',
    cache: false,
    contentType: false,
    processData: false,
    success: function(url) {
        $(el).summernote('editor.insertImage', url);
    }
});
}
</script>
    
