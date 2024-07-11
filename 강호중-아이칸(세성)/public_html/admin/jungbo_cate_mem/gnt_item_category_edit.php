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
<?
if($flag == '') {
	
	$SQL = "select * from $Gnt_Category_NameTable where seller_id='$Mall_Admin_ID' and gnt_category_num='$gnt_category_num'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$gnt_category_name_tmp = $ary["gnt_category_name"];
	}
	$SQL = "select * from $Gnt_CategoryTable where gnt_category_num=$gnt_category_num";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary = mysql_fetch_array($dbresult);
		$gnt_category_name = $ary["gnt_category_name"];
	}
	if($gnt_category_name_tmp != "") $gnt_category_name = $gnt_category_name_tmp;
	
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(f){
	if(f.gnt_category_name.value == ""){
		alert("변경할 분류명을 입력하세요.")
		f.gnt_category_name.focus();
		return false;
	}
	return true;
}
</script>
</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<table border="0" width="780" cellspacing="0" cellpadding="0" height="100%">

<form name="up" method="post" onsubmit="return checkform(this)">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="gnt_category_num" value="<?echo $gnt_category_num?>">

<tr>
	<td width="106" valign="top"><p align="left"><br>
		<br>
		<br>
		</p>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
  		<tr>
    		<td width="100%"><img src="../images/a3.gif" WIDTH="160" HEIGHT="36"></td>
  		</tr>
  		<tr>
    		<td width="100%" height="1" bgcolor="#98A043"></td>
  		</tr>
  		<tr>
    		<td width="100%" bgcolor="#F2F2F2"><p style="padding-left: 5px"><span class="bb"><br>
    			<small>▶</small> <font face="돋움">쇼핑몰 <strong>상품</strong>을<strong> <br>
    			&nbsp;&nbsp; 관리</strong>합니다.<br>
    			</font><br>
    			</span></td>
  		</tr>
  		<tr>
    		<td width="100%" bgcolor="#98A043" height="1"></td>
  		</tr>
		</table>
		
		<p align="left"><br>
		<br>
	</td>
	<td width="1" bgcolor="#808080"><br>
	</td>
	<td width="646" bgcolor="#FFFFFF" valign="top">
		<div align="center"><center>
		
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
  		<tr>
    		<td width="90%" bgcolor="#FFFFFF" valign="top">　<p style="padding-left: 10px"><strong><span class="cc">[분류 수정]</span></strong><span class="aa"> 등록된 
    			분류를 수정합니다.<br>
    			</span><br>
    		</td>
  		</tr>
  		<tr>
    		<td width="100%" bgcolor="#FFFFFF" height="3" valign="top">
    			<table border="0" width="100%" cellspacing="0" cellpadding="0">
      			<tr>
        			<td width="100%" bgcolor="#FFFFFF"></td>
      			</tr>
    			</table>
    		</td>
  		</tr>
  		<tr>
    		<td width="100%" bgcolor="#FFFFFF" valign="top">
    			<div align="center"><center>
    			
    			<table border="0" width="95%">
      			<tr>
        			<td width="90%" bgcolor="#999999">
        				<table border="0" width="100%" cellspacing="1" cellpadding="3">
          				<tr>
            				<td width="20%" bgcolor="#C8DFEC" align="center"><span class="aa">등록된 
            					분류명</span>
            				</td>
            				<td width="21%" bgcolor="#FFFFFF" align="center">
            					<span class="bb"><strong></strong><?echo $gnt_category_name?></span></td>
            				<td width="19%" bgcolor="#C8DFEC" align="left">
            					<span class="aa"><p align="center">변경할 분류명</span></td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<span class="aa">
            					<input class="aa" name="gnt_category_name" size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid"></span>
            				</td>
          				</tr>
        				</table>
        			</td>
      			</tr>
    			</table>
    			</center></div>
    		</td>
  		</tr>
  		<tr>
    		<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
    			<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="완료"> 
    			<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="재입력"> 
    			<input class="aa" onclick="window.location.href='category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="이전화면">
    		</td>
  		</tr>
  		<tr align="center">
    		<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
  		</tr>
		</table>
		</center></div>
	</td>
</tr>
</form>
</table>
</body>
</html>
<?
}
elseif ($flag == "update") {
	
	$SQL = "select * from $Gnt_Category_NameTable where seller_id='$Mall_Admin_ID' and gnt_category_num='$gnt_category_num'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		$SQL = "update $Gnt_Category_NameTable set gnt_category_name='$gnt_category_name' where seller_id='$Mall_Admin_ID' and gnt_category_num='$gnt_category_num'";
	}
	else{
		$SQL = "insert into $Gnt_Category_NameTable (seller_id, gnt_category_num, gnt_category_name) values ('$Mall_Admin_ID' ,'$gnt_category_num', '$gnt_category_name')";
	}

	$dbresult = mysql_query($SQL, $dbconn);

	echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
}
?>
<?
mysql_close($dbconn);
?>