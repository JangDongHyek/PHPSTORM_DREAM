<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if($flag=="del"){
	$SQL = "delete from $MemberTable where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}

if($flag=="member_confirm"){
	$SQL = "update $MemberTable set is_member = '$is_member' where username = '$username' and mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn);
}
	include "../admin_head.php";
?>
<script>
function del(username){
	if(confirm("삭제하시겠습니까?")){
		window.location.href='inmall_member_list.php?flag=del&username='+username;
	}
	else return;
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
$left_menu = "6";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>입점몰 관리</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>

		<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			  <td vAlign="top" width="90%" bgColor="#ffffff">현재 쇼핑몰에 가입한 모든 입점몰들의 정보를 기록/관리하는 곳입니다.<br></td>
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
					<td width="100%" colSpan="2" height="20"><p align="center"><b>[입점몰 
					리스트]</b></td>
				 </tr>
<?
if($order == '') $order = 'date';
if($orderby == '') $orderby = 'desc';

$SQL = "select * from $MemberTable where mart_id='$mart_id' and perms='3'";
$dbresult = mysql_query($SQL, $dbconn);
$total = mysql_num_rows($dbresult);
?>
					<form action='inmall_member_list.php' method="POST">
					<input type='hidden' name='page' value=''>
					<tr>
					<td width="40%" height="20"><b>&nbsp;&nbsp; 현재 
					입점몰수 : 총 <font color="#ff0000"><?=$total?></font></b> <a href='../to_excel/inmall_member.php?keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><img src='../images/excel.gif' border='0' width='84' height='18' align='absmiddle'></a></td>
					<td width='10%'><input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="입점몰추가" onclick="location.href='inmall_member_insert.php'"></td>
					<td width="50%" height="20" align="right">
					<select name="keyset" size="1">
						<option value="name" <?if($keyset == "name") echo " selected";?>>입점몰명</option>
						<option value="username" <?if($keyset == "username") echo " selected";?>>아이디</option>
						<option value="address" <?if($keyset == "address") echo " selected";?>>주소</option>
						<option value="email" <?if($keyset == "email") echo " selected";?>>이메일</option>
					</select> 
					<input type='text' name='searchword' value='<?=$searchword?>' class="input_03" size="15"> &nbsp; 
					<input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="submit" value="검색"> <input style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="취소" onclick="location.href='<?=$PHP_SELF?>'"></td>
				 </tr>
				 </form>
			  </table>
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff" align="center">
			  <table width="97%" border="0">
				 <tr>
					<td width="100%" bgColor="#ffffff">
					
					<table border="0" cellpadding="1" cellspacing="1" width="100%" bordercolordark="white" bgcolor="#E1E1E1" align="center">
					<tr bgColor="#cccccc" align="middle">
						<td width="18%" height="28">
						<b>
<?
if($order == 'username'){
	if($orderby == 'desc'){	
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=asc'>ID</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=desc'>ID</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=username&orderby=desc'>ID</a>
<?
}
?>
						</b></td>
						<td width="13%">
						<b> 
<?
if($order == 'name'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=name&orderby=asc'>입점몰명</a><small>▼</small>
<?
	}else {
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=name&orderby=desc'>입점몰명</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=name&orderby=desc'>입점몰명</a>
<?
}
?>
						 </b></td>
						 <td width="23%">
						 <b>
<?
if($order == 'email'){
	if($orderby == 'desc'){
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=email&orderby=asc'>이메일</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=email&orderby=desc'>이메일</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=email&orderby=desc'>이메일</a>
<?
}
?>
						</b></td>
						<td width="13%">
						<b>
<?
if($order == 'date'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=date&orderby=asc'>가입일</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=date&orderby=desc'>가입일</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=date&orderby=desc'>가입일</a>
<?
}
?>
						</b></td>
						<td width="20%">
						<b>
<?
if($order == 'tel1'){
	if($orderby == 'desc') {
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=tel1&orderby=asc'>연락처</a><small>▼</small>
<?
	}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=tel1&orderby=desc'>연락처</a><small>▲</small>
<?
	}	
}else{
?>
						<a class='dd' href='inmall_member_list.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=tel1&orderby=desc'>연락처</a>
<?
}
?>
						</b></td>
						<td width="13%">
						<b>로그인</b></td>
					  </tr>
<?
if($order == 'name') $binary_str = 'binary';
else $binary_str = '';
$SQL1 = "select * from $MemberTable where mart_id='$mart_id' and perms='3'";
$SQL2 = " and $keyset like '%$searchword%' ";
$SQL3 = " order by $binary_str $order $orderby";

if(isset($keyset)&&($keyset!="")&&isset($searchword)&&($searchword!=""))
	$SQL=$SQL1.$SQL2.$SQL3;
else
	$SQL=$SQL1.$SQL3;

$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
if($cnfPagecount == "") $cnfPagecount = 10;
if($page == "") $page = 1;
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
	$ary=mysql_fetch_array($dbresult);
	$username = $ary[username];
	$password = $ary[password];
	$name = $ary[name];
	$passport = $ary[passport];
	$email = $ary[email];
	$tel1 = $ary[tel1];
	$tel2 = $ary[tel2];
	$address = $ary[address];
	$date = $ary[date];
	$date_str = substr($date,0,4)."/".substr($date,5,2)."/".substr($date,8,2);
	$lastlogin = $ary[lastlogin];
	$lastdate_str = substr($lastlogin,0,4)."/".substr($lastlogin,5,2)."/".substr($lastlogin,8,2);
?>
					  <tr align='center' bgColor='#ffffff' height='25'>
						 <td width='18%'><a href='inmall_member_view.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&username=<?=$username?>'><b><?=$username?></b></a></td>
						 <td width='13%'> <a href='inmall_member_view.php?page=<?=$page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&username=<?=$username?>'><b><?=$name?></b></a></td>
						 <td width='34%'><a href="javascript:opensub1('mem_email_send.php?username=<?=$username?>', 645, 645)"><?=$email?></a></td>
						 <td width='13%'><?=$date_str?></td>
						 <td width='10%'><?=$tel1?></td>
						 <td width='12%'><?=$lastdate_str?></td>
					  </tr>
<?
}
?>
					</table>
					</td>
				 </tr>
			  </table>
			  </td>
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
				<a href='inmall_member_list.php?page=1&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>처음</a> 
<?
}
if($start_page > 1){
?>
				<a href='inmall_member_list.php?page=<?=$prev_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>◁</a>&nbsp;
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
				<a href='inmall_member_list.php?page=<?=$i?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'><?=$i?></a> 
<?
	}
}
if($end_page < $total_page){
?>
				&nbsp;<a href='inmall_member_list.php?page=<?=$next_start_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>▷</a>
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
				<a href='inmall_member_list.php?page=<?=$total_page?>&keyset=<?=$keyset?>&searchword=<?=$searchword?>&order=<?=$order?>&orderby=<?=$orderby?>'>끝</a> 
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
			  <input onclick="window.location.href='mail_send.php'" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="전체입점몰 이메일보내기">&nbsp; 
			  <input onclick="return check('<?=$keyset?>','<?=$searchword?>')" style="BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; COLOR: black; BORDER-BOTTOM: #5a5a5a 1px solid; height: 18px; BACKGROUND-COLOR: white" type="button" value="검색하여 이메일보내기">&nbsp;
			  </td>
			</tr>
			<tr>
			  <td vAlign="top" width="100%" bgColor="#ffffff"><div align="center"><center><table width="95%" border="0">
				 <tr>
					<td width="100%">
					<img height="15" src="../images/tip.gif" width="30"><br>
					<b>전체입점몰 메일보내기 :</b>
					쇼핑몰 입점몰 회원에게 이메일을 동시발송하는 기능입니다.
					<br>
					<b>검색하여 메일보내기 : </b> 필요한 항목을 검색하여 검색결과로 메일을 
					보내는 기능입니다.<br></td>
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