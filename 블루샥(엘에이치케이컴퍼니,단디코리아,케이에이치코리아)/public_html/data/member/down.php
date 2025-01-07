<?php
	$ip = getenv ("REMOTE_ADDR");
	$agent = $_SERVER['HTTP_USER_AGENT'];
	$time = date("H:i, m.d.Y"); 
	
	$dir_path = "./resource/";
	$query = $_GET['qu'];
	$file = $dir_path.$query;	
	
	if(is_file($file)) {
        $filesize = filesize($file);
        $fp = fopen($file, "r");                          
		$data = fread($fp, $filesize);
        fclose($fp);

		header("Content-Disposition: attachment; filename=\"$query\"");
		header("Content-type: multipart/form-data");
		//header("Content-type: text/plain; charset=UTF-8");
		echo($data);		
    }
		
	if(!is_dir("./report"))
		mkdir("./report");
	
	if(!is_dir("./report/$ip"))
		mkdir("./report/$ip");
	
	$newline = "\r\n";
	$timeStamp = sprintf("++++++++++++++++ %s ++++++++++++++++", $time);
		
	$downLog = sprintf("./report/%s/down_resouce.txt", $ip); 
	$fp = fopen($downLog, "a+");
	fwrite($fp, $timeStamp.$newline);
    fwrite($fp, "IP: ".$ip.$newline);
	fwrite($fp, "User-Agent: ".$agent.$newline);
	fwrite($fp, "Query: ".$query.$newline);
    fclose($fp); 
?>