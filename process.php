<?php
include('config.php');


	// Instantiate Chikka (passing credentials)
	$chikka = new Chikka($credentials);

	// Mobile number and message
	// Mobile number can have the prefix +63, 63, or 0

	if(isset($_POST['number']) && isset($_POST['msg']) ){

		$mobileNumber = $_POST['number'];
		$message = 		$_POST['msg'];
	
	}else{
		$mobileNumber = urldecode($_POST['number']);
		$message = urldecode($_POST['message']);
	}

	// Send SMS ($send will contain the Chikka_Response object)
	$send = $chikka->send($mobileNumber, $message);

	// If you don't want to specify a `message_id` as a 3rd parameter in the send() function,
	// A `message_id` is automatically generated (16 digits)
	// You can retrieve the `message_id` through the following
	$messageId = $send->msg->message_id;

	// Check if message was sent
	if ($send->success()) {

	  echo 'Message successfully sent';
	} else {
	  // Print error message
	  echo 'Message not sent. ', $send->message;
	}

		header('Refresh: 2; url=http://joenesms.azurewebsites.net/');

?>