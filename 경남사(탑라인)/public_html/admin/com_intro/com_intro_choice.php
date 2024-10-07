<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $MartIntroTable where mart_id='$mart_id'";
	//echo "sql=$SQL";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult,0);
		$ary=mysql_fetch_array($dbresult);
		$intro_type = $ary["intro_type"];
	}

	include "../admin_head.php";
?>

<script>
function doBlink() {
  // Blink, Blink, Blink...
  var blink = document.all.tags("BLINK")
  for (var i=0; i < blink.length; i++)
	 blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
}

function startBlink() {
  // Make sure it is IE4
  if (document.all)
	 setInterval("doBlink()",500)
}
window.onload = startBlink;
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--왼쪽부분시작-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--왼쪽부분 END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>회사소개</b></td>
				</tr>
			</table>

			<!--내용 START~~--><br>
<form method="post" name="writeform">
<input type='hidden' name='flag' value='update'>
		<table border="1" cellpadding="5" cellspacing="0" width="80%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
			<tr>
			<td width="62%" bgcolor="#FFFFFF" height="7" valign="top">
				<p style="padding-left: 40px"><a href="com_intro1.php"><img src="../images/a4-1.gif" border="0" WIDTH="339" HEIGHT="107"></a></td>
			<td width="38%" bgcolor="#FFFFFF" valign="middle">
				<input name="intro_type" type="radio" value="1"
				<?
				if($intro_type == 1) echo " checked";
				?>
				>&nbsp; 
				<?if($intro_type == 1) echo "<span class='cc'><strong><blink>현재 사용중</blink></strong></span>"?>
			</td>
			</tr>
			<tr>
			<td width="62%" bgcolor="#FFFFFF" height="3" valign="top">
				<p style="padding-left: 40px">
				<a href="com_intro2.php">
				<img src="../images/a4-2.gif" border="0" WIDTH="339" HEIGHT="109"></a>
			</td>
			<td width="38%" bgcolor="#FFFFFF" valign="middle">
			<input name="intro_type" type="radio" value="2"
				<?
				if($intro_type == 2) echo " checked";
				?>
				>&nbsp; 
				<?if($intro_type == 2) echo "<span class='cc'><strong><blink>현재 사용중</blink></strong></span>"?>
				</td>
			</tr>
			<tr>
			<td width="62%" bgcolor="#FFFFFF" height="3" valign="top">
				<p style="padding-left: 40px">
				<a href="com_intro3.php">
				<img src="../images/a4-3.gif" border="0" WIDTH="339" HEIGHT="107"></a>
			</td>
			<td width="38%" bgcolor="#FFFFFF" valign="middle">
				<input name="intro_type" type="radio" value="3"
				<?
				if($intro_type == 3) echo " checked";
				?>
				>&nbsp; 
				<?if($intro_type == 3) echo "<span class='cc'><strong><blink>현재 사용중</blink></strong></span>"?>
			</td>
			</tr>
		<tr>
			<td width="100%" bgcolor="#FFFFFF" align="center" height="35" colspan=2><input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="수정">&nbsp;</td>
			</tr>
			</table>
</form>
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
elseif ($flag == "update") {
	//$help = str_replace("<BR>", "\n", $help);
	//$help = stripslashes($help);
	$SQL = "update $MartIntroTable set intro_type='$intro_type' where mart_id='$mart_id'";

	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=com_intro_choice.php'>";
}
?>	
<?
mysql_close($dbconn);
?>