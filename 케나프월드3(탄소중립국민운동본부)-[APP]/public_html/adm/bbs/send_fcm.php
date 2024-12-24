<?php 
	
include_once('./_common.php');

	function send_notification ($tokens, $data)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';

	


		$fields = array(
				'registration_ids'		=> $tokens,
				'data'	=> $data,
				'priority'          => 'high'
			);



		$headers = array(
			'Authorization:key =AAAAukQdebA:APA91bFn3rJLI7J5v3H8X2W9bwHU6k8eH1cOKEwqCdP7mYL6sPbT1dFIGXemw6gmHLCZQ1C6M0bVVWWQDXuTNsgV1KbZZoGchl14TkGPKR2WxWnDtOVlA37JYxdAIbXrPJglpGLz4Qvm' ,
			'Content-Type: application/json'
			);
	
	
		
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);    

       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}
	

	$sql = "select token from push_token";
	$tokens = array();
	$result = sql_query($sql);			//행 개수

	for	($i = 0; $row = sql_fetch_array($result); $i++) {	// while($row = sql_fetch_array($result)){
			$tokens[$i] = $row['token'];
	}


	$mTitle = "테스트 웹발신"; //title

    $mMessage = "테스트메듀플러스웹발신입니다."; //text
	$mUrl = "https://naver.com";

	$inputData = array("title"=>$mTitle,"text"=>$mMessage, "url"=>$mUrl);

	$result_notification = send_notification($tokens, $inputData);



 ?>
