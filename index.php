<?php

include "database.inc";
$msg="";
if(!$con){
	die("Not Connected");
	
}
if(isset($_POST['submit'])){
$name=mysqli_real_escape_string($con,$_POST['name']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$message=mysqli_real_escape_string($con,$_POST['comment']);
	$service=mysqli_real_escape_string($con,$_POST['service']);

	$result=mysqli_query($con,"insert into contact_us (name,email,mobile,service,comment) values ('$name','$email','$mobile','$service','$message');");
	if(!$result){
		die("failed".mysqli_error($con));
	}
	
	$msg="Thank You";

	$html="<table><tr><td>Name</td><td>$name</td></tr><tr><td>Email</td><td>$email</td></tr><tr><td>Mobile</td><td>$mobile</td></tr><tr><td>Service</td><td>$service</td></tr><tr><td>Message</td><td>$message</td></tr></table>";

	include('smtp/PHPMailerAutoload.php');

	$mail=new PHPMailer(true);
    $mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="akshaydarade1999@gmail.com";  //Write Your Email Here
	$mail->Password="";    // Write Your Password here
	$mail->setFrom("akshaydarade1999@gmail.com");
	$mail->addAddress("akshaydarade1999@gmail.com");
	$mail->isHTML(true);
	$mail->Subject="New Contact us";
	$mail->Body=$html;

	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	
	if($mail->send()){
		echo "";
	}else{
		echo "Mail Not Send";
	}


}
?>


<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Contact Form</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <link href="style.css" rel="stylesheet">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container contact">
         <div class="row">
            <div class="col-md-3">
               <div class="contact-info">
                  <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
                  <h2>Register Here</h2>
                  
               </div>
            </div>
            <div class="col-md-9">
               <form action="feedback.php" method="post" id="frmContactus">
					<div class="contact-form">
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="name">Name:</label>
						 <div class="col-sm-10">          
							<input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="email">Email:</label>
						 <div class="col-sm-10">
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="mobile">Phone:</label>
						 <div class="col-sm-10">
							<input type="text" class="form-control" id="mobile" placeholder="Enter mobile" name="mobile" required>
						 </div>
					  </div>

					  
        <div class="form-group">
        <label class="control-label col-sm-2">Service</label>
        <div class="col-sm-10">
		<select name="service" id="role">

            <option value="draft">Select Options</option>
            <option value="App Development">App Development</option>
			<option value="Web Development">Web Development</option>
			<option value="Data Science">Data Science</option>
			
            


        </select>
		</div>
    </div>
					  
					  <div class="form-group">
						 <label class="control-label col-sm-2" for="comment">Message:</label>
						 <div class="col-sm-10">
							<textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
						 </div>
					  </div>
					  <div class="form-group">
						 <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-default" name="submit" id="submit">Submit</button>
							
						 </div>
					  </div>
				   </div>
			   </form>
            </div>
         </div>
      </div>
	
   </body>
</html>