<?
include "connect_sms.php";
for( $i = 1; $i <= 16079; $i++ ){
	$sms_sql = "insert into em_tran_backup (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '011-598-5462', '051-807-7823', '1', '2005-08-27 11:55:44', '권이혁님의 입금내역이 확인되었습니다.주문번호 pwmall20050825111113405[PWMall]' )";
	$sms_res = mysql_query( $sms_sql, $connect );

	$sms_sql1 = "insert into em_tran_backup (tran_pr, tran_phone, tran_callback, tran_status, tran_date, tran_msg ) values (null, '011-9268-153', '051-807-7823', '1', '2005-08-27 11:55:44', '주문번호 Array입금이 확인되었습니다.상품을 배송해주십시오.[PWMall]' )";
	$sms_res1 = mysql_query( $sms_sql1, $connect );

}
if( !$sms_res ){
	echo "쿼리 실패";
}
if( !$sms_res1 ){
	echo "<br>쿼리 실패1";
}
mysql_close( $connect );
?>