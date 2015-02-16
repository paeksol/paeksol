<?php 

include("header.php");

error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['name']) === '') {
		$nameError =  'Forgot your name!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot to enter in your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
	// need valid phone
	if(trim($_POST['phone']) === '')  {
		$emailError = 'Forgot to enter in your phone number.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
				
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$emailTo = 'patrick@systemvillage.com';
		$subject = 'Submitted message from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\Phone: $phone \n\nComments: $comments";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>
<div class="right-section col-md-3 col-sm-3">
	<div class="row">
    <div class="Login-form">
	<div class="login-top"><h1>Drop Us A Message</h1></div>
	<div class="login-body">
	 <div class="successHolder topMargin whiteText" id="basicsSuccess">
	          Thank you. Your message has been sent. We will get back to you shortly.
	 </div>
	 <div class="errorsHolder" id="contactFormErrors">
            Please correct the following errors;

            <ul>
                <span id="nameErrorShow" style="display:none;"><li><span id="nameError"></span></li></span>
                <span id="emailErrorShow" style="display:none;"><li><span id="emailError"></span></li></span>
                <span id="phoneErrorShow" style="display:none;"><li><span id="phoneError"></span></li></span>
                <span id="messageErrorShow" style="display:none;"><li><span id="messageError"></span></li></span>
            </ul>
        </div>
	<div class="">
	<form id="contact-us" action="newcontact2.php" method="post">
						<div class="formblock">
							<label class="screen-reader-text">Name</label>
							<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="txt requiredField" placeholder="Name:" />
							
						</div>
                        
						<div class="formblock">
							<label class="screen-reader-text">Email</label>
							<input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="txt requiredField email" placeholder="Email:" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
						
                        <div class="formblock">
							<label class="screen-reader-text">Phone</label>
							<input type="text" name="phone" id="phone" value="<?php if(isset($_POST['phone']))  echo $_POST['phone'];?>" class="txt requiredField" placeholder="Phone:" />
							<?php if($emailError != '') { ?>
								<br /><span class="error"><?php echo $emailError;?></span>
							<?php } ?>
						</div>
						<div class="formblock">
							<label class="screen-reader-text">Message</label>
							 <textarea name="comments" id="commentsText" class="txtarea requiredField" placeholder="Message:"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
							<?php if($commentError != '') { ?>
								<br /><span class="error"><?php echo $commentError;?></span> 
							<?php } ?>
						</div>
                        
							<button name="submit" type="submit" class="subbutton">Send us Mail!</button>
							<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>			
	</div>
	</div>
	</div>
	</div> <!--right-section-->
<style type="text/css">
	textarea{
		background: none repeat scroll 0 0 #ecede9;
	    border: 1px solid #c9cac6;
	    height: 118px;
	    padding: 0 2%;
	    width: 85%;
	    margin-left: 24px;
	}
</style>	
	
<script type="text/javascript">
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$('form#contact-us').submit(function() {
			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($.trim($(this).val()) == '') {
					var labelText = $(this).prev('label').text();
					$(this).parent().append('<span class="error">Your forgot to enter your '+labelText+'.</span>');
					$(this).addClass('inputError');
					hasError = true;
				} else if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error">Sorry! You\'ve entered an invalid '+labelText+'.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contact-us').slideUp("fast", function() {				   
						$(this).before('<p class="tick"><strong>Thanks!</strong> Your email has been delivered.</p>');
					});
				});
			}
			
			return false;	
		});
	});
	//-->!]]>
</script>