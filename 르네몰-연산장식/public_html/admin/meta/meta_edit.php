<?
include "../lib/Mall_Admin_Session.php";
?>
<?
if ($flag == "") {
	$SQL = "select * from $Domain_forwardTable where mart_id='$mart_id' and if_confirm='1'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows > 0){
		mysql_data_seek($dbresult, 0);	
		$ary = mysql_fetch_array($dbresult);	
		$mart_id = $ary["mart_id"];
		$title = $ary["title"];
		$description = $ary["description"];
		$keywords = $ary["keywords"];
		$info_meta1 = $ary["info_meta1"];
		$domain = $ary["domain"];
		$pay = $ary["pay"];
		$date = $ary["date"];
		$if_confirm = $ary["if_confirm"];
	}
	include "../admin_head.php";
?>


<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500" bgcolor="F2F2F2">
			<!--���ʺκн���-->
<?
$left_menu = "1";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->
		 </td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="50" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>��Ÿ�ױ�</b></td>
				</tr>
			</table>

			<!--���� START~~--><br>

				<table border="1" cellpadding="5" cellspacing="0" width="90%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">						
						<strong>*���θ��� ��Ÿ�ױ״� ������ �������� ��û�Ͻ� ��쿡�� ����˴ϴ�.*</strong><br> 
						���θ��� ��Ÿ�±׸� �Է��ϴ� ���Դϴ�. ��Ÿ�±״� 'Ű����' 
						�� '����Ʈ ����'���� �����˴ϴ�. �˻����� ��<br>
						���� �˻���������&nbsp; �� ���θ� ���������� �ִ� ��Ÿ�±׸� 
						�˻��Ͽ� ����� �����ݴϴ�. �̶� ����� �˻�� �ٷ� ��Ÿ�±� 
						�Դϴ�. �˻� Ű���尡 �������̸� ��ǥ(,)�� �����Ͽ� �Է��Ͻø� 
						�˴ϴ�. <br></td>
					</tr>
<form method='post'>
<?
if($numRows == "0"){
?>
			<input type='hidden' name='flag' value='insert'>
<?
}else if($numRows > "0"){
?>
		<input type='hidden' name='flag' value='update'>
<?
}
?>

					<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top">
						<div align="center"><center>
						<table border="0" width="90%">
							<tr>
								<td width="25%">������</td>
								<td width="75%">
									<input type="text" name="domain" size="30" value='<?=$domain?>' class="input_03"> (http:// �� ������ ������ �ּ�)</td>
							</tr>
							<tr>
								<td width="25%">Ű����</td>
								<td width="75%">
									<textarea cols="60" name="keywords" rows="6" class="input_03"><?=$keywords?></textarea></td>
							</tr>
							<tr>
								<td width="25%"></td>
								<td width="75%">ȭ��ǰ���θ��� ��) ȭ��ǰ, ȭ��ǰ ���θ�, 
									�����ɾ�, ��ɼ��ɾ�, ��������ũ��, Ŭ��¡, ���, �ڽ���ƽ, 
									�ڽ���ƽ ���θ�</td>
							</tr>
							<tr>
								<td width="25%">����Ʈ ����</td>
								<td width="75%">
									<textarea cols="60" name="description" rows="6" class="input_03"><?=$description?></textarea></td>
							</tr>
							<tr>
								<td width="25%"></td>
								<td width="75%">ȭ��ǰ���θ��� ��) �����ɾ�, ��ɼ��ɾ�, 
									��������ũ��, Ŭ��¡, ���� ȭ��ǰ��Ż ���θ�</td>
							</tr>
							<!-- <tr>
								<td width="25%"></td>
								<td width="75%">
									<img border="0" src="../images/pagetitle.gif" width="412" height="49"></td>
							</tr> -->
							<tr>
								<td width="25%">������ Ÿ��Ʋ</td>
								<td width="75%"><input type="text" name="title" size="60" value='<?=$title?>' class="input_03"></td>
							</tr>
						</table>
					</td>
					</tr>
					<tr>
					<td width="100%" bgcolor="#FFFFFF" align="center" height="35">
						<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="submit" value="�Ϸ�">&nbsp; 
						<input style="background-color: rgb(90,90,90); color: rgb(255,255,255); height: 18px; border: 1px solid #5a5a5a" type="reset" value="���Է�"></td>
					</tr>
				</form>
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
}elseif ($flag == "insert") {
	$SQL = "insert into $Domain_forwardTable ( mart_id, domain, title, keywords, description, if_confirm ) values ( '$mart_id', '$domain', '$title', '$keywords', '$description', '1' )";
	$dbresult = mysql_query($SQL, $dbconn); 
	if( $dbresult ){
		echo "<meta http-equiv='refresh' content='0; URL=meta_edit.php'>";
	}else{
		echo "
			<script>
			window.alert('�ۼ��� �����߽��ϴ�');
			history.go(-1);
			</script>
			exit;
		";
	}
}elseif ($flag == "update") {
	$SQL = "select * from $Domain_forwardTable where mart_id='$mart_id' and if_confirm='1'";
	$dbresult = mysql_query($SQL, $dbconn);
	$numRows = mysql_num_rows($dbresult);
	if($numRows == 0){
		echo ("
		<script>
		history.go(-1);
		</script>
		");
		exit;
	}
	
	$SQL = "update $Domain_forwardTable set domain='$domain', title = '$title', description = '$description', keywords = '$keywords' where mart_id='$mart_id'";
	$dbresult = mysql_query($SQL, $dbconn); 

	echo "<meta http-equiv='refresh' content='0; URL=meta_edit.php'>";
}
?>	
<?
mysql_close($dbconn);
?>