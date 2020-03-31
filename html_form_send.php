<?php
if(isset($_POST['email_input'])) {
     
    // CHANGE THE TWO LINES BELOW
    $email_to = "nico@ismaili.de";
    $email_subject = $_POST['email_subject_input'];
    
     if(strlen($email_subject) > 1 || $email_subject == null){
         $email_subject = "No subject";
     }

    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
     
    // validation expected data exists
    if(!isset($_POST['name_input']) || //name = 1
        !isset($_POST['phone_input']) || //phone = 2
        !isset($_POST['email_input']) || //e-mail = 3
        !isset($_POST['email_subject_input']) || //subject = 4
        !isset($_POST['message_input']) ) //message = 5
        { 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
     
    $name = $_POST['name_input']; // required
    $phone = $_POST['phone_input']; // not required
    $email_from = $_POST['email_input']; // required
    $message = $_POST['message_input']; // required
     
    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    $name_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The email address you entered does not appear to be valid.<br />';
  }

  if(!preg_match($name_exp,$name)) {
    $error_message .= 'The name you entered does not appear to be valid.<br />';
  }

  if(strlen($message) < 2) {
    $error_message .= 'The message you entered does not appear to be valid. Please enter a message with 2 or more characters.<br />';
  }

  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "E-Mail: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
     
     
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
<!-- place your own success html below -->
Thank you for contacting us. We will be in touch with you very soon.
<?php
}
die();
?>