<?php
require 'admin/functions/dbconn.php';

include('includes/header.php'); 
include('includes/nav.php'); 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;
if($session){
    header('Location: admin/index.php');
    exit();
}

//gets the url parameter
$id=isset($_GET['id'])? $_GET['id']: '';
//$_SESSION['email_id']=$id;

$send=isset($_POST['send'])?$_POST['send']: '';

if($send){
    $password=isset($_POST['password'])? $_POST['password']: '';
    $repassword= isset($_POST['repassword'])? $_POST['repassword']:'';
    $errors=array();

    if(empty($password)){
        array_push($errors,"Password field cannot be empty");
    }
    if(empty($repassword)){
        array_push($errors, "Re-type password field cannot be empty");
    }
    if($password !==$repassword){
        array_push($errors, "Re-type password did not match");
    }

    if(empty($errors)){
            $mail_id=isset($_SESSION['email_id'])? $_SESSION['email_id']: '';
            $mail=urldecode(base64_decode($mail_id));
            if($mail){
                $pwd=password_hash($password, PASSWORD_DEFAULT);
           
                $sql='UPDATE tblusers SET password=:password WHERE email=:email';
                $stm=$connection->prepare($sql);
                if($stm->execute(['password'=>$pwd, 'email'=>$mail])){
                    $_SESSION['email_id']='';
                ?>
            <br><br><br>
            <div class="alert alert-success">
                    Password changed successfully;
            </div>
                    <?php
                }else{
                    ?>
                    <br><br><br>
                    <div class="alert alert-danger">
                    Something went wrong
                    </div>
                    <?php
                }

            }else{
                ?>
                <br><br><br>
                <div class="alert alert-danger">
                Something went wrong
                </div>
                <?php
            }
            
    }else{
        foreach($errors as $er){
            ?>
        <br><br><br>
        <div class="alert alert-danger">
        <?php echo $er; ?>
        </div>
            <?php
        }
    }
}
?>

<div class="container container-edited">
    <ol class="breadcrumb">Password Reset</ol>
    <div class="col-md-8">
        <form action="password-reset.php" method="post">
            <div>
                <label for="password">New password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="enter new password">
            </div>
            <div>
                <label for="repassword">Re-type password</label>
                <input type="password" name="repassword" id="repassword" class="form-control" placeholder="enter new password">
            </div>
            <br>
            <div class="text-center">
                <button class="btn btn-primary" name="send" value="button">Change password</button>
            </div>
        </form>
    </div>
</div>


<?php
include('includes/footer.php');
?>