<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$date = date("Y-m-d H:i:s");

if($flag == "insert"){
	//================== 업로드 함수 불러옴 ==============================================
	include "../../market/upload.php";
	$upload_dir = "$UploadRoot$mart_id/";

	if( $adminimg_name ){//첨부 파일을 업로드 했으면 파일명을 수정함
		$file = FileUploadName( "", "$upload_dir", $adminimg, $adminimg_name );
	}

	$sql = "insert into $MemberTable ( uid, mart_id, username, password, perms, date, name, admin_img, passport, zip, place, place_detail, tel1, tel2, email, message, loginno, lastlogin, me_bank, me_bankno, me_bankowner, me_delivery, me_delivery_price ) values ( '', '$mart_id', '$username', '$password', '3', '$date', '$name', '$file', '$passport', '$zip', '$place', '$place_detail', '$tel1', '$tel2', '$email', '$message', '0', '$date', '$me_bank', '$me_bankno', '$me_bankowner', '$me_delivery', '$me_delivery_price' )";
	$result = mysql_query($sql, $dbconn);
	if( $result ){
		echo "
			<script>
			alert('등록했습니다.');
			</script>
			<meta http-equiv='refresh' content='0; URL= inmall_member_list.php'>
		";
	}else{
		echo ("
			<script>
			alert('입력하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}
?>
<?
mysql_close($dbconn);
?>