<?
//================== DB ���� ������ �ҷ��� ===============================================
include "../../connect.php";
?>
<?
if($flag == "comdel"){
	if(!$Mall_Admin_ID&&$MemberLevel!=1){
		if( !$cmt_password ){
			echo("
				<script>
				window.alert('��й�ȣ�� �Է��ϼž� �մϴ�.');
				history.go(-1)
				</script>
			");
			exit;
		}
		$query = "select c_password from board_comment where c_no='$c_no' and index_no='$index_no' and bbs_no='$bbs_no' and mart_id='$mart_id'" ;
		$result = mysql_query( $query, $dbconn );
		$row = mysql_fetch_array( $result );

		$real_passwd = $row[c_password];

		//==================== ��й�ȣ�� �´��� üũ�� ==========================================
		if( $real_passwd != $cmt_password ){
			echo("
				<script>
				window.alert('��й�ȣ�� ���� �ʽ��ϴ�');
				history.go(-1)
				</script>
			");
			exit;
		}
		if( $result ){
			mysql_free_result( $result );
		}

	}
	$SQL = "delete from board_comment where c_no = '$c_no' and index_no = '$index_no' and bbs_no = '$bbs_no' and mart_id = '$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);

	if( $dbresult ){
		echo("
			<script language='javascript'>
			self.close();
			window.opener.location.href = 'board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&mart_id=$mart_id&keyset=$keyset&searchword=$searchword';
			</script>
		");
	}else{
		echo("
			<script>
			window.alert('�����ϴµ� �����߽��ϴ�.');
			history.go(-1);
			</script>
		");
	}
}
if($flag == "comment"){
#######################�����ܾ��ñ���################################	
	if($tmp = rg_str_inword("_,��Ŀ,����,����,��.��.��.��,��������,����,����,������,����,URL,����,������,�湮��,����,����,boris,���볲,���뿩,aphsun.info,��ī��,����,Ư������,��ŷī��,�����,ǥ�ø�,�ʽ�,ȭ��,������,�Ǹ���,�ߵ�,ȭ��ä��,����̺�Ʈ,�����ϰ�,���̶�,���¯,�·���,��ũ��,(��)ī��,5000����,�����,�����,��@ī@��,õ����,Ű��,���ȸ������,�뵷,�ĩɩ�,��������,�ߵ�,������,�þ˸���,��Ʊ׶�,��ī��,��/ī/��,��ī����,����,����,ī����,������������,8��,��õid,��/õ/��,�١�ī�ٶ�,��(ī)��,����Ȯ��,�����ڷ�,����,viagra,��Ʊ׶�,sialis,�þ˸���,���˸���,����,����,viagra,��Ʊ׶�,sialis,����,����,��������,���,�ƽôºи�,�Ű���,�ٴ��̾߱�,�ǽ̰�,Ȳ�ݼ�,����,������,20����,100����,200����,Ȳ �� ��,��������,�渶,�ξ�,ȫ��,�ξ�,��ī��,Ư������,����,����,http,href,www,url,URL,cock,tatoos,nude,grandma,lesbian,fuck,suck,anal,sex,sexy,clitoris,Porn,nude,poker,casinos,viagra,cialis,phentermine,xanax,��,��,��",$cmt_comment)) {
		$error_msg = $tmp.'(��)�� ����Ҽ� ���� �ܾ��Դϴ�.';
		echo"<script>alert('$error_msg');history.go(-1);</script>";
		exit;
	}
#######################################################################
	if(!$Mall_Admin_ID&&$MemberLevel!=1){ 
		if( !$cmt_name || !$cmt_password || !$cmt_comment){
			echo("
				<script>
				window.alert('�ʿ��� ���� �����ϴ�. �ٽ� �Է��� �ּ���!');
				history.go(-1)
				</script>
			");
			exit;
		}
	}

	$cmt_reg_ip = $REMOTE_ADDR;
	$cmt_comment = addslashes($cmt_comment);

	$SQL = "insert into board_comment (c_no, index_no, bbs_no, mart_id, c_name, c_password, c_comment, c_reg_ip, c_regdate, user_id) values ('', '$index_no', '$bbs_no', '$mart_id', '$cmt_name', '$cmt_password', '$cmt_comment', '$cmt_reg_ip', now(), '$UnameSess')";
	$dbresult3 = mysql_query($SQL, $dbconn);

	if( $dbresult3 ){
		echo "<meta http-equiv='refresh' content='0; URL=board_read.php?index_no=$index_no&bbs_no=$bbs_no&page=$page&mart_id=$mart_id&keyset=$keyset&searchword=$searchword'>";
	}else{
		echo("
			<script>
			window.alert('�ٽ� �Է��� �ּ���!');
			history.go(-1)
			</script>
		");
		exit;
	}
}

mysql_close($dbconn);
?>