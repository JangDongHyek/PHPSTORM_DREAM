<?

$conn_db=mysql_connect("211.51.221.165","emma","wjsghk!@#");
mysql_select_db("emma");
$mart_id = "khj"; //������

$rand_number = rand(111111,999999); 

$tran_phone1;//�޴� ��� ��ȣ
$tran_callback1 = "010-8228-7535";//������ ��� ��ȣ
$send_date = date("YmdHis");
$tran_msg1 = "[W.I.C KHAN]ȸ������ ������ȣ�� ".$rand_number."�Դϴ�.";
$sms_tf = 1;

$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
mysql_query($sms_query,$conn_db);

//��ü��ϳ����
$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
mysql_query($all_query,$conn_db);

echo $rand_number;
?>