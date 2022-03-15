<?php 
require 'admin/functions/dbconn.php';

session_start();
$session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;
if($session){
    header('Location: admin/index');
    exit();
}

$username=isset($_POST['username'])? $_POST['username']:'';
$password=isset($_POST['password'])? $_POST['password']: '';
$save=isset($_POST['save']) ? $_POST['save']: '';
$errors=array();

if($save){
    if(empty($username)){
        array_push($errors, "Username field cannot be empty");
    }
    if(empty($password)){
        array_push($errors, "Password field cannot be empty");
    }

    $sql="SELECT * FROM tblusers WHERE email=:email LIMIT 1";
        $stmt=$connection->prepare($sql);
        $stmt->execute(['email'=>$username]);
        $email=$stmt->fetch();
        if(!empty($email)){
            if(password_verify($password, $email['password'])){
                $email['id'] = $id;
                $id = $_SESSION['id'];
                $_SESSION['isLoggedIn']=true;
                $_SESSION['user']=$email;
                header('Location: admin/index.php');
                exit();
            }else{
                array_push($errors, "wrong password supplied");
            }
        }else{
            array_push($errors, 'Username not found');
        }

    if(empty($errors)){
        /* if there are no errors then get the values from database */
        
     }else{
        ?>
        <div class="mt-5" style="margin-top: 80px !important;">
        <?php
       foreach($errors as $error){
           ?>
           <div class="alert alert-danger">
          <?php echo $error."<br>"; ?>
           </div>
           <?php
       }
    }
    ?>
        </div>
    <?php

}

?>
<?php 
 include('includes/header.php'); 
 include('includes/nav.php'); 
 
 ?>
 
<div class="container container-edited">
    <div class="form-div">
        <form action="login.php" method="post">
            <div>
                <label for="username" class="label-edited">Email:</label>
                <input type="text" name="username" id="username" placeholder="e.g test@test.com" class="form-control" >
            </div>
            <div>
                <label for="password" class="label-edited">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mt-3">
            <a href="forgot-password.php">Forgot password</a>
            </div>
            <div class="mt-2">
                <button class="btn btn-primary" name="save" value="button">Sign in</button>
            </div>
        </form>
    </div>
</div>

<?php
include('includes/footer.php');
?>