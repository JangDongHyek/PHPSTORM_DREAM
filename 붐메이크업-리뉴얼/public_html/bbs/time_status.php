<?
	$bbs_id="yeyak";
	require_once("include/bbs.lib.inc.php");
	if($status){
		$bbs_ext_value1="!".str_replace("\n","|",$bbs_ext_value1);
		$bbs_ext_value2="!".str_replace("\n","|",$bbs_ext_value2);
		$sql = "update rg_bbs_cfg set bbs_ext_value1='$bbs_ext_value1',bbs_ext_value2='$bbs_ext_value2' where bbs_num=1";
		$i_result=mysql_query($sql);
		if($i_result){
			echo "<script language=javascript>";
			echo "opener.location.reload();";
			echo "</script>";
		}
	}
	$sql="select * from rg_bbs_cfg where bbs_num=1";
	$result=mysql_query($sql);
	$rs=mysql_fetch_array($result);
	extract($rs);
	$bbs_ext_value1=str_replace("!","",$bbs_ext_value1);
	$bbs_ext_content1=str_replace("|","\n",$bbs_ext_value1);
	$bbs_ext_row1=explode("|",$bbs_ext_value1);

	$bbs_ext_value2=str_replace("!","",$bbs_ext_value2);
	$bbs_ext_content2=str_replace("|","\n",$bbs_ext_value2);
	$bbs_ext_row2=explode("|",$bbs_ext_value2);
?>
<html>
<head>
<title><?=$html_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link href="<?=$skin_board_url?>style.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="frm" method="post" action="">
<input type="hidden" name="status" value="ok">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td>�ð�</td>
		<td>��</td>
	</tr>
	<tr>
		<td valign="top">
			<textarea name="bbs_ext_value1" style="width:100%" rows="<?=sizeof($bbs_ext_row1)+2?>"><?=$bbs_ext_content1?></textarea>
		</td>
		<td valign="top">
			<textarea name="bbs_ext_value2" style="width:100%" rows="<?=sizeof($bbs_ext_row2)+2?>"><?=$bbs_ext_content2?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<input type="submit" value="����">
			<input type="button" value="�ݱ�" onclick="self.close()">
		</td>
	</tr>
</table>
</form>
</body>
</html>
<?
	if($i_result){
		echo "<script>";
		echo "alert('�ð� ������ ���������� �����Ͽ����ϴ�.')";
		echo "</script>";
	}
?>