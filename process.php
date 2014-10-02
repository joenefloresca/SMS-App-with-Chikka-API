<?php
include('config.php');
if(isset($_POST['submit']))
{

	$num = $_POST['number'];
	$msg = $_POST['msg'];
	$chikkaAPI = new ChikkaSMS($clientId,$secretKey,$shortCode);
	$response = $chikkaAPI->sendText('00090', $num, $msg);
	header("HTTP/1.1 " . $response->status . " " . $response->message);

	echo $response->description;
	echo "<br /> You will be redirected after 3 seconds.";

	header('Refresh: 3; url=http://joenesms.azurewebsites.net/');
}


?>