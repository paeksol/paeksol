<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>mailer test</title>

</head>
<body>

<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$comments = $_POST['comments'];


if(!isset($contactFormErrors)) {
		$emailTo = 'patrick@systemvillage.com'; // Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nPhone Number: $phone \n\nSubject: $subject \n\nComments:\n $comments \n\nCurrent page: $page";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		echo $emailTo, $subject, $body, $headers;
		$emailSent = true;
	}
}
?>	

<h2 <?php echo $emailTo, $subject, $body, $headers; ?> />

</body>
</html>
