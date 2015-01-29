<?php
include('config.php');

// Instantiate Chikka (passing credentials)
$chikka = new Chikka($credentials);

// Receive message
$chikka->receiveMessage(function($message) {
  // The Chikka_Message object will be passed on as parameter in this callback
  // To reply, just use the reply() function for the Chikka_Message object
  // To specify the cost of message, enter the amount in float as a second parameter 
  // Amounts are automatically rounded off to its nearest ceiling valid cost
  // Example, if the network of the sender's mobile number is Smart or Globe, and you set 2 pesos as the cost
  // Since 2 pesos is not a valid cost for Smart or Globe, it will automatically be rounded off to 2.50 pesos
	$msg = $message->message;
	$pieces = explode(",", $msg);

	$url = 'http://www.yellow-pages.ph/search/';
	$data = array('what' => trim($pieces[0]), 'where' => trim($pieces[1]));

	// use key 'http' even if you send the request to https://...
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data),
	    ),
	);

	$context  = stream_context_create($options);

	$result = file_get_contents($url, false, $context);

	preg_match_all("/<h4.*h4>/", $result, $matches);
	// $size = max(array_map('count', $matches));
	$reply = '';
	$sucess = 'Hello, we found this top 3 list: ';
	$fail   = 'Sorry, no result found on your query : '.$msg;
	if(!empty($matches[0][0]))
	{
		$reply = $sucess . $response = strip_tags($matches[0][0])." | ".strip_tags($matches[0][1])." | ".strip_tags($matches[0][2]);
	}
	else
	{
		$reply = $fail;
	}

	$message->reply($reply . $response, 'FREE');
	// Return true to tell Chikka that we received and accepted the message
	return true;
});
?>