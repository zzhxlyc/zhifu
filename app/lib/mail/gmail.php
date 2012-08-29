<?php 
APP::load_util('mail');

function send_gmail($subject, $body, $to, $to_name){
	$mail = new PHPMailer();
	$body = eregi_replace('[\]','',$body);
	$mail->IsSMTP(); 						   // telling the class to use SMTP
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
	                                           // 1 = errors and messages
	                                           // 2 = messages only
	$mail->CharSet    = 'UTF-8';
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = 'ssl';                 // sets the prefix to the servier
	$mail->Host       = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = MAIL_USER;  // GMAIL username
	$mail->Password   = MAIL_PSWD;            // GMAIL password
	
	$mail->SetFrom(MAIL_USER, MAIL_NAME);
	$mail->Subject = $subject;
	$mail->MsgHTML($body);
	$mail->AddAddress($to, $to_name);
	if(!$mail->Send()) {
		return $mail->ErrorInfo;
	} 
	else {
		return true;
	}
}
