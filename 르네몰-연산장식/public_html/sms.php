<?
include "connect_sms.php";
for( $i = 1; $i <= 16079; $i++ ){
	$sms_sql = "insert into em_tran_backup (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '011-598-5462', '051-807-7823', '1', '2005-08-27 11:55:44', '���������� �Աݳ����� Ȯ�εǾ����ϴ�.�ֹ���ȣ pwmall20050825111113405[PWMall]' )";
	$sms_res = mysql_query( $sms_sql, $connect );

	$sms_sql1 = "insert into em_tran_backup (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '011-9268-153', '051-807-7823', '1', '2005-08-27 11:55:44', '�ֹ���ȣ Array�Ա��� Ȯ�εǾ����ϴ�.��ǰ�� ������ֽʽÿ�.[PWMall]' )";
	$sms_res1 = mysql_query( $sms_sql1, $connect );

}
if( !$sms_res ){
	echo "���� ����";
}
if( !$sms_res1 ){
	echo "<br>���� ����1";
}
mysql_close( $connect );
?>