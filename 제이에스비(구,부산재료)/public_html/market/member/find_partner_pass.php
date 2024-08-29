<?
//================== DB 설정 파일을 불러옴 ===============================================
include "../../connect.php";
?>
<?
if($flag!='check'){ 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ks_c_5601-1987">
<meta HTTP-EQUIV="pragma" CONTENT="no-cache">
<title>아이디, 비밀번호 찾기</title>
<style type="text/css">
<!--
.aa {  font-size: 9pt; line-height: 12pt; color: #000000}
.bb {   font-size: 9pt; color: #6B6B6B}
.cc {  font-size: 9pt; color: #F78C00}
.dd {  font-size: 9pt; color: #ffffff}
.ee {  font-size: 9pt; color: #057BB1}
A            {font-size: 9pt;text-decoration: none;color: #000000 }  
 A:hover      {text-decoration: none;  }  -->
</style>
<SCRIPT language=JavaScript>
<!--
function checkform(f)
{
	if(f.passport1.value=="") {
	    alert("\n주민등록번호 앞자리를 입력하세요.");
	    f.passport1.focus();
	    return false;
	}
	if(f.passport2.value=="") {
	    alert("\n주민등록번호 뒷자리를 입력하세요.");
	    f.passport2.focus();
	    return false;
	}
	if(f.name.value==""){
	    alert("\n성명을 입력하세요.");
	    f.name.focus();
	    return false;
	}
return true;
}
function check()
{
    var str = document.f.passport1.value.length;
    if(str == 6) {
       document.f.passport2.focus();
    }

} 

function check1()
{
    var str = document.f.passport2.value.length;
    if(str == 7) {
       document.f.name.focus();
       
	}   	
}
//-->
</SCRIPT>
</head>
<body link="#808080" vlink="#808080" alink="#C0C0C0" topmargin="0" leftmargin="0">

<table border="0" width="300" align="left" cellspacing="1" cellpadding="0">
<tr>

<form name=f onsubmit='return checkform(this)'>
<input type='hidden' name='flag' value='check'>
<input type='hidden' name='mart_id' value='<?=$mart_id?>'>

	<td width="100%" valign="top"><p align="left"><br>
		</p>
        <p style="padding-left: 10px"><span class="bb">아이디와 패스워드를 분실하셨나요?<br>
        주민등록번호와 성명을 기입하시면 <br>
        확인하실 수 있습니다.</span></p>
		<div align="center">
		<center>
		<table border="0" width="300" cellspacing="0" cellpadding="0">
		<tr>
			<td align="left" height="30" width="86"><p align="right">
				<span class="bb">주민등록번호</span></td>
			<td align="left" width="210">　
				<input class="bb" name="passport1" onkeyup=check(); size="7" style="height: 18; width: 53; border: 1px solid #7B7D7B">
				<strong><span class="zz"> </span><span class="bb">&nbsp;-&nbsp; </span></strong>
				<input class="bb" name="passport2" onkeyup=check1(); size="7" style="height: 18; width: 53; border: 1px solid #7B7D7B">
				</td>
		</tr>
		<tr>
			<td align="left" height="15" width="86"><p align="right">
				<span class="bb">성명 </span></td>
			<td align="left" width="210">　
				<input class="bb" name="name" size="10" style="height: 18; width: 93; border: 1px solid #7B7D7B">&nbsp; 
				<input class="bb" style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="submit" value="확인"></span></td>
		</tr>

		</form>
	
		</table>
		</center>
		</div>
	</td>
</tr>
<tr>
	<td width="100%" valign="top"><p align="center"><br>
	<input class="bb" onclick='window.close()' style="background-color: white; color: #7B7D7B; height: 18px; border: 1px solid #7B7D7B" type="button" value="창닫기">
	</td>
</tr>
</table>
</body>
</html>
<?
}
elseif($flag=='check'){
	$SQL = "select * from $Mart_PartnerTable where name='$name' and mart_id = '$mart_id' and passport1='$passport1' and passport2='$passport2'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows <= 0){
		echo ("
		<script language='javascript'>
			alert(\"해당하는 아이디가 없습니다.\");
			history.go(-1);		
		</script>	
		");	
		exit;			
	}
	else{
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$username = $ary["username"];
		$password = $ary["password"];	
		echo ("
		<script language='javascript'>
		alert(\"귀하의 아이디는 $username 이고 패스워드는 $password 입니다.\");
		top.window.close();
		</script>	
		");
		exit;
	}				
}
?>
<?
mysql_close($dbconn);
?>