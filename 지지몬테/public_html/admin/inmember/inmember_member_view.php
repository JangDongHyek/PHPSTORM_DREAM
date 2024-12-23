<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if(isset($flag) == false) {
	$SQL = "select * from $MemberTable where mart_id='$mart_id' and username='$username'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);	
		$ary = mysql_fetch_array($dbresult);
		$lastlogin = $ary[lastlogin];
		$loginno  = $ary[loginno ];
		$username = $ary[username];
		$password = $ary[password];
		$perms = $ary[perms];
		$name = $ary[name];
		$admin_img = $ary[admin_img]; //관리자 글작성시 아이콘
		$date1 = $ary[date];
		$description = $ary[description];
		$passport = $ary[passport];
		$tel1 = $ary[tel1]; 
		$tel2 = $ary[tel2];
		$email = $ary[email];
		$message = $ary[message];
		$gubun = $ary[gubun];
		$zip = $ary[zip];
		$place = $ary[place];
		$place_detail = $ary[place_detail];
		$me_bank = $ary[me_bank];
		$me_bankno = $ary[me_bankno];
		$me_bankowner = $ary[me_bankowner];

		if($perms == "4"){
			$Perms = "회원사";
		}elseif($perms == "3"){
			$Perms = "입점몰";
		}elseif($perms == "2"){
			$Perms = "쇼핑몰관리자";
		}elseif($perms == "1"){
			$Perms = "전체관리자";
		}else{
			$Perms = "&nbsp;";
		}

		if( $admin_img ){
			//========================= 그림파일이 있을때 출력 ===========================
			$upload = "../../up/$mart_id/"; //업로드 디렉토리
			$target = "$upload"."$admin_img";
			$admin_img_new = "<img src='$target' border='0' align='absmiddle'>";
		}
	}

	include "../admin_head.php";
?>
<script language="JavaScript">
function Tcheck(target, cmt, astr, lmin, lmax)
{
	var i
	var t = target.value

	if (t.length < lmin || t.length > lmax) {
		if (lmin == lmax) alert(cmt + '는 ' + lmin + ' Byte 이어야 합니다.');
			 else alert(cmt + '는 ' + lmin + ' ~ ' + lmax + ' Byte 이내로 입력하세요.');
		target.focus()
		return true
	}
	if (astr.length > 1) {
	        for (i=0; i<t.length; i++)
	                if(astr.indexOf(t.substring(i,i+1))<0) {
				alert(cmt + '에 허용할 수 없는 문자가 입력되었습니다');
				target.focus()
				return true
			}
	}
        return false
	
}

function Eaddcheck(target, cmt)
{
	var i
	var t = target.value

	if (t.length > 1) {
	        for (i=0; i<t.length; i++)
	                if(t.substring(i,i+1) == '@') {
				return false;
			}
	}
        	alert(cmt + '를 정확히 입력하여 주십시오.');
	target.focus()
	return true	
}


function checkform(f)
{
	var Alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
	var Digit = '1234567890'

	if (Tcheck(f.password, '비밀번호', Alpha + Digit, 4, 8)) return false;
	
	if (f.name.value=="") {
	        alert("\n이름을 입력하세요.");
	        f.name.focus();
	        return false;
	}
	
}
function find_zip()	{
	var Sel = window.open ( '../../market/member/find_zip.php?flag=inmember', 'Zip', 'toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=350,height=300' );
}
function really(){
	if(confirm("\n정말 회원사를 삭제하시겠습니까?\n\n복구는 되지 않습니다.")){
    window.location.href='inmember_member_view.php?flag=del&username=<?=$username?>';
  }
	
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "7";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원사 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">현재 쇼핑몰에 가입한 모든 회원사들의 정보를 기록/관리하는 곳입니다.<br></td>
					</tr>
					<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top"></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
						<table border="0" width="100%">
							<tr>
								<td width="100%" height="20"><p align="center"><b>[회원사 상세정보 및 수정]</b></td>
							</tr>
						</table>
					</td>
					</tr>
					
				<form method="post" name="f" onsubmit="return checkform(this)" enctype="multipart/form-data">
				<input type='hidden' name='flag' value='update'>
				<input type='hidden' name='username' value='<?=$username?>'>
				<input type='hidden' name='admin_img' value='<?=$admin_img?>'>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"align="center">
						<table border="0" width="97%">
							<tr>
								<td width="100%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
									<tr>
										 <td width="15%" bgcolor="#C8DFEC" align="left">회원사명</td>
										 <td width="35%" bgcolor="#FFFFFF" align="left"><input name="name" value="<?=$name?>" size="20" class="input_03" style='ime-mode:active'></td>
										 <td width="15%" bgcolor="#C8DFEC" align="left">가입일</td>
										 <td width="35%" bgcolor="#FFFFFF" align="left"><?=$date1?></td>
									  </tr>
									<tr>
										<td width="15%" bgcolor="#C8DFEC" align="left">최종로그인</td>
										<td width="35%" bgcolor="#FFFFFF" align="left"><?=$lastlogin?></td>
										<td width="15%" bgcolor="#C8DFEC" align="left">로그인횟수</td>
										<td width="35%" bgcolor="#FFFFFF" align="left"><?=$loginno?></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">아이콘</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"><?=$admin_img_new?> <input type='file' name='adminimg' class="bb" size="30"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">ID</td>
										<td bgcolor="#FFFFFF" align="left"><?=$username?></td>
										<td bgcolor="#C8DFEC" align="left">이메일</td>
										<td bgcolor="#FFFFFF" align="left"><p align="left"><input name="email" value="<?=$email?>" size="35" class="input_03" style='ime-mode:inactive'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">비밀번호</td>
										<td bgcolor="#FFFFFF" align="left"><input name="password" value="<?=$password?>" size="20" class="input_03" style='ime-mode:inactive'></td>
										<td bgcolor="#C8DFEC" align="left">사업자번호</td>
										<td bgcolor="#FFFFFF" align="left"><input name="passport" value="<?=$passport?>" size="14" maxlength='14' class="input_03"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">우편번호</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3">
											<input name="zip" value='<?=$zip?>' size="13" class="input_03" readonly>
											<input onclick="javascript:find_zip();" class="input_03" type="button" value="찾기" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px">
										</td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">주소</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="place" value='<?=$place?>' size="50" class="input_03" style='ime-mode:active'> </td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">상세주소</td>
										<td bgcolor="#FFFFFF" align="left" colspan="3"><input name="place_detail" value='<?=$place_detail?>' size="50" class="input_03" style='ime-mode:active'> </td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">연락처</td>
										<td bgcolor="#FFFFFF" align="left"><input name="tel1" value='<?=$tel1?>' size="20" class="input_03"></td>
										<td bgcolor="#C8DFEC" align="left">휴대폰</td>
										<td bgcolor="#FFFFFF" align="left"><input name="tel2" value='<?=$tel2?>' size="20" class="input_03"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">결제은행</td>
										<td bgcolor="#FFFFFF" align="left"><input name="me_bank" value='<?=$me_bank?>' size="20" class="input_03" style='ime-mode:active'>
										<td bgcolor="#C8DFEC" align="left">계좌번호</td>
										<td bgcolor="#FFFFFF" align="left"><input name="me_bankno" value='<?=$me_bankno?>' size="20" class="input_03"></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">예금주</td>
										<td bgcolor="#FFFFFF" align="left" colspan='3'><input name="me_bankowner" value='<?=$me_bankowner?>' size="20" class="input_03" style='ime-mode:active'></td>
									</tr>
									<tr>
										<td bgcolor="#C8DFEC" align="left">메 모</td>
										<td bgcolor="#FFFFFF" align="left" colspan='3'><textarea cols="55" name="message" rows="4" class="input_03" style='ime-mode:active'><?=$message?></textarea></td>
									</tr>
         
									</table>
								</td>
							</tr>
						</table>
					</td>
					</tr>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="수정">
						&nbsp; 
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력">
						&nbsp; 
						<input onclick="really()" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭제">
						&nbsp; 
						<input onclick="window.location.href='inmember_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="리스트로">
					</td>
					</tr>
</form>
				</table>


<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
}
if($flag == "update"){
	//================== 업로드 함수 불러옴 ==============================================
	include "../../market/upload.php";
	$upload_dir = "$UploadRoot$mart_id/";

	if( $adminimg_name ){//첨부 파일을 업로드 했으면 파일명을 수정함
		$file = FileUploadName( "$admin_img", "$upload_dir", $adminimg, $adminimg_name );
		$sql = "update $MemberTable set admin_img='$file' where username='$username'";
		$res = mysql_query( $sql, $dbconn );

		if( !$res ){
			echo("
				<script>
				window.alert('이미지를 수정하는데 실패했습니다!');
				history.go(-1)
				</script>
			");
			exit;
		}
	}

	$SQL = "update $MemberTable set name='$name', password='$password', email= '$email', tel1='$tel1', tel2='$tel2', zip='$zip', place='$place', place_detail='$place_detail', passport='$passport', message='$message', me_bank='$me_bank', me_bankno='$me_bankno', me_bankowner='$me_bankowner' where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= inmember_member_view.php?username=$username'>";
	}else{
		echo ("
			<script>
			alert('수정하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}
if($flag=="del"){
	$upload_dir = "$UploadRoot$mart_id/";

	//==================== 파일이 있다면 파일을 먼저 삭제함 ==============================
	$sql = "select admin_img from $MemberTable where username='$username' and mart_id ='$mart_id'";
	$res = mysql_query($sql, $dbconn);
	$row = mysql_fetch_array( $res );
	$admin_img = $row[admin_img];

	if( $admin_img ){
		$desc = "{$upload_dir}{$admin_img}";
		unlink($desc);
	}

	$SQL = "delete from $MemberTable where username='$username' and mart_id ='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL= inmember_member_list.php'>";
	}else{
		echo ("
			<script>
			alert('삭제하는데 실패했습니다.');
			history.go(-1);
			</script>
		");
	}
}
?>
<?
mysql_close($dbconn);
?>