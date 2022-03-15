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

    $edit_id=isset($_POST['edit_id'])? $_POST['edit_id']: '';

     if($edit_id){
        $sql="SELECT * FROM tblusers WHERE id=:id LIMIT 1";
        $stm=$connection->prepare($sql);
        $stm->execute(['id'=>$edit_id]);
        $user1=$stm->fetch();

        
     }

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
                    <option value="<?php echo $user['id'] ?>"
                        <?php
                        if($user['id'] == $user1['id']){
                            echo " selected";
                        }
                        ?>
                    ><?php echo $user['fullname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <div class="col-md-6">
                <select name="role" id="roles" class="custom-select" required>
                    <option value="">Select role</option>
                    <option value="Site Admin"
                        <?php
                        if($user1['role']=="Site Admin"){
                            echo " selected";
                        }
                        ?>
                    >Site admin</option>
                    <option value="Account Admin"
                    <?php
                        if($user1['role']=="Account Admin"){
                            echo " selected";
                        }
                        ?>
                    >Account admin</option>
                    <option value="Content Editor"
                    <?php
                        if($user1['role']=="Content Editor"){
                            echo " selected";
                        }
                        ?>
                    >Content editor</option>
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