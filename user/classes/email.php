<?php
require("../sendgrid-php/sendgrid-php.php");

class email{
	
public function sendEmail($to, $subject, $message){
        $sendgrid = new SendGrid('kkamalthakker696', 'm0nm0uth'); 
		$email    = new SendGrid\Email();
	
		// Overwrite
		//$to 	= "kamalthakker@gmail.com";
		
		// Not working
		//$message = '<html><head><script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"></head><body>' . $message . '</body></html>';
		
		$email->addTo($to)
			  ->addCc("s0962803@monmouth.edu")	
		      ->setFrom("SkillsEndorsement@skillsendorsement-monmouth.rhcloud.com")
		      ->setSubject($subject)
		      ->setHtml($message);
		
		$sendgrid->send($email);
		
	} // sendEmail	

} // End of class	
?>