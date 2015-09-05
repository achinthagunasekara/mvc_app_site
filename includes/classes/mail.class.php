<?php

class Mail
{
	public function send_email($body)
	{
		global $config;

		$mail = new PHPMailer();
	
		$mail->IsSMTP();  // telling the class to use SMTP
		$mail->Host     = $config["CONTACT_ME"]["mail_server"]; // SMTP server
		$mail->FromName = $config["CONTACT_ME"]["from_name"];
		$mail->From     = $config["CONTACT_ME"]["from"];
		$mail->AddAddress($config["CONTACT_ME"]["to"]);
		$mail->Subject  = $config["CONTACT_ME"]["subject"];
		$mail->Body     = $body;
		$mail->WordWrap = 50;
	
		if(!$mail->Send())
		{
			$error = 'Mailer error: ' . $mail->ErrorInfo;
		}

		return $error;
	}
}

?>
