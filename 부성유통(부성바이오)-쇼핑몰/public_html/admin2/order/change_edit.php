<?
include "../lib/Mall_Admin_Session.php";
include "../admin_head.php";
?>
<?
$table = "changegood";

$query = "select * from $table where c_uid='$c_uid'";

$result = mysql_query( $query, $dbconn );
$row = mysql_fetch_array( $result );

$c_code = $row[c_code];
$c_title = $row[c_title];
$c_order_num = $row[c_order_num];
$username = $row[username];
$c_name = $row[c_name];
$c_phone = $row[c_phone];
$c_email = $row[c_email];
$c_content = $row[c_content];
$c_reply = $row[c_reply];
$c_ok = $row[c_ok];
$c_regdate = $row[c_regdate];

$c_content = eregi_replace( "<br>", "", $c_content );

if( $username ){
	$username_str = "<a href='../member/member_view.php?username=$username'>$username</a>";
}else{
	$username_str = "비회원";
}

if( $result ){
	mysql_free_result( $result );
}

?>
<script language="JavaScript">
<!-- 
function OpenWindow() {
	RemindWindow = window.open( "", "mainpage","toolbar=no,width=610,height=150,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no");
}
// -->
</script>
<script>
function really(num){
	if(confirm("\n정말로 삭제하시겟습니까?")){
		window.location.href='change_modify.php?flag=delete&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&c_uid='+num;
		return true;
	}
	return false; 
}

function change_check(){ 
	var base = document.changeform;

	if(base.c_title.value == ""){
		alert("제목을 입력하세요")
		base.c_title.focus()
		return;
	}

	if(base.c_name.value == ""){
		alert("신청자를 입력하세요")
		base.c_name.focus()
		return;
	}

	if(base.c_order_num.value == ""){
		alert("주문번호를 입력하세요")
		base.c_order_num.focus()
		return;
	}

	if(base.c_phone.value == ""){
		alert("연락처를 입력하세요")
		base.c_phone.focus()
		return;
	}

	if(base.c_email.value == ""){
		alert("E-mail을 입력하세요")
		base.c_email.focus()
		return;
	}else{
		if(!check_email(base.c_email.value)){
			alert("잘못된 E-Mail 입니다.");
			base.c_email.focus();
			return;
		}
	}

	if(base.c_content.value == ""){
		alert("사유를 입력하세요")
		base.c_content.focus()
		return;
	}

	base.submit();
}
</script>
<script>
function product_send_mail(order_num){
	var conf = confirm("배송중메일을 보내시겠습니까?");
	if(conf == true)
	window.open("./product_send_mail.php?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>&c_uid="+c_uid,"0x0","top=3000,left=3000,width=0,height=0");
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" onload="InitializeStaticMenu();">
<?  include '../inc/menu4.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">주문관리</span> &gt; <span class="text_gray2_c">교환/반품 관리 </span></div></td>
                </tr>
                <tr>
                  <td height="28">&nbsp;</td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;관리자모드에 접속하셨습니다.</span></div></td>
                </tr>
              </table>
            </div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>교환/반품 관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						교환/반품 접수를 관리합니다.</font><br>
					</td>
				</tr>
				<tr>
					<td width="100%" bgcolor="#808080" height="1" valign="top"></td>
				</tr>				
				<tr>
				<form name='changeform' method='post' action='change_modify.php?flag=update&c_uid=<?=$c_uid?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>' onsubmit='change_check(); return false;'>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
							<tr>
								<td width="90%" bgcolor="#999999">
									<table border="0" width="100%" cellspacing="1" cellpadding="3">
										<tr>
											<td width="100%" bgcolor="#8FBECD" colspan="2">
												<table border="0" width="100%" cellspacing="0" cellpadding="0">
													<tr>
														<td>&nbsp; <b>교환/반품 접수 정보 &nbsp; [접수일 : <?=$c_regdate?>]</b></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr height='30'>
											<td width="20%" bgcolor="#FFFFFF" align="center">제 목</td>
											<td width='80%' bgcolor="#FFFFFF" align="left">
												<input name="c_title" size="85" value='<?=$c_title?>' class="input_03" style='ime-mode:active'>
											</td>
										</tr>
										<tr height='30'>
											<td width="20%" bgcolor="#FFFFFF" align="center">주문번호</td>
											<td width='80%' bgcolor="#FFFFFF" align="left">
												<input name="c_order_num" size="30" value='<?=$c_order_num?>' class="input_03" style='ime-mode:inactive'>
											</td>
										</tr>
										<tr height='30'>
											<td bgcolor="#FFFFFF" align="center">신청자</td>
											<td bgcolor="#FFFFFF" align="left">
												<input name="c_name" size="20" value='<?=$c_name?>' class="input_03" style='ime-mode:active'> (<?=$username_str?>)
											</td>
										</tr>
										<tr height='30'>
											<td bgcolor="#FFFFFF" align="center">이메일</td>
											<td bgcolor="#FFFFFF" align="left">
												<input name="c_email" size="50" value='<?=$c_email?>' class="input_03" style='ime-mode:inactive'>
											</td>
										</tr>
										<tr height='30'>
											<td bgcolor="#FFFFFF" align="center">연락처</td>
											<td bgcolor="#FFFFFF" align="left"><input name="c_phone" size="30" value='<?=$c_phone?>' class="input_03"></td>
										</tr>
										<tr>
											<td bgcolor="#FFFFFF" align="center">교환/반품 사유</td>
											<td bgcolor="#FFFFFF" align="left"><textarea name="c_content" cols="83" rows="10" style='ime-mode:active'><?=$c_content?></textarea></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<p align="center">
						<input type="submit" value="수 정" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px">
						<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="취 소">
						<input onClick="location.href='change_list.php?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="목 록">
						<input onClick="javascript:return really('<?=$c_uid?>')" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="삭 제">
						</p>
					</td>
				</form>
				</tr>
			</table>
			

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
?>
<?
mysql_close($dbconn);
?>