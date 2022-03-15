<?php 
require 'admin/functions/dbconn.php';
include('includes/header.php'); 
include('includes/nav.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';

 include('includes/header.php'); 
 //include('includes/nav.php'); 

 if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$session=isset($_SESSION['isLoggedIn'])? $_SESSION['isLoggedIn']: false;
if($session){
    header('Location: admin/index.php');
    exit();
}


 $id=isset($_GET['id'])?$_GET['id']: '';

 if($id){
   // $mail=urldecode(base64_decode($id));
   $_SESSION['email_id']=$id;
   if($_SESSION['email_id']){
    header('Location: password-reset.php?id='.$id);
   }
    
 }

 $send=isset($_POST['send'])? $_POST['send']: '';
 if($send){
    $email=isset($_POST['email'])? $_POST['email']: '';

    if($email){
        $sql='SELECT * FROM tblusers WHERE email=:email LIMIT 1';
        $stmt=$connection->prepare($sql);
        $stmt->execute(['email'=>$email]);
        $email=$stmt->fetch();
        if($email){
            $mail = new PHPMailer(true);
           
            //$directory=substr($dir,strrpos($dir,'/'));
            $link="http://localhost".$_SERVER['REQUEST_URI']."?id=".urlencode(
            base64_encode($email['email']));
           // die($link);
            $message='
            <div>
                <p>Please follow this link to reset your password</p>
                <p><a href="'.$link.'">Click to reset</a></p>
            </div>
            ';
            try {
                //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;            
                $mail->Host = 'ssl://smtp.gmail.com:465';
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->Username = 'kaecomp1321@gmail.com'; // Gmail address which you want to use as SMTP server
                $mail->Password = 'Password123.'; // Gmail address Password
                $mail->Port = 465; //587
                $mail->SMTPSecure = 'ssl'; //tls
                $mail->addAddress($email['email']); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
                $mail->setFrom('kaecomp1321@gmail.com', 'Recipe site'); // Gmail address which you used as SMTP server
                //$mail->debug = 2;
                $mail->isHTML(true);
                $mail->Subject = 'Reset password (Recipe Site)';
                $mail->Body = $message;
                $mail->AltBody = '';

                if ($mail->Send()) 
                    $success['data'] = 'Email Sent successfully';
                else
                    $errors['mail'] = 'Email Not sent';
                

            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }else{
            ?>
            <br><br><br>
            <div class="alert alert-danger"><?php echo "email not found"; ?></div>
            <?php
        }
    }else{
        ?>
        <br><br><br>
        <div class="alert alert-danger"><?php echo "Email field cannot be empty"; ?></div>
        <?php
    }

 }
 
 ?>
<div class="container container-edited">
    <ol class="breadcrumb">Forgot Password</ol>
    <form action="forgot-password.php" method="post">
        <div class="col-md-8">
            <label for="email" style="color:black">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="Enter username/email">
            <br>
            <button class="btn btn-primary" value="button" name="send">Send</button>
        </div>
    </form>
</div>

<?php
include('includes/footer.php');
?>