<?php
require 'admin/functions/dbconn.php';

include_once getcwd() . '/securimage/securimage.php';

session_start();
$session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;
if($session){
    header('Location: admin/index.php');
    exit();
}

$fullname=isset($_POST['fullname'])? $_POST['fullname']:'';
$email=isset($_POST['email'])? $_POST['email']: '';
$password=isset($_POST['password'])? $_POST['password']: '';
$passwordconfirmation=isset($_POST['passwordconfirmation'])? $_POST['passwordconfirmation'] : '';
$save=isset($_POST['save']) ? $_POST['save']: '';
$role='Content Editor';
$errors=array();

if($save){
    
/*
captcha implementation, the captcha implemented was from
https://github.com/dapphp/securimage
*/
    $securimage = new Securimage();

    if ($securimage->check($_POST['captcha_code']) == false) {
        // the code was incorrect
        // you should handle the error so that the form processor doesn't continue
      
        // or you can use the following code if there is no validation or you do not know how
        echo "The security code entered was incorrect.<br /><br />";
        echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
        exit;
      }else{
            if(!$fullname){
                array_push($errors,'Fullname field cannot be empty');
            }
            if(!$email){
                array_push($errors, "Email field cannot be empty");
            }
            if(!$password){
                array_push($errors,'Password field cannot be empty');
            }
            if(!$passwordconfirmation){
                array_push($errors, "Password confirmation does not match");
            }
            if($password !== $passwordconfirmation){
                array_push($errors, "password confirmation mismatch");
            }
            if($email){
                $sql="SELECT * FROM tblusers WHERE email=:email";
                $stmt=$connection->prepare($sql);
                $stmt->execute(['email'=>$email]);
                $emails=$stmt->fetch();
                if($emails){
                    array_push($errors, "email taken");
                }
            }
        
            if(empty($errors)){
            /* if there are no errors then save to database */
            $sql="INSERT INTO tblusers (fullname, email, password, role) VALUES (:fullname, :email, :password, :role)";
            $con=$connection->prepare($sql);
            if($con->execute(['fullname'=>$fullname, 'email'=>$email, 'password'=>password_hash($password, PASSWORD_DEFAULT),'role'=>$role])){
                ?>
                <div class="alert alert-success" style="margin-top: 15px !important;">
                <?php echo "<br><br><br>"."User saved successfully"; ?>
                </div>
                <?php
            }else{
                echo "there was an error";
            }
            }else{
                ?>
                <div class="mt-5" style="margin-top: 15px !important;">
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
      }
      


    
?>

<?php 
 include('includes/header.php'); 
 include('includes/nav.php'); 
 
 ?>
 
<div class="container container-edited">
    <div class="form-div">
        <form action="signup.php" method="post">
            <div>
                <label for="fullname" class="label-edited">Full name:</label>
                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="e.g John Doe" >
            </div>
            <div>
                <label for="email" class="label-edited">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="e.g johndoe@gmail.com" >
            </div>
            <div>
                <label for="password" class="label-edited">Password:</label>
                <input type="password" name="password" id="password" class="form-control" >
            </div>
            <div>
                <label for="passwordconfirmation" class="label-edited">Password confirmation:</label>
                <input type="password" name="passwordconfirmation" id="passwordconfirmation" class="form-control" >
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image" />
                </div>
                <div class="col">
                    <input type="text" name="captcha_code" size="10" maxlength="6" class="form-control" />
                    <a href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
                </div>

            </div>
            <div class="mt-2 text-center">
                <button class="btn btn-secondary" name="save" value="button">Save</button>
            </div>
            <br>
        </form>
    </div>
</div>

<?php
include('includes/footer.php');
?>