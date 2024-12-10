<?
	$site_path = '../';
	require_once($site_path."include/admin.lib.inc.php");
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
			// 검색어로 검색
			case 0 : 
				if(!empty($kw)) {
					switch ($ss[$ss_key[$i]]) {
						case 0 : 
									$qstr .= " AND `bbs_id` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
						case 1 : 
									$qstr .= " AND `bbs_name` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
						case 2 : 
									$qstr .= " AND `bbs_skin` LIKE '%$kw%'";
									$doc_title = "'$kw' 검색 결과";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 회원구분
				if(!empty($ss[$ss_key[$i]])) {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `bbs_gr_num` ";
				}
				break;
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
	$ostr .= " ORDER BY bbs_gr_num DESC,bbs_num DESC";

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_bbs_cfg`
		WHERE (1=1) $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);
	// 그룹정보읽기
	$dbqry="
		SELECT *
		FROM `$db_table_group_cfg`
	";
	$rs=query($dbqry,$dbcon);
	while($R=mysql_fetch_array($rs)) {
		$group_list[$R[gr_num]]=$R;
	}
?>	
<? include("admin.header.php"); ?>
<? include("admin.menu.php"); ?>
<br>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="37" valign="top" background="images/line.gif" style="padding-top:12">&nbsp;<img src="images/t05.gif" width="77" height="13"></td>
  </tr>
</table>
<br>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_search" method="post" enctype="multipart/form-data" onsubmit='return formcheck1()'>
<input name="act" type="hidden" value="ok">
	<tr> 
		  <td width="200" height="35"> 그룹선택: 
        <select name="ss[1]" id="ss[1]" onChange="mb_search.submit()">
          <option value="">전체</option>
          <?
echo rg_html_option($group_list,'','gr_id',$ss[1])
?>
        </select> </td>
		  <td align="right">검색: 
        <select name="ss[0]" id="ss[0]">
				<?
$ssList = array("게시판아이디","게시판이름","스킨");
for($i=0;$i<count($ssList);$i++) 
if ($i==$ss[0])
echo "<option value='$i' selected>$ssList[$i]</option>";
else
echo "<option value='$i'>$ssList[$i]</option>";
?>
			</select> <input name="kw" type="text" id="kw" value="<?=$kw?>" size="14"> <input type="submit" name="검색" value="검색" style="font-style:normal; font-size:11px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-style:solid; padding-top:2"> 
			<input type="button" value="취소" onclick="location.href='?'" style="font-style:normal; font-size:11px; color:white; line-height:16px; background-color:#404040; border-width:1px; border-style:solid; padding-top:2">
			<input type="button" name="새로고침" value="새로고침" onclick="location.reload()"  style="font-style:돋움; font-size:11px; color:white; line-height:16px; background-color:#2086BB; border-width:1px; border-color:rgb(221,221,221); border-style:solid; padding-top:2"></td>
    </tr>
</form>
</table>
<table width="850" border="0" align="center" cellpadding="0" cellspacing="0">
<form name="mb_list" method="post" enctype="multipart/form-data" onsubmit='return formcheck2()' action="?<?=$p_str?>">
<input name="act" type="hidden" value="">
<input name="page" type="hidden" value="<?=$page?>">
  <tr>
    <td align="center">
        <table width="850" border="1" align="center" cellpadding="3" cellspacing="1" bordercolor="#FFFFFF"  bgcolor="#ADADAD">
          <tr> 
            <td width="1" bgcolor="#F7F7F7">&nbsp; </td>
            <td width="30" height="24" align="center" bgcolor="#f7f7f7"><font color="#333333">NO</font></td>
            <td width="80" align="center" bgcolor="#f7f7f7"><font color="#333333">그룹아이디</font></td>
            <td width="80" align="center" bgcolor="#f7f7f7"><font color="#333333">게시판아이디</font></td>
            <td align="center" bgcolor="#f7f7f7"><font color="#333333">이름</font></td>
            <td width="130" align="center" bgcolor="#f7f7f7"><font color="#333333">스킨</font></td>
            <td width="80" align="center" bgcolor="#f7f7f7"><font color="#333333">개설일</font></td>
            <td width="35" align="center" bgcolor="#f7f7f7"><font color="#333333">분류</font></td>
            <td width="35" align="center" bgcolor="#f7f7f7"><font color="#333333">보기</font></td>
            <td width="35" align="center" bgcolor="#f7f7f7"><font color="#333333">수정</font></td>
            <td width="55" align="center" bgcolor="#f7f7f7"><font color="#333333">기능설정</font></td>
            <td width="35" align="center" bgcolor="#f7f7f7"><font color="#333333">삭제</font></td>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `$db_table_bbs_cfg`
		WHERE (1=1) $qstr
		$ostr
		LIMIT  $page_info[offset],$page_info[rows] ";
	
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
            <td width="1" align="center" bgcolor="#FFFFFF"> <input name="bg_num[]" type="checkbox" id="bg_num[]" value="<?=$R[bg_num]?>">            </td>
            <td height="24" align="center" bgcolor="#FFFFFF"> 
              <?=$no?>            </td>
            <td width="0" align="center" bgcolor="#FFFFFF"> 
              <?=$group_list[$R[bbs_gr_num]][gr_id]?>            </td>
            <td align="center" bgcolor="#FFFFFF"> 
              <?=$R[bbs_id]?>            </td>
            <td bgcolor="#FFFFFF"> 
              <?=$R[bbs_name]?>            </td>
            <td align="center" bgcolor="#FFFFFF"> 
              <?=$R[bbs_skin]?>            </td>
            <td align="center" bgcolor="#FFFFFF"> 
              <?=rg_date($R[bbs_reg_date],'%Y-%m-%d')?>            </td>
            <td align="center" bgcolor="#FFFFFF"><a href="board_category.php?bbs_id=<?=$R[bbs_id]?>" target="category" onclick="open('','category','scrollbars=yes,width=400,height=500')">분류</a></td>
            <td align="center" bgcolor="#FFFFFF"><a href="../list.php?bbs_id=<?=$R[bbs_id]?>" target="_blank">보기</a></td>
            <td align="center" bgcolor="#FFFFFF"><a href="board_edit.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$R[bbs_num]?>">수정</a></td>
            <td align="center" bgcolor="#FFFFFF"><a href="board_edit1.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$R[bbs_num]?>">기능설정</a></td>
            <td align="center" bgcolor="#FFFFFF"><a href="board_delete.php?<?=$p_str?>&page=<?=$page?>&mode=edit&bbs_num=<?=$R[bbs_num]?>">삭제</a></td>
          </tr>
          <?

	}
?>
        </table>
        <? include("navigation.php"); ?> 
        <table border="0" cellspacing="0" cellpadding="0" width="850">
          <tr>
            <td> <a href="board_edit.php?<?=$p_str?>&page=<?=$page?>" title="게시판등록"><img src="images/plus_bbs.gif"  border="0"></a></td>
          </tr>
        </table>
        <!--				
        <p align="center"> 
          <select name="bg_bad_sel" size="1" id="bg_bad_sel">
            <option value="0">메인카테고리에 보이게 하기</option>
            <option value="1">메인카테고리에 안보이게 하기</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='bg_bad'" value="확인">
          &nbsp; 
          <select name="mb_type_sel" id="mb_type_sel">
            <option value="0">일반회원으로</option>
            <option value="1">좋은글회원으로</option>
            <option value="2">요주의회원으로</option>
          </select>
          <input name="submit" type="submit" onclick="document.mb_list.act.value='mb_type'" value="확인">
          &nbsp; 
          <select name="bg_tag_sel" id="bg_tag_sel">
            <option value="0">일반글</option>
            <option value="1">메인주요글</option>
          </select>
          <input name="submit2" type="submit" onclick="document.mb_list.act.value='bg_tag'" value="확인">
        &nbsp; 
        <select name="bg_cat_sel" id="bg_cat_sel">
<?
	reset($cat_info);
	while (list ($key, $R) = each ($cat_info)) {
		echo "<option value=\"$R[bg_cat_num]\">$R[bg_cat_name]</option>";		
	}
?>
        </select>
        <input name="submit22" type="submit" onclick="document.mb_list.act.value='bg_cat'" value="확인">
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
			alert('하나 이상선택해주세요.');
			return false;
		}
		return true;
	}
</script>
<? include("admin.footer.php"); ?>