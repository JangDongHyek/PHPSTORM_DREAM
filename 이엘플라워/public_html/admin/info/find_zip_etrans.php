<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
if(isset($confirm)==false){
?>
<html>
<head>
<title>우편번호검색</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script>
	
function frm_val(f){
	if(f.dong.value==""){
		alert("읍/면/동 또는 키워드를 입력하세요!");
		f.dong.focus();
		return false;
	}
	else{
		var i;
		var t = f.dong.value;			
		for(i=0;i<t.length;i++){					
			if(t.substring(i,i+1)=="'"){
				alert("허용할수 없는 문자가 입력되었습니다.")
				f.dong.focus();
				return false
			}					
		}			
		for(i=0;i<t.length;i++)
			if(t.substring(i,i+1)==" "){
				alert("허용할수 없는 문자가 입력되었습니다.")
				f.dong.focus();
				return false
			}							
		return true;
	}
}
</script>

</head>

<body marginwidth=0 marginheight=0 leftmargin=0 topmargin=0>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr>
	<td align=left valign=top width=1%></td>
	<td align=left valign=top width=98%>&nbsp;</td>
	<td align=left valign=top width=1%></td>
</tr>
<tr>
	<td align=left valign=top  >&nbsp;</td>			
	<td align=center valign=top >
			
		<form onsubmit="return frm_val(this)">
		<input type=hidden name=confirm value=ok>
		<input type=hidden name=mart_id value="guest2">
		<input type=hidden name=from value="">
	
		<table width=100% cellpadding=0 cellspacing=0 border=0 align=center>
		<tr>
			<td align="left" valign=top>
				<br><b><span class='aa'>우편번호 검색시작</span></b><br>
			</td>
		</tr>
		<tr>
			<td align="left" valign=top background=../image/zip/dot.gif height=24>&nbsp;</td>
		</tr>
		</table>

		<table width=100% cellpadding=0 cellspacing=0 border=0 align=center>
		<tr>
			<td align="center" valign=top colspan=2>
       			<br><br><span class='aa'><b>읍/면/동 또는 키워드를 입력하십시오.</span><br><br></td>
		</tr>
		<tr>
			<td width=60% align=right><input type=text name=dong size=20 class='aa'></td>
			<td>&nbsp;
			<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="찾기"></td>
		</tr>
		</table>
							
		<br><br>

		<table width=100% cellpadding=0 cellspacing=0 border=0 align=center>								
		<tr>
			<td align="left" valign=top background=../image/zip/dot.gif height=24>&nbsp;</td>
		</tr>
		<tr>
			<td width=60% align="right" valign=top>
				<input class="aa" onclick="javascript:window.close()" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="닫기">&nbsp;
			</td>
		</tr>
		</table>
							
		</form>
					
	</td>
	<td align=left valign=top>&nbsp;</td>
</tr>
<tr>
	<td align=left valign=top></td>
	<td align=left valign=top>&nbsp;</td>
	<td align=left valign=top></td>
</tr>
</table>
</form>
</body>
</html>

	
<? 
}
else if($confirm =="ok"){
	$dbconn = mysql_connect($HostName,$Admin,$AdminPass);mysql_select_db ($DbName);
	if ($dbconn == false) {
   		echo "데이타베이스 연결 실패!";
	}
	
?>
	
<html>
<head>
<title>우편번호검색</title>
<META HTTP-EQUIV="Content-Type" content="text/html;charset=euc-kr">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {  line-height: 13pt; font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #4CAABE}

A            {font-size: 9pt;line-height: 12pt;text-decoration: none; }  
 A:hover      {text-decoration: none;  }  -->
</style>
<script>
	
function frm_val(f){
	if(f.dong.value==""){
		alert("읍/면/동 또는 키워드를 입력하세요!!");
		f.dong.focus();
		return false;
	}	
	else{
		var i;
		var t = f.dong.value;			
		for(i=0;i<t.length;i++){			
			if(t.substring(i,i+1)=="'"){
				alert("허용할수 없는 문자가 입력되었습니다.")
				f.dong.focus();
				return false
			}					
		}			
		for(i=0;i<t.length;i++){
			if(t.substring(i,i+1)==" "){
				alert("허용할수 없는 문자가 입력되었습니다.")
				f.dong.focus();
				return false
			}							
		}
		return true;
	}
}
	
</script>
	       
</head>

<body leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<form id=form1 name=form1 onsubmit="return frm_val(this)">
<input type=hidden name=from value="">

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align=left valign=top width=1%></td>
	<td align=left valign=top width=98%>&nbsp;</td>
	<td align=left valign=top width=1%></td>
</tr>
<tr>
	<td align=left valign=top>&nbsp;</td>
	<td align=left valign=top>
			
		<table width=100% cellpadding=0 cellspacing=0 border=0 align=center>
		<tr>
			<td align="left" valign=top colspan=2>
				<br><b><span class='aa'>우편번호 검색결과</span></b><br>
			</td>
		</tr>
		<tr>
			<td align="left" valign=top colspan=2 background=../image/zip/dot.gif height=24>&nbsp;</td>
		</tr>
		</table>

		<form onsubmit="return frm_val(this)">
		<input type=hidden name=confirm value=ok>
		<input type=hidden name=mart_id value="guest2">
		<input type=hidden name=from value="">

		<table width=100% cellpadding=0 cellspacing=0 border=0 align=center>				
		<tr>
			<td align=right width=50%><span class='aa'>우편번호 재검색 : &nbsp;</span></td>
			<td align=right width=30%><input type=text name=dong size=16 class='aa'></td>
			<td>&nbsp;<input class="aa" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="찾기"></td>
		</tr>
		<tr>
			<td align="left" valign=top colspan=3 background=../image/zip/dot.gif height=24>&nbsp;</td>
		</tr>
		</table>

		<table width=100% cellpadding=0 cellspacing=0 border=0>
		<tr>
			<td align="left" valign=top>
			    <br><span class='aa'><b>해당되는 주소를 클릭 하십시오.</b></span><br><br></td>
		</tr>
		<tr>
			<td align=left valign=top>  	
<?	  	
	$SQL = "select * from $PostCodeTable where region3 like '%$dong%'";

	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	for($i=0;$i<$numRows;$i++){
		mysql_data_seek($dbresult, $i);
		$ary = mysql_fetch_array($dbresult);
		$post_no = str_replace('-','',trim($ary["post_no"]));
		$region1 = trim($ary["region1"]);
		$region2 = trim($ary["region2"]);
		$region3 = trim($ary["region3"]);
		
		$region3s = explode(" ", $region3);
		$region3_0 = $region3s[0];
		$region3_1 = trim(str_replace($region3_0, "", $region3));

		$j = $i + 1;
		echo ("
		<a href=\"javascript:ReturnFocus('$post_no','$region1 $region2 $region3_0','$region3_1')\">
			<span class='aa'>$j. $region1 $region2 $region3</span></a><br><br>
		");
	}
?>
			</td>
		</tr>
		</table><br><br>
		<table width=100% cellpadding=0 cellspacing=0 border=0 align=center>								
		<tr>
			<td align="right" valign=top>
				<input class="aa" onclick="javascript:window.close()" style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="button" value="닫기">&nbsp;
			</td>
		</tr>
		</table>
		</form>
	
	</td>
	<td align=left valign=top>&nbsp;</td>
</tr>
<tr>
	<td align=left valign=top></td>
	<td align=left valign=top>&nbsp;</td>
	<td align=left valign=top></td>
</tr>
</table>		
</form>		
</body>
</html>	
<?
mysql_close($dbconn);
?>