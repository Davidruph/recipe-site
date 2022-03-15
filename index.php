<?php
//include database connection
require 'admin/functions/dbconn.php';

//fetch recipe
$sql = 'SELECT * FROM tblrecipe';
$statement = $connection->prepare($sql);
$statement->execute();
$recipe = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
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
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
   $postingdate = date("Y-m-d H:i:s", time());

  $mail = new PHPMailer(true);

  try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;            
    $mail->Host = 'ssl://smtp.gmail.com:465';
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Username = 'kaecomp1321@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'Password123.'; // Gmail address Password
    $mail->Port = 465; //587
    $mail->SMTPSecure = 'ssl'; //tls
    $mail->addAddress('kaecomp1321@gmail.com'); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)
    $mail->setFrom('kaecomp1321@gmail.com', 'Contact Form'); // Gmail address which you used as SMTP server
    //$mail->debug = 2;
    $mail->isHTML(true);
    $mail->Subject = 'Message Received From (Recipe Site)';
    $mail->Body = "<P>Name: $name<br>Email: $email<br>Message: $message</P>";
    $mail->AltBody = '';

 $sql = 'INSERT INTO tblmail(email, name, message, PostingDate) VALUES(:email, :name, :message, :postingdate)';
		$statement = $connection->prepare($sql);

  if ($statement->execute([':email' => $email, ':name' => $name, ':message' => $message, ':postingdate' => $postingdate])) {
   		$mail->Send();
    $success['data'] = 'Your Email has been sent!';
  }else{
    $errors['data'] = 'Ooops, an error occured';
  }
    

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


}

?>


 <?php 
 include('includes/header.php'); 
 include('includes/nav.php'); 
 
 ?>


<main role="main" class="bg-light" style="">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
       <img src="image/slide1-1.jpg" style="filter: brightness(50%);">
       <div class="carousel-caption text-center">
            <h1>Potatoes and Salad Mixed</h1>
            <p>This is a really nice delicacy to eat during your lunch hours</p>
            
          </div>

    </div>
    <div class="carousel-item">
      <img src="image/slide1-2.jpg" style="filter: brightness(50%);">
       <div class="carousel-caption text-center">
            <h1>Freshly made vegetables.</h1>
            <p>Freshly made vegetables with oranges, cowpeas and some assorted fruits to prepare your bele for the main course meal</p>
            
          </div>
    </div>
    <div class="carousel-item">
      <img src="image/slide1-3.jpg" style="filter: brightness(50%);">
      <div class="carousel-caption text-center">
      
            <h1>Strawberry Sauce</h1>
            <p>Rice, strawberry, oranges, sounds like fun. we all need that extra balance in terms of balanced diet.</p>
           
            
          </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container-fluid recipe">
<div class="text-center"><h4 style="text-transform: uppercase;">Featured</h4></div><br>
 <div class="row">
      <div class="col-lg-4" id="featured">
	<div class="card">
	  <img src="img/product/product2.jpg" class="img-fluid">
	  <div class="card-body">
	    <h5 class="card-title">Pumpkin Cheesecake & Gingersnap Crust</h5>
	    <p class="card-text">This pumpkin cheesecake with gingersnap crust is the ultimate pumpkin dessert for Thanksgiving or Friendsgiving celebrations! Make-ahead friendly, easily gluten-free. </p>
	    
	  </div>
</div>
</div>

<div class="col-lg-4">
	<div class="card">
	  <img src="img/product/product1.jpg" class="img-fluid">
	  <div class="card-body">
	    <h5 class="card-title">Tomatoes Stuffed with Foie Gras, Duck Confit, and Chanterelles</h5>
	    <p class="card-text">Foie gras, chanterelles, and black truffle juice combine to make a particularly luxurious filling for tomatoes.</p>
	    
	  </div>
</div>
</div>

<div class="col-lg-4">
	<div class="card">
	  <img src="img/product/product3.jpg" class="img-fluid">
	  <div class="card-body">
	    <h5 class="card-title">Blueberry Juice with Lemon Cream</h5>
	    <p class="card-text">Blending vanilla yogurt and reduced-fat cream cheese creates a topping that's as virtuous as it is delicious. Any fresh berry can be used in this recipe. </p>
	    
	  </div>
</div>
</div>
</div>
	<div class="text-center"><h4 style="text-transform: uppercase;">Recipes</h4></div><br><br>
  <div class="row mb-2 ">

  	 <?php foreach($recipe as $reci): //php fetch blog post from database?>

    <div class="col-md-6" id="recipe">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary"><?php echo $reci['Author']; ?></strong>
          <h3 class="mb-0"><?php echo $reci['RecipeName']; ?></h3>
          <div class="mb-1 text-muted"><?php echo $reci['PostingDate']; ?></div>
          <p class="card-text mb-auto"><?php echo $reci['category']; ?></p>
           <form action="recipe-details.php"  method="post">
                <input type="hidden" name="edit_id" value="<?php echo $reci["id"]; ?>">
                  <button type="submit" name="btn_edit" class="btn btn-link stretched-link">Continue reading</button>
            </form>
          <!-- <a href="#" class="stretched-link">Continue reading</a> -->
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="admin/uploads/<?php echo $reci['image']; ?>" class="img-fluid">
        </div>
      </div>
    </div>


    <?php endforeach; ?>
   
    
  </div>
  <br>
    <div class="text-center"><h4 style="text-transform: uppercase;">Contact Page</h4></div><br><br>
<div class="jumbotron bg-teal" id="contact" style="background-color: teal;color: white;">
	<h4 class="text-center">Want to send us a message?</h4><br><br>
	<div class="row">
		
	<div class="col-sm-12 col-md-6 col-lg-7">
<form method="post" action="index.php">
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
	<div class="form-group">
	    <label for="name">Your Name</label>
	    <input type="text" class="form-control" name="name" id="name" placeholder="John Doe" required="">
  </div>

  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required="">
  </div>
  
  <div class="form-group">
    <label for="message">Message</label>
    <textarea class="form-control" id="message" name="message" rows="3" placeholder="Message" required=""></textarea>
  </div>

  <div class="form-group">
    <input type="submit" name="submit" name="submit" class="btn btn-block btn-info">
  </div>
</form>
	</div>

	<div class="col-sm-12 col-md-6 col-lg-5" style="">
		
		<div class="form-group add" style="">
				<label class="move">Contact:</label>
	    <p><a href="tel:5554280940"class="text-white">000-000-000</a></p>
  		</div>
  		<div class="form-group add">
  			<label class="move">Address:</label>
		    <p>25 Food Street, London</p>
	  		</div>

	  		<div class="form-group">
  			<label>About:</label>
		    <p>A recipe website that is estimated to have over 100 visitors each month. With a crisp and easily navigable site and backing of skilled and experienced culinary masters, this platform furnishes its visitors with hundreds of recipes and meal preparation information. It also features comprehensive how-to-do guides on absolutely everything food-related topics.</p>
	  		</div>
		</div>
	</div>
</div>

</div>
<div class="col text-right">
        <a class="social" href="#"><i title="go back up" style="color: teal;" class="fa fa-arrow-up"></i></a>
     </div>
</main>

<?php
include('includes/footer.php');
?>