<?
include "../lib/Mall_Admin_Session.php";
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
$gigan_money10 = $row[gigan_money10];
$gigan_money20 = $row[gigan_money20];
$gigan_money30 = $row[gigan_money30];

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
              <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�з� ���� </span> </div></td>
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
            				<td width="20%" bgcolor="#C8DFEC" align="center">
								��ϵ� �з���
            				</td>
            				<td width="21%" bgcolor="#FFFFFF" align="center">
            					<b><?=$category_name?></b>
							</td>
            				<td width="19%" bgcolor="#C8DFEC"  align="center">
								������ �з���
							</td>
            				<td width="40%" bgcolor="#FFFFFF" align="center">
            					<input class="aa" name="category_name" value='<?=$category_name?>' size="14" style="width:90%;BORDER-BOTTOM: rgb(136,136,136) 1px solid; BORDER-LEFT: rgb(136,136,136) 1px solid; BORDER-RIGHT: rgb(136,136,136) 1px solid; BORDER-TOP: rgb(136,136,136) 1px solid">
            				</td>
          				</tr>













          				<tr>
            				<td bgcolor="#C8DFEC" align="center">�Ⱓ</td>
            				<td bgcolor="#FFFFFF" colspan='3'>10��:<input type=text name="gigan_money10" value="<?=$gigan_money10?>" size=10>��<br>
								20��:<input type=text name="gigan_money20" value="<?=$gigan_money20?>" size=10>��<br>
								30��:<input type=text name="gigan_money30" value="<?=$gigan_money30?>" size=10>��
							</td>
          				</tr>          				
<!--
          				<tr>
            				<td bgcolor="#C8DFEC" align="center">�ݾ�</td>
            				<td bgcolor="#FFFFFF" colspan='3'>&nbsp;&nbsp;
								<input type=text name="money" value="<?=$money?>" size=10>�� 
								<input type=hidden name="if_hide" value="0">
							</td>
          				</tr>          				
-->














<!--
          				<tr>
							<td width="20%" bgcolor="#C8DFEC" align="center"><span class="aa">Ȩ�������������</span></td>
							<td width="80%" bgcolor="#FFFFFF" colspan="3">
							&nbsp;&nbsp;&nbsp;&nbsp; 
							<input class="aa" type="radio" value="0" name="if_hide" <?if($if_hide == '0') echo "checked";?>> Ȩ�������� �����
							<input class="aa" type="radio" value="1" name="if_hide" <?if($if_hide == '1') echo "checked";?>>Ȩ�������� ����������� <br>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							(����� ������, Ȩ�������� ��µ����� �ʽ��ϴ�)
						</td>
              		</tr>
-->
        				</table>
        			</td>
      			</tr>
   		   </table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
      			<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top"><p align="center"><br>
						<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="submit" value="�Ϸ�"> 
						<input class="aa" style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; HEIGHT: 18px" type="reset" value="���Է�"> 
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