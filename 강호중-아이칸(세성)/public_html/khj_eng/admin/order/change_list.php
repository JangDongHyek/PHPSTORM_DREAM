<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$table = "changegood";

if($page == ""){
	$page = 1;
}

if($mode == "search"){
	$qry = "select count(*) from $table where $select_key like '%$input_key%'";
}else{
	$qry = "select count(*) from $table";
}

$result = mysql_query($qry,$dbconn);
$total = mysql_result($result,0,0);

$line = 20;
$list = 10;
$total_page = ceil($total/$line);
$total_list = intval($total_page/$list);

if($total_page%$list == 0){
	$total_list--;
}

$curr_list = intval($page/$list);

if($page%$list == 0){
	$curr_list--;
}

$start_page = $curr_list*$list+1;
$prev_list = $start_page - $list;
$next_list = $start_page + $list;
$olds = $line*($page-1);

if($mode == "search"){
	$qry = "select * from $table where $select_key like '%$input_key%' order by c_regdate desc limit $olds,$line";
}else{
	$qry = "select * from $table order by c_regdate desc limit $olds,$line";
}

$result = mysql_query($qry,$dbconn);

include "../admin_head.php";
?>

<script language="javascript">
function check(){
	var it = document.f;
	if(it.input_key.value == ""){
		alert("검색어를 입력하세요");
		it.input_key.focus();
		return false;
	}

	it.submit();
}

function delcheck(num1,num2,num3){
	var remessage = " 다시확인 합니다. \n\n 삭제하시겠습니까.?";

	if(confirm(remessage)){
		location.href="delete.html?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&mod=del&page="+num1+"&re_uid="+num2+"&re_code="+num3;
	}
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
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
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">현재페이지</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">주문관리</span> &gt; <span class="text_gray2_c">교환/반품 관리 </span> </div></td>
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
		<td width="200" height="500">
			<!--왼쪽부분시작-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>교환/반품 관리 </b></td>
				</tr>
			</table>

			<!--내용 START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						교환/반품 접수를 관리합니다.</font><br><br>
						<b>주문번호</b>를 누르시면 <b>주문서 관리</b>로 이동합니다.<br>
						<b>제목</b>을 누르시면 <b>교환/반품 접수 상세정보</b>로 이동합니다.<br>
						<b>신청자</b>를 누르시면 <b>회원관리</b>로 이동합니다.
					</td>
				</tr>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
							<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan="5">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<form name="f" method="post" action="<?=$PHP_SELF?>?mode=search" onSubmit="check(); return false;">
												<td width="50%">
<? 
if($mode=="search"){ 
?>
													[ Search Result : <?=$total?> ]
<? 
}else{ 
?>
													[ Total : <?=$total?> ]
<? 
} 
?>											
												</td>
												<td width="50%" align="right">
													<select name="select_key" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; height: 18px">
														<option value="c_title" selected>제목</option>
														<option value="c_name">이름</option>
														<option value="c_order_num">주문번호</option>
														<option value="c_phone">전화번호</option>
														<option value="c_email">이메일</option>
													</select>
													&nbsp; 
													<input name='input_key' value='<?=$searchword?>' size="13" class="input_03"> &nbsp; 
													<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px" type="submit" value="검색"> <input type='button' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px" style='cusor:hand' onclick="location.href='<?=$PHP_SELF?>'" value="취소">&nbsp;
												</td>
											  </form>
											</tr>										
										</table>
									</td>
								</tr>
								<tr>
									<td width="8%" bgcolor="#FFFFFF" align="center">번호</td>
									<td width="25%" bgcolor="#FFFFFF" align="center">주문번호</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">신청자</td>
									<td width="35%" bgcolor="#FFFFFF" align="center">제 목</td>
									<td width="20%" bgcolor="#FFFFFF" align="center">날 짜</td>
								</tr>
<?
if($total == 0){
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td colspan='5'><b>접수된 내용이 없습니다</b></td>
								</tr>
<?
}else{
	$i = 0;
	while($row = mysql_fetch_array($result)){
		$id = $total - ($olds + $i);
		$i++;

		if( $row[re_status] == "y" ){
			$mail_str = "발 송";
		}else{
			$mail_str = "미발송";
		}

		if( $row[re_ok] == "y" ){
			$status = "<img src='../image/ok.gif' width='21' height='13'>";
		}else{
			$status = "-";
		}

		if( $row[c_title] ){
			$c_title = $row[c_title];
		}else{
			$c_title = "제목없음";
		}

		if( $row[username] ){
			$username_str = "<a href='../member/member_view.php?username=$row[username]'>$row[c_name]</a>";
		}else{
			$username_str = $row[c_name];
		}
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td><a href='change_edit.php?c_uid=<?=$row[c_uid]?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'><?=$id?></a></td>
									<td align="left"><a href='change_edit.php?c_uid=<?=$row[c_uid]?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'><b><?=$row[c_order_num]?></a></b></td>
									<td><b><?=$username_str?></b></td>
									<td align="left"><a href='change_edit.php?c_uid=<?=$row[c_uid]?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'><b><?=$row[c_title]?></b></a></td>
									<td><?=$row[c_regdate]?></td>
								</tr>
<?
	}
}
?>
								</table>
							</td>
						</tr>
					</table>
				</td>
				</tr>

			<tr align="center">
				<td width="100%" bgcolor="#FFFFFF">
<? 
if($prev_list <= 0){ 
?>
					처음
<? 
}else{ 
?>

					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$prev_list?>">처음</a>

<? 
} 
?>
<? 
if($page-1 <= 0){ 
?>
					◁
<? 
}else{ 
?>
					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page-1?>">◁</a>
<? 
} 
?>
					&nbsp;
<? 
for($i=$start_page;$i<$start_page+$list;$i++){
?>
<? 
	if($i == $page){ 
?>
					<b>[<?=$i?>]</b>
<? 
	}else{ 
?>

					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$i?>"><?=$i?></a>
<? 
	} 
?>
					&nbsp;
<?
	if($i>=$total_page)
	break
?>
<? 
} 
?>
<? 
if($page+1 > $total_page){ 
?>
					▷
<? 
}else{ 
?>
					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page+1?>">▷</a>
<? 
} 
?>
<? 
if($next_list>$total_page){ 
?>
					끝
<? 
}else{ 
?>
					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$next_list?>">끝</a>
<? 
} 
?>
			  </td>
			  </tr>
		  </table>

<br>
			<!--내용 END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
if( $result ){
	mysql_free_result( $result );
}
mysql_close($dbconn);
?>
