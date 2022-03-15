<?php
    require 'functions/dbconn.php';

    
    //All header tag to be included
    include('include/header.php');
     //sidebar tag to be included
     include('include/sidebar.php');

     $sql="SELECT * FROM tblusers";
     $stmt=$connection->prepare($sql);
     $stmt->execute();
     $users=$stmt->fetchAll();

     $save=isset($_POST['save']) ? $_POST['save']: '';

     if($save){
         $user=isset($_POST['user'])? $_POST['user']: '';
         $role=isset($_POST['role'])? $_POST['role']: '';
         $errors=array();

         if(empty($user)){
             array_push($errors,"user field cannot be empty");
         }
         if(empty($role)){
             array_push($errors, "role field cannot be empty");
         }

         if(empty($errors)){
           
            $sql="UPDATE tblusers SET role=:role WHERE id=:id";
            $stmt=$connection->prepare($sql);
           if($stmt->execute(['role'=>$role, 'id'=>$user])){
               ?>
            <div class="alert alert-success">Changes made successfully</div>
               <?php
           }else{
               ?>
            <div class="alert alert-danger">There was an error</div>
               <?php
           }

         }else{
             ?>
             <br><br>
             <?php
             foreach($errors as $error){
                 ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
                 <?php
             }
         }
     }
?>

<div class="container mt-4">
    <div>
        <form action="add-role.php" method="post">
            <div class="col-md-6">
                <label for="users">Users</label>
                <select name="user" id="users" class="custom-select" required>
                    <option value="">Select User</option>
                    <?php 
                        foreach($users as $user){
                    ?>
                    <option value="<?php echo $user['id'] ?>"><?php echo $user['fullname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="col-md-6">
                <select name="role" id="roles" class="custom-select" required>
                    <option value="">Select role</option>
                    <option value="Site Admin">Site admin</option>
                    <option value="Account Admin">Account admin</option>
                    <option value="Content Editor">Content editor</option>
                </select>
            </div>
            <br>
            <div class="col-md-6 text-center">
                <button class="btn btn-primary" name="save" value="button">Save</button>
            </div>
        </form>
    </div>
</div>


<?php
  //footer tag to be included
  include('include/footer.php');
  //javascripts files to be included
  include('include/scripts.php');
  ?>