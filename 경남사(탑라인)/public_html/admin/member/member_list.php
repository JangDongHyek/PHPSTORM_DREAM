<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){

	for($i=0; $i<sizeof($loan_number); $i++){
		$query = "select * from $Mart_Member_NewTable where mart_id='$mart_id' and username='$loan_number[$i]'";
		$result	=	mysql_query($query,$dbconn);
		$rows	=	mysql_fetch_array($result);

		


		$SQL = "delete from $BonusTable where id = '$rows[username]' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);
		
		$SQL = "delete from $Mart_Member_NewTable where username = '$rows[username]' and mart_id='$mart_id'";
		$dbresult = mysql_query($SQL, $dbconn);

		echo "<meta http-equiv='refresh' content='0; URL= member_list.php'>";
	}
}

if($flag=="member_confirm"){
	$SQL = "update $Mart_Member_NewTable set is_member = '$is_member' where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>
<script>
function selectAll() {
	var form = document.form1;

	for (i=0; i < form.elements.length; i++) {
		if (form.elements[i].name =="loan_number[]") {
			if (form.elements[i].checked == true) {
				form.elements[i].checked = false;
			}
			else{
				form.elements[i].checked = true;
			}
		}
	}
}
function execute(){
var form=document.form1;

		if(confirm("삭제하시겠습니까?")){
				var no_count = 0;
					for(i=0; i < form.elements.length; i++){
						if(form.elements[i].name == "loan_number[]"){
							if(form.elements[i].checked == true){
								no_count++;
							}
						}
					}

					if(no_count == 0){
						alert('선택된 항목이 없습니다');
						return;
					}
					document.form1.action = "member_list.php?flag=del";
					document.form1.submit();
		}
}

function send_mail(){
var form=document.form1;

	var no_count = 0;
		for(i=0; i < form.elements.length; i++){
			if(form.elements[i].name == "loan_number[]"){
				if(form.elements[i].checked == true){
					no_count++;
				}
			}
		}

		if(no_count == 0){
			alert('선택된 항목이 없습니다');
			return;
		}
		document.form1.action = "mail_send.php?mail_type=suntak";
		document.form1.submit();
}

function check(keyset, searchword){
	if(keyset == '' || searchword == ''){
		alert("먼저 검색을 하세요.");
		return false;
	}
	else{
		window.location.href='mail_send.php?keyset='+keyset+'&searchword='+searchword;
		return true;
	}
}
function opensub(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
function opensub1(t,w,h)
{	 
	var option = "toolbar=no,menubar=no,status=no,scrollbars=no,resizable=no,width=" +  w + ",height=" + h + ",left=0,top=0"
	window.open(t,'t' ,option);

}  
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "5";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회원 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">현재 쇼핑몰에 가입한 모든 회원들의 정보를 기록/관리하는  곳입니다. <br>
			  해당 항목의 제목을 클릭하시면 정렬순서가 바뀝니다.<br>
			  <br>
			  ID 클릭 : 회원구매이력 확인<br>
			  성명클릭 : 회원정보 수정및 삭제<br>
			  이메일 클릭 : 개별회원 메일발송<br>
			  M 클릭 : 포인트 조회와 포인트 추가 가능</td>
			</tr>
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#808080" height="1"></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" height="3">
			  <table width="95%" border="0" align="center">
				 <tr>
					<td width="100%" colSpan="2" height="20"><p align="center"><b>[회원가입 
					리스트]</b></td>
				 </tr>

				 <?
				 if($order == '') $order = 'date';
				 if($orderby == '') $orderby = 'desc';
				 
				 $SQL = "select * from $Mart_Member_NewTable where mart_id='$mart_id' ";
						$dbresult = mysql_query($SQL, $dbconn);
						$numRows = mysql_num_rows($dbresult);
						?>
						<form action='member_list.php' method="GET">
					<input type='hidden' name='page' value=''>
					<tr>
					<td width="50%" height="20"><p align="left"><b>&nbsp;&nbsp; 현재 
					회원수 : 총 <font color="#ff0000"><?echo $numRows?></font> 명</b> <a href='../to_excel/member.php?keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><img src='../images/excel.gif' border='0' width='84' height='18' align='absmiddle'></a></td>
					<td width="50%" height="20"><p align="right">
					<select name="keyset" size="1">
						<option value="name" <?if($keyset == "name") echo " selected";?>>이름</option>
						<option value="username" <?if($keyset == "username") echo " selected";?>>아이디</option>
						<option value="address" <?if($keyset == "address") echo " selected";?>>주소</option>
						<option value="email" <?if($keyset == "email") echo " selected";?>>이메일</option>
						<option value="passport1" <?if($keyset == "passport1") echo " selected"; ?>>주민등록번호</option>
					</select> 
					<input type='text' name='searchword' value='<?=$searchword?>' class="input_03" size="15"> &nbsp; 
					<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="취소" onclick="location.href='<?=$PHP_SELF?>'"></td>
				 </tr>
				 </form>
			  </table>
			  </td>
			</tr>
			<form action='member_list.php' name="form1" method="post">
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bordercolordark="white" align="center">
					<tr bgColor="#CCCCCC" align="center" height="28">
						<td  width="14%">
						<b>
<?
if($order == 'name'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=name&orderby=asc'>이름</a><small>▼</small>
<?
	}else {
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=name&orderby=desc'>이름</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=name&orderby=desc'>이름</a>
<?
}
?>							</b></td>
						<td width="13%">
						<b> 
<?
if($order == 'username'){
	if($orderby == 'desc'){	
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=asc'>ID</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=desc'>ID</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=desc'>ID</a>
<?
}
?>						
						</b></td>
						<td width="20%">
						<b> 
<?
if($order == 'address'){
	if($orderby == 'desc'){	
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=asc'>주소</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=desc'>주소</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=desc'>주소</a>
<?
}
?>						
						</b></td>
						<td width="20%">
						<b>
<?
if($order == 'email'){
	if($orderby == 'desc'){
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=email&orderby=asc'>이메일</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=email&orderby=desc'>이메일</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=email&orderby=desc'>이메일</a>
<?
}
?>
						</b></td>									
						<td width="10%">
						<b>
<?
if($order == 'date'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=date&orderby=asc'>가입일</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=date&orderby=desc'>가입일</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=date&orderby=desc'>가입일</a>
<?
}
?>
						</b></td>
						<td  width="8%">
						<b>
<?
if($order == 'bonus_total'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=bonus_total&orderby=asc'>M</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=bonus_total&orderby=desc'>M </a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=bonus_total&orderby=desc'>M</a>
<?
}
?>
						</b></td>
						<td width="8%">
						<b>
<?
if($order == 'login_count'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=login_count&orderby=asc'>로그인</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=login_count&orderby=desc'>로그인</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=login_count&orderby=desc'>로그인</a>
<?
}
?>
						</b></td>
					  </tr>
<?
if($order == 'name') $binary_str = 'binary';
else $binary_str = '';
$SQL1 = "select * from $Mart_Member_NewTable where mart_id='$mart_id'";
$SQL2 = " and $keyset like '%$searchword%' ";
$SQL3 = " order by $binary_str $order $orderby";
if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!=""))
	$SQL=$SQL1.$SQL2.$SQL3;
else
	$SQL=$SQL1.$SQL3;

//echo $SQL;

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if ($cnfPagecount == "") $cnfPagecount = 20;
if ($page == "") $page = 1;
$skipNum = ($page - 1) * $cnfPagecount;

$prev_page = $page - 1;
$next_page = $page + 1;

$total_page = ($numRows - 1) / $cnfPagecount;
$total_page = intval($total_page)+1;

if($page % 10 == 0)
	$start_page = $page - 9;
else
	$start_page = $page - ($page % 10) + 1;

$end_page = $start_page + 9;
if($end_page >= $total_page)
	$end_page = $total_page;
$prev_start_page = $start_page - 10;
$next_start_page = $start_page + 10;

for($i=$skipNum; $i < ($cnfPagecount+$skipNum); $i++){
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);
	$username = $ary[username];
	$password = $ary[password];
	$name = $ary[name];
	$passport1 = $ary[passport1];
	$passport2 = $ary[passport2];
	$age = $ary[age];
	$birth = $ary[birth];
	$email = $ary[email];
	$tel = $ary[tel];
	$tel1 = $ary[tel1];
	$zip = $ary[zip];
	$resd = $ary[resd];
	$address = $ary[address];
	$date = $ary[date];
	$date_str = substr($date,0,4)."/".substr($date,4,2)."/".substr($date,6,2);
	$is_member = $ary[is_member];
	$if_maillist = $ary[if_maillist];
	$login_count = $ary[login_count];
	$bonus_total = $ary[bonus_total];
	$provider_id = $ary[provider_id];//쿠폰을 지급한 회원사

	//========================= 회원사명을 가져옴 ====================================
	/*$mem_sql = "select name from $MemberTable where mart_id='$mart_id' and username='$provider_id'";
	$mem_res = mysql_query($mem_sql, $dbconn);
	$mem_row = mysql_fetch_array( $mem_res );
	$mem_name = $mem_row[name];
	if( !$mem_name ){
		$mem_name = "...";
	}*/
		
	if( !$name ){
		$name = "...";
	}
	
	if($if_maillist == '1') $if_maillist_str ="<img src='../images/y.gif'>";
	else $if_maillist_str ="<img src='../images/n.gif'>";

	//========================= 포인트 합계를 가져옴 ====================================
	$bonus_sql = "select sum(bonus) as  bonus_total from $BonusTable where mart_id='$mart_id' and id='$username'";
	$bonus_res = mysql_query($bonus_sql, $dbconn);
	$bonus_row = mysql_fetch_array( $bonus_res);
	
	$bonus_total_str = number_format($bonus_row[bonus_total]);
?>
					  <tr height='25' bgColor='#F3F3F3' align='center'>
						 <td>
						 <input type=checkbox name="loan_number[]" value="<?=$username?>">
						 <?=$if_maillist_str?> <a href='member_view.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&username=<?=$username?>'><b><?=$name?></b></a></td>
						 <td><a href="javascript:opensub('mem_order_list.php?username=<?=$username?>', 620, 500)"><?=$username?></a></td>
						 <td><?=$address?></td>
						 <td><a href="javascript:opensub1('mem_email_send.php?username=<?=$username?>', 645, 645)"><?=$email?></a></td>
						 <!-- <td><?=$mem_name?></td> -->
					   <td><?=$date_str?></td>
						 <td><a href="javascript:opensub('bonus.php?username=<?=$username?>', 665, 400)"><?=$bonus_total_str?></a></td>
						 <td><?=$login_count?></td>
					  </tr>
<?
}
if( $dbresult ){
	mysql_free_result( $dbresult );
}						 
if( $mem_res ){
	mysql_free_result( $mem_res );
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </center></div></td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><p align="right">
<?
if($page == 1){
?>
				처음
<?
}else{
?>
				<a href='member_list.php?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>처음</a> 
<?
}
if($start_page > 1){
?>
				<a href='member_list.php?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>◁</a>&nbsp;
<?
}else{
?>
				◁&nbsp; 
<?
}
for($i=$start_page;$i<=$end_page;$i++){
	if($i == $page){
?>
				[<b><?=$i?></b>]
<?
	}else{
?>
				<a href='member_list.php?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='member_list.php?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>▷</a>
<?
}else{
?>
				&nbsp;▷
<?
}
if($page == $total_page){
?>
				끝
<?
}else{
?>
				<a href='member_list.php?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>끝</a> 
<?
}
?>
				</td>
			</tr>
			<tr align="middle">
			  <td vAlign="top" width="100%" bgColor="#ffffff"></td>
			</tr>
			<tr align="middle">
			  <td vAlign="top" width="100%" bgColor="#ffffff">
				 <input onclick="javascript:send_mail();" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="선택회원 메일">&nbsp; 
					<input onclick="window.location.href='mail_send.php?mail_type=all'" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="전체회원 메일">&nbsp; 
			  <input onclick="return check('<?echo $keyset?>','<?echo $searchword?>')" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="검색하여 메일">&nbsp; 
				<input onclick="javascript:execute();" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; HEIGHT: 18px; BACKGROUND-COLOR: white" type="button" value="선택회원 삭제">
			  </td>
			</tr>
			</form>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table width="95%" border="0">
				 <tr>
					<td width="100%">
					<img height="15" src="../images/tip.gif" width="30"><br>
					<b>선택회원 메일 :</b>
					회원리스트에서 체크박스를 선택한 회원에게 이메일을 동시발송하는 기능입니다.
					<br>					<b>전체회원 메일 :</b>
					쇼핑몰 전체 회원에게 이메일을 동시발송하는 기능입니다.
					<br>
					<b>검색하여 메일 : </b>주소, 생년등 필요한 항목을 검색하여 검색결과로 메일을 
					보내는 기능입니다.<br>
					(특정 분류의 회원 이메일마케팅에 유용합니다.) <br>
					위의 검색창에서 필요한 항목으로 검색한 후 검색하여 
					메일보내기를 클릭하시면 검색된 회원들만을 댓아으로 메일을 
					보내게 됩니다.
					<br>
					<img height="11" src="../images/y.gif" width="11"> 
					<img height="11" src="../images/n.gif" width="11"> 
					는 메일수신여부를 나타냅니다. ( 
					<img height="11" src="../images/y.gif" width="11">
					:수신허용, <img height="11" src="../images/n.gif" width="11"> : 
					수신비허용)</td>
				 </tr>
			  </table>
			  </center></div></td>
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
<?
mysql_close($dbconn);
?>