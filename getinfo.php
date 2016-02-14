<?php

require("sendgrid-php/sendgrid-php.php");
	 
echo 'hostname:' . gethostname(). '<br/>';
echo 'servername:'. $_SERVER['SERVER_NAME'];
?>

<!-- send email-->
     <?php
	     
	     /*
         $to = "kamalthakker@gmail.com";
         $subject = "MITRE - Skills Endorsement";
         
         //$message = "<b>A new project added, please approve</b>";
         $message .= "<h1>A new project added, please approve.</h1>";
         
         $header = "From:s0962803@monmouth.edu \r\n";
         $header = "Cc:s0962803@monmouth.edu \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         } 
         */
         
         echo '<br/>sending via sendgrid...'. getenv('SENDGRID_USERNAME');
         
         //$sendgrid = new SendGrid(getenv('SENDGRID_USERNAME'), getenv('SENDGRID_PASSWORD'));
         
         $sendgrid = new SendGrid('kkamalthakker696', 'm0nm0uth');
         
$email    = new SendGrid\Email();

$email->addTo("s0962803@monmouth.edu")
      ->setFrom("MITRE.SE.Notifications@skillsendorsement-monmouth.rhcloud.com")
      ->setSubject("hello")
      ->setHtml("and easy to do anywhere, even with PHP");

$sendgrid->send($email);

echo '<br/>sent via sendgrid...';
         
         
      ?>