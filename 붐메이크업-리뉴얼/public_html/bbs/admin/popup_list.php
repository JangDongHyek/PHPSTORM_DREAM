<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");

	function OX($boolen)
	{
		if($boolen)
			return "��";
		return "X";
	}
/*	
	if(!empty($act) && !empty($nums)) $sel_nums=implode(",",$nums);

	switch($act) {
		case 'bg_bad' :
				$dbqry="
					UPDATE `blog_body` SET
						bg_bad = '$bg_bad_sel'
					WHERE bg_num in ($sel_nums)
				";
				query($dbqry,$dbcon);
				go_href("?$p_str&page=$page");
				break;
	}
*/
  $qstr='';
	for($i=0;$i<count($ss_key);$i++) {
		switch ($ss_key[$i]) {
				/***********************************************************************/
				// �˻���� �˻�
				case 0 : 
					if(!empty($kw)) {
						switch ($ss[$ss_key[$i]]) {
							case 0 : 
										$qstr .= " AND `title` LIKE '%$kw%'";
										$doc_title = "'$kw' �˻� ���";
										break;
						}
					}
					break; 
				/***********************************************************************/
		}
	}
/*
  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY BBSNum";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }
*/
	$ostr .= " ORDER BY idx DESC";

	$dbqry="
		SELECT count(*) as row_count 
		FROM `tblpopup`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	if(!$page){
		$page=1;
	}
	$total_page=ceil($row_count/10);

	$page_info=rg_navigation($page,$row_count,20,10);
?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<script language="javascript">
	function PopupDelete(p_str,page,idx){
		var answer=confirm("�� �� �����ϸ� ����� �����Ͻ� �� �����ϴ�.\n�׷��� �����Ͻðڽ��ϱ�?");
		if(answer==true){
			location.href="popup_delete.php?"+p_str+"&page="+page+"&mode=delete&idx="+idx;
		}
	}
</script>
<br>
<table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr> 
    <td width="796" height="30" bgcolor="#F7F7F7"> <p align="center"><span style="font-size:9pt;"><font color="#404040">�˾�����</font></span></p></td>
  </tr>
</table>
<br>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_search" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
	<tr> 
		  <td width="200">&nbsp;</td>
		  <td align="center">�˻�: 
        <select name="ss[0]" id="ss[0]">
				<?
$ssList = array("����");
for($i=0;$i<count($ssList);$i++) 
if ($i==$ss[0])
echo "<option value='$i' selected>$ssList[$i]</option>";
else
echo "<option value='$i'>$ssList[$i]</option>";
?>
			</select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="�˻�" value="�˻�" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> 
			<input type="button" value="���" onclick="location.href='?'" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"> &nbsp;&nbsp; 
			<input type="button" name="���ΰ�ħ" value="���ΰ�ħ" onclick="location.reload()" style="font-style:normal; font-size:12px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid;"></td>
			<!--��ī���ͽ���-->
		  <td width="141" align="right">&nbsp;Total : &nbsp;&nbsp;<?=$page?> &nbsp;&nbsp;(<?=$page?>/<?=$total_page?>)</td>
		  <!--��ī���� ��-->
	</tr>
</form>
</table>
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td align="center">
        <table width="796" border="1" align="center" cellpadding="0" cellspacing="0" bordercolorlight="#E1E1E1" bordercolordark="white">
          <tr> 
            <td width="1">&nbsp; </td>
            <td width="50" height="24" align="center" bgcolor="#f7f7f7">NO</td>
			<td align="center" bgcolor="#f7f7f7">����</td>
            <td width="65" align="center" bgcolor="#f7f7f7">����</td>
            <td width="65" align="center" bgcolor="#f7f7f7">��Ű</td>
            <td width="65" align="center" bgcolor="#f7f7f7">��ȸ��</td>
            <td width="100" align="center" bgcolor="#f7f7f7">�����</td>
			<!-- <td width="35" align="center" bgcolor="#f7f7f7">����</td> -->
            <td width="35" align="center" bgcolor="#f7f7f7">����</td>
            <td width="35" align="center" bgcolor="#f7f7f7">����</td>
          </tr>
          <?
	$dbqry="
		SELECT *, date_format(regdate, \"%Y-%m-%d\") as regdate
		FROM `tblpopup`
		WHERE (1=1) $qstr
		$ostr
		LIMIT $page_info[offset],$page_info[rows] ";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$R[bg_title]=nl2br(htmlspecialchars($R[bg_title]));
		$R[bg_cmt_cnt]=($R[bg_cmt_cnt]>0)?"($R[bg_cmt_cnt])":"";
		$blog_link="http://{$R[mb_id]}.$main_domain/blog/blog_list.php?ss[10]=$R[bg_cat_num]#blog_$R[bg_num]";
		$no--;
		/*
		if(!empty($kw)) {
			switch ($ss[0]) {
				case 0 : 
							$R[bg_title] = str_replace($kw, "<font color=\"#FF9900\"><b>{$kw}</b></font>", $R[bg_title]);
							break;
				case 1 : 
							$R[bg_writer] = str_replace($kw, "<font color=\"#FF9900\"><b>{$kw}</b></font>", $R[bg_writer]);
							break;
			}
		}*/
?>
          <tr onmouseover='this.style.backgroundColor="#DAEDED"' onmouseout='this.style.backgroundColor=""'> 
            <td width="1" align="center"> <input name="bg_num[]" type="checkbox" id="bg_num[]" value="<?=$R[bg_num]?>"> 
            </td>
            <td height="24" align="center"> 
              <?=$no?>
            </td>
            <td width="0" align="center"> 
              <?=$R[title]?>
            </td>
            <td align="center">
				<?=OX($R[visible])?>
            </td>
            <td align="center"> 
              <?=OX($R[cookie])?>
            </td>
            <td align="center"> 
              <?=$R[visit]?>
            </td>
            <td align="center"> 
              <?=$R[regdate]?>
            </td>
			<!-- <td align="center"><a href="#" target="_blank">����</a></td> -->
            <td align="center"><a href="popup_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&idx=<?=$R[idx]?>">����</a></td>
            <td align="center">
			<!--
			<a href="popup_delete.php?<?=$p_str?>&page=<?=$page?>&mode=delete&idx=<?=$R[idx]?>">-->
			<a href="javascript:PopupDelete('<?=$p_str?>','<?=$page?>','<?=$R[idx]?>')">
			����</a>
			</td>
          </tr>
          <?

	}
?>
        </table>
        <? include("navigation.php"); ?> 
        <table border="0" cellspacing="0" cellpadding="0" width="796">
          <tr>
            <td> <a href="popup_edit.php?<?=$p_str?>&page=<?=$page?>" title="�Խ��ǵ��"><img src="images/plus_popup.gif" width="90" height="25" border="0"></a></td>
          </tr>
        </table>
        <!--				
        <p align="center"> 
          <select name="bg_bad_sel" size="1" id="bg_bad_sel">
            <option value="0">����ī�װ��� ���̰� �ϱ�</option>
            <option value="1">����ī�װ��� �Ⱥ��̰� �ϱ�</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='bg_bad'" value="Ȯ��">
          &nbsp; 
          <select name="mb_type_sel" id="mb_type_sel">
            <option value="0">�Ϲ�ȸ������</option>
            <option value="1">������ȸ������</option>
            <option value="2">������ȸ������</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='mb_type'" value="Ȯ��">
          &nbsp; 
          <select name="bg_tag_sel" id="bg_tag_sel">
            <option value="0">�Ϲݱ�</option>
            <option value="1">�����ֿ��</option>
          </select>
          <input name="submit2" type="submit" onclick="document.mb_list.act.value='bg_tag'" value="Ȯ��">
        &nbsp; 
        <select name="bg_cat_sel" id="bg_cat_sel">
<?
	reset($cat_info);
	while (list ($key, $R) = each ($cat_info)) {
		echo "<option value=\"$R[bg_cat_num]\">$R[bg_cat_name]</option>";		
	}
?>
        </select>
        <input name="submit22" type="submit" onclick="document.mb_list.act.value='bg_cat'" value="Ȯ��">
        </p> -->
  	</td>
  </tr>
 </form>
</table>
<script language="JavaScript" type="text/JavaScript">
	var f = document.mb_form;
	function formcheck2()
	{
		if(!list_checkbox(document.mb_list,'bg_num[]')) {
			alert('�ϳ� �̻������ּ���.');
			return false;
		}
		return true;
	}
</script>
<? include("admin.footer.php"); ?>