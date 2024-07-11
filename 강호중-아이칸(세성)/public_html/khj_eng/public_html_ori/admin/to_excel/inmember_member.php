<? 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=회원사.xls" ); 
header( "Content-Description: PHP4 Generated Data" ); 
?>
<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";

if( !$MemberLevel || ($MemberLevel > 2) ){
	echo("
		<script>
		parent.location.href='../login.html';
		</script>
	");
	exit;
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<script language='javascript' src='../js/common.js'></script>
<style>
<!--
.shopstyle
	{mso-style-parent:style0;
	border:.5pt solid black;
	white-space:normal;}
-->
</style>
</head>

<body bgcolor=white > 
<table cellspacing=0 cellpadding=2 border=0 > 
<tr bgcolor='#D8D88C'>
	<td class=shopstyle width='15%'>
		ID</td>
	<td class=shopstyle width='15%'>
		비밀번호</td>
	<td class=shopstyle width='11%'>
		회원사명</td>
	<td class=shopstyle width='11%'>
		사업자번호</td>
	<td class=shopstyle width='26%'>
		이메일</td>
	<td class=shopstyle width='26%'>
		연락처</td>
	<td class=shopstyle width='26%'>
		휴대폰</td>
	<td class=shopstyle width='26%'>
		우편번호</td>
	<td class=shopstyle width='26%'>
		주소</td>
	<td class=shopstyle width='26%'>
		상세주소</td>
	<td class=shopstyle width='10%'>
		결제은행</td>
	<td class=shopstyle width='15%'>
		계좌번호</td>
	<td class=shopstyle width='10%'>
		예금주</td>
	<td class=shopstyle width='15%'>
		가입일</td>
</tr>
<? 
if($order == '') $order = 'date';
if($orderby == '') $orderby = 'desc';

$SQL = "select * from $MemberTable where mart_id='$mart_id' and perms='4'";
$dbresult = mysql_query($SQL, $dbconn);
$numRows = mysql_num_rows($dbresult);
for ($i=0; $i < $numRows; $i++) {
	if ($i >= $numRows) break;
	mysql_data_seek($dbresult, $i);
	$ary = mysql_fetch_array($dbresult);
	$lastlogin = $ary[lastlogin];
	$loginno  = $ary[loginno ];
	$username = $ary[username];
	$password = $ary[password];
	$name = $ary[name];
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
	$me_delivery = $ary[me_delivery];

	$date = $ary[date];
	$date_str = substr($date,0,4)."/".substr($date,5,2)."/".substr($date,8,2);
	echo "
<tr bgcolor='#F6F5CC' align='left'>
	<td class=shopstyle>
		$username</td>
	<td class=shopstyle>
		$password</td>
	<td class=shopstyle>
		$name</td>
	<td class=shopstyle>
		$passport</td>
	<td class=shopstyle>
		$email</td>
	<td class=shopstyle>
		$tel1</td>
	<td class=shopstyle>
		$tel2</td>
	<td class=shopstyle>
		$zip</td>
	<td class=shopstyle>
		$place</td>
	<td class=shopstyle>
		$place_detail</td>
	<td class=shopstyle>
		$me_bank</td>
	<td class=shopstyle>
		$me_bankno</td>
	<td class=shopstyle>
		$me_bankowner</td>
	<td class=shopstyle>
		$date_str</td>

</tr>
	";
}
?>
</table> 
</body> 
</html> 
<?
mysql_close($dbconn);
?>