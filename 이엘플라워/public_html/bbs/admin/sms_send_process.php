<?
$site_path = '../';
$site_url = '../';
require_once($site_path."include/admin.lib.inc.php");
$conn_db=mysql_connect("localhost","emma","ffpcm080");
mysql_select_db("emma");

$mart_id = "������"; //������


/*  ���̺� �����ؾ���

CREATE TABLE `tbl_sms` (
  `f_id` int(11) NOT NULL auto_increment,
  `f_idno` varchar(50) default NULL,
  `f_from_phone` varchar(20) default NULL,
  `f_to_phone` varchar(20) default NULL,
  `f_comment` text,
  `f_wdate` datetime default NULL,
  `f_type` int(1) NOT NULL default '0',
  PRIMARY KEY  (`f_id`)
)

*/

$allPhone_ex = explode(",",$allPhone); //�޴»����ȣ
$number_receive_people=0;
for($i=0;$i<sizeof($allPhone_ex);$i++){
	if($allPhone_ex[$i]){
		$tran_phone1 = $allPhone_ex[$i];//�޴� ��� ��ȣ ������

		$tran_callback1 = $rphone;//������ ��� ��ȣ
		$send_date = date("YmdHis");
		$tran_msg1 = $mbs_msg_member_join;


		$sms_query = "Insert into emma.em_tran (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1')";
		query($sms_query,$conn_db);
		
		//��ü��ϳ����
		$all_query = "Insert into emma.em_all_log (tran_pr,tran_id,tran_phone,tran_callback,tran_status,tran_date,tran_msg,reg_date) values (null,'$mart_id','$tran_phone1','$tran_callback1','1','$send_date','$tran_msg1',curdate())";
		query($all_query,$conn_db);

		$query = "Insert into tbl_sms(f_idno,f_from_phone,f_to_phone,f_comment,f_wdate) values('$mart_id','$tran_callback1','$tran_phone1','$tran_msg1','$send_date')";
		query($query,$dbcon);
	}
}
?>
<SCRIPT LANGUAGE="JavaScript">
<!--
alert('���ڰ� �߼۵Ǿ����ϴ�.');
history.go(-1);
//-->
</SCRIPT>
