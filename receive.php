<?php
include('config.php');
$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
	try
	{
		$message_type = $_POST["message_type"];
	}
	catch (Exception $e)
	{
		echo "Error";
		exit(0);
	}

	if (strtoupper($message_type) == "INCOMING")
	{
		try
		{	
			$message = $_POST["message"];
			$mobile_number = $_POST["mobile_number"];
			$shortcode = $shortCode;
			$timestamp = $_POST["timestamp"];
			$request_id = $_POST["request_id"];

			$response = $chikkaAPI->reply($request_id, '225011313', $mobile_number, 'Free', 'Got ur Message');
			header("HTTP/1.1 " . $response->status . " " . $response->message);

			echo $response->description;

			// $arr_post_body = array(
			// "message_type" => "SEND",
			// "mobile_number" => $mobile_number,
			// "shortcode" => "2929001511",
			// "message_id" => "11111111111111111111111111",
			// "message" => "Welcome to My Service!",
			// "client_id" => "30c78bec559d12c8e83b37ebaebf1c2b50b0be997d24a76e11317a8f01e2c0a0",
			// "secret_key" => "1b2238693e1ff6b4afd35ad6dfa2976ee79704878172a524d6625f83f03d8b97"
			// );

			// $query_string = "";
			// foreach($arr_post_body as $key => $frow)
			// {
			// 	$query_string .= '&'.$key.'='.$frow;
			// }

			// $URL = "https://post.chikka.com/smsapi/request";
			// $curl_handler = curl_init();
			// curl_setopt($curl_handler, CURLOPT_URL, $URL);
			// curl_setopt($curl_handler, CURLOPT_POST, count($arr_post_body));
			// curl_setopt($curl_handler, CURLOPT_POSTFIELDS, $query_string);
			// curl_setopt($curl_handler, CURLOPT_RETURNTRANSFER, TRUE);
			// $response = curl_exec($curl_handler);
			// curl_close($curl_handler);
			// exit(0);
			// echo "Accepted";
			// exit(0);
		}
		catch (Exception $e)
		{
			echo "Error";
			exit(0);
		}
	}
	else
	{
		echo "Error";
		exit(0);
	}
?>