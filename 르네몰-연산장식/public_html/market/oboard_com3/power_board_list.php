<?

/*
if($HTTP_SESSION_VARS[AUTH2] || ($Mall_Admin_ID&&$MemberLevel==1)){
	$auth_chk = "ok";
}
if(!$auth_chk){
	err_msg("�α����� �̿밡���մϴ�");
}
*/




$it_board_row = 15;			//  ����
$it_board_page_num = 10;	//  ��������
$link_page_num = 10;
$time_limit = 60*60*24*1;

if(!$page) $page=1;
$result = mysql_query("select count(*) from $board where code='$code_url' and 0<orderby");
db_error($result,"ī��Ʈ����!");
$total = mysql_result($result,0,0);

if($total){
	$total_page = ceil($total/$it_board_row);
	$total_block = ceil($total_page/$it_board_page_num);
	$block = ceil($page/$link_page_num);

	$first_page = ($block-1)*$it_board_page_num;
	$last_page = $block*$it_board_page_num;

	if($total_block<=$block) $last_page = $total_page;

	$row_num = $total-$it_board_row*($page-1);
	$start = ($page-1)*$it_board_row;

	if($Mall_Admin_ID&&$MemberLevel==1){
			$result = mysql_query("select * from $board where code='$code_url' and 0<orderby order by orderby desc,thread desc,thread2 asc,pos asc limit $start,$it_board_row");
	}else{
		$result = mysql_query("select * from $board where code='$code_url' and 0<orderby order by orderby desc,thread desc,thread2 asc,pos asc limit $start,$it_board_row");
	}
	

	db_error($result,"���������ǹ� ����");

	$total_list = mysql_num_rows($result);

	if($total_list >= $it_board_row) $IsNext = ($page == $total_page)? 0:1;
}

if($Mall_Admin_ID&&$MemberLevel==1){
	$colspan1="9";
	$colspan2="9";
}else{
	$colspan1="6";
	$colspan2="6";
}
?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function Scheck_box(Num)
{
	var ck_data=new Array();
	var ck_num=0;

	for(var i=0; i < Num;i++){
		var ck_box=eval("document.all.checkbox"+i);

		if(ck_box.checked == true){
			ck_data[ck_num]=ck_box.value;
			ck_num++;
		}
	}
	if(ck_num=="0"){
		alert("��ü��,���ǰ��,���� �� �ϳ��̻� �����ϼž� �մϴ�.");
		return;
	}
	document.all.check_array.value=ck_data;
	it.submit();
}

//Enter key control
function word_box()
{
	if(event.keyCode == 13){
		event.returnValue=false;
		Scheck_box(3);
	}
}
//-->
</SCRIPT>
<link href="../css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<form name="it" method="post">
<input type="hidden" name="check_array">
	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="90%"><img src="../images/sa_title.gif" width="673" height="88" border="0" usemap="#Map" /></td>
      </tr>
      <tr>
        <td width="90%" align="right">
		<?
		if($HTTP_SESSION_VARS[AUTH2]){
		?>
			<a href="../oboard_com3/logout.php"><b>�α׾ƿ�</b></a>
		<?
		}else{
		?>
			<a href="../main/reservation_com3.html?set=auth"><b>�α���/���Ի��� ��û�ϱ�</b></a>
		<?
		}
		?>
		</td>
      </tr>
	</table>
	<? 
		//include "../oboard_com3/power_board_list.php";
	?>
                  <!--�˻� ���̺� ���� -->
				  <table width="60%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr> 
                      <td width="10" align="center">&nbsp;</td>
                      <td width="297" align="center"><input type="checkbox" name="checkbox0" value="value1">
��ü�� 
  <input type="checkbox" name="checkbox1" value="value10"> 
  ���ǰ�� 
  </td>
                      <td width="188" align="center"> <input name="search_word" type="text" size="16" maxlength="18" onkeypress="word_box()"></td>
                      <td width="101"><a href="#">
                        <!--�˻���ư -->
                        <img src="../oboard_com3/images/search_btn.gif" width="60" height="22" border="0" align="top" onclick="Scheck_box(3)"></a></td>
                    </tr>
                  </table>
                  <!--�˻� ���̺� �� -->
				  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="1">
			<tr bgcolor="F2F2F2"> 
                <td height="2" colspan="<?=$colspan2?>" align="center"></td>
      </tr>
              <tr> 
                <td width="160" align="center" bgcolor="2EACDF"><span class="style1"> 
                ��ü��</span></td>
                  <td width="120" align="center" bgcolor="2EACDF"><span class="style1"> 
                 ���ǰ��</span></td>
                <td width="80" align="center" bgcolor="2EACDF"><span class="style1"> 
                �߼�����</span></td>
                <td width="80" align="center" bgcolor="2EACDF"><span class="style1"> 
                �������</span></td>
	                <td width="100" align="center" bgcolor="2EACDF"><span class="style1"> 
                 ��ȭ��ȣ</span></td>
	                <td width="100" align="center" bgcolor="2EACDF"><span class="style1"> 
                 Ȩ������</span></td>
<?
if($Mall_Admin_ID&&$MemberLevel==1){
?>
						<td width="100" align="center" bgcolor="2EACDF"><span class="style1"> 
                 �����</span></td>
						<td width="60" align="center" bgcolor="2EACDF"><span class="style1"> 
                 ��ȸ��</span></td>
						<!--
						<td width="60" align="center" bgcolor="2EACDF"><span class="style1"> 
                 ����</span></td>-->
<?
}
?>
              </tr>
			<tr bgcolor="CFCFCF"> 
                <td height="2" colspan="<?=$colspan2?>" align="center"></td>
      </tr>

<?
########################################### �Խ��� for ������ 
if($total){
	for($i=0;	$ans = mysql_fetch_array($result); $i++){

		if($board_type == "board"){



	$qry="SELECT * FROM rg_goods_category where cat_name='$ans[value11]'";
	$rs=mysql_query($qry);
	$tmp = mysql_fetch_array($rs);

	if($ans[value8]){
		$ahref="http://$ans[value8]";
		$gubun = "<font color=green>Ȩ������</font>";
	}else{
		$ahref="";
		$gubun = "";
	}
?>

<tr onmouseover="this.style.backgroundColor='#fafad2'" onmouseout="this.style.backgroundColor='white'" style="cursor:hand">
						<td align="center" bgcolor="#F7FCFD"  height="28">
						<a href='#' title="<?=$ans[body]?>"><font face=���� color='#666666'>
						<a href='<?=$code_url?>?set=view&board=<?=$board?>&uid=<?=$ans[0]?>&opti_ex=<?=$ans[9]?>&check_array=<?=$check_array?>&search_word=<?=$search_word?>&page=<?=$page?>&page_num=<?=$row_num?>&sort1=<?=$sort1?>&sort2=<?=$sort2?>'><font face=���� color='#666666'><b><?=$ans[value1]?></b></a>	
						</td>
						<td align="center">
						<?=$ans[value10]?>						</td>
						<td align="center" bgcolor="#F7FCFD">
						<?=$ans[value2]?>						</td>
						<td align="center">
						<?=$ans[value13]?>						</td>
						<td align="center" bgcolor="#F7FCFD">
						  <?=$ans[value6]?>
						</td>
						<td align="center" bgcolor="#F7FCFD"> 
						<a href="<?=$ahref?>" target='_blank'><b><?=$gubun?></b></a>
						</td>		
<?
if($Mall_Admin_ID&&$MemberLevel==1){
?>
						<td align="center"> 
						<?=$ans[reg_date]?>					  </td>						
						<td align="center" bgcolor="#F7FCFD"> 
						<?=$ans[count]?>					  </td>		
						<!--
						<td align="center" bgcolor="#F7FCFD"> 
						<?
							if($ans[ox] == "x"){
								echo"<a href='$code_url?ox_modify=o&set=list&board=$board&uid=$ans[id]&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'><font color='red'>�̵��</font></a>";
							}elseif($ans[ox] == "o"){
								echo"<a href='$code_url?ox_modify=x&set=list&board=$board&uid=$ans[id]&check_array=$check_array&search_word=$search_word&page=$page&sort1=$sort1&sort2=$sort2'><font color='blue'>���</font></a>";
							}
						?>
					  </td>	
					  -->
<?
}
?>
	  </tr>
					<tr bgcolor="F2F2F2"> 
					<td height="1" colspan="<?=$colspan2?>" align="center"></td>
					</tr>
		<?
		}
	$name = "";
	$row_num--;
	}
}
#############################################�Ի��� for�� ��#######################################
?>
			  <tr> 
                <td height="1" colspan="<?=$colspan2?>" bgcolor="CFCFCF"></td>
              </tr>
  </table>
<br />















<map name="Map" id="Map">
<!--area shape="rect" coords="406,12,658,79" href="../site/usage.htm" /-->
</map>