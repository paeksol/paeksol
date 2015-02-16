<!DOCTYPE HTML>
<html>
echo '$message'
</html>
<?php

require_once '/Swiftmailer/lib/swift_required.php';


$transport = Swift_MailTransport::newInstance();


// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('A Subject')
  ->setTo('patrick@systemvillage.com)
  ->setSubject('Test subject')
  ->setBody('Here is the message itself')
  ;

// Send the message
$result = $mailer->send($message);

?>