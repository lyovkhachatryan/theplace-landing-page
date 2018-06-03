<?php

	function sendMail($name, $email, $comment) {
		$email_to = 'andranik@hovesyan.pro';
		$subject = 'The Place Contact';
			
		$result = [];
		$error = false;
		if (strlen($name) <= 3) {
			$error = 'Name is too short';
		} else if (strlen($comment) <= 10) {
			$error = 'Message is too short';
		} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error = 'Email is invalid';
		}

		if ($error){
			$result['success'] = false;
			$result['message'] = $error;
		} else {

			$message = 'Name: ' . $name . "\r\n";
			$message.=  'Email: ' . $email . "\r\n";
			$message.=  'Message: ' . $comment;

			$headers = 'From: no-reply@theplace.am' . "\r\n";
			$headers.= 'Reply-To: ' . $email . "\r\n" ;
			
			$sent = mail($email_to, $subject, $message, $headers);

			if ($sent) {
				$result['message'] = 'Thank you!';
				$result['success'] = true;
			} else {
				$result['message'] = 'Please try again later';
				$result['success'] = false;
			}
		}	

		

		return $result;
	}
	

	


	if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['comment'])) {

		$result = sendMail($_POST['name'], $_POST['email'], $_POST['comment']);

		echo json_encode($result);
	}
