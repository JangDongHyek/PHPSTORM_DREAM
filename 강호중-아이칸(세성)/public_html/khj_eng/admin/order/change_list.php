<?
include "../lib/Mall_Admin_Session.php";
?>
<?
$table = "changegood";

if($page == ""){
	$page = 1;
}

if($mode == "search"){
	$qry = "select count(*) from $table where $select_key like '%$input_key%'";
}else{
	$qry = "select count(*) from $table";
}

$result = mysql_query($qry,$dbconn);
$total = mysql_result($result,0,0);

$line = 20;
$list = 10;
$total_page = ceil($total/$line);
$total_list = intval($total_page/$list);

if($total_page%$list == 0){
	$total_list--;
}

$curr_list = intval($page/$list);

if($page%$list == 0){
	$curr_list--;
}

$start_page = $curr_list*$list+1;
$prev_list = $start_page - $list;
$next_list = $start_page + $list;
$olds = $line*($page-1);

if($mode == "search"){
	$qry = "select * from $table where $select_key like '%$input_key%' order by c_regdate desc limit $olds,$line";
}else{
	$qry = "select * from $table order by c_regdate desc limit $olds,$line";
}

$result = mysql_query($qry,$dbconn);

include "../admin_head.php";
?>

<script language="javascript">
function check(){
	var it = document.f;
	if(it.input_key.value == ""){
		alert("�˻�� �Է��ϼ���");
		it.input_key.focus();
		return false;
	}

	it.submit();
}

function delcheck(num1,num2,num3){
	var remessage = " �ٽ�Ȯ�� �մϴ�. \n\n �����Ͻðڽ��ϱ�.?";

	if(confirm(remessage)){
		location.href="delete.html?mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&mod=del&page="+num1+"&re_uid="+num2+"&re_code="+num3;
	}
}
</script>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0">
<?  include '../inc/menu4.html'; ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
    <td width="990" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" background="../img/mid_bg.gif">&nbsp;</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="310"><img src="../img/page_title4.gif" width="326" height="81"></td>
            <td valign="top" background="../img/top_2_bg.gif"><div align="right">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="10"></td>
                </tr>
                <tr>
                  <td><div align="right"><img src="../img/top_icon.gif" width="13" height="15" align="absmiddle"> <span class="text_gray2_t">����������</span><span class="text_gray2"> : <a href="../index.html">HOME</a> &gt; </span><span class="text_gray2_c">�ֹ�����</span> &gt; <span class="text_gray2_c">��ȯ/��ǰ ���� </span> </div></td>
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
      </tr>
    </table></td>
    <td valign="top"><table width="100%" height="81" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td background="../img/mid_bg.gif">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="990" height="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
	<tr valign="top">
		<td width="200" height="500">
			<!--���ʺκн���-->
<?
$left_menu = "4";
include "../include/left_menu_layer.php"; 
?>
			<!--���ʺκ� END-->		</td>
		<td>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
				<td width="100%" height="30" bgcolor="F2F2F2" class="title"><img src="../images/icon_1.gif" width="30" height="17" align="absmiddle"><b>��ȯ/��ǰ ���� </b></td>
				</tr>
			</table>

			<!--���� START~~-->
<br>

			<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" align="center">
				<tr>
					<td width="90%" bgcolor="#FFFFFF" valign="top">
						��ȯ/��ǰ ������ �����մϴ�.</font><br><br>
						<b>�ֹ���ȣ</b>�� �����ø� <b>�ֹ��� ����</b>�� �̵��մϴ�.<br>
						<b>����</b>�� �����ø� <b>��ȯ/��ǰ ���� ������</b>�� �̵��մϴ�.<br>
						<b>��û��</b>�� �����ø� <b>ȸ������</b>�� �̵��մϴ�.
					</td>
				</tr>
				<tr>
					<td width="100%" bgcolor="#FFFFFF" valign="top" align="center">
						<table border="0" width="95%">
							<tr>
							<td width="90%" bgcolor="#999999">
								<table border="0" width="100%" cellspacing="1" cellpadding="3">
								<tr>
									<td width="100%" bgcolor="#8FBECD" colspan="5">
										<table border="0" width="100%" cellspacing="0" cellpadding="0">
											<tr>
											<form name="f" method="post" action="<?=$PHP_SELF?>?mode=search" onSubmit="check(); return false;">
												<td width="50%">
<? 
if($mode=="search"){ 
?>
													[ Search Result : <?=$total?> ]
<? 
}else{ 
?>
													[ Total : <?=$total?> ]
<? 
} 
?>											
												</td>
												<td width="50%" align="right">
													<select name="select_key" size="1" style="BORDER-BOTTOM: black 1px solid; BORDER-LEFT: black 1px solid; BORDER-RIGHT: black 1px solid; BORDER-TOP: black 1px solid; height: 18px">
														<option value="c_title" selected>����</option>
														<option value="c_name">�̸�</option>
														<option value="c_order_num">�ֹ���ȣ</option>
														<option value="c_phone">��ȭ��ȣ</option>
														<option value="c_email">�̸���</option>
													</select>
													&nbsp; 
													<input name='input_key' value='<?=$searchword?>' size="13" class="input_03"> &nbsp; 
													<input style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px" type="submit" value="�˻�"> <input type='button' style="BACKGROUND-COLOR: white; BORDER-BOTTOM: #5a5a5a 1px solid; BORDER-LEFT: #5a5a5a 1px solid; BORDER-RIGHT: #5a5a5a 1px solid; BORDER-TOP: #5a5a5a 1px solid; COLOR: black; height: 18px" style='cusor:hand' onclick="location.href='<?=$PHP_SELF?>'" value="���">&nbsp;
												</td>
											  </form>
											</tr>										
										</table>
									</td>
								</tr>
								<tr>
									<td width="8%" bgcolor="#FFFFFF" align="center">��ȣ</td>
									<td width="25%" bgcolor="#FFFFFF" align="center">�ֹ���ȣ</td>
									<td width="12%" bgcolor="#FFFFFF" align="center">��û��</td>
									<td width="35%" bgcolor="#FFFFFF" align="center">�� ��</td>
									<td width="20%" bgcolor="#FFFFFF" align="center">�� ¥</td>
								</tr>
<?
if($total == 0){
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td colspan='5'><b>������ ������ �����ϴ�</b></td>
								</tr>
<?
}else{
	$i = 0;
	while($row = mysql_fetch_array($result)){
		$id = $total - ($olds + $i);
		$i++;

		if( $row[re_status] == "y" ){
			$mail_str = "�� ��";
		}else{
			$mail_str = "�̹߼�";
		}

		if( $row[re_ok] == "y" ){
			$status = "<img src='../image/ok.gif' width='21' height='13'>";
		}else{
			$status = "-";
		}

		if( $row[c_title] ){
			$c_title = $row[c_title];
		}else{
			$c_title = "�������";
		}

		if( $row[username] ){
			$username_str = "<a href='../member/member_view.php?username=$row[username]'>$row[c_name]</a>";
		}else{
			$username_str = $row[c_name];
		}
?>
								<tr bgcolor="#FFFFFF" align="center">
									<td><a href='change_edit.php?c_uid=<?=$row[c_uid]?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'><?=$id?></a></td>
									<td align="left"><a href='change_edit.php?c_uid=<?=$row[c_uid]?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'><b><?=$row[c_order_num]?></a></b></td>
									<td><b><?=$username_str?></b></td>
									<td align="left"><a href='change_edit.php?c_uid=<?=$row[c_uid]?>&code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page?>'><b><?=$row[c_title]?></b></a></td>
									<td><?=$row[c_regdate]?></td>
								</tr>
<?
	}
}
?>
								</table>
							</td>
						</tr>
					</table>
				</td>
				</tr>

			<tr align="center">
				<td width="100%" bgcolor="#FFFFFF">
<? 
if($prev_list <= 0){ 
?>
					ó��
<? 
}else{ 
?>

					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$prev_list?>">ó��</a>

<? 
} 
?>
<? 
if($page-1 <= 0){ 
?>
					��
<? 
}else{ 
?>
					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page-1?>">��</a>
<? 
} 
?>
					&nbsp;
<? 
for($i=$start_page;$i<$start_page+$list;$i++){
?>
<? 
	if($i == $page){ 
?>
					<b>[<?=$i?>]</b>
<? 
	}else{ 
?>

					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$i?>"><?=$i?></a>
<? 
	} 
?>
					&nbsp;
<?
	if($i>=$total_page)
	break
?>
<? 
} 
?>
<? 
if($page+1 > $total_page){ 
?>
					��
<? 
}else{ 
?>
					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$page+1?>">��</a>
<? 
} 
?>
<? 
if($next_list>$total_page){ 
?>
					��
<? 
}else{ 
?>
					<a href="<?=$PHP_SELF?>?code=<?=$code?>&mode=<?=$mode?>&select_key=<?=$select_key?>&input_key=<?=$input_key?>&page=<?=$next_list?>">��</a>
<? 
} 
?>
			  </td>
			  </tr>
		  </table>

<br>
			<!--���� END~~-->
		</td>
	</tr>
</table>
</body>
</html>
<?
if( $result ){
	mysql_free_result( $result );
}
mysql_close($dbconn);
?>
