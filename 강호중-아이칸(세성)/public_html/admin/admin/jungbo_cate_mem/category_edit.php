<?
include "../lib/Mall_Admin_Session.php";
?>

<?
$sql = "select * from jungbo_cate_mem where category_num='$category_num' and item_id='$_SESSION[Mall_Admin_ID]' order by end_date desc limit 1";
$res = mysql_query($sql,$dbconn);
$row = mysql_fetch_array($res);
?>								
<?
$today = date("Y-m-d");
if($today <= $row[end_date]){//������ ���� �籸�� ����
	echo ("
	<script>
	alert(\"�������� ���ҽ��ϴ� ������ ������ �ּ���.\");
	</script>
	");
	echo "<meta http-equiv='refresh' content='0; URL=category_list.php'>";
	exit;	
}
?>


<?
$SQL = "select * from jungbo_cate where category_num=$category_num and mart_id='$mart_id'";
$dbresult = mysql_query($SQL, $dbconn);
$row = mysql_fetch_array( $dbresult );
$category_name = $row[category_name];
$category_date = $row[category_date];
$category_desc = $row[category_desc];
$category_degree = $row[category_degree];
$category_img = $row[category_img];

$gigan = $row[gigan];
$money = $row[money];

$if_hide = $row[if_hide];
$category_html = htmlspecialchars($row[category_html], ENT_QUOTES);
//$category_left = htmlspecialchars($row[category_left], ENT_QUOTES);

$upload = "../../up/$mart_id/";
$target = "$upload"."$category_img";
if( $category_img ){
	$cate_target_img = "<img src='$target' border='0' align='absmiddle'>";
}else{
	$cate_target_img = "No Image";
}
?>
<html>
<head>
<title><?=$admin_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script language="javascript" src="../js/common.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
function checkform(f){
	if(f.category_name.value == ""){
		alert("������ �з����� �Է��ϼ���.")
		f.category_name.focus();
		return false;
	}	

	//var category_left = ed.getHtml(); //��ü�� textarea�� �ۼ���HTML�� ����
	//if(category_left=="")
	//{
	//		alert("������ �����ּ���!");
	////		ed.focus();
			//return false;
	//}

	return true;
}
</script>
<script src="../../editor/easyEditor.js"></script>

</head>

<body bgcolor="#FFFFFF" topmargin="0" leftmargin="0">
<?  include '../inc/menu2.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="310"><img src="../img/page_title2.gif" width="326" height="81"></td>
        <td valign="top" background="../img/top_2_bg.gif"><div align="right">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="10"></td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../good/board_frame8.html">HOME</a> &gt; </span><span class="text_gray2_c">�з� ���� </span> </div></td>
            </tr>
            <tr>
              <td height="28">&nbsp;</td>
            </tr>
            <tr>
              <td><div align="right"><img src="../img/top_icon2.gif" width="5" height="7"> <span class="title">&nbsp;�����ڸ�忡 �����ϼ̽��ϴ�.</span></div></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<form action='category_modify.php?category_num=<?=$category_num?>' name="up" method="post" onSubmit="return checkform(this)" enctype="multipart/form-data">
<input type="hidden" name="flag" value="update">
<input type="hidden" name="category_img" value="<?=$category_img?>">
<input type="hidden" name="money" value="<?=$money?>">
<input type="hidden" name="gigan" value="<?=$gigan?>">
<input type="hidden" name="category_name" value="<?=$category_name?>">

<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		 <td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>�з� ���� </b></td>
				</tr>
			</table>

			<!--���� START~~--><br>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function view_image(input)
	{
		var oImg = document.getElementById("upImage");
		oImg.src = input.value;
		oImg.style.display = "";
	}
//-->
</SCRIPT>
			<table border="1" cellpadding="0" cellspacing="0" width="100%" bordercolordark="white"  align="center">
      			<tr>
        			<td width="90%" bgcolor="#999999">
        				<table border="0" width="100%" cellspacing="1" cellpadding="3">
          				<tr>
            				<td width="30%" bgcolor="#C8DFEC" align="center">
								�з���
            				</td>
            				<td width="70%" bgcolor="#FFFFFF">&nbsp;&nbsp;
            					<b><?=$category_name?></b>
							</td>
          				</tr>













          				<tr>
            				<td bgcolor="#C8DFEC" align="center">�Ⱓ</td>
            				<td bgcolor="#FFFFFF" >&nbsp;&nbsp;
								<?=$gigan?>��
							</td>
          				</tr>          				

          				<tr>
            				<td bgcolor="#C8DFEC" align="center">���Աݾ�</td>
            				<td bgcolor="#FFFFFF" >&nbsp;&nbsp;
								<?=number_format($money)?>�� 
								<input type=hidden name="if_hide" value="0">
							</td>
          				</tr>          				


          				<tr>
            				<td bgcolor="#C8DFEC" align="center">�������ܾ�</td>
							<?
							$sql = "select bonus_total from item where item_id='$_SESSION[Mall_Admin_ID]'";
							$res = mysql_query($sql,$dbconn);
							$row = mysql_fetch_array($res);
							?>
								
							<td bgcolor="#FFFFFF" >&nbsp;&nbsp;

								<?=number_format($row[bonus_total])?>��
								<input type=hidden name="if_hide" value="0">
							</td>
          				</tr>

        				</table>
        			</td>
      			</tr>
   		   </table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
      			<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
						<?
						if($money > $row[bonus_total]){
						?>
						<font color=RED><b>������ �������ܾ��� �����մϴ� �������� ���Թٶ��ϴ�</b></font><br>
						<?}else{?>
						<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�����ϱ�"> 
						<?}?>
						<input class="aa" onClick="window.location.href='category_list.php'" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="button" value="���">
    				</td>
  				</tr>
  				<tr align="center">
    				<td width="100%" bgcolor="#FFFFFF" valign="top"></td>
  				</tr>
			</table>
<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
mysql_close($dbconn);
?>