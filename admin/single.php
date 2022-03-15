<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
$errors = array();
$success = array();
//if submit button is clicked and inputs are not empty
if (isset($_POST['submit'])) {
  $user = $_POST['user'];
  $message = $_POST['message'];
  

  $mail = new PHPMailer(true);

  try {
    //Server settings
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;            
    $mail->Host = 'ssl://smtp.gmail.com:465';
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = 'kaecomp1321@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'Password123.'; // Gmail address Password
    $mail->Port = 465; //587
    $mail->SMTPSecure = 'ssl'; //tls
    $mail->addAddress($user); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
    $mail->setFrom('kaecomp1321@gmail.com', 'Updates/Offers'); // Gmail address which you used as SMTP server
    //$mail->debug = 2;
    $mail->isHTML(true);
    $mail->Subject = 'Message Received From (Recipe Site)';
    $mail->Body = "$message";
    $mail->AltBody = '';

    if ($mail->Send()) 
        $success['data'] = 'Email Sent successfully';
    else
         $errors['mail'] = 'Email Not sent';
    

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}

?>
<?php
    //All header tag to be included
    include('include/header.php');

    //db connection included
require 'functions/dbconn.php';


?>

<?php
    //sidebar tag to be included
    include('include/sidebar.php');
?>


<main>
    <div class="container-fluid">
        <h1 class="mt-4">Single Mail </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Send Mail Page</li>
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
        <form class="form-horizontal" name="single" method="post" autocomplete="off" action="single.php">
            <div class="form-group">
                <label class="col-md-6 control-label">Select or Enter Author email</label>
                <div class="col-md-10">
                    <input list="browser" name="user" id="user" class="form-control" required>
                </div>
            </div>
              <?php
                  $sql = 'SELECT * FROM tblauthor';
                  $statement = $connection->prepare($sql);
                  $statement->execute();
                  $category = $statement->fetchAll(PDO::FETCH_OBJ);
              ?>

              <datalist id="browser">

                <?php foreach($category as $cat): ?>
                 <option value="<?= $cat->email; ?>"></option>
                 <?php endforeach; ?>
              </datalist>

                <div class="form-group">
                    <label class="col-md-4 control-label">Message</label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="5" name="message" id="message"></textarea>
                    </div>
                </div>

                <div class="form-group">
                <label class="col-md-2 control-label">&nbsp;</label>
                <div class="col-md-10">
              
            <button type="submit" class="btn btn-primary btn-block" name="submit">
                Send Mail
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
 
$("#message").summernote({
  placeholder: 'Enter Message here...',
        height: 100,
    });
</script>
 