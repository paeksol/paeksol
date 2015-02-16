if(isset($_POST) == true){
    $status = 1 // init to one, assume there will not be an error
    //Store the entered values in the variables
    $name = mysql_escape_string(trim($_POST['name']));
    $email = mysql_escape_string(trim($_POST['email']));
	$phone = mysql_escape_string(trim($_POST['phone']));
    $comments = mysql_escape_string(trim($_POST['comments']));
    $comments = str_replace('\r\n','<br>',$comments);

    // EMAIL HEADERS
    $headers = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=utf-8\n";
    $headers .= "X-Priority: 3\n";
    $headers .= "X-MSMail-Priority: Normal\n";
    $headers .= "X-Mailer: php\n";          
    $headers .= "From: *****<*****@l*****>\n";

    //SEND EMAIL TO BRANCH
    // EMAIL TITLE
    $subject = $name ;

    //message
    $message1 = "<style type=\"text/css\">";
    $message1 .= "div { font-family: Arial, Verdana, Tahoma; font-size: 10pt; line-height: 120%; }";
    $message1 .= "h1 { margin: 0; font-size: 14pt; }";
    $message1 .= "h2 { margin: 0; font-size: 12pt; }";
    $message1 .= "span { font-size: 9pt; font-weight: bold; }";
    $message1 .= "</style>\n";
    $message1 .= "<div>";
    $message1 .= "<p>" . $name . " </p>\n";
    $message1 .= " " . $email . "<br />";
    $message1 .= " " . $comments . "<br />";
    $message1 .= "</p>\n";
    $message1 .= "<br /><br />";
    $message1 .= "<br />";
    $message1 .= "</div>";

    //Send branch email
    $success = mail('patrick@systemvillage.com', $subject, $message1, $headers); 
    
    if (!$success) {
       $status = 0;
    }   
    echo $status;
}